@extends('layout')

@section('title')
    Login
@endsection

@section('body')
    <div class="container">
        <div class="loginForm">
            <h3 class="text-primary">Login Details</h3>
            <form action="{{ route('user.login') }}" method="POST">
                @csrf
                 <div class="mb-3">
                    <label for="emailId" class="form-label">Email address</label>
                    <input type="email" value="{{ old('email') }}" class="form-control c_login_control @error('email') is-invalid @enderror"
                     id="emailId" name="email">
                     <span class="text-danger">
                      @error('email')
                        {{ $message }}
                      @enderror
                     </span>
                  </div>

                  <div class="mb-3">
                    <label for="passwordId" class="form-label">Password</label>
                    <input type="password" class="form-control c_login_control @error('password') is-invalid @enderror"
                     id="passwordId" name="password">
                     <span class="text-danger">
                      @error('password')
                        {{ $message }}
                      @enderror
                     </span>
                  </div>

                  <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="remember" id="chekbox" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="chekbox">
                      Remember Me
                    </label>
                  </div>

                  <div class="d-grid mb-5">
                    <button class="btn btn-primary" type="submit">Log in</button>
                  </div>
                  <hr>

                  <div class="custom_reg text-center">
                    <a href="/register" class="btn btn-success custom_reg_btn">Registration</a>
                  </div>

  
            </form>
        </div>
    </div>
@endsection