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
                    <div class="container">
                        <h4>Relatório Pedido de Compra por período
                            @if(session('success'))
                            <span class="alert alert-success">{{ session('success') }}</span>
                            @endif
                            @if(session('erro'))
                            <div class="alert alert-danger" role="alert">
                                {{session('erro')}}
                            </div>
                            @endif
                            @if ($errors->any())
                            <ul>
                                @foreach ($errors->all() as $error)
                                <div class="alert alert-danger" role="alert">
                                    <li>{{$error}}</li>
                                </div>
                                @endforeach
                            </ul>
                            @endif
                        </h4>
                    </div>
                </div>

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Resultados dos pedidos</h3>
                    </div>
                    <div class="card-body">
                        <!-- Date range -->
                        <div class="form-group">
                            <!-- left column -->
                            <div class="col-md-6">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <form method="post" action="{{route('Comercial.Compra.impRelatorioMpdc')}}">
                                            @csrf
                                            <h3 class="card-title">Selecione o período dos pedidos finalizados
                                                </br>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <label for="periodotime1">Data inicial:</label>
                                                        <input type="date" id="periodotime1" name="periodotime1">

                                                    </div>
                                                    <div class="col-4">
                                                        <label for="periodotime2">Data final:</label>
                                                        <input type="date" id="periodotime2" name="periodotime2">
                                                    </div>
                                                    <button type="submit" class="btn btn-success"><i
                                                            class="ion ion-printer"></i> Clicar para gerar
                                                        relatório</button>
                                                </div>
                                            </h3>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @includeIf('Painel.Layouts.footer')

    </div>

    @include('sweetalert::alert')

    @includeIf('Painel.Layouts.javascript')

</body>

</html>
