<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'product_name', 'description', 'price',
        'category', 'sub_category', 'image_url', 'details'
    ];

    // Product belongs to many cart items
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    // Product belongs to many order items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
