<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Rent extends Model
{
    use HasFactory;
    protected $fillable = ['offer_id','user_id','cost','date_rent','date_return', 'state'];

    public static function get_states(){
        return ['In progress', 'Waiting for you', 'Rented', 'Returned', 'Canceled'];
    }

    public static function rent_due(Rent $rent){
        $cost = $rent->cost;
        $date_return = Carbon::parse($rent->date_return);
        $days_due = Carbon::now()->diffInDays($date_return);
        $due = false;

        if($days_due > 0 && Carbon::now()->isAfter($date_return) && $rent->state =='Rented'){
            $cost = round($cost + $cost * (30/100) * $days_due, 2);
            $due = true;
        }

        $wynik = array($days_due, $cost, $due);

        return $wynik;
    }
    public static function is_rent_due(Rent $rent){
        $date_return = Carbon::parse($rent->date_return);
        $days_due = Carbon::now()->diffInDays($date_return);

        if($days_due > 0 && Carbon::now()->isAfter($date_return) && $rent->state =='Rented'){
            return true;
        }
        return false;
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
