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
                        <h5>Listar Plano de contas
                            <!-- Trigger the modal with a button -->
                            <a title="Cadastrar cliente " class="btn btn btn-success "
                                href="{{route('Contabilidade.Planocontas.createMplanoconta')}}"><i
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
                                <th>Conta</th>
                                <th>Descrição</th>
                                <th>Classe</th>
                                <th>Ação</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach($mplanoconta as $mcontas)

                            <tr>
                                <td>{{$mcontas->id}}</td>
                                <td>{{$mcontas->cod_conta}}</td>
                                <td>{{$mcontas->descricao}}</td>
                                <td>{{$mcontas->classe}}</td>
                                <td>
                                    <a title="Alterar cliente " class="btn btn-warning "
                                        href="{{route('Contabilidade.Planocontas.editMplanoconta',$mcontas->id)}}"><i
                                            class="fa fa-edit"></i></a>
                                </td>
                            </tr>

                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>

                                <th>ID</th>
                                <th>Conta</th>
                                <th>Descrição</th>
                                <th>Classe</th>
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
