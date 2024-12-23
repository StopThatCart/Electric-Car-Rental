<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $fillable = ['car_id','period', 'price'];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function rents()
    {
        return $this->hasMany(Rent::class);
    }
}
