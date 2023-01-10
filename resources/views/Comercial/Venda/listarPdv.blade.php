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
                        <h5>Listar Pedido de Venda
                            <!-- Trigger the modal with a button -->
                            <a title="Criar pedido de venda " class="btn btn btn-success "
                                href="{{route('Comercial.Venda.createMpdv')}}"><i class="fa fa-plus"></i></a>
                        </h5>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>

                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Status</th>
                                <th>Valor total pedido</th>
                                <th>Emissão</th>
                                <th>Ação</th>

                            </tr>
                        </thead>
                        <tbody>
                            <!-- início do preloader -->
                            <div id="preloader">
                                <div class="inner">
                                    <!-- HTML DA ANIMAÇÃO -->
                                    <div class="loader">

                                        @foreach($mpedidoVenda as $mpdv)
                                        <tr>
                                            <td>{{$mpdv->id}}</td>
                                            <td>{{$mpdv->nomeFantasia}}</td>
                                            <td>{{$mpdv->situacao}}</td>
                                            <td>R$
                                                {{number_format($mpdv->valorTotalPedido ? $mpdv->valorTotalPedido : null ,2, ',', '.')}}
                                            </td>
                                            <td>{{(new DateTime($mpdv->dt_emissao))->format('d/m/Y')}}</td>
                                            <td>
                                                <a title="Alterar pedido de venda " class="btn btn-success"
                                                    href="{{route('Comercial.Venda.pedidoMpdv',$mpdv->id)}}"><i
                                                        class="fa fa-edit"></i></a>
                                                <a title="Imprimir pedido de venda " class="btn btn-secondary"
                                                    href="{{route('Comercial.Venda.imprimirMpdv',$mpdv->id)}}"><i
                                                        class="ion ion-printer"></i></a>
                                                <a title="Imprimir recibo " class="btn btn-info"
                                                    href="{{route('Comercial.Venda.reciboMpdv',$mpdv->id)}}"><i
                                                        class="ion ion-printer"></i></a>
                                                <a title="Cancelar pedido de venda " class="btn btn-danger"
                                                    href="{{route('Comercial.Venda.cancelaMpdv',$mpdv->id)}}"><i
                                                        class="fa fa-trash"></i></a>
                                                <a title="Devolução pedido de venda " class="btn btn-warning"
                                                    href="{{route('Comercial.Venda.devolucaoMpdv',$mpdv->id)}}"><i
                                                        class="ion ion-ios-refresh-empty"></i></a>
                                            </td>
                                        </tr>

                                        @endforeach
                                    </div>
                                    <!-- fim do preloader -->

                                </div>
                            </div>

                        </tbody>
                        <tfoot>
                            <tr>

                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Status</th>
                                <th>Valor total pedido</th>
                                <th>Emissão</th>
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