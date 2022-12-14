<?php

namespace App\Http\Controllers;

use App\Category;
use App\Question;
use App\Tag;
use App\User;
use App\View;
use App\Vote;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function create()
    {
        $categories = Category::select('id','name')->get();

        return view('questions.new-question',compact('categories'));
    }

    public function store(Request $request)
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
                'ip' => '127.0.0.2'
            ]);  
        }

        Question::create([
            'user_id' => $user->id,
            'category_id' => $request->category,
            'title' => $request->title,
            'question' => $request->question,
            'question_type' => $request->status == 1 ? 'public' : 'private',
            'tag' => $request->tag,
            'slug' => str_replace(" ","-",$request->title)
        ]);

        return redirect()->route('pending','question');
    }

    public function show($slug)
    {
        $question = Question::with('answer')->where('slug',$slug)->where('status','approved')->first();

        View::create([
            'user_id' => request()->ip(),
            'question_id' => $question['id'],
            'type' => 'question'
        ]);

        return view('questions.single', compact('question'));
    }

    public function questionCategory($slug)
    {
        $category = Category::select('id','name','slug')->where('slug',$slug)->firstOrFail();
        
        $categories = Category::select('id','name','slug')->get();
        $questions = Question::where('category_id',$category->id)->where('status','approved')->get();

        return view('questions.categories',compact('questions','categories'));
    }

    public function questionFilter($filter)
    {
        switch ($filter) {
            case 'all':
                $questions = Question::paginate(20);
                break;
            case 'open':
                $questions = Question::where('stage',$filter)->get();
                break;
            
            case 'resolved':
                $questions = Question::where('stage',$filter)->get();
                break;
            case 'closed':
                $questions = Question::where('stage',$filter)->get();
                break;
            case 'unanswered':
                $questions = Question::all()->reject( function($items){
                    return $items->answer == null;
                });
                break;
        }
        $categories = Category::select('id','name','slug')->get();
        

        return view('questions.filters',compact('questions','categories'));
    }

    public function modal()
    {
        return view('questions.modal');
    }

    public function dashboard()
    {
        return view('questions.dashboard');
    }

    public function upvote(Request $request)
    {
        $user = User::select('id')->where('ip',$request->ip())->first();
        
        if(!Vote::where('user_id',$request->ip())
        ->where('type', $request->type)->where('question_id',$request->question)->exists()){
            Vote::create([
                'user_id' => $request->ip(),
                'question_id' => $request->question,
                'type' => $request->type
            ]);
        }
        return back();
    }

    public function downvote(Request $request)
    {
        $user = User::select('id')->where('ip',$request->ip())->first();

        if(Vote::where('user_id',$request->ip())->where('question_id', $request->question)->exists()){
            Vote::where('user_id', $request->ip())->where('type',$request->type)->delete();
        }

        return back();
    }

    public function pending($hint)
    {
        $categories = Category::select('id','name')->get();

        return view('questions.pending',compact('hint','categories'));
    }
}
