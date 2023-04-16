<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Undefined;

use function PHPUnit\Framework\isNan;
use function PHPUnit\Framework\isNull;

class ProjectController extends Controller
{
    //controller to view the project form page
    public function create_project()
    {
        return view('project/create_project');
    }


    public function add_project(Request $request)
    {
        //get project name from request and put it into database
        $project = new Project([
            "P_name" => $request->get('name'),
            "user_id" => Auth::id(),
        ]);
        $project->save();

        $projects = Project::get();
        $users = User::get();

        return view('task/create_task', ["projects" => $projects], ["users" => $users]);
    }


    public function show_projects()
    {
        //get project from database
        $projects = Project::get();

        //get the tasks data with related data from project and user table
        $tasks = Task::with('project', 'user')->get();
        return view('project/show_projects', ["projects" => $projects], ["tasks" => $tasks]);
    }


    public function delete_project($id)
    {
        
        //get selected project from database to delete
        $task = DB::table('tasks')
            ->where('project_id', '=', $id)
            ->get();
        if (empty($task[0])) {
            $projects = Project::find($id);
            $projects->delete();
        } elseif ($task[0]) {
            $tasks = Task::find($task[0]->id);
            $tasks->delete();
            $projects = Project::find($id);
            $projects->delete();
        }
        //get the tasks data with related data from project and user table
        $tasks = Task::with('project', 'user')->get();
        $projects = Project::get();

        return view('project/show_projects', ["projects" => $projects], ["tasks" => $tasks]);
    }


    public function update($id)
    {
        //get selected project from database to delete
        $projects = Project::find($id);

        //get the tasks data with related data from project and user table
        $tasks = Task::with('project', 'user')->get();
        $users = User::get();
        return view('project/update', compact('projects', 'tasks', 'users'));
    }


    public function updated_data(Request $request, $id)
    {
        //condition to control the incoming request is not updated for all db
        if ($request->project_name) {
            //get selected project from database to update
            $project = Project::find($id);
            $project->P_name = $request->project_name;
            $project->save();

            $tasks = Task::with('project', 'user')->get();
            $projects = Project::get();

            return view('project/show_projects', ["projects" => $projects], ["tasks" => $tasks]);
        } else {
            //get selected task from database to update
            $task = Task::find($id);
            $task->task_name = $request->task_name;
            $task->user_id = $request->userid;
            $task->save();

            //get the tasks data with related data from project and user table
            $tasks = Task::with('project', 'user')->get();
            $projects = Project::get();

            return view('project/show_projects', ["projects" => $projects], ["tasks" => $tasks]);
        }
    }
}
