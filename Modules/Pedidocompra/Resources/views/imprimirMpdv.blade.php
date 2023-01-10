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
                                        {{ date('d/m/Y H:i:s') }}</small>
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
                            <b>NÚMERO PEDIDO #000{{$mpedidoVenda->id}}</b><br>
                            <b>Emissão:</b> {{date('d/m/Y H:i:s', strtotime($mpedidoVenda->dt_emissao))}}<br>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <p>Lista de itens do pedido</p>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Produto</th>
                                        <th>Quantidade</th>
                                        <th>Valor unitário</th>
                                        <th>Valor sem desconto</th>
                                        <th>Valor desconto</th>
                                        <th>Valor sub-total</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    @foreach($mpedidoVendaItem as $mpedidoVI)
                                    <tr>
                                        <td>{{$mpedidoVI->nome_produto}}</td>
                                        <td>{{$mpedidoVI->quantidade}}</td>
                                        <td>
                                            {{  number_format($mpedidoVI->valor_unitario, 2, ',', '.') }}
                                        </td>
                                        <td>{{  number_format($mpedidoVI->valor_semDesconto, 2, ',', '.') }}
                                        </td>
                                        <td>{{  number_format($mpedidoVI->valor_desconto, 2, ',', '.') }}
                                        </td>
                                        <td>{{  number_format($mpedidoVI->valor_totalProduto, 2, ',', '.') }}
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
                                    <tr>
                                        <th>Valor total recebido</th>
                                        <td>{{  'R$ '.number_format($mpedidoVenda->valorTotalRecebido, 2, ',', '.') }}
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