<!DOCTYPE html>
<html lang="pt-br">

@includeIf('Painel.Layouts.head')

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="error-page">
                <h2 class="headline text-warning">{{ $exception->getMessage() }}</h2>

                <div class="error-content">
                    <h1><i class="fas fa-exclamation-triangle text-warning"></i> Ops!
                        <p>
                            404 - Não foi possível encontrar a página que você estava procurando.
                            Enquanto isso, você pode <a href="{{route('Admin.acesso.login')}}">clique aqui para
                                voltar !</a></p>
                    </h1>
                </div>
                <!-- /.error-content -->
            </div>
            <!-- /.error-page -->
        </section>
        <!-- /.content -->

        @includeIf('Painel.Layouts.Usuario.footerusuario')

    </div>

    @includeIf('Painel.Layouts.javascript')

</body>

</html>