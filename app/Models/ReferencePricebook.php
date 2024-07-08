<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferencePricebook extends Model
{
    use HasFactory;

    protected $table = 'reference_pricebooks';

    protected $fillable = [
        'pricebook_id',
        'reference_id',
    ];

    public function pricebook()
    {
        return $this->belongsTo(Pricebook::class);
    }

    public function reference()
    {
        return $this->belongsTo(Reference::class);
    }
}
