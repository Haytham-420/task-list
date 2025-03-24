<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Task;

class TaskController extends Controller
{
    //
    public function index()
    {
        // $tasks = DB::table('tasks')->get();
        $tasks = Task::all();

        return view('tasks', compact('tasks'));
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name'=> 'required|max:15'
        ]);

        // $task_name = $_POST['name'];
        // DB::table('tasks')->insert(['name' => $task_name]);
        $task = new Task;
        // Note the *name* below is the name of the column in the DB
        $task->name =  $request->name;
        // ->save() should be used at the very end after inserting everything
        $task->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        // DB::table('tasks')->where('id', '=', $id)->delete();
        Task::find($id)->delete();
        return redirect()->back();
    }

    public function edit($id)
    {
        // $task = DB::table('tasks')->where('id', $id)->first();
        $task = Task::find($id);
        // $tasks = DB::table('tasks')->get();
        $tasks = Task::all();
        return view('tasks', compact('task', 'tasks'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:15'
        ]);

        $id = $request->id;
        // DB::table('tasks')->where('id', $id)->update(['name' => $_POST['name']]);
        // Task::where('id', $id)->update(['name' => $_POST['name']]);
        Task::where('id', $id)->update(['name' => $request->name]);
        return redirect('tasks');
    }
}
