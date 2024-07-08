<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Segmentation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'price_rule',
    ];

    protected $casts = [
        'price_rule' => 'array',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_segmentation');
    }
}
