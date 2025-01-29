<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'stock', 'sku', 'image', 'category_id'
    ];


    /**
     * Get the category that owns the product.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Scope a query to only include products of a given category.
     */
    public function scopeOfCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    /**
     * Mutator to format the price attribute.
     */
    public function getPriceAttribute($value)
    {
        return number_format($value, 2);
    }

    /**
     * Mutator to set the product name with first letter capitalized.
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst($value);
    }
}
