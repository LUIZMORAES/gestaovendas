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
                        <h5>Listar Contas a Pagar
                            <!-- Trigger the modal with a button -->
                            <a title="Cadastrar conta a pagar " class="btn btn btn-success "
                                href="{{route('Financeiro.Pagar.createMpagar')}}"><i class=" fa fa-plus"></i></a>
                        </h5>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>

                                <th>ID</th>
                                <th>Fornecedor</th>
                                <th>Pedido</th>
                                <th>Emissão</th>
                                <th>Vencimento</th>
                                <th>Pagamento</th>
                                <th>Valor</th>
                                <th>Parcela</th>
                                <th>Vlr Parcela</th>
                                <th>Situação</th>
                                <th>Ação</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach($mpagar as $mpaga)

                            <tr>
                                <td>{{$mpaga->id}}</td>
                                <td>{{$mpaga->nomeFantasia}}</td>
                                <td>{{$mpaga->id_pedido}}</td>
                                <td>{{date('d/m/Y', strtotime($mpaga->dt_emissao))}}</td>
                                @if ($mpaga->dt_vencimento)
                                <td>{{date('d/m/Y', strtotime($mpaga->dt_vencimento))}}</td>
                                @else
                                <td></td>
                                @endif
                                @if ($mpaga->dt_pagamento)
                                <td>{{date('d/m/Y', strtotime($mpaga->dt_pagamento))}}</td>
                                @else
                                <td></td>
                                @endif
                                <td>R$
                                    {{number_format($mpaga->valorTotal ? $mpaga->valorTotal : null ,2, ',', '.')}}
                                </td>
                                <td>{{$mpaga->parcelas}}</td>
                                <td>R$
                                    {{number_format($mpaga->valorformaPgto1 ? $mpaga->valorformaPgto1 : null ,2, ',', '.')}}
                                </td>
                                <td>{{$mpaga->situacao}}</td>
                                <td>
                                    <a title="Alterar conta a pagar " class="btn btn-warning "
                                        href="{{route('Financeiro.Pagar.editMpagar',$mpaga->id)}}"><i
                                            class="fa fa-edit"></i></a>
                                </td>
                            </tr>

                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>

                                <th>ID</th>
                                <th>Fornecedor</th>
                                <th>Pedido</th>
                                <th>Emissão</th>
                                <th>Vencimento</th>
                                <th>Pagamento</th>
                                <th>Valor</th>
                                <th>Parcela</th>
                                <th>Vlr Parcela</th>
                                <th>Situação</th>
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
