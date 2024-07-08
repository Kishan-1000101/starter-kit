<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'code',
        'parent',
    ];

    // Optional: Define relationships if any
    public function children()
    {
        return $this->hasMany(Technology::class, 'parent', 'id');
    }
}
