<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <title>Sanipower Comerciais</title>

    <link href="{{asset('assets/css/siqtheme.css')}}" rel="stylesheet">

    @include('layouts.styles')
</head>

<body class="theme-dark">

    <div class="login-wrapper">
        <div class="d-flex justify-content-center align-items-center h-100">
            <div class="card" id="login-card">
                <div class="card-body text-center">
                   <img src="{{asset('logo/sanipower_Azul.svg')}}" width="200">
                </div>
                <div class="card-body">
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="text-center pb-3">
                            <h5 class="text-center bold">Login</h5>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ti-user"></i></span>
                            </div>

                            <x-text-input id="email" class="form-control" type="email" name="email" placeholder="email" :value="old('email')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />

                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ti-lock"></i></span>
                            </div>
                            <x-text-input id="password" class="form-control" type="password" name="password" placeholder="password" required autocomplete="current-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />

                        </div>
                        <div class="form-checkbox">
                            <label>
                                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                                <span class="checkmark"><i class="ti-check"></i></span>
                                Lembrar me
                            </label>
                            <div class="float-right">
                                @if (Route::has('password.request'))
                                    <a class="card-link" href="{{ route('password.request') }}">
                                        Esqueceu password?
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-carolina">Login</button>
                        </div>
                    </form>
                </div>
        
                <div class="card-footer text-center">
                    <p><small>Copyright © 2024 BR&VR. All rights reserved.</small></p>
                </div>
            </div>

        </div>
    </div>
    
    <script src="{{asset('assets/scripts/pages/pg_login.js')}}" type="text/javascript"></script>
</body>


</html>