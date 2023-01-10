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
                    @if(isset($registro))
                    <h3 class="card-title">Alterar Produto : </h3>
                    @else
                    <h3 class="card-title">Incluir Produto : </h3>
                    @endif
                    <a title="Voltar para lista de produtos " href="{{ route('Comercial.Estoque.listarMestoque') }}"
                        class="btn btn-success "><i class="fas fa-arrow-alt-circle-left"></i></a>
                </div>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
                @if(isset($registro))
                <form method="post" action="{{route('Comercial.Estoque.updateMestoque',$registro)}}"
                    enctype="multipart/form-data">
                    @else
                    <form role="form" enctype="multipart/form-data" method="post"
                        action="{{ route('Comercial.Estoque.storeMestoque') }}">
                        @endif

                        @csrf

                        <div class="row">
                            @if(isset($registro))
                            <div class="col-2">
                                <label><i class="fas fa-check"></i> Registro</label>
                                <input type="text" readonly name="registro" class="form-control"
                                    value="{{ isset($registro) ? $registro : null }}">

                            </div>
                            @endif
                            <div class="col-8">
                                <label class="col-form-label"><i class="fas fa-check"></i> Responsável</label>
                                <input type="text" readonly class="form-control" name="id_responsavel"
                                    value="{{ Auth::user()->id  ?? '' }}">
                                <input type="text" readonly class="form-control" name="nome_responsavel"
                                    value="{{ Auth::user()->name  ?? '' }}">
                            </div>
                            <div class="col-6">
                                <label>Código de barra</label>
                                <input type="text" name="codigo_barra" class="form-control"
                                    placeholder="Código de barra"
                                    value="{{ isset($codigo_barra) ? $codigo_barra : null }}">
                            </div>
                            <div class="col-6">
                                <label>* Descrição do produto</label>
                                <input type="text" name="nome_produto" class="form-control"
                                    placeholder="Nome do produto"
                                    value="{{ isset($nome_produto) ? $nome_produto : null }}" required>
                            </div>
                            <div class="col-4">
                                @if(isset($registro))
                                <label>Data vencimento</label>
                                <input type="text" name="data_vencimento" id="dataVencimento" class="form-control"
                                    value="{{ isset($data_vencimento) ? $data_vencimento : null }}">
                                @else
                                <label>Data vencimento : {{ isset($data_vencimento) ? $data_vencimento : null }}</label>
                                <input type="datetime-local" name="data_vencimento" class="form-control"
                                    placeholder="Data de vencimento"
                                    value="{{ isset($data_vencimento) ? $data_vencimento : null }}">
                                @endif
                            </div>
                            <div class="col-4">
                                <label>Categoria</label>
                                <input type="text" name="categoria" class="form-control" placeholder="Categoria"
                                    value="{{ isset($categoria) ? $categoria : null }}">
                            </div>
                            <div class="col-4">
                                <label>Marca</label>
                                <input type="text" name="marca" class="form-control" placeholder="Marca"
                                    value="{{ isset($marca) ? $marca : null }}">
                            </div>
                            <div class="col-4">
                                <div class="col-4">
                                    <label>Unidade</label>
                                    <select class="custom-select" name="unidade" id="inputGroupSelect01">
                                        <option selected>{{ isset($unidade) ? $unidade : null }}</option>
                                        <option value="UN">UN</option>
                                        <option value="ML">ML</option>
                                        <option value="L">L</option>
                                        <option value="CX">CX</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <label>* Conta contabil</label>
                                <input type="text" readonly name="cod_conta" id="codigoconta" class="form-control"
                                    value="{{ isset($cod_conta) ? $cod_conta : '1.1.02.01.01' }}" required>
                            </div>
                            <div class="col-4">
                                <label>* Estoque</label>
                                <input type="number" name="estoque" class="form-control" placeholder="Estoque"
                                    value="{{ isset($estoque) ? $estoque : null }}" required>
                            </div>
                            <div class="col-4">
                                <label>Estoque Minimo</label>
                                <input type="number" name="estoque_minimo" class="form-control"
                                    placeholder="Estoque minimo"
                                    value="{{ isset($estoque_minimo) ? $estoque_minimo : null }}">
                            </div>
                            <div class="col-4">
                                <label>Preço de custo</label>
                                <input type="text" name="preco_custo" id="precocusto" class="form-control"
                                    placeholder="Preço custo" value="{{ isset($preco_custo) ? $preco_custo : null }}">
                            </div>
                            <div class="col-4">
                                <label>* Preço de venda</label>
                                <input type="text" name="preco_venda" id="precovenda" class="form-control"
                                    placeholder="Preço venda" value="{{ isset($preco_venda) ? $preco_venda : null }}"
                                    required>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="modal-footer">
                                <button title="Salvar produto no estoque " type="submit"
                                    class="btn btn-primary">Salvar</button>
                            </div>
                        </div>

                    </form>
            </div>
            <!-- /.card-body -->

        </div>

        @includeIf('Painel.Layouts.footer')

    </div>

    @include('sweetalert::alert')

    @includeIf('Painel.Layouts.javascript')


</body>


</html>