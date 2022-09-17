<?php

namespace App;

use App\answer;
use App\User;
use App\Category;
use App\Tag;
use App\View;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $fillable = [
        'user_id',
        'tag',
        'category_id',
        'title',
        'question_type',
        'status',
        'question',
        'slug'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tag()
    {
        return $this->hasMany(Tag::class);
    }

    public function answer()
    {
        return $this->hasMany(Answer::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class,'id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class,'question_id');
    }

    public function views()
    {
        return $this->hasMany(View::class);
    }
}
