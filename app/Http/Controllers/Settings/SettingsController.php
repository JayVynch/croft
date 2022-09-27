<?php

namespace App\Http\Controllers\Settings;

use App\Answer;
use App\Category;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Question;
use App\Tag;
use App\User;
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

    public function createCategory()
    {
        return view('questions.category');
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

    public function addQuestion()
    {
        $categories = Category::select('id','name')->get();
        $question = Question::all();
        return view('admin.add-question',compact('categories','question'));
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
        $tags = Question::select('tag')->get();
        $questions = Question::all();
        return view('admin.tags', compact('tags','questions'));
    }

    public function showTags($tag)
    {
        
        $questions = Question::all();
        $tags = Question::where('tag',$tag)->get();

        return view('admin.question-tags', compact('tags','questions'));
    }
}
