<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['name', 'description'];
    protected $appends = ['image_path', 'profit_percent'];
    protected $fillable = ['category_id', 'image', 'purchase_price', 'sale_price', 'stock'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    } // end of category relationship


    public function getImagePathAttribute()
    {
        return asset('uploads/product_images/' . $this->image);
    } // end of getImagePathAttribute

    public function getProfitPercentAttribute()
    {
        $profit = $this->sale_price - $this->purchase_price;
        $profit_percent = $profit * 100 / $this->purchase_price;
        return round($profit_percent, 2);
    } // end of getProfitPercentAttribute

    // search by product name
    public function scopeWhenSearch($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {

            return $q->whereTranslationLike('name', "%{$search}%");
        });

    }// end of scopeWhenSearch

    // filter by category_id
    public function scopeFilter($query, $category)
    {
        return $query->when($category, function ($q) use ($category)
        {
            return $q->where('category_id', $category);
        });
    }


} // end of model
