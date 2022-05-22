<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    use Translatable;

    public $translatedAttributes = ['name'];
    protected $guarded= [];

    public function scopeWhenSearch($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {

            return $q->whereTranslationLike('name', "%{$search}%");
        });

    }// end of scopeWhenSearch
}
