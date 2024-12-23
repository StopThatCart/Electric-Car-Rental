<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Brand;
use App\Models\Offer;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * Jest to na razie tylko szkielet. Potem zajmę się właściwym ustawianiem tego
     * EDIT: No i ustawione.
     */
    public function index()
    {
        $car = new Car();
        $this->authorize('viewAny', $car);
        $cars = Car::with('brand')->orderBy('brand_id')->get();

        return view('cars.index', ['cars' => $cars]);

    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
           $car = new Car();
           $this->authorize('create', $car);

        return response()->view('cars.create', ['brands' => Brand::all()->except(1)]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarRequest $request)
    {
        //$user =Auth::user();
        $car = new Car();
        $this->authorize('create',$car);

        $input = $request->all();
        Car::create($input);

        return redirect()->route('cars.index')->with('message', __('create successful'))->withStatus(201);
    }


    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {

        $car = Car::with('offers')->find($car->id);
        return view('cars.show', [
            'c' => $car
        ]);
    }

    public function car_cards()
    {
        return view('cars.car_cards', [
            'cars' => Car::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        $this->authorize('view', $car);

        return view('cars.edit', ['c' => $car, 'brands'=> Brand::all()->except(1)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        $this->authorize('update', $car);

        $user =Auth::user();
        if(($user->role_id != 1 && $request->brand_id != $user->brand_id) && $request->brand_id != null){
            return redirect()->back()->with('error', __('employee edits brand'))->withStatus(400);
        }

        $input = $request->all();
        $car->update($input);
        return redirect()->route('cars.index')->with('message', __('edit successful'));
    }

    /**
     * Remove the specified resource from storage.
     * $brand = Brand::where('id', $car->brand_id)->get()
     */
    public function destroy(Car $car)
    {
        $this->authorize('delete', $car);

        Car::findOrFail($car->id);

        if (Offer::where('car_id', $car->id)->exists()) {
        return redirect()->back()->with('error', __('car has offers'))->withStatus(400);
        }

        $car->delete();
        return redirect()->route('cars.index')->with('message', __('delete successful'));
    }
}
