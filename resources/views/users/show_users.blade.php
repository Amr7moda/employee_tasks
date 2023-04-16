@extends('layouts.nav')

@section('title')
    <title>Show Users</title>
@endsection

@section('body')

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

    <div class="container mt-5">
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    {{-- display all users --}}
                    @foreach ($users as $index => $user)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <a href="{{ route('delete_user', $user->id) }}"> <button id="{{ $user->id }}"
                                        class="btn btn-danger"> Delete </button></a>
                                <button value="{{ $user->id }}" id="updateUser" class="btn btn-success"> Update
                                </button>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>


        </div>
    </div>



    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary d-none" id="openusermodal" data-bs-toggle="modal"
        data-bs-target="#staticBackdrop">
    </button>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('new_update_user') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 ">
                            <label for="user_name" class="form-label">Employee Name</label>
                            <input type="text" class="form-control" name="user_name" id="user_name">
                        </div>

                        <input type="text" hidden class="form-control" name="user_id" id="user_id">

                        <div class="mb-3 ">
                            <label for="user_email" class="form-label">Employee Email</label>
                            <input type="email" class="form-control" name="email" id="user_email">
                        </div>

                        <div class="mb-3 ">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select" name="role" aria-label="Default select example" required>
                                <option id="role"></option>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="user_update" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
