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
                        <h5>Listar Contas a Receber
                            <!-- Trigger the modal with a button -->
                            <a title="Cadastrar conta a receber " class="btn btn btn-success "
                                href="{{route('Financeiro.Receber.createMreceber')}}""><i class=" fa fa-plus"></i></a>
                        </h5>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>

                                <th>ID</th>
                                <th>Nome fantasia</th>
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

                            @foreach($mreceber as $mrecebe)

                            <tr>
                                <td>{{$mrecebe->id}}</td>
                                <td>{{$mrecebe->nomeFantasia}}</td>
                                <td>{{$mrecebe->id_pedido}}</td>
                                <td>{{date('d/m/Y', strtotime($mrecebe->dt_emissao))}}</td>
                                @if ($mrecebe->dt_vencimento)
                                <td>{{date('d/m/Y', strtotime($mrecebe->dt_vencimento))}}</td>
                                @else
                                <td></td>
                                @endif
                                @if ($mrecebe->dt_pagamento)
                                <td>{{date('d/m/Y', strtotime($mrecebe->dt_pagamento))}}</td>
                                @else
                                <td></td>
                                @endif
                                <td>R$
                                    {{number_format($mrecebe->valorTotal ? $mrecebe->valorTotal : null ,2, ',', '.')}}
                                </td>
                                <td>{{$mrecebe->parcelas}}</td>
                                <td>R$
                                    {{number_format($mrecebe->valorformaPgto1 ? $mrecebe->valorformaPgto1 : null ,2, ',', '.')}}
                                </td>
                                <td>{{$mrecebe->situacao}}</td>
                                <td>
                                    <a title="Alterar conta a receber " class="btn btn-warning "
                                        href="{{route('Financeiro.Receber.editMreceber',$mrecebe->id)}}"><i
                                            class="fa fa-edit"></i></a>
                                </td>
                            </tr>

                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>

                                <th>ID</th>
                                <th>Nome fantasia</th>
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