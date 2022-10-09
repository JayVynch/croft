<?php

namespace App\Http\Controllers;

use App\Answer;
use App\User;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'email',
            'name' => 'string',
            'question' => 'numeric',
            'answer' => 'string',
        ]);

        $user = User::where('email',$request->email)->first();

        
        if ($user == null) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'ip' => $request->ip()
            ]);  
        }

        Answer::create([
            'user_id' => $user->id,
            'answer' => $request->answer,
            'question_id' => $request->question,
        ]);

        return redirect()->route('pending','answer');
    }
    
    public function editAnswer($id)
    {
        $answer = Answer::where('id',$id)->first();

        return view('admin.edit-answer', compact('answer'));
    }

    public function updateAnswer(Request $request, $id)
    {
        $answer = Answer::where('id',$id)->first();

        $answer->answer = $request->answer;
        $answer->save();

        return redirect()->route('set.answer');
    }

    public function deleteAnswer($id)
    {
        Answer::where('id',$id)->delete();
        return redirect()->route('set.answer');
    }
}
