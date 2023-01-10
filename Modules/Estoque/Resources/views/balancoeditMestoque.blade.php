<!DOCTYPE html>
<html lang="pt-br">

@includeIf('Painel.Layouts.head')

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

    @includeIf('Painel.Layouts.header')

    @includeIf('Painel.Layouts.sidebar_lateral')

    <div class="content-wrapper">
        <!-- Modal Edit-->
        <!-- <div class="modal fade" id="modalEdit" role="dialog"> -->
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Alterar produto do BALANÇO</h4>
                </div>
                <div class="modal-body">
                    <form role="form" method="post" action="{{ route('Comercial.Estoque.upbalancoMestoque',$mestoqueEditar->id) }}">
                        @csrf

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

                        <div class="card-body">
                            <label>CÓDIGO DO PRODUTO</label>
                            <input type="text" readonly name="id_produto" class="form-control" value="{{$mestoqueEditar->id}}">
                        </div>

                        <div class="card-body">
                            <label class="col-form-label"><i class="fas fa-check"></i> Responsável</label>
                            <input type="text" readonly class="form-control" name="id_responsavel" value="{{ Auth::user()->id ?? ''}}">
                            <input type="text" readonly class="form-control" name="nome_responsavel" value="{{ Auth::user()->name ?? '' }}">
                        </div>

                        <div class="card-body">
                            <label>Código de barra</label>
                            <input type="text" name="codigo_barra" class="form-control" placeholder="Código de barra" value="{{ $mestoqueEditar->codigo_barra ?? '' }}">
                        </div>

                        <div class="card-body">
                            <label>Descrição do produto</label>
                            <input type="text" name="nome_produto" class="form-control" placeholder="Nome do produto" value="{{ $mestoqueEditar->nome_produto ?? '' }}">
                        </div>
                        <div class="card-body">
                            <label>Data vencimento : {{(new DateTime($mestoqueEditar->data_vencimento))->format('d/m/Y H:i:s')}}</label>
                            <input type="datetime-local" name="data_vencimento" class="form-control" >
                        </div>
                        <div class="card-body">
                            <label>Categoria</label>
                            <input type="text" name="categoria" class="form-control" placeholder="Categoria" value="{{ $mestoqueEditar->categoria ?? '' }}">
                        </div>
                        <div class="card-body">
                            <label>Marca</label>
                            <input type="text" name="marca" class="form-control" placeholder="Marca" value="{{ $mestoqueEditar->marca ?? '' }}">
                        </div>
                        <div class="card-body">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Unidade: {{ $mestoqueEditar->unidade ?? '' }}</label>
                                </div>
                                <select class="custom-select" name="unidade" id="inputGroupSelect01">
                                    <option selected>Selecione</option>
                                    <option value="UN">UN</option>
                                    <option value="ML">ML</option>
                                    <option value="L">L</option>
                                    <option value="CX">CX</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-body">
                            <label>Estoque atual</label>
                            <input type="number" name="estoque_atual" class="form-control" value="{{ $mestoqueEditar->estoque_atual ?? '' }}">
                        </div>
                        <div class="card-body">
                            <label>Contagem</label>
                            <input type="number" name="estoque_contagem" class="form-control" value="{{ $mestoqueEditar->estoque_contagem ?? '' }}">
                        </div>
                        <div class="card-body">
                            <label>Preço de venda</label>
                            <input type="number" name="preco_venda" step="0.010" class="form-control" placeholder="Preço venda" value="{{ $mestoqueEditar->preco_venda ?? '' }}">
                        </div>
                        <div class="card-body">
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Alterar balanço</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- </div> -->
        <!-- Final Modal Edit-->

    </div>

    @includeIf('Painel.Layouts.footer')

</div>

@includeIf('Painel.Layouts.javascript')

</body>

</body>

</html>

