<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductItem extends Model
{
    use HasFactory;

    protected $table = 'product_items';

    protected $fillable = [
        'product_id',
        'item_id',
        'item_value',
    ];
    
    public $timestamps = false; // Disable timestamps

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
