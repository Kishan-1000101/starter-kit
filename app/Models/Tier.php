<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tier extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'segmentation_id',
        'tier_id',
        'tier_type_id',
        'tierable_type',
        'tierable_id',
    ];

    public function tierType()
    {
        return $this->belongsTo(TierType::class,'tier_type_id');
    }

    public function segmentation()
    {
        return $this->belongsTo(Segmentation::class,'segmentation_id');
    }
}
