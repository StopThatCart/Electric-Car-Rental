<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Car;
use App\Models\Brand;
use App\Models\Offer;
use App\Models\Rent;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use PDO;

class UserController extends Controller
{

    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('users.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([

            'email' => ['required','email:rfc','exists:users,email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => __('wrong email or password'),
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    public function register()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('users.register');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $this->authorize('view', $user);
        $users = User::with('brand')->get();
        return view('users.index', [
            'users' => $users
        ]);


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        if (Hash::check($request->password2, $request->password)) {
            return back()->withErrors([
                __('password2') => __('not match'),
            ])->withInput();
        }
        $user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role_id' => 3,
        ]);

        Auth::login($user);
        $request->session()->regenerate();
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $this->authorize('viewSelf', $user);
        return view('users.show', [
            'u' => $user, 'brands' => Brand::find($user->brand_id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {

        $this->authorize('view', $user);
        $user2 = Auth::user();

        if ($user2->role_id != 1) {
            return redirect()->route('users.index');
        }

        return view('users.edit', ['u' => $user],['brands'=> Brand::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user_2 = Auth::user();
        $this->authorize('update', $user);
        $input = $request->all();
        if ($user->role_id == 1) {
            $email = $request->email;
            $name = $request->name;
            $user->update([
                'email' => $email,
                'name' => $name,
            ]);

            return redirect()->route('users.index')->with('message', __('edit successful'));
        }

        if($request->role_id == 1){
            return redirect()->back()->with('error', __('no more admins'));
        }
        if($user->role_id == 2){
            if ($request->role_id != 2 && $request->brand_id != 1) {
                return redirect()->back()->with('error',  __('employee to user'));
            }
        }
        if($user->role_id == 3){
            if ($request->role_id != 3 && $request->brand_id == 1) {
                return redirect()->back()->with('error',  __('user to employee'));
            }
            if (Rent::where('user_id', $user->id)->exists() && $request->role_id != $user->role_id) {
                return redirect()->back()->with('error', __('change role when has rents'));
            }
            if ($request->brand_id != 1) {
                return redirect()->back()->with('error', __('brand to user'));
            }
        }

        $user->update($input);
        return redirect()->route('users.index')->with('message', __('edit successful'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        User::findOrFail($user->id);

        $states = Rent::get_states();

        if (Rent::where('user_id', $user->id)
        ->whereNotIn('state', [$states[3], $states[4]])
        ->exists()) {
        return redirect()->back()->with('error', __('user has active rents'));
        }
        $user_2 = Auth::user();

        if ($user_2->role_id != 1) {
            Auth::logout();
            $user->delete();
            Session::invalidate();
            Session::regenerateToken();
            return redirect()->route('home');
        }
        $user->delete();
        return redirect()->route('users.index')->with('message', __('delete successful'));
    }
}
