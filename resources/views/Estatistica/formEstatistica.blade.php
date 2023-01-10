<!DOCTYPE html>
<html lang="pt-br">

@includeIf('Painel.Layouts.head')

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

        @includeIf('Painel.Layouts.header')

        @includeIf('Painel.Layouts.sidebar_lateral')

        <div class="content-wrapper">
            <div class="card-header">
                @if(isset($registro))
                <h3 class="card-title">Alterar cliente : </h3>
                @else
                <h3 class="card-title">Incluir cliente : </h3>
                @endif
                <a title="Voltar para lista de clientes " href="{{ route('Estatistica.listarMlink') }}"
                    class="btn btn-success "><i class="fas fa-arrow-alt-circle-left"></i></a>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
                <!-- input states -->
                <div class="form-group">
                    @if(isset($registro))
                    <form method="post" action="{{route('Estatistica.updateMlink',$registro)}}"
                        enctype="multipart/form-data">

                        @csrf

                        <div class="row">

                            <div class="col-2">
                                <label><i class="fas fa-check"></i> Registro</label>
                                <input type="text" readonly name="registro" class="form-control"
                                    value="{{ isset($registro) ? $registro : null }}">
                            </div>

                            <div class="col-3">
                                <input type="hidden" readonly class="form-control" name="id_responsavel"
                                    value="{{ Auth::user()->id  ?? '' }}">
                            </div>
                            <div class="col-10">
                                <label>Razão social</label>
                                <input type="text" name="razaoSocial" class="form-control"
                                    value="{{$razaoSocial ?? ''}}">
                                <label>Nome fantasia</label>
                                <input type="text" name="nomeFantasia" class="form-control"
                                    value="{{$nomeFantasia ?? ''}}">
                            </div>
                            <div class="col-10">
                                <label>Link</label>
                                <input type="text" name="link" class="form-control" value="{{$link ?? ''}}">
                            </div>
                        </div>

                        <div class="card-body">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>

                    </form>

                    @else
                    <form role="form" enctype="multipart/form-data" method="post"
                        action="{{ route('Estatistica.storeMlink') }}">

                        @csrf

                        <div class="row">
                            <div class="col-2">
                                <label><i class="fas fa-check"></i> Registro</label>
                                <input type="text" readonly name="registro" class="form-control"
                                    value="{{ isset($registro) ? $registro : null }}">
                            </div>
                            <div class="col-3">
                                <input type="hidden" readonly class="form-control" name="id_responsavel"
                                    value="{{ Auth::user()->id  ?? '' }}">
                            </div>
                            <div class="col-10">
                                <label>Razão social</label>
                                <input type="text" name="razaoSocial" class="form-control"
                                    value="{{$razaoSocial ?? ''}}">
                                <label>Nome fantasia</label>
                                <input type="text" name="nomeFantasia" class="form-control"
                                    value="{{$nomeFantasia ?? ''}}">
                            </div>
                            <div class="col-10">
                                <label>Link</label>
                                <input type="text" name="link" class="form-control" value="{{$link ?? ''}}">
                            </div>
                        </div>
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                </div>
                </form>
                @endif

            </div>
        </div>
        <!-- /.card-body -->

    </div>

    @includeIf('Painel.Layouts.footer')

    </div>

    @includeIf('Painel.Layouts.javascript')

</body>

</body>


</html>
