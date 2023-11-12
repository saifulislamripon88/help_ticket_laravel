@extends('layout')

@section('title')
    Registration
@endsection

@section('body')
    <div class="container">
        <div class="registrationForm">
            <h3 class="text-success">Registration Details</h3>
            <form action="{{ route('view.registration') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nameId" class="form-label">Name</label>
                    <input type="text" value="{{ old('name') }}" class="form-control c_registration_control @error('name') is-invalid @enderror"
                     id="nameId" name="name">
                     <span class="text-danger">
                        @error('name')
                            {{ $message }}
                        @enderror
                     </span>
                </div>

                <div class="mb-3">
                    <label for="emailId" class="form-label">Email address</label>
                    <input type="email" value="{{ old('email') }}" class="form-control c_registration_control @error('email') is-invalid @enderror" 
                    id="emailId" name="email">
                    <span class="text-danger">
                       @error('email')
                           {{ $message }}
                       @enderror
                    </span>
                </div>

                <div class="mb-3">
                    <label for="passwordId" class="form-label">Password</label>
                    <input type="password" class="form-control c_registration_control @error('password') is-invalid @enderror" 
                    id="passwordId" name="password"> 
                    <span class="text-danger"> 
                        @error('password')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="d-grid mb-3">
                    <button class="btn btn-success" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
