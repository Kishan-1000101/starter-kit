<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tier_id',
        'name',
        'legal_form',
        'registration_number',
        'vat_number',
        'address_id',
        'fixed_phone',
        'email',
    ];

    public function address()
    {
        return $this->belongsTo(Address::class,'address_id');
    }

    public function tier()
    {
        return $this->belongsTo(Tier::class,'tier_id');
    }
}
