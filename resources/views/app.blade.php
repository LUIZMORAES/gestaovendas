<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>LCAM</title>
    <link rel="icon" href="{{ asset('adm/logoempresa/lcam_ico.jpg') }}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('adm/csslogin/login.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('AdminLTE/dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="text-center">
    <main>
        <div class="imagem-principal">
            <div class="container-fluid">
                <div class="d-block mx-auto mb-4">
                    <img src="{{URL::asset('adm/logoempresa/logo_lcam.jpg')}}" width="300" height="150">
                    <h3 class="login-box-msg">SGV - Sistema Gestão Vendas</h3>
                    <div class="mx-auto" style="width: 450px;">
                        <p class="login-box-msg">Digitar e-mail e senha para acessar !</p>
                        <form method="POST" action="{{route('Admin.credencial')}}">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" name="email" id="email"
                                    value="{{ old('$email') }}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" name="password" id="password"
                                    placeholder="Password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="submit" name="Botao1" class="btn btn-primary" value="Acessar">
                            </div>
                            <div class="input-group mb-4">
                                <b class="imagem-empresa">Esqueci minha senha</b>
                                <div class="input-group mb-3">
                                    <input type="submit" name="Botao2" class="btn btn-warning">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('sweetalert::alert')
</body>

</html>