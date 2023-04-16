@extends('layouts.nav')

@section('title')
<title>Add User</title>
@endsection

@section('body')
<div class="container mt-5 p-5 shadow border w-50">
    <div class="row">
        <form method="post" action="{{ route('add_user') }}">
            @csrf
            <div class="mb-3 ">
                <label for="User_name" class="form-label">User Name</label>
                <input type="text" class="form-control" name="name" id="User_name" required>
            </div>

            <div class="mb-3 ">
                <label for="User_email" class="form-label">User Email</label>
                <input type="email" class="form-control" name="email" id="User_email" required>
            </div>

            <div class="mb-3 ">
                <label for="User_password" class="form-label">User Password</label>
                <input type="password" class="form-control" name="password" id="User_password" required>
            </div>

            <select class="form-select" name="role" id="role" aria-label="Default select example" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>

            @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="text-center mt-4">
                <button type="submit " class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection