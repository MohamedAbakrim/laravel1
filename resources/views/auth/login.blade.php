@extends('base')

@section('title', 'login')

@section('content')
    <h1>Log In</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{route('auth.login')}}" method="POST" class="vstack gap-3">
                @csrf
                <div class="mb-3 mt-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="{{old('email')}}">
                    @error('email')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 mt-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password">
                    @error('password')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <button class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
@endsection