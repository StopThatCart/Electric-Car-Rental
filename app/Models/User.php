<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'brand_id',
        'name',
        'email',
        'password',
        'role_id',
    ];

    protected $attributes = [
        'brand_id' => '1',
        'role_id' => '3',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function rents()
    {
        return $this->hasMany(Rent::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

}
