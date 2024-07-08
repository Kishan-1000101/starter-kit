<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShareholderMeta extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'comment',
    ];
    
    public function shareholders()
    {
        return $this->hasMany(Shareholder::class, 'id');
    }
}
