<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'order_items';

    /**
     * Get the order that owns the OrderItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the Product that owns the OrderItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the review that owns the OrderItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function review()
    {
        return $this->hasOne( Review::class, 'order_item_id' );
    }

}
