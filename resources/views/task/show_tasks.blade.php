@extends('layouts.nav')

@section('title')
    <title>Show Tasks</title>
@endsection


@section('body')
    {{-- {{dd($tasks)}} --}}
    <h1 class="m-3 text-center">Submit Your Tasks!</h1>

    @if (session('status'))
        <div id="success" class="alert alert-success">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container w-50">
        <div class="row ms-5">
            @foreach ($tasks as $task)
                @if (Auth::user()->id == $task->user_id)
                    @if ($task->submit == false)
                        <div class="col-10 shadow border p-5 mt-5">
                            <h1>{{ $task->project->P_name }}</h1>
                            <h3>{{ $task->task_name }}</h3>
                            <div>
                                <div class="mb-3 ">
                                    <label for="details" class="form-label">Task Details</label>
                                    <input type="text" class="form-control" name="details" id="details"
                                        value="{{ $task->details }}">
                                    <input type="text" hidden name="id" value="{{ $task->id }}">
                                </div>
                                <a href="{{ route('delete_task', $task->id) }}"> <button type="submit"
                                        class="btn btn-danger">Delete</button> </a>

                                <a href="{{ route('submit_task', $task->id) }}"> <button type="submit"
                                        class="btn btn-success  ">Submit</button></a>

                                <button type="submit" id="update" value="{{ $task->id }}"
                                    class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    @endif
                @endif
            @endforeach
        </div>
    </div>


    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary d-none" id="openmodal" data-bs-toggle="modal"
        data-bs-target="#staticBackdrop">
    </button>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('new_update_task') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 ">
                            <label for="task_name" class="form-label">Task Name</label>
                            <input type="text" class="form-control" name="task_name" id="task_name">
                        </div>

                        <input type="text" hidden class="form-control" name="user_id" id="user_id">
                        <input type="text" hidden class="form-control" name="task_id" id="task_id">

                        <div class="mb-3 ">
                            <label for="user_email" class="form-label">Employee Email</label>
                            <input type="email" class="form-control" name="email" id="user_email">
                        </div>

                        <div class="mb-3 ">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" name="status" aria-label="Default select example" required>
                                <option id="status"></option>
                                <option value="1">Finished</option>
                                <option value="0">Unfinished</option>
                            </select>
                        </div>

                        <div class="mb-3 ">
                            <label for="details" class="form-label">Details</label>
                            <input type="text" class="form-control" name="details" id="details">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="modal_update" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
