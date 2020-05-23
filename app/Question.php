<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Tag;
use App\Answer;

class Question extends Model
{
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'question_tags', 'question_id', 'tag_id');
    }

    public function answers()
    {
    	return $this->hasMany(Answer::class);
    }


/*Query Scopes*/
	public function scopeTags(Builder $query, $busqueda)
	{
		if($busqueda){
			return $query->where('title', 'LIKE', '%'.$busqueda.'%');
		}
	}



}
