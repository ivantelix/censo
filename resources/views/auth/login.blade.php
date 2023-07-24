<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Censo | Login</title>

    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css?v=3.2.0">
    <script type="text/javascript">

        let captcha = false;
        
        var verifyCallback = function(response) {
            captcha = response;
        };

        var onloadCallback = function() {
            grecaptcha.render('grecaptcha-container', {
            'sitekey' : '6Ld-qKoUAAAAAF3qEUN7O_xPqRk5IZqY1KKWfAX0',
            'callback' : verifyCallback,
            'theme' : 'dark'
            });
        };

        function login() {
            if (captcha) {
                $('#form_login').submit();
            }
        }
      
    </script>

</head>
<body class="login-page" style="min-height: 496.781px;">
<div class="login-box">
    <div class="login-logo">
        <a href="/home"><b>Censo</b></a>
    </div>

    @if(isset($isBloked))
        <div class="alert alert-danger" role="alert">
            {{$isBloked}}
        </div>
    @endif

    @if(isset($credentials))
        <div class="alert alert-warning" role="alert">
            {{$credentials}}
        </div>
    @endif

    @if(isset($account_exist))
        <div class="alert alert-warning" role="alert">
            {{$account_exist}}
        </div>
    @endif

    @if(isset($password_succesfully))
        <div class="alert alert-success" role="alert">
            {{$password_succesfully}}
        </div>
    @endif

    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Iniciar Sesion</p>
            <form method="POST" action="{{ route('login') }}" id="form_login">
                @csrf

                <div class="input-group mb-3">
                    <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div id="grecaptcha-container"></div>

                </br>

                <div class="row">
                    <div class="col-12">
                        <button type="button" class="btn btn-primary btn-block" onclick="login()">Sign In</button>
                    </div>

                </div>
            </form>

            <p class="mb-1">
                <a href="{{ route('register') }}">Registrar nuevo usuario</a>
            </p>
            <p class="mb-1">
                <a href="{{ route('recover_password') }}">Olvide la contrasenia</a>
            </p>
        </div>

    </div>
</div>


<script src="../../plugins/jquery/jquery.min.js"></script>

<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../../dist/js/adminlte.min.js?v=3.2.0"></script>

<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
    </script>


</body>
</html>
