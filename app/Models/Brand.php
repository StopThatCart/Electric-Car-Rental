<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = [
        'brand'
    ];

    public function cars()
    {
        return $this->hasMany(Car::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
