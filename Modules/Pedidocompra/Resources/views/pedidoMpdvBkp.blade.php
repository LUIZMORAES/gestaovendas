<!DOCTYPE html>
<html lang="pt-br">

@includeIf('Painel.Layouts.head')

<script src="{{ asset('AdminLTE/plugins/jquery/3.5.1/jquery.min.js') }}"></script>

<body class="hold-transition sidebar-mini layout-fixed">

    @includeIf('Painel.Layouts.header')

    @includeIf('Painel.Layouts.sidebar_lateral')
    <!-- wrapper -->
    <div class="wrapper">
        <div class="content-wrapper">
            <!-- /.card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Incluir produto no pedido | Voltar: <a
                            href="{{ route('Comercial.Venda.listarMpdv') }}" class="btn btn-success "><i
                                class="fas fa-arrow-alt-circle-left"></i></a>
                        Incluir Produto
                        <a class="btn btn btn-warning" href="{{route('Comercial.Estoque.createMestoque')}}"><i
                                class="fa fa-plus"></i></a>

                    </h3>
                </div>
            </div>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Seleção dos produtos</h3>
                                </div>
                                <!-- class container -->
                                <div class="container">
                                    <div class="card-body">
                                        <h3>Escolha produto: O valor total sem desconto e total do produto, já é
                                            calculado automaticamente!
                                            <!-- Trigger the modal with a button -->
                                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal"
                                                data-target="#myModal">Clicar para listar produto</button>
                                        </h3>
                                    </div>

                                    <div class="card-body">
                                        <!-- Form 1-->
                                        <form method="post"
                                            action="{{route('Comercial.Venda.incluirItemPdv',$mpedidoVenda->id)}}">
                                            @csrf
                                            <label>CÓDIGO DO PEDIDO</label>
                                            <input type="text" readonly name="id_pedido" class="form-control"
                                                value="{{$mpedidoVenda->id}}">
                                            <label class="col-form-label"><i class="fas fa-check"></i>
                                                Responsável</label>
                                            <input type="text" readonly class="form-control" name="id_responsavel"
                                                value="{{ Auth::user()->id ?? ''}}">
                                            <input type="text" readonly class="form-control" name="nome_responsavel"
                                                value="{{ Auth::user()->name ?? '' }}">
                                            <label class="col-form-label"><i class="fas fa-check"></i>
                                                Cliente</label>
                                            <input type="text" readonly class="form-control" name="id_cliente"
                                                value="{{ isset($id_cliente) ? $id_cliente : null }}">
                                            <input type="text" readonly class="form-control" name="nomeFantasia"
                                                value="{{ isset($nomeFantasia) ? $nomeFantasia : null }}">
                                            <br>
                                            @if($mestoqueBuscar)
                                            <label>CÓDIGO DO PRODUTO</label>
                                            <input type="text" readonly name="id_produto" class="form-control"
                                                value="{{$mestoqueBuscar->id}}">
                                            <br>
                                            <label>Nome do produto</label>
                                            <input type="text" readonly name="nome_produto" class="form-control"
                                                placeholder="Nome produto" value="{{ $mestoqueBuscar->nome_produto }}">
                                            <label>Código de barra</label>
                                            <input type="text" readonly name="codigo_barra" class="form-control"
                                                placeholder="Código de barra"
                                                value="{{ $mestoqueBuscar->codigo_barra }}">
                                            <label>Quantidade</label>
                                            <input type="number" id="quantidade" name="quantidade" class="form-control"
                                                value="1">
                                            <label>Valor Unitário</label>
                                            <input type="number" id="valor_unitario" name="valor_unitario" step="0.010"
                                                class="form-control" value="{{ $mestoqueBuscar->preco_venda ?? '' }}">
                                            <label>Valor Desconto</label>
                                            <input type="number" id="valor_desconto" name="valor_desconto" step="0.010"
                                                class="form-control" value="0">
                                            <br>
                                            <label for="inputStatus"><button type="button"
                                                    onclick="multiplicar()">Calcular valor total
                                                    produto</button></label>
                                            <p id="valor_Tprotuto" step="0.010" class="form-control">Resultado dos
                                                valores colocados aqui</p>
                                            <button type="submit" class="btn btn-primary">Incluir item no
                                                pedido</button>
                                            @endif
                                        </form>
                                        <!-- Final Form 1-->
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="myModal" role="dialog">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <!-- Form 2-->

                                                <div class="modal-body">
                                                    <p>Lista de Produto</p>
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Voltar</button>
                                                    <!-- /.card-header -->
                                                    <div class="card-body">
                                                        <table id="example1" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>ID</th>
                                                                    <th>Código_barra</th>
                                                                    <th>Produto</th>
                                                                    <th>Estoque</th>
                                                                    <th>Estoque Minimo</th>
                                                                    <th>Preço venda</th>
                                                                    <th>Pedido | Ação</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                @foreach($mestoque as $mproduto)
                                                                <tr
                                                                    class="{{$mproduto->estoque <= $mproduto->estoque_minimo ? 'bg-danger' : ''}}">
                                                                    <td>{{$mproduto->id}}</td>
                                                                    <td>{{$mproduto->codigo_barra}}</td>
                                                                    <td>{{$mproduto->nome_produto}}</td>
                                                                    <td>{{$mproduto->estoque}}</td>
                                                                    <td>{{$mproduto->estoque_minimo}}</td>
                                                                    <td>{{$mproduto->preco_venda}}</td>
                                                                    <td>
                                                                        <!-- Form 2-->
                                                                        <form method="post"
                                                                            action="{{route('Comercial.Venda.buscarPestoque',$mproduto->id)}}">
                                                                            @csrf
                                                                            <input type="text" readonly name="id_pedido"
                                                                                class="form-control"
                                                                                value="{{$mpedidoVenda->id}}">
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Buscar
                                                                                produto</button>
                                                                        </form>
                                                                        <!-- Final Form 2-->
                                                                    </td>
                                                                </tr>
                                                                @endforeach

                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>ID</th>
                                                                    <th>Código_barra</th>
                                                                    <th>Produto</th>
                                                                    <th>Estoque</th>
                                                                    <th>Estoque Minimo</th>
                                                                    <th>Preço venda</th>
                                                                    <th>Pedido | Ação</th>
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
                                <!-- Fim class container -->
                            </div>
                        </div>
                        <!-- right column -->
                        <div class="col-md-6">
                            <!-- general form elements disabled -->
                            <div class="card card-warning">
                                <div class="card-header">
                                    <h3 class="card-title">Conferir produtos escolhidos!</h3>
                                </div>
                                <!-- class container -->
                                <div class="container">

                                    <div class="card-body">
                                        <h3>A lista de itens do pedido, só aparece depois que escolher o PRODUTO!
                                            <!-- Trigger the modal with a button -->
                                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal"
                                                data-target="#myModalitem">Clicar para listar itens pedido</button>
                                        </h3>
                                        <a class="btn btn-success"
                                            href="{{route('Comercial.Venda.conferirItemMpdv',$mpedidoVenda->id)}}"><i
                                                class="fa fa-edit"></i>CONFERIR PEDIDO</a>
                                    </div>
                                    <!-- Form 3-->
                                    <form method="post" action="{{route('Comercial.Venda.finalizaMpdv')}}">
                                        @csrf
                                        <div class="card-body">
                                            <label>CÓDIGO DO PEDIDO</label>
                                            <input type="text" readonly name="id_pedido" class="form-control"
                                                value="{{$mpedidoVenda->id}}">
                                            <label>Valor total sem desconto</label>
                                            <input type="number" name="valorTotalsemDesconto" class="form-control"
                                                placeholder="Valor total sem desconto"
                                                value="{{ $mpedidoVenda->valorTotalsemDesconto ?? '' }}">

                                            <div class="card-body">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text" for="inputGroupSelect01">Forma
                                                            de pagamento 1</label>
                                                    </div>
                                                    <select class="custom-select" name="formaPgto1"
                                                        id="inputGroupSelect01">
                                                        <option selected>Selecione</option>
                                                        <option value="Dinheiro">Dinheiro</option>
                                                        <option value="Debito">Débito</option>
                                                        <option value="Credito">Crédido</option>
                                                    </select>
                                                </div>
                                                <label>Valor forma de pagamento 1</label>
                                                <input type="number" id="valorformaPgto1" name="valorformaPgto1"
                                                    step="0.010" class="form-control"
                                                    placeholder="Valor forma pagamento 1">
                                            </div>
                                            <div class="card-body">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text" for="inputGroupSelect01">Forma
                                                            de pagamento 2</label>
                                                    </div>
                                                    <select class="custom-select" name="formaPgto2"
                                                        id="inputGroupSelect01">
                                                        <option selected>Selecione</option>
                                                        <option value="Dinheiro">Dinheiro</option>
                                                        <option value="Debito">Débito</option>
                                                        <option value="Credito">Crédido</option>
                                                    </select>
                                                </div>
                                                <label>Valor forma de pagamento 2</label>
                                                <input type="number" id="valorformaPgto2" name="valorformaPgto2"
                                                    step="0.010" class="form-control"
                                                    placeholder="Valor forma pagamento 2">
                                                <br>
                                                <label><button type="button" onclick="calcularFpagto()">Calcular Forma
                                                        de pagamento</button></label>
                                                <p id="valor_Fpagto" step="0.010" class="form-control">Resultado dos
                                                    valores colocados aqui</p>

                                            </div>
                                            <div class="card-body">
                                                <h3>Valor total pedido</h3>
                                                <input type="number" id="valorTotalPedido" name="valorTotalPedido"
                                                    step="0.010" class="form-control"
                                                    value="{{ $mpedidoVenda->valorTotalPedido ?? '' }}">
                                                <label>Valor total desconto</label>
                                                <input type="number" name="valorTotaldesconto" class="form-control"
                                                    placeholder="Valor total desconto"
                                                    value="{{ $mpedidoVenda->valorTotalDesconto ?? '' }}">
                                                <h3>Valor total recebido</h3>
                                                <input type="number" id="valorTotalRecebido" name="valorTotalRecebido"
                                                    step="0.010" class="form-control" value="0">
                                                <h3>Valor Troco</h3>
                                                <input type="number" name="valorTroco" step="0.010" class="form-control"
                                                    placeholder="Valor troco">
                                                <label><button type="button" onclick="calcularTroco()">Calcular
                                                        troco</button></label>
                                                <p id="valor_Troco" step="0.010" class="form-control">Resultado dos
                                                    valores colocados aqui</p>
                                                <br>
                                                <button type="submit" class="btn btn-success">Finalizar pedido</button>
                                            </div>
                                    </form>
                                    <!-- Final Form 3-->
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="myModalitem" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <!-- Form 2-->

                                            <div class="modal-body">
                                                <p>Lista de itens pedido</p>
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Voltar</button>
                                                <!-- /.card-header -->
                                                <div class="card-body">
                                                    <table id="example1" class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Pedido</th>
                                                                <th>Produto</th>
                                                                <th>Quantidade</th>
                                                                <th>Valor unitário</th>
                                                                <th>Valor desconto</th>
                                                                <th>Valor sem desconto</th>
                                                                <th>Valor sub-total</th>
                                                                <th>Ação</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($mpedidoVendaItem as $mpedidoVI)
                                                            <tr>
                                                                <td>{{$mpedidoVI->id}}</td>
                                                                <td>{{$mpedidoVI->id_pedido_item}}</td>
                                                                <td>{{$mpedidoVI->nome_produto}}</td>
                                                                <td>{{$mpedidoVI->quantidade}}</td>
                                                                <td>{{$mpedidoVI->valor_unitario}}</td>
                                                                <td>{{$mpedidoVI->valor_desconto}}</td>
                                                                <td>{{$mpedidoVI->valor_semDesconto}}</td>
                                                                <td>{{$mpedidoVI->valor_totalProduto}}</td>
                                                                <td>
                                                                    <a class="btn btn-danger "
                                                                        href="{{route('Comercial.Venda.apagarItemMpdv',$mpedidoVI->id)}}"><i
                                                                            class="fa fa-trash"></i></a>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Pedido</th>
                                                                <th>Produto</th>
                                                                <th>Quantidade</th>
                                                                <th>Valor unitário</th>
                                                                <th>Valor desconto</th>
                                                                <th>Valor sem desconto</th>
                                                                <th>Valor sub-total</th>
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
                </div>
        </div>
        </section>

    </div>
    </div>
    @includeIf('Painel.Layouts.javascript')

    <script>
    function multiplicar() {

        var inputvalue1 = Number(document.getElementById('quantidade').value);
        var inputvalue2 = Number(document.getElementById('valor_unitario').value);
        var inputvalue3 = Number(document.getElementById('valor_desconto').value);

        result = (inputvalue1 * inputvalue2) - inputvalue3;

        document.getElementById('valor_Tprotuto').innerHTML = result.toFixed(2);

    }

    function calcularFpagto() {

        var inputvalue4 = Number(document.getElementById('valorformaPgto1').value);
        var inputvalue5 = Number(document.getElementById('valorformaPgto2').value);
        var inputvalue6 = Number(document.getElementById('valorTotalPedido').value);

        resultPgto = (inputvalue5 + inputvalue4) - inputvalue6;

        document.getElementById('valor_Fpagto').innerHTML = resultPgto.toFixed(2);
    }

    function calcularTroco() {

        var inputvalue7 = Number(document.getElementById('valorTotalPedido').value);
        var inputvalue8 = Number(document.getElementById('valorTotalRecebido').value);

        resultTroco = (inputvalue8 - inputvalue7);

        document.getElementById('valor_Troco').innerHTML = resultTroco.toFixed(2);
    }
    </script>

</body>

</html>