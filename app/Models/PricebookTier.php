<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricebookTier extends Model
{
    protected $table = 'pricebook_tier';
    public $timestamps = false;

    protected $fillable = [
        'pricebook_id',
        'tier_id',
        'start',
        'end',
    ];

    public function pricebook()
    {
        return $this->belongsTo(Pricebook::class);
    }

    public function tier()
    {
        return $this->belongsTo(Tier::class);
    }
}
