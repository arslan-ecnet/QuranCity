@extends('layouts.lite')
@section('title')
    <title>{{env("APP_NAME")}} | Login</title>
@endsection
@section("content")
{{--    <div class="d-flex justify-content-center align-items-center vh-100">--}}
{{--        <div class="card shadow-lg border-0" style="width: 400px; border-radius: 20px;">--}}

{{--            <div class="card-header text-center bg-white border-0" style="border-top-left-radius: 20px; border-top-right-radius: 20px;">--}}
{{--                <a href="/" class="h1 text-dark"><b>Quran</b> City</a>--}}
{{--                <p class="mt-2 text-muted">Welcome back! 👋</p>--}}
{{--            </div>--}}

{{--            <div class="card-body" style="padding: 2rem;">--}}

{{--                <form method="POST" action="{{ route('login') }}">--}}
{{--                    @csrf--}}

{{--                    <div class="form-group mb-4">--}}
{{--                        <label class="text-muted">Email Address</label>--}}
{{--                        <input type="email"--}}
{{--                               class="form-control @error('email') is-invalid @enderror shadow-sm"--}}
{{--                               placeholder="Enter your email"--}}
{{--                               name="email"--}}
{{--                               value="{{ old('email') }}"--}}
{{--                               required autofocus--}}
{{--                               style="border-radius: 12px; border: 1px solid #dce0e6;">--}}
{{--                        @error('email')--}}
{{--                        <small class="text-danger d-block mt-1">{{ $message }}</small>--}}
{{--                        @enderror--}}
{{--                    </div>--}}

{{--                    <div class="form-group mb-4">--}}
{{--                        <label class="text-muted">Password</label>--}}
{{--                        <input type="password"--}}
{{--                               class="form-control @error('password') is-invalid @enderror shadow-sm"--}}
{{--                               placeholder="Enter your password"--}}
{{--                               name="password"--}}
{{--                               required--}}
{{--                               style="border-radius: 12px; border: 1px solid #dce0e6;">--}}
{{--                        @error('password')--}}
{{--                        <small class="text-danger d-block mt-1">{{ $message }}</small>--}}
{{--                        @enderror--}}
{{--                    </div>--}}

{{--                    <div class="d-flex justify-content-between align-items-center mb-3">--}}
{{--                        <div class="form-check">--}}
{{--                            <input type="checkbox" class="form-check-input" id="remember" name="remember">--}}
{{--                            <label class="form-check-label" for="remember">Remember Me</label>--}}
{{--                        </div>--}}
{{--                        <button type="submit" class="btn btn-primary shadow" style="border-radius: 12px; padding: 0.5rem 1.5rem;">--}}
{{--                            Sign In--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </form>--}}

{{--                <hr>--}}
{{--                <p class="text-center text-muted small mb-0">Forgot your password? <a href="#" class="text-primary">Reset here</a></p>--}}

{{--            </div>--}}
{{--        </div>--}}


{{--    </div>--}}
{{--    <div class="position-absolute w-100 text-center mb-3 text-muted small" style="bottom: 5rem">--}}
{{--            <?php--}}
{{--            $year = date('Y');--}}
{{--            ?>--}}
{{--        <strong>Copyright &copy; {{$year}} <a href="https://ecnetsolutions.ca/" target="_blank">EcNet Solution</a>.</strong> All rights reserved.    </div>--}}

<div class="login-body">
    <header class="login-header">
        <div class="container-fluid d-flex align-items-center justify-content-center">
            <div><img src="images/logo-icon.png" alt=""></div>
            <div><img src="images/dashboard-logo-lg.png" alt=""></div>
        </div>
    </header>
    <div class="login-main position-relative overflow-hidden">
        <div class="container">
            <div class="login-content row g-0">
                <div class="col-lg-6 full-img d-none d-lg-block"><img src="images/image.png" alt=""></div>
                <div class="col-lg-6 align-self-center">
                    <div class="content">
                        <div class="mb-5">
                            <h2>Welcome to</h2>
                            <h3>Quran City <span>Administration</span></h3>
                            <h5>Enter your login details below</h5>
                        </div>
                        <div class="mb-3">
                            @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <form action="{{route('login')}}" method="POST">
                            @csrf
                            <div class="mb-4"><label>EMAIL ADDRESS</label><input type="text" name="email" class="form-control"
                                                                                 placeholder=""></div>
                            <div class="mb-4"><label>PASSWORD</label><input type="password" name="password" class="form-control"
                                                                            placeholder=""></div>
                            <div class="pt-3 mb-4"><input type="submit" value="SIGN IN"></div>
                            <div class="d-flex align-items-center">
                                <div class="form-check"><input class="form-check-input" type="checkbox" value=""
                                                               id="Remember" checked><label class="form-check-label"
                                                                                            for="Remember">Remember
                                        me</label></div>
{{--                                <a href="#">Forgot password?</a>--}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="login-footer">
        <div class="container-fluid">
            <ul>
                <li>Copyright © 2023 QFatima. All rights reserved</li>
                <li>Developed by <img src="images/footer-icon.png" alt=""></li>
            </ul>
        </div>
    </footer>
</div>

@endsection
