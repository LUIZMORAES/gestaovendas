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
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h2 class="page-header">
                                <div class="image">
                                    <img width="100" height="100" src="{{ asset('/adm/logoempresa/logo_lcam.jpg') }}"
                                        class="img-thumbnail" alt="User Image">
                                    LUIZ MORAES
                                    <small class="float-right">Data: {{ date('d/m/Y') }}</small>
                                </div>
                            </h2>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            <address>
                                Cel/Whatsapp: (11) 96261-3720<br>
                                Email: financeiro@lcaminformatioca.com.br
                            </address>
                        </div>
                        <div class="col-sm-4 invoice-col">
                            <b>Emissão:</b> {{(new DateTime())->format('d/m/Y')}}<br>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Ano</th>
                                        <th>Jan</th>
                                        <th>Fev</th>
                                        <th>Mar</th>
                                        <th>Abr</th>
                                        <th>Mai</th>
                                        <th>Jun</th>
                                        <th>Jul</th>
                                        <th>Ago</th>
                                        <th>Set</th>
                                        <th>Out</th>
                                        <th>Nov</th>
                                        <th>Dez</th>
                                        <th>Total</th>
                                        <th>Data</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    @foreach($mbalancopdv as $balancoPdv)

                                    <tr>
                                        <td>{{$balancoPdv->id}}</td>
                                        <td>{{$balancoPdv->ano }}</td>
                                        <td>{{$balancoPdv->valormes1}}</td>
                                        <td>{{$balancoPdv->valormes2}}</td>
                                        <td>{{$balancoPdv->valormes3}}</td>
                                        <td>{{$balancoPdv->valormes4}}</td>
                                        <td>{{$balancoPdv->valormes5}}</td>
                                        <td>{{$balancoPdv->valormes6}}</td>
                                        <td>{{$balancoPdv->valormes7}}</td>
                                        <td>{{$balancoPdv->valormes8}}</td>
                                        <td>{{$balancoPdv->valormes9}}</td>
                                        <td>{{$balancoPdv->valormes10}}</td>
                                        <td>{{$balancoPdv->valormes11}}</td>
                                        <td>{{$balancoPdv->valormes12}}</td>
                                        <td>{{$balancoPdv->valortotal}}</td>
                                        <td>{{(new DateTime($balancoPdv->uptedated))->format('d/m/Y H:i:s')}}</td>
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
                                        <td>R$ {{$mvalortotal}}</td>
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