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
                    <div class="container-fluid">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-6">
                                <div class="container">
                                    <h3>Balanço do PDV - Pedido de vendas anual</h3>
                                    <h5>O que é balanço de vendas?
                                        Mede o movimento das vendas a prazo e à vista do comércio da capital paulista.
                                        É, assim, um dos maiores termômetros do varejo nacional. O Balanço de Vendas é
                                        baseado em amostra de dados de clientes da Boa Vista Serviços, que administra o
                                        Serviço Central de Proteção ao Crédito (SCPC).</h5>
                                    <h5>CUIDADO! A limpeza do balanço deve iniciar com o botão ZERAR BALANÇO.</h5>
                                    <a class="btn btn btn-danger "
                                        href="{{route('Comercial.Venda.zerarbalancoMpdv')}}">ZERAR
                                        BALANÇO</i></a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="container">
                                    <h5>A cada inicio de balanço será feito uma atualização dos pedidos de vendas.
                                    </h5>
                                    <a class="btn btn btn-success "
                                        href="{{route('Comercial.Venda.iniciarbalancoMpdv')}}">INICIAR</i></a>
                                    <h5>Para Terminar o balanço é necessário fazer a contagem em todos os produtos.</h5>
                                    <h5>Ao Terminar a contagem será feito uma atualização do balanço para estoque.</h5>
                                    <a class="btn btn btn-info "
                                        href="{{route('Comercial.Venda.imprimirbalancoMpdv')}}">IMPRIMIR</i></a>
                                    <h4>Bom trabalho!</h4>
                                    <!-- Trigger the modal with a button -->
                                </div>
                            </div>
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
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ano</th>
                                <th>Jan</th>
                                <th>Fev</th>
                                <th>Mar</th>
                                <th>Abr</th>
                                <th>Mai</th>
                                <th>Jun</th>
                                <th>Jul</th>
                                <th>Ago</th>
                                <th>Set</th>
                                <th>Out</th>
                                <th>Nov</th>
                                <th>Dez</th>
                                <th>Total</th>
                                <th>Data</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($mbalancoPdv as $balancoPdv)

                            <tr>
                                <td>{{$balancoPdv->id}}</td>
                                <td>{{$balancoPdv->ano }}</td>
                                <td>{{$balancoPdv->valormes1}}</td>
                                <td>{{$balancoPdv->valormes2}}</td>
                                <td>{{$balancoPdv->valormes3}}</td>
                                <td>{{$balancoPdv->valormes4}}</td>
                                <td>{{$balancoPdv->valormes5}}</td>
                                <td>{{$balancoPdv->valormes6}}</td>
                                <td>{{$balancoPdv->valormes7}}</td>
                                <td>{{$balancoPdv->valormes8}}</td>
                                <td>{{$balancoPdv->valormes9}}</td>
                                <td>{{$balancoPdv->valormes10}}</td>
                                <td>{{$balancoPdv->valormes11}}</td>
                                <td>{{$balancoPdv->valormes12}}</td>
                                <td>{{$balancoPdv->valortotal}}</td>
                                <td>{{(new DateTime($balancoPdv->uptedated))->format('d/m/Y H:i:s')}}</td>
                            </tr>

                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Ano</th>
                                <th>Jan</th>
                                <th>Fev</th>
                                <th>Mar</th>
                                <th>Abr</th>
                                <th>Mai</th>
                                <th>Jun</th>
                                <th>Jul</th>
                                <th>Ago</th>
                                <th>Set</th>
                                <th>Out</th>
                                <th>Nov</th>
                                <th>Dez</th>
                                <th>Total</th>
                                <th>Data</th>
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

</html>