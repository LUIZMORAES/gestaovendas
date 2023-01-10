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
                            <b>Cliente : {{$mpedidoVenda->id}} - {{$mpedidoVenda->nomeFantasia}}</b><br>
                            <b>CPF / CNPJ :</b> {{$mpedidoVenda->cpfcnpj}}<br>
                        </div>
                        <div class="col-sm-4 invoice-col">
                            <b>RECIBO NÚMERO #000{{$mpedidoVenda->id}}</b><br>
                            <b>Emissão:</b> {{date('d/m/Y', strtotime($mpedidoVenda->dt_emissao))}}<br>
                        </div>
                    </div>
                    <br>
                    <b>PRESTAÇÃO DE SERVIÇO</b>
                    <br>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-6">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Valor sem desconto:</th>
                                        <td>
                                            {{  'R$ '.number_format($mpedidoVenda->valorTotalsemDesconto, 2, ',', '.') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Valor desconto:</th>
                                        <td>{{  'R$ '.number_format($mpedidoVenda->valorTotalDesconto, 2, ',', '.') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Valor do pedido:</th>
                                        <td>{{  'R$ '.number_format($mpedidoVenda->valorTotalPedido, 2, ',', '.') }}
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
