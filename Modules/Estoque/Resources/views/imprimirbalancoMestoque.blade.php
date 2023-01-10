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
                        LCAM INFORMÁTICA
                        <small class="float-right">Data: {{ date('d/m/Y') }}</small>
                    </h2>
                </div>
                <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <address>
                        <strong>Comércio e Serviços de informártica.</strong><br>
                        Cel/Whatsapp: (11) 96242-2624<br>
                        Email: comercial@lcaminformatica.com.br
                    </address>
                </div>
                <div class="col-sm-4 invoice-col">
                    <b>BALANÇO DO ESTOQUE</b><br>
                </div>
                <!-- /.col -->
                </div>
                <!-- /.row -->
                <!-- Table row -->
                <div class="row">
                <div class="col-12 table-responsive">
                    <p>Lista de produtos</p>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>ID produto</th>
                            <th>Código_barra</th>
                            <th>Produto</th>
                            <th>Categoria</th>
                            <th>Unidade</th>
                            <th>Estoque atual</th>
                            <th>Contagem</th>
                            <th>Preço venda</th>
                            <th>Data</th>
                        </tr>
                        </thead>
                        <tbody id="myTable">
                        @foreach($mestoqueBalanco as $mestBalanco)
                            <tr>
                                <td>{{$mestBalanco->id}}</td>
                                <td>{{$mestBalanco->id_produto }}</td>
                                <td>{{$mestBalanco->codigo_barra}}</td>
                                <td>{{$mestBalanco->nome_produto}}</td>
                                <td>{{$mestBalanco->categoria}}</td>
                                <td>{{$mestBalanco->unidade}}</td>
                                <td>{{$mestBalanco->estoque_atual}}</td>
                                <td>{{$mestBalanco->estoque_contagem}}</td>
                                <td>{{$mestBalanco->preco_venda}}</td>
                                <td>{{(new DateTime($mestBalanco->updated_at))->format('d/m/Y H:i:s')}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
                </div>
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
