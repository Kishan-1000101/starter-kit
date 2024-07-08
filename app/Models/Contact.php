<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tier_id',
        'company_id',
        'company_position',
        'contact_type_id',
        'title',
        'firstname',
        'lastname',
        'email',
        'fixed_phone',
        'mobile_phone',
        'address_id',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function tier()
    {
        return $this->belongsTo(Tier::class);
    }

    public function contactType()
    {
        return $this->belongsTo(ContactType::class);
    }
}
