<!DOCTYPE html>
<html lang="pt-br">

@includeIf('Painel.Layouts.head')

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

        @includeIf('Painel.Layouts.header')

        @includeIf('Painel.Layouts.sidebar_lateral')

        <div class="content-wrapper">
            <div class="card-header">
                @if(isset($registro))
                <h3 class="card-title">Alterar conta a receber : </h3>
                @else
                <h3 class="card-title">Incluir conta a receber : </h3>
                @endif
                <a title="Voltar para lista de conta a receber " href="{{ route('Financeiro.Receber.listarMreceber') }}"
                    class="btn btn-success "><i class="fas fa-arrow-alt-circle-left"></i></a>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
                <!-- input states -->
                <div class="form-group">
                    @if(isset($registro))
                    <form method="post" action="{{route('Financeiro.Receber.updateMreceber')}}"
                        enctype="multipart/form-data">

                        @csrf

                        <div class="row">
                            <div class="col-1">
                                <button title="Clicar para listar pedidos" type="button"
                                    class="btn btn-outline-info btn-lg" data-toggle="modal"
                                    data-target="#myModalpedidos"><i class="fa fa-search"
                                        aria-hidden="true"></i></button>
                            </div>
                            <div class="col-2">
                                <label><i class="fas fa-check"></i> Registro</label>
                                <input type="text" readonly name="registro" class="form-control"
                                    value="{{ isset($registro) ? $registro : null }}">
                                <input type="hidden" readonly class="form-control" name="id_responsavel"
                                    value="{{ Auth::user()->id  ?? '' }}">
                            </div>
                            <div class="col-6">
                                <label>Razão social</label>
                                <input type="text" name="id_cliente" class="form-control" value="{{$id_cliente ?? ''}}">
                                <input type="text" name="razaoSocial" class="form-control"
                                    value="{{$razaoSocial ?? ''}}">
                                <label>Nome fantasia</label>
                                <input type="text" name="nomeFantasia" class="form-control"
                                    value="{{$nomeFantasia ?? ''}}">
                            </div>
                            <div class="col-4">
                                <label>* Conta contabil</label>
                                <input type="text" readonly name="cod_conta" id="codigoconta" class="form-control"
                                    value="{{ isset($cod_conta) ? $cod_conta : '1.1.03.01.01' }}" required>
                            </div>
                            <div class="col-4">
                                <label>Pedido</label>
                                <input type="text" name="id_pedido" class="form-control"
                                    value="{{ isset($id_pedido) ? $id_pedido : null }}">
                            </div>
                            <div class="col-4">
                                <label>Nota fiscal</label>
                                <input type="text" name="id_notafiscal" class="form-control"
                                    value="{{ isset($id_notafiscal) ? $id_notafiscal : null }}">
                            </div>
                            <div class="col-4">
                                <label>Documento</label>
                                <input type="text" name="documento" class="form-control"
                                    value="{{ isset($documento) ? $documento : null }}">
                            </div>
                            <div class="col-4">
                                <label>* Data emissão</label>
                                <input type="text" name="dt_emissao" id="dataEmissao" class="form-control"
                                    value="{{ isset($dt_emissao) ? $dt_emissao : null }}" required>
                            </div>
                            <div class="col-4">
                                <label>Data vencimento</label>
                                <input type="text" name="dt_vencimento" id="dataVencimento" class="form-control"
                                    value="{{ isset($dt_vencimento) ? $dt_vencimento : null }}">
                            </div>
                            <div class="col-4">
                                <label>Data pagamento</label>
                                <input type="text" name="dt_pagamento" id="dataPagamento" class="form-control"
                                    value="{{ isset($dt_pagamento) ? $dt_pagamento : null }}">
                            </div>
                            <div class="col-4">
                                <label>Valor sem desconto</label>
                                <input type="text" name="vlrTsDesconto" id="vlrTsDesconto" class="form-control"
                                    value="{{ isset($vlrTsDesconto) ? $vlrTsDesconto : null }}">
                            </div>
                            <div class="col-4">
                                <label>Valor desconto</label>
                                <input type="text" name="vlrTDesconto" id="vlrTDesconto" class="form-control"
                                    value="{{ isset($vlrTDesconto) ? $vlrTDesconto : null }}">
                            </div>
                            <div class="col-4">
                                <label>Valor total</label>
                                <input type="text" name="vlrTPedido" id="vlrTPedido" class="form-control"
                                    value="{{ isset($vlrTPedido) ? $vlrTPedido : null }}">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-2">
                                <label>* Número de parcelas</label>
                                <input type="number" name="parcelas" class="form-control"
                                    value="{{ isset($parcelas) ? $parcelas : null }}" required>
                            </div>
                            <div class="col-4">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Forma de pagamento
                                        1</label>
                                </div>
                                <select class="custom-select" name="formaPgto1" id="inputGroupSelect01" required>
                                    <option selected>Dinheiro</option>
                                    <option value="Dinheiro">Dinheiro</option>
                                    <option value="Debito">Débito</option>
                                    <option value="Credito">Crédido</option>
                                </select>
                                <label>Valor </label>
                                <input type="text" name="valorformaPgto1" id="precocusto" class="form-control"
                                    value="{{ isset($valorformaPgto1) ? $valorformaPgto1 : null }}">
                            </div>
                            <div class="col-4">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Forma de pagamento
                                        2</label>
                                </div>
                                <select class="custom-select" name="formaPgto2" id="inputGroupSelect01">
                                    <option selected>Dinheiro</option>
                                    <option value="Dinheiro">Dinheiro</option>
                                    <option value="Debito">Débito</option>
                                    <option value="Credito">Crédido</option>
                                </select>
                                <label>Valor </label>
                                <input type="text" name="valorformaPgto2" id="precovenda" class="form-control"
                                    value="{{ isset($valorformaPgto2) ? $valorformaPgto2 : null }}">
                            </div>
                            <div class="col-4">
                                <label>Porcentagem</label>
                                <input type="number" name="porcentagem" class="form-control"
                                    value="{{ isset($porcentagem) ? $porcentagem : null }}">
                            </div>
                            <div class="col-4">
                                <label>Valor juros</label>
                                <input type="text" name="vlrJuros" id="vlrJuros" class="form-control"
                                    value="{{ isset($vlrJuros) ? $vlrJuros : null }}">
                            </div>

                        </div>
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                    @else
                    <form role="form" enctype="multipart/form-data" method="post"
                        action="{{route('Financeiro.Receber.storeMreceber')}}">

                        @csrf

                        <div class="row">
                            <div class="col-1">
                                <button title="Clicar para listar pedidos" type="button"
                                    class="btn btn-outline-info btn-lg" data-toggle="modal"
                                    data-target="#myModalpedidos"><i class="fa fa-search"
                                        aria-hidden="true"></i></button>
                            </div>
                            <div class="col-2">
                                <label><i class="fas fa-check"></i> Registro</label>
                                <input type="text" readonly name="registro" class="form-control"
                                    value="{{ isset($registro) ? $registro : null }}">
                                <input type="hidden" readonly class="form-control" name="id_responsavel"
                                    value="{{ Auth::user()->id  ?? '' }}">
                            </div>
                            <div class="col-6">
                                <label>Razão social</label>
                                <input type="text" name="id_cliente" class="form-control" value="{{$id_cliente ?? ''}}">
                                <input type="text" name="razaoSocial" class="form-control"
                                    value="{{$razaoSocial ?? ''}}">
                                <label>Nome fantasia</label>
                                <input type="text" name="nomeFantasia" class="form-control"
                                    value="{{$nomeFantasia ?? ''}}">
                            </div>
                            <div class="col-4">
                                <label>* Conta contabil</label>
                                <input type="text" readonly name="cod_conta" id="codigoconta" class="form-control"
                                    value="{{ isset($cod_conta) ? $cod_conta : '1.1.03.01.01' }}" required>
                            </div>
                            <div class="col-4">
                                <label>Pedido</label>
                                <input type="text" name="id_pedido" class="form-control"
                                    value="{{ isset($id_pedido) ? $id_pedido : null }}">
                            </div>
                            <div class="col-4">
                                <label>Nota fiscal</label>
                                <input type="text" name="id_notafiscal" class="form-control"
                                    value="{{ isset($id_notafiscal) ? $id_notafiscal : null }}">
                            </div>
                            <div class="col-4">
                                <label>Documento</label>
                                <input type="text" name="documento" class="form-control"
                                    value="{{ isset($documento) ? $documento : null }}">
                            </div>
                            <div class="col-4">
                                <label>* Data emissão</label>
                                <input type="text" name="dt_emissao" id="dataEmissao" class="form-control"
                                    value="{{ isset($dt_emissao) ? $dt_emissao : null }}" required>
                            </div>
                            <div class="col-4">
                                <label>Data vencimento</label>
                                <input type="text" name="dt_vencimento" id="dataVencimento" class="form-control"
                                    value="{{ isset($dt_vencimento) ? $dt_vencimento : null }}">
                            </div>
                            <div class="col-4">
                                <label>Data pagamento</label>
                                <input type="text" name="dt_pagamento" id="dataPagamento" class="form-control"
                                    value="{{ isset($dt_pagamento) ? $dt_pagamento : null }}">
                            </div>
                            <div class="col-4">
                                <label>Valor sem desconto</label>
                                <input type="text" name="vlrTsDesconto" id="vlrTsDesconto" class="form-control"
                                    value="{{ isset($vlrTsDesconto) ? $vlrTsDesconto : null }}">
                            </div>
                            <div class="col-4">
                                <label>Valor desconto</label>
                                <input type="text" name="vlrTDesconto" id="vlrTDesconto" class="form-control"
                                    value="{{ isset($vlrTDesconto) ? $vlrTDesconto : null }}">
                            </div>
                            <div class="col-4">
                                <label>Valor total</label>
                                <input type="text" name="vlrTPedido" id="vlrTPedido" class="form-control"
                                    value="{{ isset($vlrTPedido) ? $vlrTPedido : null }}">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-2">
                                <label>* Número de parcelas</label>
                                <input type="number" name="parcelas" class="form-control"
                                    value="{{ isset($parcelas) ? $parcelas : null }}" required>
                            </div>
                            <div class="col-4">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Forma de pagamento
                                        1</label>
                                </div>
                                <select class="custom-select" name="formaPgto1" id="inputGroupSelect01" required>
                                    <option selected>Dinheiro</option>
                                    <option value="Dinheiro">Dinheiro</option>
                                    <option value="Debito">Débito</option>
                                    <option value="Credito">Crédido</option>
                                </select>
                                <label>Valor </label>
                                <input type="text" name="valorformaPgto1" id="precocusto" class="form-control"
                                    value="{{ isset($valorformaPgto1) ? $valorformaPgto1 : null }}">
                            </div>
                            <div class="col-4">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Forma de pagamento
                                        2</label>
                                </div>
                                <select class="custom-select" name="formaPgto2" id="inputGroupSelect01">
                                    <option selected>Dinheiro</option>
                                    <option value="Dinheiro">Dinheiro</option>
                                    <option value="Debito">Débito</option>
                                    <option value="Credito">Crédido</option>
                                </select>
                                <label>Valor </label>
                                <input type="text" name="valorformaPgto2" id="precovenda" class="form-control"
                                    value="{{ isset($valorformaPgto2) ? $valorformaPgto2 : null }}">
                            </div>
                            <div class="col-4">
                                <label>Porcentagem</label>
                                <input type="number" name="porcentagem" class="form-control"
                                    value="{{ isset($porcentagem) ? $porcentagem : null }}">
                            </div>
                            <div class="col-4">
                                <label>Valor juros</label>
                                <input type="text" name="vlrJuros" id="vlrJuros" class="form-control"
                                    value="{{ isset($vlrJuros) ? $vlrJuros : null }}">
                            </div>

                        </div>
                </div>
                <div class="card-body">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
            </form>
            @endif
            <!-- Modal pedido -->
            <div class="modal fade" id="myModalpedidos" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-body">
                            <p>Lista de pedido de venda</p>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Voltar</button>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Pedido</th>
                                            <th>Cliente</th>
                                            <th>Emissão</th>
                                            <th>Valor</th>
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
                                                        <td>{{$mpdv->nomeFantasia}}
                                                        <td>{{date('d/m/Y', strtotime($mpdv->dt_emissao))}}</td>
                                                        <td>{{$mpdv->valorTotalPedido}}
                                                        </td>
                                                        <td>
                                                            <!-- Form busca pedido-->
                                                            <form method="post"
                                                                action="{{route('Financeiro.Receber.buscarpedidoMreceber',$mpdv->id)}}">
                                                                @csrf
                                                                <input type="hidden" readonly name="registro"
                                                                    value="{{ isset($registro) ? $registro : null }}">
                                                                <input type="hidden" readonly name="id_pedido"
                                                                    value="{{ isset($id_pedido) ? $id_pedido : null }}">
                                                                <button title="Buscar pedido " type="submit"
                                                                    class="btn btn-primary"><i class="fa fa-search"
                                                                        aria-hidden="true"></i></button>
                                                            </form>
                                                            <!-- Final busca pedido-->
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
                                            <th>Pedido</th>
                                            <th>Cliente</th>
                                            <th>Emissão</th>
                                            <th>Valor</th>
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
            <!-- Modal pedido  -->

        </div>
    </div>
    <!-- /.card-body -->

    </div>

    @includeIf('Painel.Layouts.footer')

    </div>

    @includeIf('Painel.Layouts.javascript')

</body>

</html>