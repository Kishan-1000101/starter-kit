<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reference extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'description',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Product::class, 'category_id', 'category_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_references')->withPivot('item_value');
    }
}
