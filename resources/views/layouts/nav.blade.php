<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>

    @yield('title')
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="https://www.rc.virginia.edu/images/accord/project.png" width="100px" class="rounded-circle"  alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('show_projects') }}">Show
                            Projects</a>
                    </li>
                    @if (Auth::user()->is_admin == true)
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('create_project') }}">Create
                                Project</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('create_task') }}">Create
                                Task</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('show_task') }}">My
                            Tasks</a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-5">
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <h5>Welcome,{{ Auth::user()->name }}</h5>
                            </li>
                    </ul>
                    <ul class="navbar-nav position-absolute me-5 end-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                                class="text-sm text-gray-700 dark:text-gray-500 underline"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                @else
                    <ul class="navbar-nav position-absolute me-3 end-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"
                                class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}"
                                    class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                            </li>
                        @endif
                    @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('body')


    {{-- @extends('layouts.footer') --}}
