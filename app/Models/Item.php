<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'display_name',
        'type',
        'input_type',
        'values',
        'rules',
        'disabled',
        'prefix',
        'suffix',
        'groupingKey',
        'parent'
    ];

    protected $attributes = [
        'type' => 'string',
        'input_type' => 'text',
        'disabled' => '0',
        'groupingKey' => '*',
 
    ];
        // Optional: Define relationships if any
    public function children()
    {
        $this->hasMany(Item::class, 'parent', 'id');
    }
}