@extends('base')

@section('content')
    <div class="d-flex justify-content-center flex-column container col-md-4 offset-md-4 mt-5 border-start border-end">

        <img src="https://i.pinimg.com/550x/04/8a/ac/048aac8f549e923dbd25aa769032d339.jpg" alt="" style="width: 150px; margin: auto;">

        <h2 class="mb-3">Log in to your account</h2>

        @if(session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{'/login'}}" method="POST">
            {{ csrf_field() }}

            <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email</label>
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <a href="/register">Create an account</a>
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
            @method('POST')
        </form>
    </div>
@endsection
