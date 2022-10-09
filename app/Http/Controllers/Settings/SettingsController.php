<?php

namespace App\Http\Controllers\Settings;

use App\Answer;
use App\Category;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Question;
use App\Tag;
use App\User;
use Facade\Ignition\QueryRecorder\Query;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function createTag()
    {
        return view('questions.tags');
    }

    public function storeTag(Request $request)
    {
        $validate = $request->validate([
            'tag' => 'string'
        ]);

        Tag::create(['name' => $request->tag ]);

        return back();
    }

    public function filter($filter)
    {
        switch ($filter) {
            case 'all':
                $questions = Question::with('user')->paginate(20);
                break;
            case 'published':
                $questions = Question::with('user')->where('status','approved')->get();
                break;
            
            case 'pending':
                $questions = Question::with('user')->where('status',$filter)->get();
                break;
            case 'private':
                $questions = Question::with('user')->where('question_type',$filter)->get();
                break;
        }
        

        return view('admin.filters',compact('questions'));
    }

    public function createCategory()
    {
        $categories = Category::all();
        return view('questions.category', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $validate = $request->validate([
            'name' => 'string',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => str_replace(" ","-",$request->name)
        ]);   

        return back();
    }

    public function editCategory($id)
    {
        $category = Category::where('id',$id)->first();

        return view('admin.edit-categories',compact('category'));
    }

    public function updateCategory(Request $request,$id)
    {
    
        Category::where('id',$id)->update([
            'name' => $request->name,
            'slug' => str_replace(" ","-",$request->name)
        ]);

        return back();
    }

    public function deleteCategory($id)
    {
        Category::where('id',$id)->delete();

        return back();
    }

    public function addQuestion()
    {
        $categories = Category::select('id','name')->get();
        $question = Question::all();
        return view('admin.add-question',compact('categories','question'));
    }

    public function editQuestion($id)
    {
        $quest = Question::where('id',$id)->first();
        $categories = Category::select('id','name')->get();
        $question = Question::all();
        return view('admin.edit-question',compact('categories','question','quest'));
    }

    public function updateQuestion(Request $request,$id)
    {
        
        $request->validate([
            'title' => 'string|nullable',
            'question' => 'string|nullable',
            'status' => 'numeric|nullable',
            'category' => 'numeric|nullable',
            'tag' => 'string|nullable'
        ]);

        
        $quest = Question::where('id',$id)->first();
        $quest->title = $request->title;
        $quest->category_id = $request->category;
        $quest->question = $request->question;
        $quest->status = $request->status;
        $quest->tag = $request->tag;
        $quest->save();

        return redirect()->route('dashboard');
    }

    public function deleteQuestion($id)
    {
        Question::where('id',$id)->delete();
        return redirect()->route('dashboard');
    }

    public function question()
    {
        $questions = Question::with('user')->get();
        
        return view('admin.questions', compact('questions'));
    }

    public function showQuestion($id)
    {
        $question = Question::with('user')->where('id',$id)->first();
        
        return view('admin.question', compact('question'));
    }

    public function storeQuestion(Request $request)
    {
        $request->validate([
            'name' => 'string',
            'email' => 'email',
            'title' => 'string',
            'question' => 'string',
            'status' => 'numeric',
            'category' => 'numeric',
            'tag' => 'string'
        ]);

        $user = User::where('email', $request->email)->first();
        
        if ($user == null) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'type' => 'admin',
                'ip' => $request->ip()
            ]);  
        }

        Question::create([
            'user_id' => $user->id,
            'category_id' => $request->category,
            'title' => $request->title,
            'question' => $request->question,
            'slug' => str_replace(" ","-",$request->title),
            'question_type' => $request->status == 1 ? 'public' : 'private',
            'tag' => $request->tag
        ]);

        return back();
    }

    public function answer()
    {   
        $answers = Answer::with('user','question')->get();
        return view('admin.answers', compact('answers'));
    }

    public function showAnswer($id)
    {
        $answer = Answer::with('user','question')->where('id',$id)->first();
        
        return view('admin.answer', compact('answer'));
    }

    public function comment()
    {
        $comments = Comment::with('user','answer')->get();
        return view('admin.comments', compact('comments'));
    }

    public function showComment($id)
    {
        $comment = Comment::with('user','answer')->where('id',$id)->first();
        
        return view('admin.comment', compact('comment'));
    }

    public function approveQuestion(Request $request)
    {
        Question::where('id',$request->question)->update([
            'status' => 'approved'
        ]);

        return back();
    }

    public function approveAnswer(Request $request)
    {
        Answer::where('id',$request->answer)->update([
            'status' => 'approved'
        ]);

        return back();
    }

    public function approveComment(Request $request)
    {
        Comment::where('id',$request->comment)->update([
            'status' => 'approved'
        ]);

        return back();
    }

    public function stageQuestion(Request $request)
    {
        Question::where('id',$request->question)->update([
            'stage' => $request->status
        ]);

        return back();
    }

    public function tags()
    {
        $tags = Question::select('tag')->get()->reject(function($item){
            return $item->tag == null;
        });
        $questions = Question::all()->reject(function($item){
            return $item->tag == null;
        });

        return view('admin.tags', compact('tags','questions'));
    }

    public function showTags($tag)
    {
        
        $questions = Question::all()->reject(function($item){
            return $item->tag == null;
        });
        
        $tags = Question::where('tag',$tag)->get()->reject(function($item){
            return $item->tag == null;
        });

        return view('admin.question-tags', compact('tags','questions'));
    }

    public function editTag($tag)
    {
        $tag = Question::where('tag',$tag)->first();

        return view('admin.edit-tag',compact('tag'));
    }

    public function updateTag(Request $request,$id)
    {
        Question::where('tag',$id)->get()->map( function ($item) use ($request){

            $item->tag = $request->name;
            $item->save();
        });

        return redirect()->route('tags');
    }

    public function deleteTag($id)
    {
        Question::where('tag',$id)->get()->map( function ($item){
            $item->tag = null;
            $item->save();
        });

        return redirect()->route('tags');
    }
}
