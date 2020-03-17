<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Tag;
use App\Category;

class Subcategory extends Model
{
    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }


}
