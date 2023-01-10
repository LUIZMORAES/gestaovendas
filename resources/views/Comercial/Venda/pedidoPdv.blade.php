<!DOCTYPE html>
<html lang="pt-br">

@includeIf('Painel.Layouts.head')

<script src="{{ asset('AdminLTE/plugins/jquery/3.5.1/jquery.min.js') }}"></script>

<body class="hold-transition sidebar-mini layout-fixed">

    @includeIf('Painel.Layouts.header')

    @includeIf('Painel.Layouts.sidebar_lateral')

    <!-- wrapper -->
    <div class="wrapper">
        <div class="content-wrapper">
            <div class="card-header">
                <a title="Voltar para lista de pedido de venda " href="{{ route('Comercial.Venda.listarMpdv') }}"
                    class="btn btn-success "><i class="fas fa-arrow-alt-circle-left"></i></a>
                @if(isset($id_pedido))
                <h3 class="card-title">Alterar pedido de venda : </h3>
                @else
                <h3 class="card-title">Incluir pedido de venda : </h3>
                @endif

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-12">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">PEDIDO : {{ isset($id_pedido) ? $id_pedido : null }}</h3>
                                    </div>
                                    <!-- class container -->
                                    <div class="container">
                                        <div class="card-body">
                                            <!-- Form 1-->
                                            @if(isset($id_pedido))
                                            <form method="post"
                                                action="{{route('Comercial.Venda.updateMpdv',$id_pedido)}}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <input type="hidden" readonly class="form-control"
                                                        name="id_responsavel" value="{{ Auth::user()->id  ?? '' }}">
                                                    <input type="hidden" readonly name="id_pedido" class="form-control"
                                                        value="{{ isset($id_pedido) ? $id_pedido : null }}">

                                                    <div class="col-3">

                                                        <button title="Clicar para listar cliente" type="button"
                                                            class="btn btn-outline-info btn-lg" data-toggle="modal"
                                                            data-target="#myModalcliente"><i class="fa fa-search"
                                                                aria-hidden="true"></i></button>

                                                        <button
                                                            title="Clicar para cadastrar cliente, ao terminar buscar na lista!"
                                                            type="button" class="btn btn-outline-info btn-lg"
                                                            data-toggle="modal" data-target="#myModalcadcliente"><i
                                                                class="fas fa-save" aria-hidden="true"></i></button>

                                                    </div>
                                                    <div class="col-4">
                                                        <label>Razão Social</label>
                                                        <input type="text" readonly class="form-control"
                                                            name="id_cliente"
                                                            value="{{ isset($id_cliente) ? $id_cliente : null }}">
                                                        <input type="text" readonly name="razaoSocial"
                                                            class="form-control"
                                                            value="{{ isset($razaoSocial) ? $razaoSocial : null }}">
                                                        <input type="text" readonly class="form-control"
                                                            name="nomeFantasia"
                                                            value="{{ isset($nomeFantasia) ? $nomeFantasia : null }}">
                                                    </div>
                                                    <div class="col-2">
                                                        <label>CPF / CNPJ / RG </label>
                                                        <input type="text" readonly name="cpfcnpj" class="form-control"
                                                            value="{{ isset($cpfcnpj) ? $cpfcnpj : null }}">
                                                    </div>
                                                    <div class="col-3">
                                                        <label>Inscrição Estadual</label>
                                                        <input type="text" readonly name="insestadual"
                                                            class="form-control"
                                                            value="{{ isset($insestadual) ? $insestadual : null }}">
                                                    </div>
                                                    <div class="col-2">
                                                        <label>Inscrição Municípal</label>
                                                        <input type="text" readonly name="insmunicipal"
                                                            class="form-control"
                                                            value="{{ isset($insmunicipal) ? $insmunicipal : null }}">
                                                    </div>
                                                    <div class="col-2">
                                                        <label>CEP</label>
                                                        <input type="text" readonly name="end_cep" class="form-control"
                                                            value="{{ isset($end_cep) ? $end_cep : null }}">
                                                    </div>
                                                    <div class="col-4">
                                                        <label>Logradouro</label>
                                                        <input type="text" readonly name="end_logradouro"
                                                            class="form-control"
                                                            value="{{ isset($end_logradouro) ? $end_logradouro : null }}">
                                                    </div>
                                                    <div class="col-2">
                                                        <label>Número</label>
                                                        <input type="text" readonly name="end_numero"
                                                            class="form-control"
                                                            value="{{ isset($end_numero) ? $end_numero : null }}">
                                                    </div>
                                                    <div class="col-3">
                                                        <label>Complemento</label>
                                                        <input type="text" readonly name="end_complemento"
                                                            class="form-control"
                                                            value="{{ isset($end_complemento) ? $end_complemento : null }}">
                                                    </div>
                                                    <div class="col-4">
                                                        <label>Bairro</label>
                                                        <input type="text" readonly name="end_bairro"
                                                            class="form-control"
                                                            value="{{ isset($end_bairro) ? $end_bairro : null }}">
                                                    </div>
                                                    <div class="col-4">
                                                        <label>Município</label>
                                                        <input type="text" readonly name="end_cidade"
                                                            class="form-control"
                                                            value="{{ isset($end_cidade) ? $end_cidade : null }}">
                                                    </div>
                                                    <div class="col-1">
                                                        <label>Estado</label>
                                                        <input type="text" readonly name="end_uf" class="form-control"
                                                            value="{{ isset($end_uf) ? $end_uf : null }}">
                                                    </div>
                                                    <div class="col-3">
                                                        <label>Status</label>
                                                        <input type="text" readonly name="situacao" class="form-control"
                                                            value="{{ isset($situacao) ? $situacao : null }}">
                                                    </div>
                                                </div>

                                                <hr>
                                                <div class="row">
                                                    <div class="col-2">
                                                        <label>Vlr sem desconto</label>
                                                        <input type="text" readonly name="valorTotalsemDesconto"
                                                            id="vlrTsDesconto" class="form-control"
                                                            value="{{ isset($valorTotalsemDesconto) ? $valorTotalsemDesconto : null }}">
                                                    </div>
                                                    <div class="col-2">
                                                        <label>Vlr com desconto</label>
                                                        <input type="text" readonly name="valorTotalDesconto"
                                                            id="vlrTDesconto" class="form-control"
                                                            value="{{ isset($valorTotalDesconto) ? $valorTotalDesconto : null }}">

                                                    </div>
                                                    <div class="col-2">
                                                        <label>Vlr pedido</label>
                                                        <input type="text" readonly name="valorTotalPedido"
                                                            id="vlrTPedido" class="form-control"
                                                            value="{{ isset($valorTotalPedido) ? $valorTotalPedido : null }}">
                                                    </div>
                                                    <div class="col-2">
                                                        <label>* Data emissão</label>
                                                        <input type="text" name="dt_emissao" id="dataEmissao"
                                                            class="form-control"
                                                            value="{{ isset($dt_emissao) ? $dt_emissao : null }}"
                                                            required>
                                                    </div>
                                                    <div class="col-4">
                                                        <label for="inputGroupSelect01">* Forma de pagamento :
                                                            <select class="custom-select" required name="formaPgto1"
                                                                id="inputGroupSelect01">
                                                                <option selected>
                                                                    {{ isset($formaPgto1) ? $formaPgto1 : null }}
                                                                </option>
                                                                <option value="Pix">Pix</option>
                                                                <option value="Dinheiro">Dinheiro</option>
                                                                <option value="Debito">Débito</option>
                                                                <option value="Credito">Crédido</option>
                                                            </select>
                                                        </label>
                                                    </div>

                                                </div>

                                                <button title="Clicar para salvar pedido" type="submit"
                                                    class="btn btn-outline-success btn-lg"><i class="fas fa-save"></i>
                                                </button>
                                                <a title="Atenção: ao FINALIZAR será atualizado o estoque"
                                                    class="btn btn-outline-warning btn-lg"
                                                    href="{{route('Comercial.Venda.finalizaMpdv',[$id_pedido])}}"><i
                                                        class="fas fa-shipping-fast"></i></a>

                                            </form>
                                            @else
                                            <form method="post" role="form" enctype="multipart/form-data"
                                                action="{{ route('Comercial.Venda.storeMpdv') }}">

                                                @csrf

                                                <div class="row">
                                                    <input type="hidden" readonly class="form-control"
                                                        name="id_responsavel" value="{{ Auth::user()->id  ?? '' }}">
                                                    <input type="hidden" readonly name="id_pedido" class="form-control"
                                                        value="{{ isset($id_pedido) ? $id_pedido : null }}">

                                                    <div class="col-3">

                                                        <button title="Clicar para listar cliente" type="button"
                                                            class="btn btn-outline-info btn-lg" data-toggle="modal"
                                                            data-target="#myModalcliente"><i class="fa fa-search"
                                                                aria-hidden="true"></i></button>
                                                    </div>
                                                    <div class="col-4">
                                                        <label>Razão Social</label>
                                                        <input type="text" readonly class="form-control"
                                                            name="id_cliente"
                                                            value="{{ isset($id_cliente) ? $id_cliente : null }}">
                                                        <input type="text" readonly name="razaoSocial"
                                                            class="form-control"
                                                            value="{{ isset($razaoSocial) ? $razaoSocial : null }}">
                                                        <input type="text" readonly class="form-control"
                                                            name="nomeFantasia"
                                                            value="{{ isset($nomeFantasia) ? $nomeFantasia : null }}">
                                                    </div>
                                                    <div class="col-2">
                                                        <label>CPF / CNPJ / RG </label>
                                                        <input type="text" readonly name="cpfcnpj" class="form-control"
                                                            value="{{ isset($cpfcnpj) ? $cpfcnpj : null }}">
                                                    </div>
                                                    <div class="col-3">
                                                        <label>Inscrição Estadual</label>
                                                        <input type="text" readonly name="insestadual"
                                                            class="form-control"
                                                            value="{{ isset($insestadual) ? $insestadual : null }}">
                                                    </div>
                                                    <div class="col-2">
                                                        <label>Inscrição Municípal</label>
                                                        <input type="text" readonly name="insmunicipal"
                                                            class="form-control"
                                                            value="{{ isset($insmunicipal) ? $insmunicipal : null }}">
                                                    </div>
                                                    <div class="col-2">
                                                        <label>CEP</label>
                                                        <input type="text" readonly name="end_cep" class="form-control"
                                                            value="{{ isset($end_cep) ? $end_cep : null }}">
                                                    </div>
                                                    <div class="col-4">
                                                        <label>Logradouro</label>
                                                        <input type="text" readonly name="end_logradouro"
                                                            class="form-control"
                                                            value="{{ isset($end_logradouro) ? $end_logradouro : null }}">
                                                    </div>
                                                    <div class="col-2">
                                                        <label>Número</label>
                                                        <input type="text" readonly name="end_numero"
                                                            class="form-control"
                                                            value="{{ isset($end_numero) ? $end_numero : null }}">
                                                    </div>
                                                    <div class="col-3">
                                                        <label>Complemento</label>
                                                        <input type="text" readonly name="end_complemento"
                                                            class="form-control"
                                                            value="{{ isset($end_complemento) ? $end_complemento : null }}">
                                                    </div>
                                                    <div class="col-4">
                                                        <label>Bairro</label>
                                                        <input type="text" readonly name="end_bairro"
                                                            class="form-control"
                                                            value="{{ isset($end_bairro) ? $end_bairro : null }}">
                                                    </div>
                                                    <div class="col-4">
                                                        <label>Município</label>
                                                        <input type="text" readonly name="end_cidade"
                                                            class="form-control"
                                                            value="{{ isset($end_cidade) ? $end_cidade : null }}">
                                                    </div>
                                                    <div class="col-1">
                                                        <label>Estado</label>
                                                        <input type="text" readonly name="end_uf" class="form-control"
                                                            value="{{ isset($end_uf) ? $end_uf : null }}">
                                                    </div>
                                                    <div class="col-3">
                                                        <label>Status</label>
                                                        <input type="text" readonly name="situacao" class="form-control"
                                                            value="{{ isset($situacao) ? $situacao : null }}">
                                                    </div>
                                                </div>

                                                <button title="Clicar para salvar pedido" type="submit"
                                                    class="btn btn-outline-success btn-lg"><i class="fas fa-save"></i>
                                                </button>

                                            </form>
                                            @endif
                                            <!-- Final Form 1-->
                                        </div>
                                    </div>
                                    <!-- Modal cliente -->
                                    <div class="modal fade" id="myModalcliente" role="dialog">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <p>Lista de cliente</p>
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Voltar</button>
                                                    <!-- /.card-header -->
                                                    <div class="card-body">
                                                        <table id="example1" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>ID</th>
                                                                    <th>Cliente</th>
                                                                    <th>Ação</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <!-- início do preloader -->
                                                                <div id="preloader">
                                                                    <div class="inner">
                                                                        <!-- HTML DA ANIMAÇÃO -->
                                                                        <div class="loader">
                                                                            @foreach($mcliente as $mclientes)
                                                                            <tr>
                                                                                <td>{{$mclientes->id}}</td>
                                                                                <td>{{$mclientes->nomeFantasia}}
                                                                                </td>
                                                                                <td>
                                                                                    <!-- Form busca cliente-->
                                                                                    <form method="post"
                                                                                        action="{{route('Comercial.Venda.buscarEcliente',$mclientes->id)}}">
                                                                                        @csrf
                                                                                        <input type="hidden" readonly
                                                                                            name="id_pedido"
                                                                                            class="form-control"
                                                                                            value="{{ isset($id_pedido) ? $id_pedido : null }}">
                                                                                        <input type="hidden"
                                                                                            name="id_cliente"
                                                                                            value="{{$mclientes->id}}">
                                                                                        <button type="submit"
                                                                                            class="btn btn-primary"><i
                                                                                                class="fa fa-search"
                                                                                                aria-hidden="true"></i></button>
                                                                                    </form>
                                                                                    <!-- Final Form 2-->
                                                                                </td>
                                                                            </tr>
                                                                            @endforeach
                                                                        </div>
                                                                        <!-- fim do preloader -->
                                                                    </div>
                                                                </div>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>ID</th>
                                                                    <th>Cliente</th>
                                                                    <th>Ação</th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal cadastra cliente -->
                                    <div class="modal fade" id="myModalcadcliente" role="dialog">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <p>Cadastro de cliente</p>
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Voltar</button>

                                                    <form role="form" enctype="multipart/form-data" method="post"
                                                        action="{{ route('Comercial.Venda.cadastrarMcliente') }}">
                                                        @csrf

                                                        <div class="row">
                                                            <input type="hidden" readonly name="id_pedido"
                                                                class="form-control"
                                                                value="{{ isset($id_pedido) ? $id_pedido : null }}">
                                                            <div class="col-3">
                                                                <input type="hidden" readonly class="form-control"
                                                                    name="id_responsavel"
                                                                    value="{{ Auth::user()->id  ?? '' }}">
                                                            </div>
                                                            <div class="col-10">
                                                                <label>* Razão social</label>
                                                                <input type="text" required name="razaoSocial"
                                                                    class="form-control" value="{{$razaoSocial ?? ''}}">
                                                                <label>* Nome fantasia</label>
                                                                <input type="text" required name="nomeFantasia"
                                                                    class="form-control"
                                                                    value="{{$nomeFantasia ?? ''}}">
                                                            </div>
                                                            <div class="col-4">
                                                                <label>* CPF</label>
                                                                <input type="text" required id="cpf" name="cpfcnpj"
                                                                    class="form-control" value="{{$cpfcnpj ?? ''}}">
                                                            </div>
                                                            <div class="col-3">
                                                                <label>Número de contrato</label>
                                                                <input type="text" name="contrato_numero"
                                                                    class="form-control"
                                                                    value="{{$contrato_numero ?? ''}}">
                                                            </div>
                                                            <div class="col-4">
                                                                <label>Telefone</label>
                                                                <input type="text" name="telefone" class="form-control"
                                                                    value="{{$telefone ?? ''}}">
                                                            </div>
                                                            <div class="col-4">
                                                                <label>E-mail</label>
                                                                <input type="text" name="email" class="form-control"
                                                                    value="{{$email ?? ''}}">
                                                            </div>
                                                            <div class="col-2">
                                                                <label>CEP</label>
                                                                <input type="text" name="end_cep" class="form-control"
                                                                    value="{{$end_cep ?? ''}}">
                                                            </div>
                                                            <div class="col-5">
                                                                <label>Logradouro</label>
                                                                <input type="text" name="end_logradouro"
                                                                    class="form-control"
                                                                    value="{{$end_logradouro ?? ''}}">
                                                            </div>
                                                            <div class="col-2">
                                                                <label>Número</label>
                                                                <input type="text" name="end_numero"
                                                                    class="form-control" value="{{$end_numero ?? ''}}">
                                                            </div>
                                                            <div class="col-3">
                                                                <label>Complemento</label>
                                                                <input type="text" name="end_complemento"
                                                                    class="form-control"
                                                                    value="{{$end_complemento ?? ''}}">
                                                            </div>
                                                            <div class="col-4">
                                                                <label>Bairro</label>
                                                                <input type="text" name="end_bairro"
                                                                    class="form-control" value="{{$end_bairro ?? ''}}">
                                                            </div>
                                                            <div class="col-4">
                                                                <label>Município</label>
                                                                <input type="text" name="end_cidade"
                                                                    class="form-control" value="{{$end_cidade ?? ''}}">
                                                            </div>
                                                            <div class="col-2">
                                                                <label for="inputGroupSelect01">Estado :
                                                                    <select class="custom-select" name="end_uf"
                                                                        id="inputGroupSelect01">
                                                                        <option selected>
                                                                            {{ isset($end_uf) ? $end_uf : null }}
                                                                        </option>
                                                                        <option value="SP">SP - São Paulo</option>
                                                                        <option value="AC">AC - Acre</option>
                                                                        <option value="AL">AL - Alagoas</option>
                                                                        <option value="AP">AP - Amapá</option>
                                                                        <option value="AM">AM - Amazonas</option>
                                                                        <option value="BA">BA - Bahia</option>
                                                                        <option value="CE">CE - Ceará</option>
                                                                        <option value="ES">ES - Espírito Santo
                                                                        </option>
                                                                        <option value="GO">GO - Goiás</option>
                                                                        <option value="MA">MA - Maranhão</option>
                                                                        <option value="MT">MT - Mato Grosso</option>
                                                                        <option value="MS">MS - Mato Grosso do Sul
                                                                        </option>
                                                                        <option value="MG">MG - Minas Gerais
                                                                        </option>
                                                                        <option value="PA">PA - Pará</option>
                                                                        <option value="PB">PB - Paraíba</option>
                                                                        <option value="PR">PR - Paraná</option>
                                                                        <option value="PE">PE - Pernambuco</option>
                                                                        <option value="PI">PI - Piauí</option>
                                                                        <option value="RJ">RJ - Rio de Janeiro
                                                                        </option>
                                                                        <option value="RN">RN - Rio Grande do Norte
                                                                        </option>
                                                                        <option value="RS">RS - Rio Grande do Sul
                                                                        </option>
                                                                        <option value="RO">RO - Rondônia</option>
                                                                        <option value="RR">RR - Roraima</option>
                                                                        <option value="SC">SC - Santa Catarina
                                                                        </option>
                                                                        <option value="SE">SE - Sergipe</option>
                                                                        <option value="TO">TO - Tocantins</option>
                                                                        <option value="DF">DF - Distrito Federal
                                                                        </option>
                                                                    </select>
                                                                </label>
                                                            </div>
                                                            <div class="col-3">
                                                                <label for="inputGroupSelect01">Status :
                                                                    <select class="custom-select" name="status"
                                                                        id="inputGroupSelect01">
                                                                        <option selected>
                                                                            {{ isset($status) ? $status : null }}
                                                                        </option>
                                                                        <option value="ATIVO">ATIVO</option>
                                                                        <option value="INATIVO">INATIVO</option>
                                                                    </select>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="card-body">
                                                            <button type="submit"
                                                                class="btn btn-primary">Salvar</button>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- Fim class container -->
                            </div>
                        </div>
                        @if(isset($id_pedido))
                        <div class="col-md-12">
                            <div class="card card-warning">
                                <div class="card-header">
                                    <h3 class="card-title">Lista de produtos do pedido</h3>
                                </div>
                                <div class="container">
                                    <div class="card-body">
                                        <div class="col-3">
                                            <button title="Clicar para listar produto" type="button"
                                                class="btn btn-info btn-lg" data-toggle="modal"
                                                data-target="#myModalproduto"><i class="fa fa-search"
                                                    aria-hidden="true"></i></button>
                                        </div>
                                        <form method="post"
                                            action="{{route('Comercial.Venda.incluirItemPdv',$id_pedido) }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-2">
                                                    <label>CÓDIGO</label>
                                                    <input type="text" readonly name="id_produto" class="form-control"
                                                        value="{{ isset($id_produto) ? $id_produto : null }}">
                                                </div>
                                                <div class="col-4">
                                                    <label>Nome do produto</label>
                                                    <input type="text" readonly name="nome_produto" class="form-control"
                                                        value="{{ isset($nome_produto) ? $nome_produto : null }}">
                                                </div>
                                                <div class="col-2">
                                                    <label>Quantidade</label>
                                                    <input type="number" id="quantidade" name="quantidade"
                                                        onkeyup="calcularQproduto()" class="form-control" value="0">
                                                </div>
                                                <div class="col-3">
                                                    <label>Valor Unitário</label>
                                                    <input type="text" name="valor_unitario" id="vlrUnitario"
                                                        onkeyup="calcularQproduto()" class="form-control"
                                                        value="{{ isset($valor_unitario) ? $valor_unitario : null }}">
                                                </div>
                                                <div class="col-3">
                                                    <label>Valor Desconto</label>
                                                    <input type="text" id="vlrDesconto" name="valor_desconto"
                                                        onkeyup="calcularQproduto()" class="form-control" value="0">
                                                </div>
                                                <div class="col-3">
                                                    <label>Valor total produto</label>
                                                    <input readonly id="valor_Tprotuto" name="valor_Tprotuto"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <input type="hidden" readonly name="id_pedido"
                                                    value="{{ isset($id_pedido) ? $id_pedido : null }}">
                                                <button title="Salvar produto no pedido " type="submit"
                                                    class="btn btn-primary btn-lg"><i class="fas fa-save"></i>
                                                </button>
                                            </div>

                                        </form>
                                        <!-- Modal produto-->
                                        <div class="modal fade" id="myModalproduto" role="dialog">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <p>Lista de produtos</p>
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Voltar</button>
                                                        <!-- /.card-header -->
                                                        <div class="card-body">
                                                            <table id="example2"
                                                                class="table table-bordered table-striped">
                                                                <thead>
                                                                    <tr>

                                                                        <th>Ação</th>
                                                                        <th>ID</th>
                                                                        <th>Código_barra</th>
                                                                        <th>Produto</th>
                                                                        <th>Marca</th>
                                                                        <th>Estoque</th>
                                                                        <th>Preço venda</th>

                                                                    </tr>
                                                                </thead>

                                                                <tbody id="myTable">
                                                                    @foreach($mestoque as $mproduto)
                                                                    <tr
                                                                        class="{{$mproduto->estoque <= $mproduto->estoque_minimo ? 'bg-danger' : ''}}">
                                                                        <td>
                                                                            <!-- Form busca produto-->
                                                                            <form method="post"
                                                                                action="{{route('Comercial.Venda.buscarPestoque',$mproduto->id)}}">
                                                                                @csrf
                                                                                <input type="hidden" readonly
                                                                                    name="id_pedido"
                                                                                    class="form-control"
                                                                                    value="{{ isset($id_pedido) ? $id_pedido : null }}">
                                                                                <button title="Buscar produto"
                                                                                    type="submit"
                                                                                    class="btn btn-primary"><i
                                                                                        class="fa fa-search"
                                                                                        aria-hidden="true"></i></button>
                                                                            </form>
                                                                            <!-- Final busca produto-->
                                                                        </td>
                                                                        <td>{{$mproduto->id}}</td>
                                                                        <td>{{$mproduto->codigo_barra}}</td>
                                                                        <td>{{$mproduto->nome_produto}}</td>
                                                                        <td>{{$mproduto->marca}}</td>
                                                                        <td>{{$mproduto->estoque}}</td>
                                                                        <td>R$
                                                                            {{number_format($mproduto->preco_venda ? $mproduto->preco_venda : null ,2, ',', '.')}}
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th>Ação</th>
                                                                        <th>ID</th>
                                                                        <th>Código_barra</th>
                                                                        <th>Produto</th>
                                                                        <th>Marca</th>
                                                                        <th>Estoque</th>
                                                                        <th>Preço venda</th>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                        <!-- /.card-body -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Fim Modal -->

                                    </div>
                                </div>

                                <hr>
                                <!-- class container -->
                                <div class="container">
                                    <div class="card-body">
                                        <table id="example3" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Id </th>
                                                    <th>Pedido</th>
                                                    <th>Produto</th>
                                                    <th>Qtd</th>
                                                    <th>Vlr sem desconto</th>
                                                    <th>Vlr desconto</th>
                                                    <th>Vlr Total</th>
                                                    <th>Ação</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($mpedidoVendaItem as $mVendaItem)
                                                <tr>
                                                    <td>{{$mVendaItem->id}}</td>
                                                    <td>{{$mVendaItem->id_pedido_item}}</td>
                                                    <td>{{$mVendaItem->id_prod_item}} -
                                                        {{$mVendaItem->nome_produto}}
                                                    </td>
                                                    <td>{{$mVendaItem->quantidade}}</td>
                                                    <td>
                                                        {{number_format($mVendaItem->valor_semDesconto ? $mVendaItem->valor_semDesconto : null ,2, ',', '.')}}
                                                    </td>
                                                    <td>
                                                        {{number_format($mVendaItem->valor_desconto ? $mVendaItem->valor_desconto : null ,2, ',', '.')}}
                                                    </td>
                                                    <td>
                                                        {{number_format($mVendaItem->valor_totalProduto ? $mVendaItem->valor_totalProduto : null ,2, ',', '.')}}
                                                    </td>
                                                    <td>
                                                        <!-- Form deleta produto-->
                                                        <form method="post"
                                                            action="{{route('Comercial.Venda.apagarItemMpdv',$mVendaItem->id)}}">
                                                            @csrf
                                                            <input type="hidden" readonly name="id_pedido"
                                                                class="form-control"
                                                                value="{{ isset($id_pedido) ? $id_pedido : null }}">
                                                            <button title="Excluir produto" type="submit"
                                                                class="btn btn-danger"><i class="fa fa-trash"
                                                                    aria-hidden="true"></i></button>
                                                        </form>
                                                        <!-- Final delete produto-->
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Id </th>
                                                    <th>Pedido</th>
                                                    <th>Produto</th>
                                                    <th>Qtd</th>
                                                    <th>Vlr sem desconto</th>
                                                    <th>Vlr desconto</th>
                                                    <th>Vlr Total</th>
                                                    <th>Ação</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
            </div>
            </section>
        </div>
    </div>
    </div>

    <script>
    function calcularQproduto() {

        //alert("CALCULAR VR PRODUTO");

        // Formato valor brasileiro

        var inputvalue1 = document.getElementById(
            'quantidade').value;
        var inputvalue2 = document.getElementById(
            'vlrUnitario').value;
        var inputvalue3 = document.getElementById(
            'vlrDesconto').value;

        //alert(inputvalue1);

        valorQuantidade = inputvalue1;

        // Formato brasileiro para americano

        valorCamericano1 = inputvalue2.split(',').join('.');
        valorCamericano2 = inputvalue3.split(',').join('.');

        var valorBrasil = new Intl.NumberFormat("pt-BR", {
            style: "currency",
            currency: "BRL",
            minimumFractionDigits: 2
        });

        var valorTproduto = valorBrasil.format((valorQuantidade * valorCamericano1) - valorCamericano2);

        $('#valor_Tprotuto').val(valorTproduto);

    }
    </script>

    @include('sweetalert::alert')

    @includeIf('Painel.Layouts.javascript')

</body>
















</html>