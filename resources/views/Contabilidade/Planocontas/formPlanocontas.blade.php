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
                <label>Alterar plano de contas :</label>
                @else
                <label>Incluir plano de contas :</label>
                @endif
                <a title="Voltar para lista de plano de contas "
                    href="{{ route('Contabilidade.Planocontas.listarMplanoconta') }}" class="btn btn-success "><i
                        class="fas fa-arrow-alt-circle-left"></i></a>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
                <!-- input states -->
                <div class="form-group">
                    @if(isset($registro))
                    <form method="post" action="{{route('Contabilidade.Planocontas.updateMplanoconta',$registro)}}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-2">
                                <label><i class="fas fa-check"></i> Registro</label>
                                <input type="text" readonly name="registro" class="form-control"
                                    value="{{ isset($registro) ? $registro : null }}">
                                <input type="hidden" readonly class="form-control" name="id_responsavel"
                                    value="{{ Auth::user()->id  ?? '' }}">
                            </div>
                            <div class="col-4">
                                <label>* Código conta</label>
                                <input type="text" name="cod_conta" id="codigoconta" class="form-control"
                                    value="{{ isset($cod_conta) ? $cod_conta : null }}" required>
                            </div>
                            <div class="col-4">
                                <label>* Descrição</label>
                                <input type="text" name="descricao" class="form-control"
                                    value="{{ isset($descricao) ? $descricao : null }}" required>
                            </div>
                            <div class="col-3">
                                <label for="inputGroupSelect01">* Condição :
                                    <select class="custom-select" name="condicao" id="inputGroupSelect01" required>
                                        <option selected>{{ isset($condicao) ? $condicao : null }}</option>
                                        <option value="Credora">Credora</option>
                                        <option value="Devedora">Devedora</option>
                                    </select>
                                </label>
                            </div>
                            <div class="col-3">
                                <label for="inputGroupSelect01">* Classe :
                                    <select class="custom-select" name="classe" id="inputGroupSelect01" required>
                                        <option selected>{{ isset($classe) ? $classe : null }}</option>
                                        <option value="Sintetica">Sintética</option>
                                        <option value="Analitica">Analítica</option>
                                    </select>
                                </label>
                            </div>
                            <div class="col-3">
                                <label for="inputGroupSelect01">* Status :
                                    <select class="custom-select" name="status" id="inputGroupSelect01" required>
                                        <option selected>{{ isset($status) ? $status : null }}</option>
                                        <option value="ATIVO">ATIVO</option>
                                        <option value="INATIVO">INATIVO</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>

                </div>

                </form>
                @else
                <form role="form" enctype="multipart/form-data" method="post"
                    action="{{ route('Contabilidade.Planocontas.storeMplanoconta') }}">
                    @csrf
                    <div class="row">

                        <input type="hidden" readonly class="form-control" name="id_responsavel"
                            value="{{ Auth::user()->id  ?? '' }}">

                        <div class="col-4">
                            <label>* Código conta</label>
                            <input type="text" name="cod_conta" id="codigoconta" class="form-control"
                                value="{{ isset($cod_conta) ? $cod_conta : null }}" required>
                        </div>
                        <div class="col-4">
                            <label>* Descrição</label>
                            <input type="text" name="descricao" class="form-control"
                                value="{{ isset($descricao) ? $descricao : null }}" required>
                        </div>
                        <div class="col-4">
                            <label for="inputGroupSelect01">* Condição :
                                <select class="custom-select" name="condicao" id="inputGroupSelect01" required>
                                    <option selected>{{ isset($condicao) ? $condicao : null }}</option>
                                    <option value="Credora">Credora</option>
                                    <option value="Devedora">Devedora</option>
                                </select>
                            </label>
                        </div>
                        <div class="col-4">
                            <label for="inputGroupSelect01">* Classe :
                                <select class="custom-select" name="classe" id="inputGroupSelect01" required>
                                    <option selected>{{ isset($classe) ? $classe : null }}</option>
                                    <option value="Sintetica">Sintética</option>
                                    <option value="Analitica">Analítica</option>
                                </select>
                            </label>
                        </div>
                        <div class="col-4">
                            <label for="inputGroupSelect01">* Status :
                                <select class="custom-select" name="status" id="inputGroupSelect01" required>
                                    <option selected>{{ isset($status) ? $status : null }}</option>
                                    <option value="ATIVO">ATIVO</option>
                                    <option value="INATIVO">INATIVO</option>
                                </select>
                            </label>
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
