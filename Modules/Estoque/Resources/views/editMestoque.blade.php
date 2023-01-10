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
                    <h3 class="card-title">Alterar Produto | Voltar: <a
                            href="{{ route('Comercial.Estoque.listarMestoque') }}" class="btn btn-success "><i
                                class="fas fa-arrow-alt-circle-left"></i></a></h3>
                </div>
            </div>

            <div class="modal-body">
                <form role="form" method="post"
                    action="{{ route('Comercial.Estoque.updateMestoque',$mestoqueEditar->id) }}">
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
                        <input type="text" readonly name="id_produto" class="form-control"
                            value="{{$mestoqueEditar->id}}">
                    </div>

                    <div class="card-body">
                        <label class="col-form-label"><i class="fas fa-check"></i> Responsável</label>
                        <input type="text" readonly class="form-control" name="id_responsavel"
                            value="{{ Auth::user()->id ?? ''}}">
                        <input type="text" readonly class="form-control" name="nome_responsavel"
                            value="{{ Auth::user()->name ?? '' }}">
                    </div>

                    <div class="card-body">
                        <label>Código de barra</label>
                        <input type="text" name="codigo_barra" class="form-control" placeholder="Código de barra"
                            value="{{ $mestoqueEditar->codigo_barra ?? '' }}">
                    </div>

                    <div class="card-body">
                        <label>Descrição do produto</label>
                        <input type="text" name="nome_produto" class="form-control" placeholder="Nome do produto"
                            value="{{ $mestoqueEditar->nome_produto ?? '' }}">
                    </div>
                    <div class="card-body">
                        <label>Data vencimento :
                            {{(new DateTime($mestoqueEditar->data_vencimento))->format('d/m/Y H:i:s')}}</label>
                        <input type="datetime-local" name="data_vencimento" class="form-control">
                    </div>
                    <div class="card-body">
                        <label>Categoria</label>
                        <input type="text" name="categoria" class="form-control" placeholder="Categoria"
                            value="{{ $mestoqueEditar->categoria ?? '' }}">
                    </div>
                    <div class="card-body">
                        <label>Marca</label>
                        <input type="text" name="marca" class="form-control" placeholder="Marca"
                            value="{{ $mestoqueEditar->marca ?? '' }}">
                    </div>
                    <div class="card-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Unidade:
                                    {{ $mestoqueEditar->unidade ?? '' }}</label>
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
                        <label>Estoque</label>
                        <input type="number" name="estoque" class="form-control" placeholder="Estoque"
                            value="{{ $mestoqueEditar->estoque ?? '' }}">
                    </div>
                    <div class="card-body">
                        <label>Estoque Minimo</label>
                        <input type="number" name="estoque_minimo" class="form-control" placeholder="Estoque minimo"
                            value="{{ $mestoqueEditar->estoque_minimo ?? '' }}">
                    </div>
                    <div class="card-body">
                        <label>Preço de custo</label>
                        <input type="number" name="preco_custo" step="0.010" class="form-control"
                            placeholder="Preço custo" value="{{ $mestoqueEditar->preco_custo ?? '' }}">
                    </div>
                    <div class="card-body">
                        <label>Preço de venda</label>
                        <input type="number" name="preco_venda" step="0.010" class="form-control"
                            placeholder="Preço venda" value="{{ $mestoqueEditar->preco_venda ?? '' }}">
                    </div>
                    <div class="card-body">
                        <label>Valor do lucro </label>
                        <input type="number" name="preco_lucro" step="0.010" class="form-control"
                            placeholder="Valor lucro" value="{{ $mestoqueEditar->preco_lucro ?? '' }}">
                    </div>
                    <div class="card-body">
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Alterar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @includeIf('Painel.Layouts.footer')

    </div>

    @includeIf('Painel.Layouts.javascript')

</body>

</body>

</html>