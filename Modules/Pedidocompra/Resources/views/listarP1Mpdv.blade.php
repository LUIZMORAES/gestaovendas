<!DOCTYPE html>
<html lang="pt-br">

@includeIf('Painel.Layouts.head')

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

    @includeIf('Painel.Layouts.header')

    @includeIf('Painel.Layouts.sidebar_lateral')

    <div class="content-wrapper">
        <!-- /.card -->
        <div class="card">
            <div class="card-header">
                <div class="container">
                    <h5>RELATÓRIO PEDIDO POR PERÍODO
                        <!-- Trigger the modal with a button -->
                        <a class="btn btn btn-success " href="{{route('Comercial.Venda.periodoMpdv')}}"><i class="fas fa-arrow-alt-circle-left"></i></a>
                        <form><INPUT TYPE="button" VALUE="Atualizar Página" onClick='parent.location="javascript:location.reload()"'></form>
                        @if(session('success'))
                            <span class="alert alert-success">{{ session('success') }}</span>
                        @endif
                        @if(session('erro'))
                            <div class="alert alert-danger" role="alert">
                                {{session('erro')}}
                            </div>
                        @endif
                        @if ($errors->any())
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger" role="alert">
                                        <li>{{$error}}</li>
                                    </div>
                                @endforeach
                            </ul>
                        @endif
                    </h5>
                </div>
            </div>
            <div class="card-body">
                <h5>Total período FINALIZADO</h5>
                <div class="row">
                <div class="col-md-6">
                    Valor forma de pagamento 1
                    <input type="text" step="0.010" readonly class="form-control" value="{{$somarTfpagto1Pdv}}">
                    Valor forma de pagamento 2
                    <input type="text" step="0.010" readonly class="form-control" value="{{$somarTfpagto2Pdv}}">
                    Valor dinheiro
                    <input type="text" step="0.010" readonly class="form-control" value="{{$somarTfpdinheiroPdv}}">
                    Valor Débito
                    <input type="text" step="0.010" readonly class="form-control" value="{{$somarTfpdebitoPdv}}">
                    Valor Crédito
                    <input type="text" step="0.010" readonly class="form-control" value="{{$somarTfpcreditoPdv}}">
                </div>
                <div class="col-md-6">
                    Valor sem desconto
                    <input type="text" step="0.010" readonly class="form-control" value="{{$somarTsemdescPdv}}">
                    Valor desconto
                    <input type="text" step="0.010" readonly class="form-control" value="{{$somarTdescPdv}}">
                    Valor pedido
                    <input type="text" step="0.010" readonly class="form-control" value="{{$somarTpedidoPdv}}">
                    Valor recebido
                    <input type="text" step="0.010" readonly class="form-control" value="{{$somarTrecebidoPdv}}">
                    Valor troco
                    <input type="text" step="0.010" readonly class="form-control" value="{{$somarTtrocoPdv}}">
                </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Número pedido</th>
                        <th>Forma pgto 1</th>
                        <th>Valor pgto 1
                        <input type="text" step="0.010" readonly class="form-control" value="{{$somarTfpagto1Pdv}}">
                        </th>
                        <th>Forma pgto 2</th>
                        <th>Valor pgto 2
                        <input type="text" step="0.010" readonly class="form-control" value="{{$somarTfpagto2Pdv}}">
                        </th>
                        <th>Valor sem desconto
                        <input type="text" step="0.010" readonly class="form-control" value="{{$somarTsemdescPdv}}">
                        </th>
                        <th>Valor desconto
                        <input type="text" step="0.010" readonly class="form-control" value="{{$somarTdescPdv}}">
                        </th>
                        <th>Valor pedido
                        <input type="text" step="0.010" readonly class="form-control" value="{{$somarTpedidoPdv}}">
                        </th>
                        <th>Valor recebido
                        <input type="text" step="0.010" readonly class="form-control" value="{{$somarTrecebidoPdv}}">
                        </th>
                        <th>Valor troco
                        <input type="text" step="0.010" readonly class="form-control" value="{{$somarTtrocoPdv}}">
                        </th>
                        <th>Período</th>
                    </tr>
                    </thead>
                    <tbody>
                        <!-- início do preloader -->
                        <div id="preloader">
                            <div class="inner">
                            <!-- HTML DA ANIMAÇÃO -->
                                <div class="loader">
                                    @foreach($mpedidoVenda as $mpedidoP1)
                                        @if($mpedidoP1->situacao === "FINALIZADO")
                                            <tr>
                                                <td>{{$mpedidoP1->id}}</td>
                                                <td>{{$mpedidoP1->formaPgto1}}</td>
                                                <td>{{$mpedidoP1->valorformaPgto1}}</td>
                                                <td>{{$mpedidoP1->formaPgto2}}</td>
                                                <td>{{$mpedidoP1->valorformaPgto2}}</td>
                                                <td>{{$mpedidoP1->valorTotalsemDesconto}}</td>
                                                <td>{{$mpedidoP1->valorTotalDesconto}}</td>
                                                <td>{{$mpedidoP1->valorTotalPedido}}</td>
                                                <td>{{$mpedidoP1->valorTotalRecebido}}</td>
                                                <td>{{$mpedidoP1->valorTroco}}</td>
                                                <td>{{(new DateTime($mpedidoP1->updated_at))->format('d/m/Y H:i:s')}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    <!-- fim do preloader -->
                                </div>
                            </div>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Número pedido</th>
                        <th>Forma pgto 1</th>
                        <th>Valor pgto 1</th>
                        <th>Forma pgto 2</th>
                        <th>Valor pgto 2</th>
                        <th>Valor sem desconto</th>
                        <th>Valor desconto</th>
                        <th>Valor pedido</th>
                        <th>Valor recebido</th>
                        <th>Valor troco</th>
                        <th>Período</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>

    </div>

    @includeIf('Painel.Layouts.footer')

</div>

@includeIf('Painel.Layouts.javascript')

</body>

<script>
    $(window).on('load', function () {
    $('#preloader .inner').fadeOut();
    $('#preloader').delay(350).fadeOut('slow');
    $('body').delay(350).css({'overflow': 'visible'});
    })
</script>

<style>
    body {
  overflow: hidden;
}

/* ini: Preloader */

#preloader {
    position:fixed;
    top:0;
    left:0;
    right:0;
    bottom:0;
    background-color:#F27620; /* cor do background que vai ocupar o body */
    z-index:999; /* z-index para jogar para frente e sobrepor tudo */
}
#preloader .inner {
    position: absolute;
    top: 50%; /* centralizar a parte interna do preload (onde fica a animação)*/
    left: 50%;
    transform: translate(-50%, -50%);
}
.bolas > div {
  display: inline-block;
  background-color: #fff;
  width: 25px;
  height: 25px;
  border-radius: 100%;
  margin: 3px;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
  animation-name: animarBola;
  animation-timing-function: linear;
  animation-iteration-count: infinite;

}
.bolas > div:nth-child(1) {
    animation-duration:0.75s ;
    animation-delay: 0;
}
.bolas > div:nth-child(2) {
    animation-duration: 0.75s ;
    animation-delay: 0.12s;
}
.bolas > div:nth-child(3) {
    animation-duration: 0.75s  ;
    animation-delay: 0.24s;
}

@keyframes animarBola {
  0% {
    -webkit-transform: scale(1);
    transform: scale(1);
    opacity: 1;
  }
  16% {
    -webkit-transform: scale(0.1);
    transform: scale(0.1);
    opacity: 0.7;
  }
  33% {
    -webkit-transform: scale(1);
    transform: scale(1);
    opacity: 1;
  }
}
/* end: Preloader */
</style>

<style>
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>

</html>

