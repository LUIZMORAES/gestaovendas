<!DOCTYPE html>
<html lang="pt-br">

@includeIf('Painel.Layouts.head')

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

        @includeIf('Painel.Layouts.header')

        @includeIf('Painel.Layouts.sidebar_lateral')

        <div class="content-wrapper">
            <div class="card-header">
                @if(isset($registro))
                <h3 class="card-title">Alterar cliente : </h3>
                @else
                <h3 class="card-title">Incluir cliente : </h3>
                @endif
                <a title="Voltar para lista de clientes " href="{{ route('Comercial.Cliente.listarMcliente') }}"
                    class="btn btn-success "><i class="fas fa-arrow-alt-circle-left"></i></a>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
                <!-- input states -->
                <div class="form-group">
                    @if(isset($registro))
                    <form method="post" action="{{route('Comercial.Cliente.updateMcliente',$registro)}}"
                        enctype="multipart/form-data">
                        @else
                        <form role="form" enctype="multipart/form-data" method="post"
                            action="{{ route('Comercial.Cliente.storeMcliente') }}">
                            @endif

                            @csrf

                            <div class="row">
                                @if(isset($registro))
                                <div class="col-2">
                                    <label><i class="fas fa-check"></i> Registro</label>
                                    <input type="text" readonly name="registro" class="form-control"
                                        value="{{ isset($registro) ? $registro : null }}">
                                </div>
                                @endif
                                <div class="col-3">
                                    <input type="hidden" readonly class="form-control" name="id_responsavel"
                                        value="{{ Auth::user()->id  ?? '' }}">
                                </div>
                                <div class="col-10">
                                    <label>Razão social</label>
                                    <input type="text" name="razaosocial" class="form-control"
                                        value="{{$razaosocial ?? ''}}">
                                    <label>Nome fantasia</label>
                                    <input type="text" name="nomeFantasia" class="form-control"
                                        value="{{$nomeFantasia ?? ''}}">
                                </div>
                                <div class="col-4">
                                    <label>CPF / CNPJ</label>
                                    <input type="text" name="cpfcnpj" class="form-control" value="{{$cpfcnpj ?? ''}}">
                                </div>
                                <div class="col-3">
                                    <label>Número de contrato</label>
                                    <input type="text" name="contrato_numero" class="form-control"
                                        value="{{$contrato_numero ?? ''}}">
                                </div>
                                <div class="col-4">
                                    <label>Telefone</label>
                                    <input type="text" name="telefone" class="form-control" value="{{$telefone ?? ''}}">
                                </div>
                                <div class="col-4">
                                    <label>E-mail</label>
                                    <input type="text" name="email" class="form-control" value="{{$email ?? ''}}">
                                </div>
                                <div class="col-2">
                                    <label>CEP</label>
                                    <input type="text" name="end_cep" class="form-control" value="{{$end_cep ?? ''}}">
                                </div>
                                <div class="col-5">
                                    <label>Logradouro</label>
                                    <input type="text" name="end_logradouro" class="form-control"
                                        value="{{$end_logradouro ?? ''}}">
                                </div>
                                <div class="col-2">
                                    <label>Número</label>
                                    <input type="text" name="end_numero" class="form-control"
                                        value="{{$end_numero ?? ''}}">
                                </div>
                                <div class="col-3">
                                    <label>Complemento</label>
                                    <input type="text" name="end_complemento" class="form-control"
                                        value="{{$end_complemento ?? ''}}">
                                </div>
                                <div class="col-4">
                                    <label>Bairro</label>
                                    <input type="text" name="end_bairro" class="form-control"
                                        value="{{$end_bairro ?? ''}}">
                                </div>
                                <div class="col-4">
                                    <label>Município</label>
                                    <input type="text" name="end_cidade" class="form-control"
                                        value="{{$end_cidade ?? ''}}">
                                </div>
                                <div class="col-2">
                                    <label for="inputGroupSelect01">Estado :
                                        <select class="custom-select" name="end_uf" id="inputGroupSelect01">
                                            <option selected>{{ isset($end_uf) ? $end_uf : null }}</option>
                                            <option value="SP">SP - São Paulo</option>
                                            <option value="AC">AC - Acre</option>
                                            <option value="AL">AL - Alagoas</option>
                                            <option value="AP">AP - Amapá</option>
                                            <option value="AM">AM - Amazonas</option>
                                            <option value="BA">BA - Bahia</option>
                                            <option value="CE">CE - Ceará</option>
                                            <option value="ES">ES - Espírito Santo</option>
                                            <option value="GO">GO - Goiás</option>
                                            <option value="MA">MA - Maranhão</option>
                                            <option value="MT">MT - Mato Grosso</option>
                                            <option value="MS">MS - Mato Grosso do Sul</option>
                                            <option value="MG">MG - Minas Gerais</option>
                                            <option value="PA">PA - Pará</option>
                                            <option value="PB">PB - Paraíba</option>
                                            <option value="PR">PR - Paraná</option>
                                            <option value="PE">PE - Pernambuco</option>
                                            <option value="PI">PI - Piauí</option>
                                            <option value="RJ">RJ - Rio de Janeiro</option>
                                            <option value="RN">RN - Rio Grande do Norte</option>
                                            <option value="RS">RS - Rio Grande do Sul</option>
                                            <option value="RO">RO - Rondônia</option>
                                            <option value="RR">RR - Roraima</option>
                                            <option value="SC">SC - Santa Catarina</option>
                                            <option value="SE">SE - Sergipe</option>
                                            <option value="TO">TO - Tocantins</option>
                                            <option value="DF">DF - Distrito Federal</option>
                                        </select>
                                    </label>
                                </div>
                                <div class="col-3">
                                    <label for="inputGroupSelect01">Status :
                                        <select class="custom-select" name="status" id="inputGroupSelect01">
                                            <option selected>{{ isset($status) ? $status : null }}</option>
                                            <option value="ATIVO">ATIVO</option>
                                            <option value="INATIVO">INATIVO</option>
                                        </select>
                                    </label>
                                </div>
                            </div>

                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                </div>
                </form>
            </div>
        </div>
        <!-- /.card-body -->

    </div>

    @includeIf('Painel.Layouts.footer')

    </div>

    @includeIf('Painel.Layouts.javascript')

</body>

</body>

</html>