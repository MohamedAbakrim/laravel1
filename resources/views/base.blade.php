<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    @php
        $routeName = request()->route()->getName();
    @endphp
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('blog.index')}}">Blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => $routeName === 'blog.index']) href="{{route('blog.index')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)">Link</a>
                    </li>
                </ul>
                <div class="navbar-nav ms-auto mb-2 mb-lg-0">
                    @auth   
                        <strong class="text-white">{{\Illuminate\Support\Facades\Auth::user()->name}}</strong>
                        <form action="{{route('auth.logout')}}" method="POST" class="nav-item">
                            @method("delete")
                            @csrf
                            <button class="btn btn-primary">Logout</button>
                        </form>
                    @endauth
                    @guest
                        <div class="nav-item">
                            <a href="{{route('auth.login')}}" class="nav-link btn btn-primary">Log In</a>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        @if(session('done'))
            <div class="alert alert-success">
                {{session('done')}}
            </div>
        @endif
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>