<!DOCTYPE html>
<html lang="pt-br">

@includeIf('Painel.Layouts.head')

<body class="hold-transition sidebar-mini layout-fixed">

    @includeIf('Painel.Layouts.header')

    @includeIf('Painel.Layouts.sidebar_lateral')

    <div class="wrapper">

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Estatística</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
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
                    <label>Gráficos de acompanhamento geral</label>
                </div>
            </div>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- AREA CHART -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Gráfico de área</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <canvas id="areaChart"
                                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                            <!-- DONUT CHART -->
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h3 class="card-title">Gráfico de rosca</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <canvas id="donutChart"
                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                            <!-- PIE CHART -->
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h3 class="card-title">Gráfico de pizza</h3>

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

                        </div>
                        <!-- /.col (LEFT) -->
                        <div class="col-md-6">
                            <!-- LINE CHART -->
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Gráfico de linha</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i>
                                        </button>
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

                            <!-- BAR CHART -->
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Gráfico de barras</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i>
                                        </button>
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

                            <!-- STACKED BAR CHART -->
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Gráfico de barras empilhadas</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <canvas id="stackedBarChart"
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
            <!-- /.content-wrapper -->
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
            <!-- /.content -->
        </div>

    </div>
    <!-- ./wrapper -->

    @includeIf('Painel.Layouts.footer')

    @includeIf('Painel.Layouts.javascript')


</body>

</html>

<script>
$(function() {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
        labels: ['Cliente 1', 'Cliente 2', 'Cliente 3', 'Cliente 4', 'Cliente 5'],
        datasets: [{
                label: 'Total',
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: [46379, 54884, 54441, 37994, 43181]
            },
            {
                label: 'Falha operadora',
                backgroundColor: 'rgba(210, 214, 222, 1)',
                borderColor: 'rgba(210, 214, 222, 1)',
                pointRadius: false,
                pointColor: 'rgba(210, 214, 222, 1)',
                pointStrokeColor: '#c1c7d1',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data: [18127, 25112, 25367, 12390, 14074]
            },
        ]
    }

    var areaChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
            display: false
        },
        scales: {
            xAxes: [{
                gridLines: {
                    display: false,
                }
            }],
            yAxes: [{
                gridLines: {
                    display: false,
                }
            }]
        }
    }

    // This will get the first returned node in the jQuery collection.
    // Isso obterá o primeiro nó retornado na coleção jQuery.
    var areaChart = new Chart(areaChartCanvas, {
        type: 'line',
        data: areaChartData,
        options: areaChartOptions
    })

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
    var lineChartData = jQuery.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, {
        type: 'line',
        data: lineChartData,
        options: lineChartOptions
    })

    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData = {
        labels: [
            'Cliente 1',
            'Cliente 2',
            'Cliente 3',
            'Cliente 4',
            'Cliente 5',
        ],
        datasets: [{
            data: [46379, 54884, 54441, 37994, 43181],
            backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }]
    }
    var donutOptions = {
        maintainAspectRatio: false,
        responsive: true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
    })

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData = donutData;
    var pieOptions = {
        maintainAspectRatio: false,
        responsive: true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
        type: 'pie',
        data: pieData,
        options: pieOptions
    })

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false
    }

    var barChart = new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
    })

    //---------------------
    //- STACKED BAR CHART -
    //---------------------
    var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
    var stackedBarChartData = jQuery.extend(true, {}, barChartData)

    var stackedBarChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            xAxes: [{
                stacked: true,
            }],
            yAxes: [{
                stacked: true
            }]
        }
    }

    var stackedBarChart = new Chart(stackedBarChartCanvas, {
        type: 'bar',
        data: stackedBarChartData,
        options: stackedBarChartOptions
    })
})
</script>

