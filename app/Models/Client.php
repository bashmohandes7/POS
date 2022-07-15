<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'phone' => 'array'
    ];

    public function getNameAttribute($value)
    {
        return Str::title($value);

    }//end of get name attribute

    /* Search by name, phone and address */
    public function scopeWhenSearch($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {

            return $q->where('name', 'LIKE', "%{$search}%")
            ->orWhere('phone', 'LIKE', "%{$search}%")
            ->orWhere('address', 'LIKE', "%{$search}%");
        });
    }// end of scopeWhenSearch

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
