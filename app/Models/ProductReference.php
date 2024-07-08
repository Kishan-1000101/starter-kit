<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReference extends Model
{
    use HasFactory;

    protected $table = 'product_references';

    protected $fillable = [
        'product_id',
        'reference_id',
    ];

    public $timestamps = false; // Disable timestamps

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function reference()
    {
        return $this->belongsTo(Reference::class);
    }    
}
