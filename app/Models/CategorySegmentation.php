<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorySegmentation extends Model
{
    use HasFactory;

    protected $table = 'category_segmentation';

    protected $fillable = [
        'category_id',
        'segmentation_id',
    ];

    public $timestamps = false; // Disable timestamps
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function segmentation()
    {
        return $this->belongsTo(Segmentation::class);
    }
}