<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceMeta extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'full_name',
        'display_order',
        'devise_symbole',
        'devise_name',
        'devise_rate',
        'devise_rule',
    ];
}
