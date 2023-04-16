<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;


class UserController extends Controller
{
    //controller to add new user 
    public function create_user()
    {
        return view('users/add_user');
    }

    public function add_user(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required',  Rules\Password::defaults()],
        ]);

        //get user details from request and put it into database
        $user = new User([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "role" => $request->role
        ]);
        $user->save();

        $projects = Project::get();
        $users = User::get();

        return view('task/create_task', ["projects" => $projects], ["users" => $users]);
    }


    public function show_users()
    {
        //get users from database
        $users = User::get();
        return view('users/show_users', ["users" => $users]);
    }

    public function delete_user($id)
    {
        //get selected user from database to delete
        $user = User::find($id);
        $user->delete();


        //get users from database
        $users = User::get();
        return view('users/show_users', ["users" => $users]);
    }

    public function update_user(Request $request)
    {
        $id = $request->id;

        $user = User::find($id);

        //get tasks from database
        $users = User::get();
        return response()->json([
            'message' => 'Called successfully.',
            'data' => $user
        ],);
    }

    public function new_update_user(Request $request)
    {
        $userid = $request->user_id;
        $user = User::find($userid);

        $request->validate([
            'email' => ['string', 'email', 'unique:users,email,'.$user->id]
        ]);

        $user->name = $request->user_name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->update();

        return redirect()->back()->with('status', 'Employee Updated successfully.');
    }
}
