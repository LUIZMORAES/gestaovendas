<!DOCTYPE html>
<html lang="pt-br">

@includeIf('Painel.Layouts.head')

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

    @includeIf('Painel.Layouts.header')

    @includeIf('Painel.Layouts.sidebar_lateral')

    <div class="content-wrapper">
        <!-- /.card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Voltar: <a href="{{ route('Painel.principal.index')}}" class="btn btn-success "><i class="fas fa-arrow-alt-circle-left"></i></a></h3>
            </div>
        </div>

        <!-- /.card-header -->
        <div class="card-body">

            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Atenção!</h5>
                <h1>
                    Acesso não autorizado!
                </h1>
            </div>
        </div>
        <!-- /.card-body -->

    </div>

    @includeIf('Painel.Layouts.footer')

</div>

@includeIf('Painel.Layouts.javascript')

</body>

</html>

