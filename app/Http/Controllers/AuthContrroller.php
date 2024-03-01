<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthContrroller extends Controller
{
    //
    public function index()
    {
        return view('login');
    }

    public function blank()
    {
        return view('blank');
    }

    public function profile()
    {
        return view('profile');
    }

    public function register()
    {
        return view('register');
    }

    public function postregister(Request $request)
    {
        $register = $request->validate([
            'name'=>'required',
            'username'=>'required',
            'email'=>'required',
            'password'=>'required',
            'repassword'=>'required | same:password',
            'terms'=>'required',
        ]);
        if ($request->password == $request->repassword)
        {
            $ins = User::create([
                'name'=>$request->name,
                'username'=>$request->username,
                'email'=>$request->email,
                'password'=>bcrypt($request->password)
            ]);
            $login = $request->validate([
                'username'=>'required',
                'password'=>'required'
            ]);
            if (Auth::attempt($login))
            {
                Session::put('user_id', auth()->user()->id);
                Session::put('name', auth()->user()->name);
                return redirect()->intended('/login');
            }
            return redirect('/login');
        }
    }
    
  public function postlogin(Request $request)
  {
    $login = $request->validate([
        'username'=>'required',
        'password'=>'required',
    ]);
    if (Auth::attempt($login))
    {
        Session::get('user_id', auth()->user()->id);
        Session::get('name', auth()->user()->name);
        return redirect()->intended('/galery');
    }
    return back()->withErrors([
        'Errors'=>'username password keliru'
    ]);
  }


  public function logout()
  {
    Auth::logout();
    Session::forget('name');
    Session::forget('user_id');
    return redirect('/login');
  }
}
