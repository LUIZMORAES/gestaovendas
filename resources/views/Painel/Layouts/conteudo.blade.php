<!-- Content Wrapper. Contains page content -->
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="col-lg-3 col-6">
            <p>Administração</p>
        </div>
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-blue">
                    <div class="inner">
                        @inject('Usuario','App\Models\User')
                        <h3>{{ $Usuario->count() }}</h3>
                        <p>Usuários</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cogs"></i>
                    </div>
                    <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <hr>
        <div class="col-lg-3 col-6">
            <p>Comercial</p>
        </div>
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        @inject('Cliente','Modules\Cliente\Entities\Cliente')
                        <h3>{{ $Cliente->count() }}</h3>
                        <p>Cliente</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cogs"></i>
                    </div>
                    <a href="{{route('Comercial.Cliente.listarMcliente')}}" class="small-box-footer"><i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        @inject('Pedidovenda','Modules\Pedidovenda\Entities\Pedidovenda')
                        <h3>{{ $Pedidovenda->count() }}</h3>
                        <p>Pedido venda</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cogs"></i>
                    </div>
                    <a href="{{route('Comercial.Venda.listarMpdv')}}" class="small-box-footer"><i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        @inject('Fornecedor','Modules\Fornecedor\Entities\Fornecedor')
                        <h3>{{ $Fornecedor->count() }}</h3>
                        <p>Fornecedor</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cogs"></i>
                    </div>
                    <a href="{{route('Comercial.Fornecedor.listarMfornecedor')}}" class="small-box-footer"><i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        @inject('Pedidocompra','Modules\Pedidocompra\Entities\Pedidocompra')
                        <h3>{{ $Pedidocompra->count() }}</h3>
                        <p>Pedido compra</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cogs"></i>
                    </div>
                    <a href="{{route('Comercial.Compra.listarMpdc')}}" class="small-box-footer"><i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        @inject('Estoque','Modules\Estoque\Entities\Estoque')
                        <h3>{{ $Estoque->count() }}</h3>
                        <p>Estoque</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cogs"></i>
                    </div>
                    <a href="{{route('Comercial.Estoque.listarMestoque')}}" class="small-box-footer"><i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <hr>
        <div class="col-lg-3 col-6">
            <p>Financeiro</p>
        </div>
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-teal">
                    <div class="inner">
                        @inject('Contareceber','Modules\Financeiro\Entities\Contareceber')
                        <h3>{{ $Contareceber->count() }}</h3>
                        <p>Contas a receber</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cogs"></i>
                    </div>
                    <a href="{{route('Financeiro.Receber.listarMreceber')}}" class="small-box-footer"><i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-teal">
                    <div class="inner">
                        @inject('Contapagar','Modules\Financeiro\Entities\Contapagar')
                        <h3>{{ $Contapagar->count() }}</h3>
                        <p>Contas a pagar</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cogs"></i>
                    </div>
                    <a href="{{route('Financeiro.Pagar.listarMpagar')}}" class="small-box-footer"><i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <hr>
        <div class="col-lg-3 col-6">
            <p>Contabilidade</p>
        </div>
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-blue">
                    <div class="inner">
                        @inject('Planoconta','Modules\Contabilidade\Entities\Planoconta')
                        <h3>{{ $Planoconta->count() }}</h3>
                        <p>Plano de contas</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cogs"></i>
                    </div>
                    <a href="{{route('Contabilidade.Planocontas.listarMplanoconta')}}" class="small-box-footer"><i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>