<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsAdvertiser extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'company'];

    public function campaigns()
    {
        return $this->hasMany(AdsCampaign::class);
    }
}
