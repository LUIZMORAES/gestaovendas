<!DOCTYPE html>
<html lang="pt-br">

@includeIf('Painel.Layouts.head')

<body>

    @includeIf('Painel.Layouts.header')

    @includeIf('Painel.Layouts.sidebar_lateral')

    <!-- ./wrapper -->
    <div class="wrapper">
        <div class="content-wrapper">
            <div class="container">
                <!-- Main content -->
                <section class="invoice">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h2 class="page-header">
                                <div class="image">
                                    <img width="100" height="100" src="{{ asset('/adm/logoempresa/logo_lcam.jpg') }}"
                                        class="img-thumbnail" alt="User Image">
                                    LUIZ C A M INFORMÁTICA
                                    <small class="float-right">Data:
                                        {{ date('d/m/Y' ) }}</small>
                                </div>
                            </h2>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            <b>Relatório de pedidos de venda por período :</b><br>
                        </div>
                        <div class="col-sm-4 invoice-col">
                            <b>Data inicial:</b> {{date('d/m/Y', strtotime($data_inicial))}}<br>
                            <b>Data final:</b> {{date('d/m/Y', strtotime($data_final))}}<br>
                        </div>
                        <div class="col-sm-4 invoice-col">
                            <b>Situação:</b> {{$situacao}}<br>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <!-- Table row -->
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <p>Lista de pedido(s)</p>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Cliente</th>
                                        <th>Pedido</th>
                                        <th>Emissão</th>
                                        <th>Sub-total</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    @foreach($mdadospdv as $mdadopdv)
                                    <tr>
                                        <td>{{$mdadopdv->nomeFantasia}}</td>
                                        <td>{{$mdadopdv->id}}</td>
                                        <td>{{date('d/m/Y', strtotime($mdadopdv->dt_emissao))}}</td>
                                        <td>{{  number_format($mdadopdv->valorTotalPedido, 2, ',', '.') }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-6">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Valor total:</th>
                                        <td>
                                            {{  'R$ '.number_format($mtotalpdv, 2, ',', '.') }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </section>
                <!-- /.content -->
            </div>
        </div>
    </div>
    <!-- ./wrapper -->

    @includeIf('Painel.Layouts.footer')

    @includeIf('Painel.Layouts.javascript')

    <script type="text/javascript">
    window.addEventListener("load", window.print());
    </script>
</body>

</html>
