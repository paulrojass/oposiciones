<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Tag;

class Category extends Model
{
    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
}
