<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = 'reviews';

    /**
     * Get the OrderItem that owns the Review
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }
}
