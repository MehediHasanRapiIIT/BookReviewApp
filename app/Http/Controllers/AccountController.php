<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    //This method will show registration page
    public function register(){
        return view('account.register');
    }

    public function processRegister(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:5',
            'password_confirmation' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->route('account.register')->withInput()->withErrors($validator);
        }

        // Registration logic goes here (e.g., saving user to database)
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('account.login')->with('success', 'Registration successful! Please log in.');
    }

    public function login(){
        return view('account.login');
    }

    public function authenticate(Request $request){
        // Authentication logic goes here
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->route('account.login')->withInput()->withErrors($validator);
        }

        // Authentication logic goes here
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            // Authentication passed...
            return redirect()->route('account.profile');
        } else {
            return redirect()->route('account.login')->with('error','Either email or password is incorrect.');
        }

    }


    // Profile page
    public function profile(){
        $user = User::find(Auth::user()->id);
        return view('account.profile',[
            'user' => $user
        ]);
    }

    //update profile
    public function updateProfile(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,'.Auth::user()->id.',id',
        ]);

        if($validator->fails()){
            return redirect()->route('account.profile')->withInput()->withErrors($validator);
        }

        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        // Image upload logic can be added here
        $user->save();
        return redirect()->route('account.profile')->with('success', 'Profile updated successfully.');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('account.login')->with('success', 'You have been logged out successfully.');
    }
}
