<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Test extends Model
{
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}


