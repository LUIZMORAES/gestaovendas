<!DOCTYPE html>
<html lang="pt-br">

@includeIf('Painel.Layouts.head')

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

        @includeIf('Painel.Layouts.header')

        @includeIf('Painel.Layouts.sidebar_lateral')

        <div class="content-wrapper">
            <div class="card-header">
                <h3 class="card-title">Acompanhamento Estatística: </h3>
                <a title="Voltar para lista de clientes " href="{{ route('Estatistica.listarMlink') }}"
                    class="btn btn-success "><i class="fas fa-arrow-alt-circle-left"></i></a>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
                <!-- input states -->

                <div class="row">

                    <div class="col-3">
                        <input type="hidden" name="id_responsavel" value="{{ Auth::user()->id  ?? '' }}">
                    </div>
                    <div class="col-10">
                        <label>Nome fantasia</label>
                        <input type="text" readonly name="nomeFantasia" class="form-control"
                            value="{{$nomeFantasia ?? ''}}">
                    </div>
                    <div class="col-10">
                        <label>Link</label>
                        <input type="text" readonly name="link" class="form-control"
                            value="{{ isset($link) ? $link : null }}">
                    </div>
                </div>
                <hr>
                <div class="col-10">
                    <label>Acompanhamento chamadas geral</label>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Data</th>
                                <th>Hora</th>
                                <th>Total</th>
                                <th>Falha operadora</th>
                                <th>Telefone incorreto</th>
                                <th>Não atendida</th>
                                <th>Atendimento máquina</th>
                                <th>Humano</th>
                                <th>Abandono pre_fila</th>
                                <th>Abandono fila</th>
                                <th>Atendimento pa</th>
                                <th>Ocorrencias total</th>
                                <th>Sem contato</th>
                                <th>Com contato</th>
                                <th>Abordagem</th>
                                <th>Fechamento</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach($mestatisticaGeral as $geral)
                            <tr>
                                <td>{{$geral->id}}</td>
                                <td>{{$geral->data}}</td>
                                <td>{{$geral->hora}}</td>
                                <td>{{$geral->chamadas_total}}</td>
                                <td>{{$geral->chamadas_falha_operadora}}</td>
                                <td>{{$geral->chamadas_telefone_incorreto}}</td>
                                <td>{{$geral->chamadas_nao_atendida}}</td>
                                <td>{{$geral->chamadas_atendimento_maquina}}</td>
                                <td>{{$geral->chamadas_atendimento_humano}}</td>
                                <td>{{$geral->chamadas_abandono_pre_fila}}</td>
                                <td>{{$geral->chamadas_abandono_fila}}</td>
                                <td>{{$geral->chamadas_atendimento_pa}}</td>
                                <td>{{$geral->ocorrencias_total}}</td>
                                <td>{{$geral->ocorrencias_sem_contato}}</td>
                                <td>{{$geral->ocorrencias_com_contato}}</td>
                                <td>{{$geral->ocorrencias_abordagem}}</td>
                                <td>{{$geral->ocorrencias_fechamento}}</td>

                            </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Data</th>
                                <th>Hora</th>
                                <th>Total</th>
                                <th>Falha operadora</th>
                                <th>Telefone incorreto</th>
                                <th>Não atendida</th>
                                <th>Atendimento máquina</th>
                                <th>Humano</th>
                                <th>Abandono pre_fila</th>
                                <th>Abandono fila</th>
                                <th>Atendimento pa</th>
                                <th>Ocorrencias total</th>
                                <th>Sem contato</th>
                                <th>Com contato</th>
                                <th>Abordagem</th>
                                <th>Fechamento</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <hr>
                <div class="col-10">
                    <label>Acompanhamento chamadas por cliente</label>
                </div>
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Data</th>
                                <th>Hora</th>
                                <th>Total</th>
                                <th>Falha operadora</th>
                                <th>Telefone incorreto</th>
                                <th>Não atendida</th>
                                <th>Atendimento máquina</th>
                                <th>Humano</th>
                                <th>Abandono pre_fila</th>
                                <th>Abandono fila</th>
                                <th>Atendimento pa</th>
                                <th>Ocorrencias total</th>
                                <th>Sem contato</th>
                                <th>Com contato</th>
                                <th>Abordagem</th>
                                <th>Fechamento</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($mestatisticaCliente as $cliente)
                            <tr>
                                <td>{{$cliente->id}}</td>
                                <td>{{$cliente->cliente}}</td>
                                <td>{{$cliente->data}}</td>
                                <td>{{$cliente->hora}}</td>
                                <td>{{$cliente->chamadas_total}}</td>
                                <td>{{$cliente->chamadas_falha_operadora}}</td>
                                <td>{{$cliente->chamadas_telefone_incorreto}}</td>
                                <td>{{$cliente->chamadas_nao_atendida}}</td>
                                <td>{{$cliente->chamadas_atendimento_maquina}}</td>
                                <td>{{$cliente->chamadas_atendimento_humano}}</td>
                                <td>{{$cliente->chamadas_abandono_pre_fila}}</td>
                                <td>{{$cliente->chamadas_abandono_fila}}</td>
                                <td>{{$cliente->chamadas_atendimento_pa}}</td>
                                <td>{{$cliente->ocorrencias_total}}</td>
                                <td>{{$cliente->ocorrencias_sem_contato}}</td>
                                <td>{{$cliente->ocorrencias_com_contato}}</td>
                                <td>{{$cliente->ocorrencias_abordagem}}</td>
                                <td>{{$cliente->ocorrencias_fechamento}}</td>
                            </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Data</th>
                                <th>Hora</th>
                                <th>Total</th>
                                <th>Falha operadora</th>
                                <th>Telefone incorreto</th>
                                <th>Não atendida</th>
                                <th>Atendimento máquina</th>
                                <th>Humano</th>
                                <th>Abandono pre_fila</th>
                                <th>Abandono fila</th>
                                <th>Atendimento pa</th>
                                <th>Ocorrencias total</th>
                                <th>Sem contato</th>
                                <th>Com contato</th>
                                <th>Abordagem</th>
                                <th>Fechamento</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <hr>
                <div class="col-10">
                    <label>Gráficos de acompanhamento por cliente</label>
                </div>

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">

                                <!-- PIE CHART -->
                                <div class="card card-danger">
                                    <div class="card-header">
                                        <h3 class="card-title">Pie Chart</h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                    class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="pieChart"
                                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                                <!-- BAR CHART -->
                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Bar Chart</h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                    class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                                    class="fas fa-times"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart">
                                            <canvas id="barChart"
                                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->

                            </div>
                            <!-- /.col (LEFT) -->
                            <div class="col-md-6">
                                <!-- LINE CHART -->
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Line Chart</h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                    class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                                    class="fas fa-times"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart">
                                            <canvas id="lineChart"
                                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->


                            </div>
                            <!-- /.col (RIGHT) -->
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->

                </section>
                <!-- /.content -->
            </div>
        </div>
        <!-- /.card-body -->

    </div>

    @includeIf('Painel.Layouts.footer')

    </div>

    @includeIf('Painel.Layouts.javascript')

</body>

</html>