<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsSet extends Model
{
    use HasFactory;

    protected $fillable = ['line_item_id', 'name', 'width', 'height'];

    public function lineItem()
    {
        return $this->belongsTo(AdsLineItem::class);
    }

    public function creatives()
    {
        return $this->hasMany(AdsCreative::class);
    }
}
