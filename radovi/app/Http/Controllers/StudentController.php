<?php

namespace App\Http\Controllers;


use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StudentController extends Controller
{
    //
    function showTasks(){
        $user = Auth::user();
        $tasks = Task::all()->where('assignee',"=", null);
        foreach($tasks as $task){
            $nastavnik = User::find($task->nastavnik_id);
            $task->nastavnik = $nastavnik->email;
            if($task->students->contains($user->id))
                $task->disabled = true;
            else 
                $task->disabled = false;
        }
        return view('home', ['data'=>$tasks]);
    }

    function updateTasks(Request $request){
        $user = Auth::user();
        if($request->detach!=null){
            $task = Task::find($request->detach);
            $user->tasks()->detach($task);
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Prijava uklonjena!');
        }
        else if($request->attach!=null){
            $task = Task::find($request->attach);
            $user->tasks()->attach($task);
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Rad uspješno odabran!');
        }
        return redirect()->route('student.task');
    }
}
