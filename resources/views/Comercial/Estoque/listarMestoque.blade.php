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
                        <h5>Listar Estoque
                            <!-- Trigger the modal with a button -->
                            <a title="Cadastrar produto no estoque " class="btn btn btn-success "
                                href="{{route('Comercial.Estoque.createMestoque')}}"><i class="fa fa-plus"></i></a>
                        </h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>

                                    <th>ID</th>
                                    <th>Produto</th>
                                    <th>Código_barra</th>
                                    <th>Marca</th>
                                    <th>Estoque</th>
                                    <th>Estoque Minimo</th>
                                    <th>Preço de venda</th>
                                    <th>Data Vencimento</th>
                                    <th>Ação</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach($mestoque as $mproduto)

                                <tr class="{{$mproduto->estoque <= $mproduto->estoque_minimo ? 'bg-danger' : ''}}">
                                    <td>{{$mproduto->id}}</td>
                                    <td>{{$mproduto->nome_produto}}</td>
                                    <td>{{$mproduto->codigo_barra}}</td>
                                    <td>{{$mproduto->marca}}</td>
                                    <td>{{$mproduto->estoque}}</td>
                                    <td>{{$mproduto->estoque_minimo}}</td>
                                    <td>
                                        R$
                                        {{number_format($mproduto->preco_venda ? $mproduto->preco_venda : null ,2, ',', '.')}}
                                    </td>
                                    <td>{{(new DateTime($mproduto->data_vencimento))->format('d/m/Y H:i:s')}}</td>
                                    <td>
                                        <a title="Alterar produto no estoque " class="btn btn-warning "
                                            href="{{route('Comercial.Estoque.editMestoque',$mproduto->id)}}"><i
                                                class="fa fa-edit"></i></a>
                                    </td>
                                </tr>

                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>

                                    <th>ID</th>
                                    <th>Produto</th>
                                    <th>Código_barra</th>
                                    <th>Marca</th>
                                    <th>Estoque</th>
                                    <th>Estoque Minimo</th>
                                    <th>Preço de venda</th>
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

        @include('sweetalert::alert')

        @includeIf('Painel.Layouts.javascript')

</body>

</html>
