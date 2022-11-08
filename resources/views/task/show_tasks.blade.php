@extends('layouts.nav')

@section('title')
    <title>Show Tasks</title>
@endsection


@section('body')
    <h1 class="m-3 text-center">Submit Your Tasks!</h1>
    <div class="container w-50">
        <div class="row ms-5">
            @foreach ($tasks as $task)
                @if (Auth::user()->id == $task->user_id)
                    @if ($task->submit == false)
                        <div class="col-10 shadow border p-5 mt-5">
                            <h1>{{ $task->project->P_name }}</h1>
                            <h3>{{ $task->task_name }}</h3>
                            <form action="{{ route('submit_task') }}" method="get">
                                @csrf
                                <div class="mb-3 ">
                                    <label for="details" class="form-label">Task Details</label>
                                    <input type="text" class="form-control" name="details" id="details">
                                    <input type="text" hidden name="id" value="{{ $task->id }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    @endif
                @endif
            @endforeach
        </div>
    </div>
@endsection
