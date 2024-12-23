<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\Offer;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRentRequest;
use App\Http\Requests\UpdateRentRequest;

use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

class RentController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rent = new Rent();
        $this->authorize('viewAny', $rent);
       // $rents = Rent::all();
        $rents = Rent::with('offer', 'user')->orderBy('state')->get();

        return view('rents.index', ['rents' => $rents]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRentRequest $request)
    {
        $user =Auth::user();
        $rent = new Rent();
        $this->authorize('create', $rent);

        $states = Rent::get_states();

        if (Rent::where('user_id', $user->id)
        ->where('state', '!=', 'Returned')->where('state', '!=', 'Canceled')->exists()) {
        return redirect()->back()->with('error', __('your rent is active'))->withStatus(400);
        }

        $input = $request->all();
        $f = Offer::findOrFail($input['offer_id']);

        $input['offer_id'] = $f->id;
        $input['user_id'] = Auth::user()->id;
        $input['cost'] = $f->price;
        $input['date_rent'] = \Carbon\Carbon::now()->toDateString();
        $input['date_return'] = \Carbon\Carbon::now()->addDays($f->period)->toDateString();
        $input['state'] = $states[0];
        Rent::create($input);

        return redirect()->route('rents.index')->withStatus(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Rent $rent)
    {
            $due = false;
            $state = $rent->state;
            $state_next = null;

            $states = Rent::get_states();

            $currentIndex = array_search($state, $states);

        if ($currentIndex !== false) {
             $nextIndex = ($currentIndex + 1) % count($states);
             $state_next = $states[$nextIndex];
        }

        //Jeśli są zaległe dni, to zmienia się koszt widoczny
        $zalegle = Rent::rent_due($rent);
        if($zalegle[2]){
            $rent->cost = $zalegle[1];
            $due = true;
        }

        return view('rents.show', [
            'r' => $rent,
            'previous' => $state,
            'next' => $state_next,
            'due' => $due
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRentRequest $request, Rent $rent)
    {
        $this->authorize('update', $rent);
        $state_r = $request->state;
        $state = $rent->state;
        $states = Rent::get_states();
        $currentIndex = array_search($state, $states);
        $input = $request->all();

        if($state_r == $states[4] && $currentIndex >= 2){
            return redirect()->back()->with('error', __('cancel error'))->withStatus(400);
        }
        if($state == $states[3] || $state==$states[4]){
            return redirect()->back()->with('error', __('already returned or canceled'))->withStatus(400);
        }
        if ($state == $states[2]) {
            $zalegle = Rent::rent_due($rent);
            if($zalegle[2]){
                $input['cost'] = $zalegle[1];
                if($zalegle[0] > 30){
                    $input['state'] = $states[4];
                    $rent->update($input);
                    return redirect()->back()->with('error', __('over 30 days'))->withStatus(400);
                }
            }
            $input['date_return'] = Carbon::now()->toDateString();
        }else if ($state == $states[1]) {
            if(Carbon::now()->isAfter($rent->date_return)){
                $input['state'] = $states[4];
                $rent->update($input);
                return redirect()->back()->with('error', __('cannot be rented after date return'))->withStatus(400);
            }else if(Carbon::now()->isAfter($rent->date_rent)){
                $date_rent = Carbon::parse($rent->date_rent);
                $date_return = Carbon::parse($rent->date_return);
                $diff = $date_return->diffInDays($date_rent);
                $input['date_rent'] = Carbon::now()->toDateString();
                $input['date_return'] = Carbon::now()->addDays($diff)->toDateString();

            }
        }
        $rent->update($input);
        return redirect()->back()->with('message', __('edit successful'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rent $rent)
    {
       $this->authorize('delete', $rent);
       Rent::findOrFail($rent->id);
       $states = Rent::get_states();

        if ($rent->state == $states[3] || $rent->state == $states[4]) {
            $rent->delete();
            return redirect()->route('rents.index')->with('message', __('delete successful'));
        }
        return redirect()->back()->with('error', __('rent is active'))->withStatus(400);
    }


}
