<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    //controller to view the tasks form page
    public function create_task()
    {
        $projects = Project::get();
        $users = User::get();

        return view('task/create_task', ["projects" => $projects], ["users" => $users]);
    }

    public function add_task(Request $request)
    {
        //get task details from request and put it into database
        $task = new Task([
            "task_name" => $request->get('name'),
            "project_id" => $request->projectid,
            "user_id" => $request->userid,
        ]);
        $task->save();

        $projects = Project::get();
        $users = User::get();

        return view('task/create_task', ["projects" => $projects], ["users" => $users]);
    }


    public function show_task()
    {
        //get task data from databse
        $tasks = Task::with('project', 'user')->get();

        return view('task/show_tasks', ["tasks" => $tasks]);
    }


    public function submit_task(Request $request)
    {
        //get submited task data and save it to database
        $task = Task::find($request->id);
        $task->details = $request->get('details');
        $task->submit = true;
        $task->save();

        $tasks = Task::get();
        return view('task/show_tasks', ["tasks" => $tasks]);
    }

    public function delete_task($id)
    {
        //get selected task from database to delete
        $tasks = Task::find($id);
        $tasks->delete();

        $tasks = Task::with('project', 'user')->get();
        $projects = Project::get();

        return view('project/show_projects', ["projects" => $projects], ["tasks" => $tasks]);
    }
}
