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
                    <h3 class="card-title">Voltar: <a href="{{ route('Comercial.Cliente.listarMcliente') }}"
                            class="btn btn-success "><i class="fas fa-arrow-alt-circle-left"></i></a></h3>
                </div>
            </div>

            <!-- /.card-header -->
            <div class="card-body">

                <!-- input states -->

                <div class="form-group">

                    <form role="form" method="post" action="{{ route('Comercial.Cliente.storeMcliente') }}">
                        @csrf

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

                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Cadastro de Cliente</h3>
                            </div>
                            <div class="card-body">
                                <label class="col-form-label"><i class="fas fa-check"></i> Respons??vel</label>
                                <input type="text" readonly class="form-control" name="id_responsavel"
                                    value="{{ Auth::user()->id  ?? '' }}">
                                <input type="text" readonly class="form-control" name="nome_responsavel"
                                    value="{{ Auth::user()->name  ?? '' }}">
                                <label>Raz??o social</label>
                                <input type="text" name="razaosocial" class="form-control" placeholder="Raz??o social">
                                <label>Nome fantasia</label>
                                <input type="text" name="nomeFantasia" class="form-control" placeholder="Nome fantasia">
                                <div class="row">
                                    <div class="col-4">
                                        <label>CPF / CNPJ</label>
                                        <input type="text" name="cpfcnpj" class="form-control" placeholder="CPF / CNPJ">
                                    </div>
                                    <div class="col-4">
                                        <label>Inscri????o Estadual</label>
                                        <input type="text" name="insestadual" class="form-control"
                                            placeholder="Inscri????o Estadual">
                                    </div>
                                    <div class="col-4">
                                        <label>Inscri????o Munic??pal</label>
                                        <input type="text" name="insmunicipal" class="form-control"
                                            placeholder="Inscri????o Munic??pal">
                                    </div>
                                    <div class="col-3">
                                        <label>Contrato n??mero</label>
                                        <input type="text" name="contrato_numero" class="form-control" placeholder="0">
                                    </div>
                                    <div class="col-3">
                                        <label>Contrato Valor</label>
                                        <input type="text" name="contrato_valor" class="form-control" placeholder="0">
                                    </div>
                                    <div class="col-4">
                                        <label>Telefone</label>
                                        <input type="text" name="telefone" class="form-control" placeholder="Telefone">
                                    </div>
                                    <div class="col-4">
                                        <label>Celular</label>
                                        <input type="text" name="celular" class="form-control" placeholder="Celular">
                                    </div>
                                    <div class="col-4">
                                        <label>E-mail</label>
                                        <input type="text" name="email" class="form-control" placeholder="E-mail">
                                    </div>
                                    <div class="col-1">
                                        <label>CEP</label>
                                        <input type="text" name="end_cep" class="form-control" placeholder="CEP">
                                    </div>
                                    <div class="col-5">
                                        <label>Logradouro</label>
                                        <input type="text" name="end_logradouro" class="form-control"
                                            placeholder="Logradouro Exemplo: Rua, Cal??ada,...">
                                    </div>
                                    <div class="col-1">
                                        <label>N??mero</label>
                                        <input type="text" name="end_numero" class="form-control" placeholder="N??mero">
                                    </div>
                                    <div class="col-3">
                                        <label>Complemento</label>
                                        <input type="text" name="end_complemento" class="form-control"
                                            placeholder="Complemento">
                                    </div>
                                    <div class="col-4">
                                        <label>Bairro</label>
                                        <input type="text" name="end_bairro" class="form-control" placeholder="Bairro">
                                    </div>
                                    <div class="col-4">
                                        <label>Munic??pio</label>
                                        <input type="text" name="end_cidade" class="form-control"
                                            placeholder="Munic??pio">
                                    </div>
                                    <div class="col-2">
                                        <label for="inputGroupSelect01">Estado
                                            <select class="custom-select" name="end_uf" id="inputGroupSelect01">
                                                <option selected>Selecione</option>
                                                <option value="SP">SP - S??o Paulo</option>
                                                <option value="AC">AC - Acre</option>
                                                <option value="AL">AL - Alagoas</option>
                                                <option value="AP">AP - Amap??</option>
                                                <option value="AM">AM - Amazonas</option>
                                                <option value="BA">BA - Bahia</option>
                                                <option value="CE">CE - Cear??</option>
                                                <option value="ES">ES - Esp??rito Santo</option>
                                                <option value="GO">GO - Goi??s</option>
                                                <option value="MA">MA - Maranh??o</option>
                                                <option value="MT">MT - Mato Grosso</option>
                                                <option value="MS">MS - Mato Grosso do Sul</option>
                                                <option value="MG">MG - Minas Gerais</option>
                                                <option value="PA">PA - Par??</option>
                                                <option value="PB">PB - Para??ba</option>
                                                <option value="PR">PR - Paran??</option>
                                                <option value="PE">PE - Pernambuco</option>
                                                <option value="PI">PI - Piau??</option>
                                                <option value="RJ">RJ - Rio de Janeiro</option>
                                                <option value="RN">RN - Rio Grande do Norte</option>
                                                <option value="RS">RS - Rio Grande do Sul</option>
                                                <option value="RO">RO - Rond??nia</option>
                                                <option value="RR">RR - Roraima</option>
                                                <option value="SC">SC - Santa Catarina</option>
                                                <option value="SE">SE - Sergipe</option>
                                                <option value="TO">TO - Tocantins</option>
                                                <option value="DF">DF - Distrito Federal</option>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label for="inputGroupSelect01">Status : {{$status ?? ''}}
                                            <select class="custom-select" name="status" id="inputGroupSelect01">
                                                <option selected>Selecione</option>
                                                <option value="ATIVO">ATIVO</option>
                                                <option value="INATIVO">INATIVO</option>
                                            </select>
                                        </label>
                                    </div>
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