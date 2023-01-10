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
                    <!-- Variavel de empresa -->
                    LM BEBIDAS
                    <small class="float-right">Data: {{ date('d/m/Y') }}</small>
                    </h2>
                </div>
                <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <address>
                        <strong>Comércio de bebidas.</strong><br>
                        Cel/Whatsapp: (11) 96261-3720<br>
                        Email: financeiro@lmbebidas.com.br
                    </address>
                </div>
                <div class="col-sm-4 invoice-col">
                    <b>RELATÓRIO PEDIDO POR PERÍODO</b><br>
                    <b>Periodo:</b> {{(new DateTime($mpedidoVenda->update_at))->format('d/m/Y')}}
                    <b> à </b> {{(new DateTime($mpedidoVenda->update_at))->format('d/m/Y')}}<br>
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
                            <th>Número pedido</th>
                            <th>Situação</th>
                            <th>Forma pgto 1</th>
                            <th>Valor pgto 1</th>
                            <th>Forma pgto 2</th>
                            <th>Valor pgto 2</th>
                            <th>Valor sem desconto</th>
                            <th>Valor desconto</th>
                            <th>Valor pedido</th>
                            <th>Valor recebido</th>
                            <th>Valor troco</th>
                        </tr>
                        </thead>
                        <tbody id="myTable">
                            @foreach($mpedidoVenda as $mpedidoP1)
                                <tr>
                                    <td>{{$mpedidoP1->id}}</td>
                                    <td>{{$mpedidoP1->formaPgto1}}</td>
                                    <td>{{$mpedidoP1->valorformaPgto1}}</td>
                                    <td>{{$mpedidoP1->formaPgto2}}</td>
                                    <td>{{$mpedidoP1->valorformaPgto2}}</td>
                                    <td>{{$mpedidoP1->valor_TotalsemDesconto}}</td>
                                    <td>{{$mpedidoP1->valor_Totaldesconto}}</td>
                                    <td>{{$mpedidoP1->valor_TotalPedido}}</td>
                                    <td>{{$mpedidoP1->valor_TotalRecebido}}</td>
                                    <td>{{$mpedidoP1->valor_Totaltroco}}</td>
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
                        <th style="width:50%">Valor sem desconto:</th>
                        <td>R$ {{$mpedidoVenda->valorTotalsemDesconto}}</td>
                        </tr>
                        <tr>
                        <th>Valor desconto:</th>
                        <td>R$ {{$mpedidoVenda->valorTotalDesconto}}</td>
                        </tr>
                        <tr>
                        <th>Valor do pedido:</th>
                        <td>R$ {{$mpedidoVenda->valorTotalPedido}}</td>
                        </tr>
                        <tr>
                        <th>Valor total recebido</th>
                        <td>R$ {{$mpedidoVenda->valorTotalRecebido}}</td>
                        </tr>
                        <tr>
                        <th>Valor troco</th>
                        <td>R$ {{$mpedidoVenda->valorTroco}}</td>
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
