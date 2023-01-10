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
                                <h3>Balanço do Estoque</h3>
                                <h5>Procedimento :
                                O balanço de estoque exerce o papel de manter o empreendimento seguro
                                contra desperdícios, extravios, furtos, golpes, fraudes e multas por
                                irregularidades na Declaração de Estoque e Mercadorias (DEM), além de
                                melhorar o planejamento de compras e vendas.
                                <h5>Para iniciar a contagem nesse dia não pode haver movimentação de compra e venda.</h5>
                                <h5>CUIDADO! A limpeza do balanço deve iniciar com o botão ZERAR BALANÇO.</h5>
                                <a class="btn btn btn-danger " href="{{route('Comercial.Estoque.zerarbalancoMestoque')}}">ZERAR BALANÇO</i></a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="container">
                                <h5>A cada inicio de contagem será feito uma atualização do estoque para balanço.</h5>
                                <h5>Pode ser conferido ou alterado os campos: codigo barra, nome produto, categoria,
                                    marca, unidade, contagem, preco venda.
                                </h5>
                                <a class="btn btn btn-success " href="{{route('Comercial.Estoque.iniciarbalancoMestoque')}}">INICIAR</i></a>
                                <h5>Para Terminar o balanço é necessário fazer a contagem em todos os produtos.</h5>
                                <h5>Ao Terminar a contagem será feito uma atualização do balanço para estoque.</h5>
                                <a class="btn btn btn-info " href="{{route('Comercial.Estoque.terminarbalancoMestoque')}}">TERMINAR</i></a>
                                <h5>Terminou pode imprimir ou arquivar em pdf o balanço do estoque.</h5>
                                <a class="btn btn btn-info " href="{{route('Comercial.Estoque.imprimirbalancoMestoque')}}">IMPRIMIR</i></a>
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
                        <th>ID produto</th>
                        <th>Código_barra</th>
                        <th>Produto</th>
                        <th>Categoria</th>
                        <th>Unidade</th>
                        <th>Estoque atual</th>
                        <th>Contagem</th>
                        <th>Preço venda</th>
                        <th>Data Vencimento</th>
                        <th>Ação</th>
                    </tr>
                    </thead>
                    <tbody>

                        @foreach($mestoqueBalanco as $mestBalanco)

                            <tr class="{{$mestBalanco->estoque_contagem > 0 ? 'bg-info' : ''}}">
                                <td>{{$mestBalanco->id}}</td>
                                <td>{{$mestBalanco->id_produto }}</td>
                                <td>{{$mestBalanco->codigo_barra}}</td>
                                <td>{{$mestBalanco->nome_produto}}</td>
                                <td>{{$mestBalanco->categoria}}</td>
                                <td>{{$mestBalanco->unidade}}</td>
                                <td>{{$mestBalanco->estoque_atual}}</td>
                                <td>{{$mestBalanco->estoque_contagem}}</td>
                                <td>{{$mestBalanco->preco_venda}}</td>
                                <td>{{(new DateTime($mestBalanco->data_vencimento))->format('d/m/Y H:i:s')}}</td>
                                <td>
                                    <a class="btn btn-warning " href="{{route('Comercial.Estoque.balancoeditMestoque',$mestBalanco->id)}}"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>

                        @endforeach

                    </tbody>
                    <tfoot>
                    <tr>

                    <th>ID</th>
                        <th>ID produto</th>
                        <th>Código_barra</th>
                        <th>Produto</th>
                        <th>Categoria</th>
                        <th>Unidade</th>
                        <th>Estoque atual</th>
                        <th>Contagem</th>
                        <th>Preço venda </th>
                        <th>Data Vencimento</th>
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

