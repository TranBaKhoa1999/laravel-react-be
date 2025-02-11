<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsCampaign extends Model
{
    use HasFactory;

    protected $fillable = ['advertiser_id', 'name', 'start_date', 'end_date', 'status'];

    public function advertiser()
    {
        return $this->belongsTo(AdsAdvertiser::class);
    }

    public function lineItems()
    {
        return $this->hasMany(AdsLineItem::class);
    }
}
