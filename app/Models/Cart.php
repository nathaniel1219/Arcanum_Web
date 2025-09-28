<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];
    protected $table = 'cart';

    // Cart belongs to user (User is in same namespace App\Models)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Cart has many items (canonical name)
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
}
