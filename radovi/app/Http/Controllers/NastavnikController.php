<?php

namespace App\Http\Controllers;


use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NastavnikController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        $data = Task::all()->where('nastavnik_id',"=", $user->id);
        foreach($data as $task){
            if($task->assignee!=null){
                $student = User::find($task->assignee);
                $task->assignee = $student->email;
            }
            else {
                $task->assignee = "/";
            }
        }
        return view('nastavnik', ['data'=> $data]);
    }

    function saveTask(Request $request){
        //dd($request->input());
        $request->validate([
            'naziv_rada' => 'required|max:255',
            'naziv_rada_en' => 'required',
            'zadatak_rada' => 'required'
        ]);

        $task = new Task();
        $task->naziv_rada = $request->input('naziv_rada');
        $task->naziv_rada_en = $request->input('naziv_rada_en');
        $task->zadatak_rada = $request->input('zadatak_rada');
        $task->tip_studija = $request->input('tip_studija');
        $task->nastavnik_id = Auth::user()->id;
        $task->save();
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Rad je uspješno dodan!');
        return redirect()->route('nastavnik');
    }

    function showStudents($id){
        $task=Task::find($id);
        return view('task_students', ['task'=>$task]);
    }

    function assignStudentTask(Request $request, $taskId){
        $student = $request->student;
        $task = Task::find($taskId);
        $task->assignee = $student;
        $task->save();
        return redirect()->route('nastavnik');
    }
}
