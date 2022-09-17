<?php

namespace App\Http\Controllers;

use App\Comment;
use App\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string',
            'email' => 'email',
            'answer' => 'numeric',
            'comment' => 'string',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user == null) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email
            ]);  
        }

        Comment::create([
            'user_id' => $user->id,
            'comment' => $request->comment,
            'answer_id' => $request->answer,
        ]);

        return redirect()->route('pending','comment');;
    }
}
