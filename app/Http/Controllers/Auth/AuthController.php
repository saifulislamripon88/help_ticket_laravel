<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{


    public function login(){
        return view('Auth.login');
    }

    public function register(Request $request){

    // validation -------------------------------
        $validated = $request->validate([
            'name' => 'required|max:40',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ],[
           'email.unique' => 'Email already exists. Please use a different email address'
        ]);


    //insert form ----------------------------------

    $newRegistration = DB::table('users')->insert([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'created_at' => now(),
        'updated_at' => now()
    ]);

    if($newRegistration){
        return redirect()->route('view.login');
    }


    }




    // code for login -------------------------------
    public function loginUser(Request $request){

        $loginValidation = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $loginValidation['email'],
            'password' => $loginValidation['password'],
        ];

        $remember = $request->has('remember');

        if(Auth::attempt($credentials, $remember)){
            return redirect()->intended('ticket');

        }else{
            return back()->withErrors([
                'password' => 'The provided credentials do not match records',
            ])->onlyInput('password');

        }
        

    }



    // logout -------------------------------------
    public function logout(Request $request){
        Auth::logout();
        return redirect()->route('view.login');
    }

}
