<?php

namespace App;

use App\Question;
use App\User;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $table = 'views';
    
    protected $fillable = [
        'user_id',
        'question_id',
        'type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
