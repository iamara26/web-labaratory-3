<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        
    ];

    /**
     * Define a relationship with the Product model.
     * Assuming a category has many products.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
