<!DOCTYPE html>
<html lang="pt-br">

@includeIf('Painel.Layouts.head')

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

        @includeIf('Painel.Layouts.header')

        @includeIf('Painel.Layouts.sidebar_lateral')

        <div class="content-wrapper">
            <div class="card-header">

                <h3 class="card-title">Selecione o período por data de pagamento : </h3>

                <a title="Voltar para lista de fluxo de caixa "
                    href="{{ route('Financeiro.Fluxocaixa.listarMfcaixa') }}" class="btn btn-success "><i
                        class="fas fa-arrow-alt-circle-left"></i></a>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
                <!-- input states -->
                <div class="form-group">

                    <form method="post" action="{{ route('Financeiro.Fluxocaixa.gravarMfcaixa') }}"
                        enctype="multipart/form-data">

                        @csrf
                        <div class="col-2">
                            <input type="hidden" readonly class="form-control" name="id_responsavel"
                                value="{{ Auth::user()->id  ?? '' }}">
                            <input type="hidden" readonly class="form-control" name="nome_responsavel"
                                value="{{ Auth::user()->name  ?? '' }}">
                        </div>

                        <div class="row">
                            <div class="col-2">
                                <label for="periodotime1">Data inicial:</label>
                                <input type="date" id="periodotime1" name="periodotime1">
                            </div>
                            <div class="col-2">
                                <label for="periodotime2">Data final:</label>
                                <input type="date" id="periodotime2" name="periodotime2">
                            </div>
                            <div class="col-2">
                                <label for="inputGroupSelect01">* Situação :
                                    <select class="custom-select" required name="situacao" id="inputGroupSelect01">
                                        <option selected>
                                            {{ isset($situacao) ? $situacao : null }}
                                        </option>
                                        <option value="FINALIZADO">Finalizado</option>
                                        <option value="EM PROCESSO">Em processo</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success"><i class="ion ion-printer"></i> Clicar
                            para gerar fluxo de caixa!</button>

                    </form>

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
