<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable = [
        'segmentation_id',
        'base_amount',
        'price_meta_id',
    ];

    public function segmentation()
    {
        return $this->belongsTo(Segmentation::class);
    }

    public function priceMeta()
    {
        return $this->belongsTo(PriceMeta::class);
    }
}

