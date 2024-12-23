<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RentController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\UserController;

use App\Models\Rent;
use App\Models\Car;
use App\Models\Offer;
use App\Models\Brand;

use App\Http\Controllers\LanguageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $cars = Car::with('brand')->inRandomOrder()->limit(4)->get();
    $offers = Offer::with('car')->orderBy('price')->where('period', 3)->get();
    return view('index',['cars' => $cars,
    'offers' => $offers
    ]);
})->name('home');


// Route::controller(OfferController::class)->group(function () {
//     Route::get('/offers/indexes', 'indexes')->name('offers.indexes');
// });

Route::controller(UserController::class)->group(function () {
    Route::get('/users/login', 'login')->name('login');
    Route::post('/users/login', 'authenticate')->name('login.authenticate');
    Route::get('/users/logout', 'logout')->name('logout');
    Route::get('/users/register', 'register')->name('register');
    Route::post('/users/register', 'store')->name('register.store');
});


Route::controller(CarController::class)->group(function () {
    Route::get('/cars/car_cards', 'car_cards')->name('cars.car_cards');
});

//Route::resource('trips', TripController::class);
Route::resource('rents', RentController::class);
Route::resource('brands', BrandController::class);
Route::resource('cars', CarController::class);
Route::resource('offers', OfferController::class);
Route::resource('users', UserController::class);

Route::get('locale/{lang}', [LanguageController::class,'setLang'])->name('locale');
