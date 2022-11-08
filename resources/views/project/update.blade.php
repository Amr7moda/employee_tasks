@extends('layouts.nav')

@section('title')
    <title>update</title>
@endsection

@section('body')
    <div class="container m-5">
        <div class="row">
            {{-- display updated project --}}
            @csrf
            <div class="col-8">
                <form method="get" action="{{ route('updated_data', $projects->id) }}">
                    <h1> Project Name:
                        <input type="text" name="project_name" class="d-block m-3" value="{{ $projects['P_name'] }}" required>
                    </h1>
                    <button type="submit" class="btn m-2 btn-success">Update</button>
                </form>
                @foreach ($tasks as $task)
                    {{-- condition to control the apeared tasks that belong to this project  --}}
                    @if ($task->project->id == $projects->id)
                        <form method="get" action="{{ route('updated_data', $task->id) }}">
                            <div class="border shadow m-3 p-3">
                                <h2>Task Name:
                                    <input class="d-block m-3" name="task_name" type="text"
                                        value="{{ $task->task_name }}" required>
                                </h2>
                                <h2>Employee works on:
                                    <select class="form-select mt-3" name="userid" id="userid"
                                        aria-label="Default select example" required>
                                        <option selected value={{ $task->user->id }}>{{ $task->user->name }}</option>
                                        @foreach ($users as $user)
                                            @if ($user->is_admin == false)
                                                <option value={{ $user['id'] }}>{{ $user['name'] }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </h2>

                                {{-- condition to show images to submited tasks  --}}
                                @if ($task->submit == true)
                                    <img class="m-auto"
                                        src="https://www.citypng.com/public/uploads/small/11640258356ut3nwf4hllzgxmunlocgputspvf61wd1urtfot7vhvjla6kdjlxqkuoff9pjnql53xwophwpyany8xbexfjprjgb9eog7wz26fjg.png"
                                        width="120px">
                                @else
                                    <button type="submit" class="btn m-2 btn-success">Update</button>
                                @endif
                            </div>
                        </form>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
