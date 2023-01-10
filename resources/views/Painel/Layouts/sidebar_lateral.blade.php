<aside class="main-sidebar sidebar-dark-info elevation-4">
    <!-- Brand Logo  main-sidebar sidebar-dark-info elevation-4 -->
    <a href="{{route('Painel.principal.index')}}" class="brand-link">
        <img src="{{ asset('adm/logoempresa/lcam_ico.jpg') }}" alt="LCAM Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">LCAM </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('AdminLTE/dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->id }} - {{ Auth::user()->name }}</a>
                <a class="d-block">Cadastrado {{ Auth::user()->created_at->diffForHumans()}}</a>
            </div>
        </div>
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <a title="Sair do sistema " href="{{route('Admin.logout')}}" class="nav-link">
                    <p><i class="nav-icon fas fa-outdent"></i> Sair do sistema</p>
                </a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview menu-open">
                    <a href="{{route('Painel.principal.index')}}" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Menu Principal
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Comercial - vendas
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a title="Lista de clientes " href="{{route('Comercial.Cliente.listarMcliente')}}"
                                class="nav-link">
                                <p><i class="btn btn-success " class="fas fa-circle"></i> Cliente</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a title="Lista de pedidos clientes " href="{{route('Comercial.Venda.listarMpdv')}}"
                                class="nav-link">
                                <p><i class="btn btn-success " class="fas fa-circle"></i> Pedido venda</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a title="Relatório de pedidos vendas " href="{{route('Comercial.Venda.relatorioMpdv')}}"
                                class="nav-link">
                                <p><i class="btn btn-success " class="fas fa-circle"></i> Relatório Pdv</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Comercial - compras
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a title="Lista de fornecedores " href="{{route('Comercial.Fornecedor.listarMfornecedor')}}"
                                class="nav-link">
                                <p><i class="btn btn-success " class="fas fa-circle"></i> Fornecedor</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a title="Lista pedido de compras " href="{{route('Comercial.Compra.listarMpdc')}}"
                                class="nav-link">
                                <p><i class="btn btn-success " class="fas fa-circle"></i> Pedido compra</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a title="Relatório pedido de compras " href="{{route('Comercial.Compra.relatorioMpdc')}}"
                                class="nav-link">
                                <p><i class="btn btn-success " class="fas fa-circle"></i> Relatório Pdc</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Comercial - estoque
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a title="Lista estoque de produtos" href="{{route('Comercial.Estoque.listarMestoque')}}"
                                class="nav-link">
                                <p><i class="btn btn-success " class="fas fa-circle"></i> Estoque</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a title="Balanço do estoque de produtos" href="#" class="nav-link">
                                <p><i class="btn btn-success " class="fas fa-circle"></i> Balanço estoque</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Financeiro
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a title="Listar contas a receber " href="{{route('Financeiro.Receber.listarMreceber')}}"
                                class="nav-link">
                                <p><i class="btn btn-success " class="fas fa-circle"></i> Contas a receber</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a title="Relatório de Contas a receber "
                                href="{{route('Financeiro.Receber.relatorioMreceber')}}" class="nav-link">
                                <p><i class="btn btn-success " class="fas fa-circle"></i> Relatório Receber</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a title="Listar contas a pagar " href="{{route('Financeiro.Pagar.listarMpagar')}}"
                                class="nav-link">
                                <p><i class="btn btn-success " class="fas fa-circle"></i> Contas a pagar</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a title="Relatório de Contas a pagar " href="{{route('Financeiro.Pagar.relatorioMpagar')}}"
                                class="nav-link">
                                <p><i class="btn btn-success " class="fas fa-circle"></i> Relatório Pagar</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a title="Listar fluxo de caixa " href="{{route('Financeiro.Fluxocaixa.listarMfcaixa')}}"
                                class="nav-link">
                                <p><i class="btn btn-success " class="fas fa-circle"></i> Fluxo de caixa</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Contabilidade
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a title="Listar plano de contas"
                                href="{{route('Contabilidade.Planocontas.listarMplanoconta')}}" class="nav-link">
                                <p><i class="btn btn-success " class="fas fa-circle"></i> Plano de contas</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a title="Listar plano de contas" href="#" class="nav-link">
                                <p><i class="btn btn-success " class="fas fa-circle"></i> D R E</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Estatísticas
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a title="Listar LINKS OU APIS para consumo " href="{{route('Estatistica.listarMlink')}}"
                                class="nav-link">
                                <p><i class="btn btn-success " class="fas fa-circle"></i> Links</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Suporte
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a title="Listar plano de contas" href="#" class="nav-link">
                                <p><i class="btn btn-success " class="fas fa-circle"></i> Usuários</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!--
 /.sideb
ar -->




</aside>