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
                            <!-- Trigger the modal with a button -->
                            <a class="btn btn btn-success "
                                href="{{route('Comercial.Fornecedor.createMfornecedor')}}"><i
                                    class="fa fa-plus"></i></a>
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
                        </h5>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>

                                <th>ID</th>
                                <th>Início</th>
                                <th>Fornecedor</th>
                                <th>Contrato</th>
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
                                <td>{{(new DateTime($mfornecedores->created_at))->format('d/m/Y H:i:s')}}</td>
                                <td>{{$mfornecedores->nomeFantasia}}</td>
                                <td>{{$mfornecedores->contrato_numero}}</td>
                                <td>{{$mfornecedores->cpfcnpj}}</td>
                                <td>{{$mfornecedores->telefone}}</td>
                                <td>{{$mfornecedores->email}}</td>
                                <td>{{$mfornecedores->status}}</td>
                                <td>
                                    <a class="btn btn-warning "
                                        href="{{route('Comercial.Fornecedor.editMfornecedor',$mfornecedores->id)}}"><i
                                            class="fa fa-edit"></i></a>
                                </td>
                            </tr>

                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>

                                <th>ID</th>
                                <th>Início</th>
                                <th>Fornecedor</th>
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

    @includeIf('Painel.Layouts.javascript')

</body>

</html>