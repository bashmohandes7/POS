<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded= [];

    public function client()
    {
        return $this->belongsTo(Client::class);
    } // end of client

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_order')->withPivot('quantity');
    } // end of products

    // search by client name
    public function scopeWhenSearch($query, $search)
    {
        return $query->whereHas('client', function ($q) use ($search) {

            return $q->where('name', 'like', '%' . $search . '%');
        }); // end of return

    }// end of scopeWhenSearch
}
