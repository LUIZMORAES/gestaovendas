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
                        <h5>Listar Pedido de Compra
                            <!-- Trigger the modal with a button -->
                            <a title="Criar pedido de compra " class="btn btn btn-success "
                                href="{{route('Comercial.Compra.createMpdc')}}"><i class="fa fa-plus"></i></a>
                        </h5>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>

                                <th>ID</th>
                                <th>Fornecedor</th>
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

                                        @foreach($mpedidoCompra as $mpdc)
                                        <tr>
                                            <td>{{$mpdc->id}}</td>
                                            <td>{{$mpdc->nomeFantasia}}</td>
                                            <td>{{$mpdc->situacao}}</td>
                                            <td>R$
                                                {{number_format($mpdc->valorTotalPedido ? $mpdc->valorTotalPedido : null ,2, ',', '.')}}
                                            </td>
                                            <td>{{(new DateTime($mpdc->dt_emissao))->format('d/m/Y')}}</td>
                                            <td>
                                                <a title="Alterar pedido de compra " class="btn btn-success"
                                                    href="{{route('Comercial.Compra.pedidoMpdc',$mpdc->id)}}"><i
                                                        class="fa fa-edit"></i></a>
                                                <a title="Imprimir pedido de Compra " class="btn btn-secondary"
                                                    href="{{route('Comercial.Compra.imprimirMpdc',$mpdc->id)}}"><i
                                                        class="ion ion-printer"></i></a>
                                                <a title="Cancelar pedido de compra " class="btn btn-danger"
                                                    href="{{route('Comercial.Compra.cancelaMpdc',$mpdc->id)}}"><i
                                                        class="fa fa-trash"></i></a>
                                                <a title="Devolução pedido de compra " class="btn btn-warning"
                                                    href="{{route('Comercial.Compra.devolucaoMpdc',$mpdc->id)}}"><i
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
                                <th>Fornecedor</th>
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
