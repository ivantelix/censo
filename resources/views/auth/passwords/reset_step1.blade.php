<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Censo | Login</title>

    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css?v=3.2.0">
    
    <style>
        .login-box, .register-box {
            width: 35%;
        }
    </style>

</head>
<body class="login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="/home"><b>Resetear Contrasena</b></a>
    </div>

    @isset($bad_answer)
        <div class="alert alert-danger" role="alert">
            {{$bad_answer}}
        </div>
    @endisset

    <div class="container">
        <div class="row">
           <div class="col-md-12">

           <div class="card">
                <div class="card-body login-card-body">
                    <form method="POST" action="{{ route('confirm_reset_password') }}">

                        @csrf
                        
                        <input class="form-control" type="hidden" value="{{$user->email}}" name="email">

                        <div class="input-group mb-3">
                            <input class="form-control" type="text" placeholder="{{$user->security_questions->question}}" readonly>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-info"></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input-group mb-3">
                            <input id="answer" type="text" placeholder="Ingrese la Respuesta" class="form-control @error('answer') is-invalid @enderror" name="answer" value="{{ old('answer') }}" required autocomplete="answer" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-keyboard"></span>
                                </div>
                            </div>
                            @error('answer')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input id="password" type="password" placeholder="Ingrese el Nuevo Password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fa fa-key"></span>
                                </div>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Confirmar Resetear Password</button>
                            </div>

                        </div>
                    </form>

                    <p class="mb-1">
                        <a href="{{ route('register') }}">Registrar nuevo usuario</a>
                    </p>
                    <p class="mb-1">
                        <a href="{{ route('login') }}">Iniciar Sesion</a>
                    </p>
                </div>

            </div>

            </div>
        </div>
    </div>
</div>


<script src="../../plugins/jquery/jquery.min.js"></script>

<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../../dist/js/adminlte.min.js?v=3.2.0"></script>

</body>
</html>
