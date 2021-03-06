<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    /**
     * Get the category that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    /**
     * The categories that belong to the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pro_categories()
    {
        return $this->belongsToMany(Category::class, 'product_category');
    }

    /**
     * Get all of the OrderItems for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function OrderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }
}
