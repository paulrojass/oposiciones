<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Subcategory;
use App\Question;

class Tag extends Model
{
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'question_tags', 'tag_id', 'question_id');
    }
}
