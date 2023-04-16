<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function all_tasks()
    {
        //get tasks from database
        $tasks = Task::with('project', 'user')->get();
        return view('task/all_tasks', ["tasks" => $tasks]);
    }

    public function submit_task(Request $request,$id)
    {
        //get submited task data and save it to database
        $task = Task::find($id);
        $task->details = $request->details;
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

    public function update_task(Request $request)
    {
        $id = $request->id;

        $tasks = DB::table('tasks')
            ->join('projects', 'projects.id', '=', 'tasks.project_id')
            ->join('users', 'users.id', '=', 'tasks.user_id')
            ->select('tasks.*', 'projects.P_name', 'users.email')
            ->where('tasks.id', $id)
            ->get();

        //get tasks from database
        $users = User::get();
        return response()->json([
            'message' => 'Called successfully.',
            'data' => $tasks
        ],);
    }

    public function new_update_task(Request $request)
    {
        $userid = $request->user_id;
        $taskid = $request->task_id;
        $request->validate([
            'email' => ['string', 'email', 'unique:users,email,'.$userid]
        ]);


        $task = Task::find($taskid);
        $task->task_name = $request->task_name;
        $task->submit = $request->status;
        $task->details = $request->details;
        $task->update();

        $user = User::find($userid);
        $user->email = $request->email;
        $user->update();

        return redirect()->back()->with('status', 'Employee Updated successfully.');
    }
}
