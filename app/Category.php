<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Subcategory;
use App\User;

class Category extends Model
{
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }

    public function users()
    {
        return $this->hasMany(belongsToMany::class, 'categories_users', 'category_id', 'user_id');
    }
}
