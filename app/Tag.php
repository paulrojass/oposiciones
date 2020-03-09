<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Category;
use App\Question;

class Tag extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'question_tags', 'tag_id', 'question_id');
    }
}
