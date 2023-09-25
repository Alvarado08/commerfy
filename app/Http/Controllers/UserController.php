<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function login(){
        return view('users.login');
    }

    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect('/')->with('message','Logged out succesfully!');
    }

    public function register(){
        return view('users.register');
    }

    public function store(Request $request){
        // Validate Form Fields
        $inputFields = $request->validate([
            'name' => ['required','min:3'],
            'email' => ['required','email', Rule::unique('users','email')],
            'password' => 'required|confirmed|min:6'
        ]);
        // Hash Password
        $inputFields['password'] = bcrypt($inputFields['password']);
        // Create User  
        $user = User::create($inputFields);
        // Create User Session
        auth()->login($user);
        // Return view & flash a message to user that he has created account and is logged in
        return redirect('/')->with('message', 'User created and logged in!');
    }

    public function authenticate(Request $request){
        // Validate Form Fields
        $inputFields = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        // Check if credentials match
        if(auth()->attempt($inputFields)){
            $request->session()->regenerate();
            return redirect('/')->with('message','You are succesfully logged in!');
        }
        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }
}
