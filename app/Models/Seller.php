<?php

namespace App\Models;

use App\Models\Product;
use App\Models\User;
use App\Scopes\SellerScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seller extends User
{
    use HasFactory;


    public function products()
    {
        return $this->hasMany(Product::class);
    }

    protected static function booted()
    {
        parent::booted();
        static::addGlobalScope(new SellerScope);
    }
}
