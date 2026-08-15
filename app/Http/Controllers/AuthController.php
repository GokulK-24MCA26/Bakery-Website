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
        if(Auth::attempt($credentials)){
            $role = Auth::user()->role;
            return $role === 'admin' ? redirect('/admin/dashboard') : redirect('/');
        }
        return redirect('/login')->with('error','Login Failed');
    }
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
    public function showregister(){
        return view("auth.register");
    }
    public function register(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:5|confirmed',
            'role'=>'required|in:employee,admin'
        ]);
        $data=$request->only('name', 'email', 'password', 'role');
        $data['password']=bcrypt($data['password']);
        if(User::create($data)){
            return redirect('/login')->with('success', 'Registration Successful');
        }
        return redirect('/register')->with('error', 'Registration Failed');

    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(auth $auth)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(auth $auth)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, auth $auth)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(auth $auth)
    {
        //
    }
}
