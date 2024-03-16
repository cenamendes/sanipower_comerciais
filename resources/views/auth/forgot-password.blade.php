
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
            
            <div class="card" id="forget-card">
                <div class="card-body text-center">
                    <img src="{{asset('logo/sanipower_Azul.svg')}}" width="200">
                 </div>
                <div class="card-body">
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="pb-2">
                            <h5 class="text-center bold">Esqueceu password?</h5>
                            <p class="text-center">Coloque seu email para recuperar a password</p>
                        </div>
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ti-email"></i></span>
                            </div>
                            <x-text-input id="email" class="form-control" type="email" name="email" placeholder="email" :value="old('email')" required autofocus />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-carolina">Recuperar password</button>
                            <a href="{{route('dashboard')}}" class="btn btn-secondary" id="forget-cancel">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    
    <script src="{{asset('assets/scripts/pages/pg_login.js')}}" type="text/javascript"></script>
</body>


</html>