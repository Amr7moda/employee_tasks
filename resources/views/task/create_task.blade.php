@extends('layouts.nav')

@section('title')
    <title>Create Task</title>
@endsection

@section('body')
    <div class="container mt-5 p-5 shadow border w-50">
        <div class="row">
            <form method="get" action="{{ route('add_task') }}">
                @csrf
                <div class="mb-3 ">
                    <label for="task_name" class="form-label">Task Name</label>
                    <input type="text" class="form-control" name="name" id="task_name" required>
                </div>
                <select class="form-select mt-3" name="projectid" aria-label="Default select example" required>
                    <option selected>Select Project</option>
                    @foreach ($projects as $project)
                        <option value={{ $project['id'] }}>{{ $project['P_name'] }}</option>
                    @endforeach
                </select>
                <select class="form-select mt-3" name="userid" id="userid" aria-label="Default select example" required>
                    <option selected>Select Employee</option>
                    @foreach ($users as $user)
                        @if ($user->is_admin == false)
                            <option value={{ $user['id'] }}>{{ $user['name'] }}</option>
                        @endif
                    @endforeach
                </select>
                <div class="text-center mt-4">
                    <button type="submit " class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
