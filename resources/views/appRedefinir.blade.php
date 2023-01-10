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
        <div class="imagem-redefinir">
            <div class="container-fluid">
                <div class="d-block mx-auto mb-4">
                    <img src="{{URL::asset('adm/logoempresa/logo_lcam.jpg')}}" width="300" height="150">
                    <div class="mx-auto" style="width: 500px;">
                        <div class="small-box bg-info">
                            <p>
                            <h4>SGA - Sistema Gestão Administrativo</h4>
                            Esqueci minha senha !
                            </p>

                            <form method="POST" action="{{route('Admin.acesso.nvcredencial')}}">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Digite o seu e-mail cadastrado no sistema">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" name="password" id="password"
                                        placeholder="Digite nova senha">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <button type="submit" class="btn btn-primary btn-block">Redefinir nova senha</button>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('sweetalert::alert')
</body>

</html>