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
                    <h3 class="card-title">Cadastro de Pedido de venda| Voltar: <a
                            href="{{ route('Comercial.Venda.listarMpdv') }}" class="btn btn-success "><i
                                class="fas fa-arrow-alt-circle-left"></i></a></h3>
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
            <!-- Form 1-->
            <form role="form" method="post" action="{{ route('Comercial.Venda.storeMpdv') }}">

                @csrf

                <!-- /.card-header -->
                <div class="card-body">

                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Pedido de venda</h3>
                        </div>

                        <div class="container">
                            <div class="row">
                                <div class="col-3">
                                    <label class="col-form-label"><i class="fas fa-check"></i> Responsável</label>
                                    <input type="type" readonly class="form-control" name="id_responsavel"
                                        value="{{ Auth::user()->id  ?? '' }}">
                                    <input type="type" readonly class="form-control" name="nome_responsavel"
                                        value="{{ Auth::user()->name  ?? '' }}">
                                </div>
                                <div class="col-3">
                                    <label class="col-form-label"><i class="fas fa-check"></i> Número do pedido</label>
                                    <input type="text" readonly class="form-control" name="id_pedido"
                                        value="{{ isset($id_pedido) ? $id_pedido : null }}">
                                </div>
                            </div>

                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header">
                                        <a class="card-link" data-toggle="collapse" href="#collapseOne">
                                            Dados do cliente
                                        </a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-3">
                                                    <label class="col-form-label"><i class="fas fa-check"></i>
                                                        Cliente</label>
                                                    <input type="text" readonly class="form-control" name="id_cliente"
                                                        value="{{ isset($id_cliente) ? $id_cliente : null }}">
                                                    <input type="text" readonly class="form-control" name="nomeFantasia"
                                                        value="{{ isset($nomeFantasia) ? $nomeFantasia : null }}">
                                                </div>
                                                <div class="col-3">
                                                    <div class="card-body">
                                                        <h3>Escolha cliente
                                                            <!-- Trigger the modal with a button -->
                                                            <button type="button" class="btn btn-info btn-lg"
                                                                data-toggle="modal" data-target="#myModal">Clicar para
                                                                listar cliente</button>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <label>Razão Social</label>
                                            <input type="text" readonly name="razaoSocial" class="form-control"
                                                value="{{ isset($razaoSocial) ? $razaoSocial : null }}">
                                            <div class="row">
                                                <div class="col-3">
                                                    <label>CPF / CNPJ / RG </label>
                                                    <input type="text" readonly name="cpfcnpj" class="form-control"
                                                        value="{{ isset($cpfcnpj) ? $cpfcnpj : null }}">
                                                </div>
                                                <div class="col-4">
                                                    <label>Inscrição Estadual</label>
                                                    <input type="text" readonly name="insestadual" class="form-control"
                                                        value="{{ isset($insestadual) ? $insestadual : null }}">
                                                </div>
                                                <div class="col-4">
                                                    <label>Inscrição Municípal</label>
                                                    <input type="text" readonly name="insmunicipal" class="form-control"
                                                        value="{{ isset($insmunicipal) ? $insmunicipal : null }}">
                                                </div>
                                                <div class="col-3">
                                                    <label>CEP</label>
                                                    <input type="text" readonly name="end_cep" class="form-control"
                                                        value="{{ isset($end_cep) ? $end_cep : null }}">
                                                </div>

                                                <div class="col-4">
                                                    <label>Logradouro</label>
                                                    <input type="text" readonly name="end_logradouro"
                                                        class="form-control"
                                                        value="{{ isset($end_logradouro) ? $end_logradouro : null }}">
                                                </div>
                                                <div class="col-4">
                                                    <label>Número</label>
                                                    <input type="text" readonly name="end_numero" class="form-control"
                                                        value="{{ isset($end_numero) ? $end_numero : null }}">
                                                </div>
                                                <div class="col-4">
                                                    <label>Complemento</label>
                                                    <input type="text" readonly name="end_complemento"
                                                        class="form-control"
                                                        value="{{ isset($end_complemento) ? $end_complemento : null }}">
                                                </div>
                                                <div class="col-4">
                                                    <label>Bairro</label>
                                                    <input type="text" readonly name="end_bairro" class="form-control"
                                                        value="{{ isset($end_bairro) ? $end_bairro : null }}">
                                                </div>
                                                <div class="col-4">
                                                    <label>Município</label>
                                                    <input type="text" readonly name="end_cidade" class="form-control"
                                                        value="{{ isset($end_cidade) ? $end_cidade : null }}">
                                                </div>
                                                <div class="col-4">
                                                    <label>Estado</label>
                                                    <input type="text" readonly name="end_uf" class="form-control"
                                                        value="{{ isset($end_uf) ? $end_uf : null }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                                            Endereço de faturamento - EM DESENVOLVIMENTO
                                        </a>
                                    </div>
                                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
                                            Endereço de entrega - EM DESENVOLVIMENTO
                                        </a>
                                    </div>
                                    <div id="collapseThree" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Salvar pedido</button>
                            </div>

                        </div>


                    </div>
                    <!-- /.card-body -->


            </form>
            <!-- Form 1-->
            <!-- Modal 1 -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="modal-body">
                            <p>Lista de cliente</p>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Voltar</button>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Cliente</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- início do preloader -->
                                        <div id="preloader">
                                            <div class="inner">
                                                <!-- HTML DA ANIMAÇÃO -->
                                                <div class="loader">
                                                    @foreach($mcliente as $mclientes)
                                                    <tr>
                                                        <td>{{$mclientes->id}}</td>
                                                        <td>{{$mclientes->nomeFantasia}}</td>
                                                        <td>
                                                            <!-- Form 2-->
                                                            <form method="post"
                                                                action="{{route('Comercial.Venda.buscarEcliente',$mclientes->id)}}">
                                                                @csrf
                                                                <input type="hidden" name="id_cliente"
                                                                    value="{{$mclientes->id}}">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Buscar</button>
                                                            </form>
                                                            <!-- Final Form 2-->
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
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fim Modal -->

        </div>

    </div>

    </div>

    @includeIf('Painel.Layouts.footer')

    </div>

    @includeIf('Painel.Layouts.javascript')


</body>

</html>