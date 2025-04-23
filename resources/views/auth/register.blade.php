@extends('layouts.lite')
@section('title')
    <title>{{env("APP_NAME")}} | Register</title>
@endsection
@section("content")
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg border-0" style="width: 400px; border-radius: 20px;">

            <div class="card-header text-center bg-white border-0"
                 style="border-top-left-radius: 20px; border-top-right-radius: 20px;">
                <a href="/" class="h1 text-dark"><b>Quran</b> City</a>
                <p class="mt-2 text-muted">Create your login credential</p>
            </div>

            <div class="card-body" style="padding: 2rem;">

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group mb-4">
                        <label class="text-muted">Name</label>
                        <input type="text"
                               class="form-control @error('name') is-invalid @enderror shadow-sm"
                               placeholder="Full Name"
                               name="name"
                               value="{{ old('name') }}"
                               required autofocus
                               style="border-radius: 12px; border: 1px solid #dce0e6;">
                        @error('name')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label class="text-muted">Email Address</label>
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror shadow-sm"
                               placeholder="Enter your email"
                               name="email"
                               value="{{ old('email') }}"
                               required autofocus
                               style="border-radius: 12px; border: 1px solid #dce0e6;">
                        @error('email')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label class="text-muted">Password</label>
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror shadow-sm"
                               placeholder="Enter your password"
                               name="password"
                               required
                               style="border-radius: 12px; border: 1px solid #dce0e6;">
                        @error('password')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label class="text-muted">Confirm Password</label>
                        <input type="password"
                               class="form-control @error('password_confirmation') is-invalid @enderror shadow-sm"
                               placeholder="Confirm your password"
                               name="password_confirmation"
                               required
                               id="password-confirm"
                               style="border-radius: 12px; border: 1px solid #dce0e6;">
                        @error('password')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <button type="submit" class="btn btn-primary shadow"
                                style="border-radius: 12px; padding: 0.5rem 1.5rem;">
                            Register
                        </button>
                    </div>
                </form>

                {{--                <hr>--}}
                {{--                <p class="text-center text-muted small mb-0">Forgot your password? <a href="#" class="text-primary">Reset here</a></p>--}}

            </div>
        </div>
    </div>
    <div class="position-absolute w-100 text-center mb-3 text-muted small" style="bottom: 2rem">
            <?php
            $year = date('Y');
            ?>
        <strong>Copyright &copy; {{$year}} <a href="https://ecnetsolutions.ca/" target="_blank">EcNet Solution</a>.</strong> All rights reserved.    </div>
@endsection
