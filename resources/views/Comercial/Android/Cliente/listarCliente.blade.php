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
                        <h5>Listar cliente
                            <!-- Trigger the modal with a button -->
                            <a title="Cadastrar cliente " class="btn btn btn-success "
                                href="{{route('Comercial.Cliente.createMcliente')}}"><i class="fa fa-plus"></i></a>
                        </h5>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>

                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Contrato</th>
                                <th>CPF/CNPJ</th>
                                <th>Telefone</th>
                                <th>E-mail</th>
                                <th>Status</th>
                                <th>Ação</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach($mcliente as $mclientes)

                            <tr>
                                <td>{{$mclientes->id}}</td>
                                <td>{{$mclientes->nomeFantasia}}</td>
                                <td>{{$mclientes->contrato_numero}}</td>
                                <td>{{$mclientes->cpfcnpj}}</td>
                                <td>{{$mclientes->telefone}}</td>
                                <td>{{$mclientes->email}}</td>
                                <td>{{$mclientes->status}}</td>
                                <td>
                                    <a title="Alterar cliente " class="btn btn-warning "
                                        href="{{route('Comercial.Cliente.editMcliente',$mclientes->id)}}"><i
                                            class="fa fa-edit"></i></a>
                                </td>
                            </tr>

                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>

                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Contrato</th>
                                <th>CPF/CNPJ</th>
                                <th>Telefone</th>
                                <th>E-mail</th>
                                <th>Status</th>
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
