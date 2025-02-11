<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsCreative extends Model
{
    use HasFactory;

    protected $fillable = ['ad_set_id', 'content_url', 'click_url', 'status'];

    public function adSet()
    {
        return $this->belongsTo(AdsSet::class);
    }
}
