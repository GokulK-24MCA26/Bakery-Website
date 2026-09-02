<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showlogin(){
        return view("auth.login");
    }
    public function login(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        $credentials=$request->only('email','password');
        if(Auth::attempt($credentials, $request->boolean('remember'))){
            $request->session()->regenerate();
            $role = Auth::user()->role;
            return $role === 'admin' ? redirect('/admin/dashboard') : redirect('/');
        }
        return redirect('/login')->with('error','Login Failed');
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
    public function showregister(){
        return view("auth.register");
    }
    public function register(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8|confirmed',
        ]);
        // 'password' => 'hashed' cast on User model handles hashing — do NOT bcrypt here
        $data=$request->only('name', 'email', 'password');
        $data['role']='customer';
        if(User::create($data)){
            return redirect('/login')->with('success', 'Registration Successful');
        }
        return redirect('/register')->with('error', 'Registration Failed');

    }
}
