<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Rent;
use App\Models\Car;
use App\Models\Offer;
use App\Models\Brand;
use App\Http\Requests\StoreOfferRequest;
use App\Http\Requests\UpdateOfferRequest;

use App\Http\Controllers\CarController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class OfferController extends Controller
{
    public function index()
    {
        $offer = new Offer();
        $this->authorize('viewAny',$offer);

        $offers = Offer::with('car')->orderBy('car_id')->get();
        return view('offers.index', ['offers' => $offers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $offer = new Offer();
        $this->authorize('create', $offer);

        return response()->view('offers.create', ['cars' => Car::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOfferRequest $request)
    {

        $user =Auth::user();
        $car = Car::find($request->car_id);
        $number = Offer::where('car_id', $request->car_id)->count();
        if($number >= 6){
            return redirect()->back()->with('error', __('above 6 offers'))->withStatus(400);
        }
        if($user->role_id != 1 &&  $car->brand_id != $user->brand_id){
            return redirect()->back()->with('error', __('brand id other than cars brand id'))->withStatus(400);
        }

        $input = $request->all();
        Offer::create($input);

        return redirect()->route('offers.index')->with('message', __('create successful'))->withStatus(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Offer $offer)
    {
        $carC= new CarController();
        return $carC->show(Car::find($offer->car_id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    //public function edit(Offer $Offer)

    public function edit(Offer $offer)
    {
        $this->authorize('view', $offer);

        Offer::findOrFail($offer->id);

        return view('offers.edit', ['o' => $offer,'cars' => Car::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOfferRequest $request, Offer $offer)
    {
        $this->authorize('update', $offer);

      //  $offer->car->brand_id

        $user =Auth::user();
        $car = Car::find($request->car_id);
        if($user->role_id != 1 &&  $car->brand_id != $user->brand_id){
            return redirect()->back()->with('error', __('brand id other than cars brand id'))->withStatus(400);
        }

        $input = $request->all();
        $offer->update($input);
        return redirect()->route('offers.index')->with('message', __('edit successful'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offer $offer)
    {
        $this->authorize('delete', $offer);

        Offer::findOrFail($offer->id);

        if (Rent::where('offer_id', $offer->id)->exists()) {
            return redirect()->back()->with('error', __('offer has rents'))->withStatus(400);
            }

        $offer->delete();
        return redirect()->route('offers.index')->with('message', __('delete successful'));
    }
}
