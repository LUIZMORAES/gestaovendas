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
                        <h5>Listar fluxo de caixa
                            <!-- Trigger the modal with a button -->
                            <a title="Iniciar fluxo de caixa  " class="btn btn btn-success "
                                href="{{route('Financeiro.Fluxocaixa.iniciarMfcaixa')}}"><i class="fa fa-plus"></i></a>
                        </h5>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>

                                <th>ID</th>
                                <th>Dt gerado</th>
                                <th>Dt inicial</th>
                                <th>Dt Final</th>
                                <th>Total receber</th>
                                <th>Total pagar</th>
                                <th>Fluxo total</th>
                                <th>Ação</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach($mfluxocaixa as $mfc)

                            <tr>
                                <td>{{$mfc->id}}</td>
                                <td>{{date('d/m/Y H:m:s', strtotime($mfc->dt_gerado))}}</td>
                                <td>{{date('d/m/Y', strtotime($mfc->dt_inicial))}}</td>
                                <td>{{date('d/m/Y', strtotime($mfc->dt_final))}}</td>
                                <td>R$
                                    {{number_format($mfc->valorTrecebe ? $mfc->valorTrecebe : null ,2, ',', '.')}}
                                </td>
                                <td>R$
                                    {{number_format($mfc->valorTpagar ? $mfc->valorTpagar : null ,2, ',', '.')}}
                                </td>
                                <td class="{{$mfc->valorTotal < 0 ? 'bg-danger' : ''}}" aria-hidden="true">
                                    {{$mfc->valorTotal}}</td>
                                <td>
                                    <a title="Excluir fluxo de caixa "
                                        href="{{route('Financeiro.Fluxocaixa.apagarMfcaixa',$mfc->id)}}"
                                        class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                </td>

                            </tr>

                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>

                                <th>ID</th>
                                <th>Dt gerado</th>
                                <th>Dt inicial</th>
                                <th>Dt Final</th>
                                <th>Total receber</th>
                                <th>Total pagar</th>
                                <th>Fluxo total</th>
                                <th>Ação</th>

                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>

        </div>

        @includeIf('Painel.Layouts.footer')

    </div>

    @include('sweetalert::alert')

    @includeIf('Painel.Layouts.javascript')

</body>




</html>