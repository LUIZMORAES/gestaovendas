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
                            <a class="btn btn btn-warning" href="{{route('Comercial.Venda.createMpdv')}}"><i
                                    class="fa fa-plus"></i></a>
                            Incluir Cliente
                            <a class="btn btn btn-warning" href="{{route('Comercial.Cliente.createMcliente')}}"><i
                                    class="fa fa-plus"></i></a>
                            <form><INPUT TYPE="button" VALUE="Atualizar Página"
                                    onClick='parent.location="javascript:location.reload()"'></form>
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
                                <th>Ação</th>
                                <th>Situação</th>
                                <th>Valor total desconto</th>
                                <th>Valor total pedido</th>
                                <th>Data Emissão</th>
                                <th>Data Alteração</th>
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
                                            <td>
                                                {{$mpdv->id_cliente }}-
                                                {{$mpdv->nomeFantasia}}
                                            </td>
                                            <td>
                                                <a class="btn btn-warning"
                                                    href="{{route('Comercial.Venda.editMpdv',$mpdv->id)}}"><i
                                                        class="fa fa-edit"></i></a>

                                            </td>
                                            <td>{{$mpdv->situacao}}</td>
                                            <td>{{  'R$ '.number_format($mpdv->valorTotalDesconto, 2, ',', '.') }}
                                            </td>
                                            <td>{{  'R$ '.number_format($mpdv->valorTotalPedido, 2, ',', '.') }}
                                            </td>
                                            @if($mpdv->dt_emissao)
                                            <td>{{ date('d/m/Y H:i:s', strtotime($mpdv->dt_emissao)) }}</td>
                                            @else
                                            <td>{{ $mpdv->dt_emissao }}</td>
                                            @endif
                                            <td>{{(new DateTime($mpdv->updated_at))->format('d/m/Y H:i:s')}}</td>
                                            <td>
                                                <a class="btn btn-success"
                                                    href="{{route('Comercial.Venda.pedidoMpdv',$mpdv->id)}}"><i
                                                        class="fa fa-edit"></i></a>
                                                <a class="btn btn-secondary"
                                                    href="{{route('Comercial.Venda.imprimirMpdv',$mpdv->id)}}"><i
                                                        class="ion ion-printer"></i></a>
                                                <a class="btn btn-danger"
                                                    href="{{route('Comercial.Venda.cancelaMpdv',$mpdv->id)}}"><i
                                                        class="fa fa-trash"></i></a>
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
                                <th>Ação</th>
                                <th>Situação</th>
                                <th>Valor total desconto</th>
                                <th>Valor total pedido</th>
                                <th>Data Emissão</th>
                                <th>Data Alteração</th>
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

    @includeIf('Painel.Layouts.javascript')

</body>

</html>