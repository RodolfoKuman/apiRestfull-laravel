<?php

namespace App;

use App\Buyer;
use App\Product;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    protected $dates = ['deleted_at'];
    protected $fillable = [
      'quantity',
      'buyer_id',
      'product_id',
    ];

    public function buyer()
    {
      return $this->belongsTo(Buyer::class);
    }

    public function product()
    {
      return $this->belongsTo(Product::class);
    }
}
