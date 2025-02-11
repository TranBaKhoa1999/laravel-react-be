<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsLineItem extends Model
{
    use HasFactory;

    protected $fillable = ['campaign_id', 'name', 'position_key', 'page_slug', 'position_x', 'position_y', 'allowed_sizes', 'target'];

    protected $casts = [
        'allowed_sizes' => 'array',
        'target' => 'array',
    ];

    public function campaign()
    {
        return $this->belongsTo(AdsCampaign::class);
    }

    public function adSets()
    {
        return $this->hasMany(AdsSet::class);
    }
}
