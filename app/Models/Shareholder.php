<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shareholder extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'tier_id',
        'start',
        'end',
    ];

    // Define the relationship with the Tier model
    public function tier()
    {
        return $this->belongsTo(Tier::class);
    }
}