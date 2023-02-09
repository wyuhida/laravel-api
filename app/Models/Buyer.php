<?php
namespace App\Models;

use App\Models\Transaction;
use App\Models\User;
use App\Scopes\BuyerScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Buyer extends User
{
    use HasFactory;

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    protected static function booted()
    {
        parent::booted();
        static::addGlobalScope(new BuyerScope);
    }
}
