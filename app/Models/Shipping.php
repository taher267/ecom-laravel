<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $table = 'shippings';

     /**
      * Get the Order that owns the Shipping
      *
      * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
      */
     public function order()
     {
         return $this->belongsTo(Order::class);
     }
}
