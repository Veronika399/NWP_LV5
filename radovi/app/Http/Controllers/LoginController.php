<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class LoginController extends Controller
{
    //
    public function login(Request $request){

        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ]))
        {
            $user = User::where('email', $request->email)->first();

            //Check user role
            if($user->getRole()=='admin')
            {
                return redirect()->route('admin');
            }
            else if($user->getRole()=='nastavnik')
            {
                return redirect()->route('nastavnik');
            }
            return redirect()->route('home');
        }

        //user is not authencticated
        return redirect()->back()->withErrors([
            'email' => 'Wrong credentials. Try again.'
        ]);
    }
}
