<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'lxn_id',
        'street',
        'street_no',
        'building',
        'floor',
        'apartment',
        'district',
        'zip_code',
        'city',
        'country_alpha3',
        'latitude',
        'longitude',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_alpha3', 'alpha3');
    }
}
