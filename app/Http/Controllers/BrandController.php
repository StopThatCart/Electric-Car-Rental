<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class BrandController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            abort(403);
        }
        $user =Auth::user();
        if($user->role_id != 1){
            Abort(403);
        }
        return view('brands.index', [
            'brands' => Brand::all()
        ]);

    }

    public function create()
    {
        if (!Auth::check()) {
            abort(403);
        }
        $user =Auth::user();
        if($user->role_id != 1){
            Abort(403);
        }

        return response()->view('brands.create', ['brands' => Brand::all()], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        if (!Auth::check()) {
            abort(403);
        }
        $user =Auth::user();
        if($user->role_id != 1){
            Abort(403);
        }
        return view('brands.edit', ['b' => $brand]);
    }

    public function update(Request $request, Brand $brand)
    {
        if (!Auth::check()) {
            abort(403);
        }
        $user =Auth::user();
        if($user->role_id != 1){
            Abort(403);
        }

        $inputs = ['brand' => $request->input('brand')];
        $rules = ['brand' => 'required|string|unique:brands,brand,|max:50',];

        $validator = Validator::make($inputs,$rules);
        if($validator->fails()){
            return redirect()->back()->with('error', __('brand already exists'))->withStatus(400);
        }

        $input = $request->all();
        $brand->update($input);
        return redirect()->route('brands.index')->with('message', __('edit successful'));


    }


    /**
     * Store a newly created brand.
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            abort(403);
        }
        $user =Auth::user();
        if($user->role_id != 1){
            Abort(403);
        }

        $inputs = ['brand' => $request->input('brand')];
        $rules = ['brand' => 'required|string|unique:brands,brand|max:50',];

        $validator = Validator::make($inputs,$rules);
        if($validator->fails()){
            return redirect()->back()->with('error', __('brand already exists'))->withStatus(400);
        }
         Brand::create($inputs);

        return redirect()->route('brands.index')->with('message', __('create successful'))->withStatus(201);
    }

    public function destroy(Brand $brand)
    {
        if (!Auth::check()) {
            abort(403);
        }
        $user =Auth::user();
        if($user->role_id != 1){
            return redirect()->back()->with('error',403);
        }
        Brand::findOrFail($brand->id);

        if ($brand->id == 1) {
            return redirect()->back()->with('error', __('first brand'))->withStatus(400);
        }
        if (Car::where('brand_id', $brand->id)->exists()) {
        return redirect()->back()->with('error', __('car has brand'))->withStatus(400);
        }
        if (User::where('brand_id', $brand->id)->exists()) {
            return redirect()->back()->with('error', __('user has brand'))->withStatus(400);
        }

        $brand->delete();
        return redirect()->route('brands.index')->with('message', __('delete successful'));
    }
}
