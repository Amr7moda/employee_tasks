@extends('layouts.nav')

@section('title')
    <title>Show Project</title>
@endsection

@section('body')
    <div class="container mt-5">
        <div class="row">
            <div class="accordion" id="accordionExample">
                {{-- display all projects --}}
                @foreach ($projects as $index => $project)

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne{{ $project['id'] }}" aria-expanded="true"
                                aria-controls="collapseOne{{ $project['id'] }}">
                                <h1>{{ $index + 1 }}- Project Name: <span style="color: blue">
                                        {{ $project['P_name'] }}</span></h1>
                            </button>
                        </h2>

                        <div id="collapseOne{{ $project['id'] }}" class="accordion-collapse collapse "
                            aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                @foreach ($tasks as $task)
                                    {{-- condition to control the apeared tasks that belong to this project  --}}
                                    @if ($task->project->id == $project->id)
                                        <div class="border shadow m-3 p-3 d-flex">
                                            <div>
                                                <h2>Task Name: <span style="color: blue">{{ $task->task_name }} </span></h2>
                                                <h2>Employee works on: <span style="color: blue">{{ $task->user->name }}
                                                    </span></h2>

                                                {{-- condition to show  delete button to admins only  --}}
                                                @if (Auth::user()->is_admin == true)
                                                    <a href="{{ route('delete_task', $task['id']) }}"><button
                                                            class="btn m-4 btn-danger">Delete
                                                            Task!</button></a>
                                                @endif
                                            </div>

                                            {{-- condition to show images to submited tasks  --}}
                                            @if ($task->submit == true)
                                                <img class="m-auto"
                                                    src="https://www.citypng.com/public/uploads/small/11640258356ut3nwf4hllzgxmunlocgputspvf61wd1urtfot7vhvjla6kdjlxqkuoff9pjnql53xwophwpyany8xbexfjprjgb9eog7wz26fjg.png"
                                                    width="120px">
                                            @endif

                                        </div>
                                    @endif
                                @endforeach

                                {{-- condition to show delete & create tasks buttons to admins only  --}}
                                @if (Auth::user()->role == 'admin')
                                    <a href="{{ route('create_task') }}"><button class="btn m-2 btn-primary">Craete
                                            Task!</button></a>
                                    <a href="{{ route('delete_project', $project['id']) }}"><button
                                            class="btn m-2 btn-danger">Delete
                                            Project!</button></a>
                                    <a href="{{ route('update', $project['id']) }}"><button
                                            class="btn m-2 btn-success">Update
                                        </button></a>
                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
