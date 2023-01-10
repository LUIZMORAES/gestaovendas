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
                        <h5>Listar Fornecedor
                            <a title="Criar fornecedor " class="btn btn btn-success "
                                href="{{route('Comercial.Fornecedor.createMfornecedor')}}"><i
                                    class="fa fa-plus"></i></a>
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
                                <th>CPF/CNPJ</th>
                                <th>Telefone</th>
                                <th>E-mail</th>
                                <th>Status</th>
                                <th>Ação</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach($mfornecedor as $mfornecedores)

                            <tr>
                                <td>{{$mfornecedores->id}}</td>
                                <td>{{$mfornecedores->nomeFantasia}}</td>
                                <td>{{$mfornecedores->cpfcnpj}}</td>
                                <td>{{$mfornecedores->telefone}}</td>
                                <td>{{$mfornecedores->email}}</td>
                                <td>{{$mfornecedores->status}}</td>
                                <td>
                                    <a title="Alterar fornecedor " class="btn btn-warning "
                                        href="{{route('Comercial.Fornecedor.editMfornecedor',$mfornecedores->id)}}"><i
                                            class="fa fa-edit"></i></a>
                                </td>
                            </tr>

                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>

                                <th>ID</th>
                                <th>Fornecedor</th>
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