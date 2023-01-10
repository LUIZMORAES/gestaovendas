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
                        <h5>Listar estatistica
                            <!-- Trigger the modal with a button -->
                            <a title="Cadastrar link " class="btn btn btn-success "
                                href="{{route('Estatistica.createMlink')}}"><i class="fa fa-plus"></i></a>
                        </h5>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>

                                <th>ID</th>
                                <th>Razão social</th>
                                <th>Nome fantasia</th>
                                <th>Link</th>
                                <th>Ação</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach($mestatistica as $mestatisticas)

                            <tr>
                                <td>{{$mestatisticas->id}}</td>
                                <td>{{$mestatisticas->razaoSocial}}</td>
                                <td>{{$mestatisticas->nomeFantasia}}</td>
                                <td>{{$mestatisticas->link}}</td>
                                <td>
                                    <a title="Alterar link " class="btn btn-warning "
                                        href="{{route('Estatistica.editMlink',$mestatisticas->id)}}"><i
                                            class="fa fa-edit"></i></a>

                                    <!-- Form calcula estatistica-->
                                    <form method="post"
                                        action="{{route('Estatistica.acompanhaMlink',$mestatisticas->id)}}">
                                        @csrf
                                        <input type="hidden" name="registro" value="{{$mestatisticas->id}}">
                                        <input type="hidden" name="link" value="{{$mestatisticas->link}}">
                                        <button type="submit" title="Painel de Acompanhamento "
                                            class="btn btn-primary"><i class="fa fa-fax"></i></button>
                                    </form>
                                    <!-- Final Form calcula estatistica-->
                                </td>

                            </tr>

                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>

                                <th>ID</th>
                                <th>Razão social</th>
                                <th>Nome fantasia</th>
                                <th>Link</th>
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
