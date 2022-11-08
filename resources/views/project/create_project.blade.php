@extends('layouts.nav')

@section('title')
    <title>Create Project</title>
@endsection

@section('body')
    <div class="container mt-5 p-5 shadow border w-50">
        <div class="row">
            <form method="get" action="{{ route('add_project') }}">
                @csrf
                <div class="mb-3 ">
                    <label for="project_name" class="form-label">Project Name</label>
                    <input type="text" class="form-control" name="name" id="project_name" required>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
