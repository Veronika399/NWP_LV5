<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\User;

class UserController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function showUsers(){
        $data = User::all();
        return view('admin', ['data'=>$data]);
    }

    function edit($userId){
        $data = User::find($userId);
        return view('edit', ['data'=>$data]);
    }

    function update(Request $request){
        //dd($request->input());
        $user = User::find($request->input('userId'));
        $user->role = $request->input('role');
        $user->save();
        return redirect()->route('admin');
    }
}
