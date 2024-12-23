<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = ['brand_id', 'model', 'description','description_en', 'year','battery','seats','gear','img'];

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}

