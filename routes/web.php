<?php

use Illuminate\Support\Facades\Route;

//Rotas Externas
//Administração---------------------------------------------------------------------------------------------------------

Route::get('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');

Route::get('/clearcache', [App\Http\Controllers\AuthController::class, 'clearcache'])->name('clearcache');

Route::get('/adm/login', [App\Http\Controllers\AuthController::class, 'Login'])->name('Admin.login');

Route::get('/adm/acesso/login', [App\Http\Controllers\AuthController::class, 'acessoLogin'])->name('Admin.acesso.login');

Route::get('/adm/acesso/Redefinirlogin', [App\Http\Controllers\AuthController::class, 'acessoredefinirLogin'])->name('Admin.acesso.redefinirlogin');

Route::post('/adm/acesso/nvcredencial', [App\Http\Controllers\AuthController::class, 'nvcredencial'])->name('Admin.acesso.nvcredencial');

Route::post('/adm/credencial', [App\Http\Controllers\AuthController::class, 'credencialLogin'])->name('Admin.credencial');

Route::get('/adm/logout', [App\Http\Controllers\AuthController::class, 'logoutLogin'])->name('Admin.logout');

Route::group(['middleware' => 'auth'], function(){

    //Painel---------------------------------------------------------------------------------------------------------
    Route::get('/Painel/Principal/index', [App\Http\Controllers\AuthController::class, 'painelIndex'])->name('Painel.principal.index');

    //Acesso Administração
    Route::get('/Administracao/acessoAdmin', [App\Http\Controllers\AuthController::class, 'acessoMadmin'])->name('Administracao.acessoMadmin');

// Final do grupo autenticação
});

// Inicio do grupo comercial
Route::group(['middleware' => 'comercial'], function(){

    //CRUD Estoque e balanço do estoque

    Route::group(['namespace' => 'Comercial'], function(){

        Route::get('/Comercial/Estoque/listarMestoque', [Modules\Estoque\Http\Controllers\EstoqueController::class, 'listarMestoque'])->name('Comercial.Estoque.listarMestoque');

        Route::get('/Comercial/Estoque/createMestoque', [Modules\Estoque\Http\Controllers\EstoqueController::class, 'createMestoque'])->name('Comercial.Estoque.createMestoque');

        Route::post('/Comercial/Estoque/storeMestoque', [Modules\Estoque\Http\Controllers\EstoqueController::class, 'storeMestoque'])->name('Comercial.Estoque.storeMestoque');

        Route::get('/Comercial/Estoque/editMestoque/{id}', [Modules\Estoque\Http\Controllers\EstoqueController::class, 'editMestoque'])->name('Comercial.Estoque.editMestoque');

        Route::post('/Comercial/Estoque/updateMestoque/{id}', [Modules\Estoque\Http\Controllers\EstoqueController::class, 'updateMestoque'])->name('Comercial.Estoque.updateMestoque');

    });

    //CRUD cliente

    Route::group(['namespace' => 'Comercial'], function(){

        Route::get('/Comercial/Cliente/listarMcliente', [Modules\Cliente\Http\Controllers\ClienteController::class, 'listarMcliente'])->name('Comercial.Cliente.listarMcliente');

        Route::get('/Comercial/Cliente/createMcliente', [Modules\Cliente\Http\Controllers\ClienteController::class, 'createMcliente'])->name('Comercial.Cliente.createMcliente');

        Route::post('/Comercial/Cliente/storeMcliente', [Modules\Cliente\Http\Controllers\ClienteController::class, 'storeMcliente'])->name('Comercial.Cliente.storeMcliente');

        Route::get('/Comercial/Cliente/editMcliente/{id}', [Modules\Cliente\Http\Controllers\ClienteController::class, 'editMcliente'])->name('Comercial.Cliente.editMcliente');

        Route::post('/Comercial/Cliente/updateMcliente/{id}', [Modules\Cliente\Http\Controllers\ClienteController::class, 'updateMcliente'])->name('Comercial.Cliente.updateMcliente');

    });


    //CRUD fornecedor

    Route::group(['namespace' => 'Fornecedor'], function(){

        Route::get('/Comercial/Fornecedor/listarMfornecedor', [Modules\Fornecedor\Http\Controllers\FornecedorController::class, 'listarMfornecedor'])->name('Comercial.Fornecedor.listarMfornecedor');

        Route::get('/Comercial/Fornecedor/createMfornecedor', [Modules\Fornecedor\Http\Controllers\FornecedorController::class, 'createMfornecedor'])->name('Comercial.Fornecedor.createMfornecedor');

        Route::post('/Comercial/Fornecedor/storeMfornecedor', [Modules\Fornecedor\Http\Controllers\FornecedorController::class, 'storeMfornecedor'])->name('Comercial.Fornecedor.storeMfornecedor');

        Route::get('/Comercial/Fornecedor/editMfornecedor/{id}', [Modules\Fornecedor\Http\Controllers\FornecedorController::class, 'editMfornecedor'])->name('Comercial.Fornecedor.editMfornecedor');

        Route::post('/Comercial/Fornecedor/updateMfornecedor/{id}', [Modules\Fornecedor\Http\Controllers\FornecedorController::class, 'updateMfornecedor'])->name('Comercial.Fornecedor.updateMfornecedor');
    });

    //CRUD Pedido de vendas
    Route::group(['namespace' => 'Pedidovenda'], function(){

        Route::get('/Comercial/Venda/listarMpdv', [Modules\Pedidovenda\Http\Controllers\PedidovendaController::class, 'listarMpdv'])->name('Comercial.Venda.listarMpdv');

        Route::get('/Comercial/Venda/createMpdv', [Modules\Pedidovenda\Http\Controllers\PedidovendaController::class, 'createMpdv'])->name('Comercial.Venda.createMpdv');

        Route::post('/Comercial/Venda/buscarCliente/{id}', [Modules\Pedidovenda\Http\Controllers\PedidovendaController::class, 'buscarEcliente'])->name('Comercial.Venda.buscarEcliente');

        Route::post('/Comercial/Venda/cadastrarCliente', [Modules\Pedidovenda\Http\Controllers\PedidovendaController::class, 'cadastrarMcliente'])->name('Comercial.Venda.cadastrarMcliente');

        Route::get('/Comercial/Venda/pedidoMpdv/{id}', [Modules\Pedidovenda\Http\Controllers\PedidovendaController::class, 'pedidoMpdv'])->name('Comercial.Venda.pedidoMpdv');

        Route::post('/Comercial/Venda/storeMpdv', [Modules\Pedidovenda\Http\Controllers\PedidovendaController::class, 'storeMpdv'])->name('Comercial.Venda.storeMpdv');

        Route::post('/Comercial/Venda/updateMpdv/{id}', [Modules\Pedidovenda\Http\Controllers\PedidovendaController::class, 'updateMpdv'])->name('Comercial.Venda.updateMpdv');

        Route::post('/Comercial/Venda/buscarPestoque/{id}', [Modules\Pedidovenda\Http\Controllers\PedidovendaController::class, 'buscarPestoque'])->name('Comercial.Venda.buscarPestoque');

        Route::post('/Comercial/Venda/incluirItemPdv/{id}', [Modules\Pedidovenda\Http\Controllers\PedidovendaController::class, 'incluirItemPdv'])->name('Comercial.Venda.incluirItemPdv');

        Route::get('/Comercial/Venda/listarItemMpdv', [Modules\Pedidovenda\Http\Controllers\PedidovendaController::class, 'listarItemMpdv'])->name('Comercial.Venda.listarItemMpdv');

        Route::post('/Comercial/Venda/apagarItemMpdv/{id}', [Modules\Pedidovenda\Http\Controllers\PedidovendaController::class, 'apagarItemMpdv'])->name('Comercial.Venda.apagarItemMpdv');

        Route::get('/Comercial/Venda/finalizaMpdv/{id}', [Modules\Pedidovenda\Http\Controllers\PedidovendaController::class, 'finalizaMpdv'])->name('Comercial.Venda.finalizaMpdv');

        Route::get('/Comercial/Venda/cancelaMpdv/{id}', [Modules\Pedidovenda\Http\Controllers\PedidovendaController::class, 'cancelaMpdv'])->name('Comercial.Venda.cancelaMpdv');

        Route::get('/Comercial/Venda/devolucaoMpdv/{id}', [Modules\Pedidovenda\Http\Controllers\PedidovendaController::class, 'devolucaoMpdv'])->name('Comercial.Venda.devolucaoMpdv');

        Route::get('/Comercial/Venda/imprimirMpdv/{id}', [Modules\Pedidovenda\Http\Controllers\PedidovendaController::class, 'imprimirMpdv'])->name('Comercial.Venda.imprimirMpdv');

        Route::get('/Comercial/Venda/reciboMpdv/{id}', [Modules\Pedidovenda\Http\Controllers\PedidovendaController::class, 'reciboMpdv'])->name('Comercial.Venda.reciboMpdv');

        Route::get('/Comercial/Venda/balancoMpdv', [Modules\Pedidovenda\Http\Controllers\PedidovendaController::class, 'balancoMpdv'])->name('Comercial.Venda.balancoMpdv');

        Route::get('/Comercial/Venda/zerarbalancoMpdv', [Modules\Pedidovenda\Http\Controllers\PedidovendaController::class, 'zerarbalancoMpdv'])->name('Comercial.Venda.zerarbalancoMpdv');

        Route::get('/Comercial/Venda/iniciarbalancoMpdv', [Modules\Pedidovenda\Http\Controllers\PedidovendaController::class, 'iniciarbalancoMpdv'])->name('Comercial.Venda.iniciarbalancoMpdv');

        Route::get('/Comercial/Venda/imprimirbalancoMpdv', [Modules\Pedidovenda\Http\Controllers\PedidovendaController::class, 'imprimirbalancoMpdv'])->name('Comercial.Venda.imprimirbalancoMpdv');

        Route::get('/Comercial/Venda/relatorioPdv', [Modules\Pedidovenda\Http\Controllers\PedidovendaController::class, 'relatorioMpdv'])->name('Comercial.Venda.relatorioMpdv');

        Route::post('/Comercial/Venda/impRelatorioPdv', [Modules\Pedidovenda\Http\Controllers\PedidovendaController::class, 'impRelatorioMpdv'])->name('Comercial.Venda.impRelatorioMpdv');
    });

    //CRUD Pedido de compras
    Route::group(['namespace' => 'Pedidocompra'], function(){

        Route::get('/Comercial/Compra/listarMpdc', [Modules\Pedidocompra\Http\Controllers\PedidocompraController::class, 'listarMpdc'])->name('Comercial.Compra.listarMpdc');

        Route::get('/Comercial/Compra/createMpdc', [Modules\Pedidocompra\Http\Controllers\PedidocompraController::class, 'createMpdc'])->name('Comercial.Compra.createMpdc');

        Route::post('/Comercial/Compra/buscarFornecedor/{id}', [Modules\Pedidocompra\Http\Controllers\PedidocompraController::class, 'buscarEfornecedor'])->name('Comercial.Compra.buscarEfornecedor');

        Route::get('/Comercial/Compra/pedidoMpdc/{id}', [Modules\Pedidocompra\Http\Controllers\PedidocompraController::class, 'pedidoMpdc'])->name('Comercial.Compra.pedidoMpdc');

        Route::post('/Comercial/Compra/storeMpdc', [Modules\Pedidocompra\Http\Controllers\PedidocompraController::class, 'storeMpdc'])->name('Comercial.Compra.storeMpdc');

        Route::get('/Comercial/Compra/editMpdc/{id}', [Modules\Pedidocompra\Http\Controllers\PedidocompraController::class, 'editMpdc'])->name('Comercial.Compra.editMpdc');

        Route::post('/Comercial/Compra/updateMpdc/{id}', [Modules\Pedidocompra\Http\Controllers\PedidocompraController::class, 'updateMpdc'])->name('Comercial.Compra.updateMpdc');

        Route::post('/Comercial/Compra/buscarPestoque/{id}', [Modules\Pedidocompra\Http\Controllers\PedidocompraController::class, 'buscarPestoque'])->name('Comercial.Compra.buscarPestoque');

        Route::post('/Comercial/Compra/incluirItempdc/{id}', [Modules\Pedidocompra\Http\Controllers\PedidocompraController::class, 'incluirItempdc'])->name('Comercial.Compra.incluirItemPdc');

        Route::get('/Comercial/Compra/listarItemMpdc', [Modules\Pedidocompra\Http\Controllers\PedidocompraController::class, 'listarItemMpdc'])->name('Comercial.Compra.listarItemMpdc');

        Route::post('/Comercial/Compra/apagarItemMpdc/{id}', [Modules\Pedidocompra\Http\Controllers\PedidocompraController::class, 'apagarItemMpdc'])->name('Comercial.Compra.apagarItemMpdc');

        Route::get('/Comercial/Compra/finalizaMpdc/{id}', [Modules\Pedidocompra\Http\Controllers\PedidocompraController::class, 'finalizaMpdc'])->name('Comercial.Compra.finalizaMpdc');

        Route::get('/Comercial/Compra/cancelaMpdc/{id}', [Modules\Pedidocompra\Http\Controllers\PedidocompraController::class, 'cancelaMpdc'])->name('Comercial.Compra.cancelaMpdc');

        Route::get('/Comercial/Compra/devolucaoMpdc/{id}', [Modules\Pedidocompra\Http\Controllers\PedidocompraController::class, 'devolucaoMpdc'])->name('Comercial.Compra.devolucaoMpdc');

        Route::get('/Comercial/Compra/imprimirMpdc/{id}', [Modules\Pedidocompra\Http\Controllers\PedidocompraController::class, 'imprimirMpdc'])->name('Comercial.Compra.imprimirMpdc');

        Route::get('/Comercial/Compra/periodoMpdc', [Modules\Pedidocompra\Http\Controllers\PedidocompraController::class, 'periodoMpdc'])->name('Comercial.Compra.periodoMpdc');

        Route::post('/Comercial/Compra/impPeriodoMpdc', [Modules\Pedidocompra\Http\Controllers\PedidocompraController::class, 'impPeriodoMpdc'])->name('Comercial.Compra.impPeriodoMpdc');

        Route::get('/Comercial/Compra/balancoMpdc', [Modules\Pedidocompra\Http\Controllers\PedidocompraController::class, 'balancoMpdc'])->name('Comercial.Compra.balancoMpdc');

        Route::get('/Comercial/Compra/zerarbalancoMpdc', [Modules\Pedidocompra\Http\Controllers\PedidocompraController::class, 'zerarbalancoMpdc'])->name('Comercial.Compra.zerarbalancoMpdc');

        Route::get('/Comercial/Compra/iniciarbalancoMpdc', [Modules\Pedidocompra\Http\Controllers\PedidocompraController::class, 'iniciarbalancoMpdc'])->name('Comercial.Compra.iniciarbalancoMpdc');

        Route::get('/Comercial/Compra/imprimirbalancoMpdc', [Modules\Pedidocompra\Http\Controllers\PedidocompraController::class, 'imprimirbalancoMpdc'])->name('Comercial.Compra.imprimirbalancoMpdc');

        Route::get('/Comercial/Compra/relatorioPdc', [Modules\Pedidocompra\Http\Controllers\PedidocompraController::class, 'relatorioMpdc'])->name('Comercial.Compra.relatorioMpdc');

        Route::post('/Comercial/Compra/impRelatorioPdc', [Modules\Pedidocompra\Http\Controllers\PedidocompraController::class, 'impRelatorioMpdc'])->name('Comercial.Compra.impRelatorioMpdc');

    });

});
// Final do grupo comercial

// Inicio do grupo estatistica
Route::group(['middleware' => 'estatistica'], function(){

    //CRUD estatistica
    Route::group(['namespace' => 'Estatisticas'], function(){

        Route::get('/Estatistica/listarlink', [Modules\Estatisticas\Http\Controllers\EstatisticasController::class, 'listarMlink'])->name('Estatistica.listarMlink');

        Route::get('/Estatistica/createlink', [Modules\Estatisticas\Http\Controllers\EstatisticasController::class, 'createMlink'])->name('Estatistica.createMlink');

        Route::post('/Estatistica/storelink', [Modules\Estatisticas\Http\Controllers\EstatisticasController::class, 'storeMlink'])->name('Estatistica.storeMlink');

        Route::get('/Estatistica/editlink/{id}', [Modules\Estatisticas\Http\Controllers\EstatisticasController::class, 'editMlink'])->name('Estatistica.editMlink');

        Route::post('/Estatistica/updatelink/{id}', [Modules\Estatisticas\Http\Controllers\EstatisticasController::class, 'updateMlink'])->name('Estatistica.updateMlink');

        Route::post('/Estatistica/acompanhalink', [Modules\Estatisticas\Http\Controllers\EstatisticasController::class, 'acompanhaMlink'])->name('Estatistica.acompanhaMlink');

    });

});
// Final do grupo estatistica

// Inicio do grupo financeiro
Route::group(['middleware' => 'financeiro'], function(){

        //CRUD Receber
        Route::group(['namespace' => 'Receber'], function(){

            Route::get('/Financeiro/Receber/listarReceber', [Modules\Financeiro\Http\Controllers\ContareceberController::class, 'listarMreceber'])->name('Financeiro.Receber.listarMreceber');

            Route::get('/Financeiro/Receber/createReceber', [Modules\Financeiro\Http\Controllers\ContareceberController::class, 'createMreceber'])->name('Financeiro.Receber.createMreceber');

            Route::post('/Financeiro/Receber/storeReceber', [Modules\Financeiro\Http\Controllers\ContareceberController::class, 'storeMreceber'])->name('Financeiro.Receber.storeMreceber');

            Route::get('/Financeiro/Receber/editReceber/{id}', [Modules\Financeiro\Http\Controllers\ContareceberController::class, 'editMreceber'])->name('Financeiro.Receber.editMreceber');

            Route::post('/Financeiro/Receber/updateReceber', [Modules\Financeiro\Http\Controllers\ContareceberController::class, 'updateMreceber'])->name('Financeiro.Receber.updateMreceber');

            Route::post('/Financeiro/Receber/buscarpedidoReceber/{id}', [Modules\Financeiro\Http\Controllers\ContareceberController::class, 'buscarpedidoMreceber'])->name('Financeiro.Receber.buscarpedidoMreceber');

            Route::get('/Financeiro/Receber/relatorioReceber', [Modules\Financeiro\Http\Controllers\ContareceberController::class, 'relatorioMReceber'])->name('Financeiro.Receber.relatorioMreceber');

            Route::post('/Financeiro/Receber/imprelatorioReceber1', [Modules\Financeiro\Http\Controllers\ContareceberController::class, 'impRelatorioMreceber1'])->name('Financeiro.Receber.imprelatorioMreceber1');
        });

        //CRUD Pagar
        Route::group(['namespace' => 'Pagar'], function(){

            Route::get('/Financeiro/Pagar/listarPagar', [Modules\Financeiro\Http\Controllers\ContapagarController::class, 'listarMpagar'])->name('Financeiro.Pagar.listarMpagar');

            Route::get('/Financeiro/Pagar/createPagar', [Modules\Financeiro\Http\Controllers\ContapagarController::class, 'createMpagar'])->name('Financeiro.Pagar.createMpagar');

            Route::post('/Financeiro/Pagar/storePagar', [Modules\Financeiro\Http\Controllers\ContapagarController::class, 'storeMpagar'])->name('Financeiro.Pagar.storeMpagar');

            Route::get('/Financeiro/Pagar/editPagar/{id}', [Modules\Financeiro\Http\Controllers\ContapagarController::class, 'editMpagar'])->name('Financeiro.Pagar.editMpagar');

            Route::post('/Financeiro/Pagar/updatePagar', [Modules\Financeiro\Http\Controllers\ContapagarController::class, 'updateMpagar'])->name('Financeiro.Pagar.updateMpagar');

            Route::post('/Financeiro/Pagar/buscarpedidoPagar/{id}', [Modules\Financeiro\Http\Controllers\ContapagarController::class, 'buscarpedidoMpagar'])->name('Financeiro.Pagar.buscarpedidoMpagar');

            Route::get('/Financeiro/Pagar/relatorioPagar', [Modules\Financeiro\Http\Controllers\ContapagarController::class, 'relatorioMpagar'])->name('Financeiro.Pagar.relatorioMpagar');

            Route::post('/Financeiro/Pagar/imprelatorioPagar1', [Modules\Financeiro\Http\Controllers\ContapagarController::class, 'impRelatorioMpagar1'])->name('Financeiro.Pagar.imprelatorioMpagar1');

        });

        //CRUD Fluxo de caixa
        Route::group(['namespace' => 'Fluxocaixa'], function(){

            Route::get('/Financeiro/Fluxocaixa/listarFcaixa', [Modules\Financeiro\Http\Controllers\FluxocaixaController::class, 'listarMfcaixa'])->name('Financeiro.Fluxocaixa.listarMfcaixa');

            Route::get('/Financeiro/Fluxocaixa/iniciarFcaixa', [Modules\Financeiro\Http\Controllers\FluxocaixaController::class, 'iniciarMfcaixa'])->name('Financeiro.Fluxocaixa.iniciarMfcaixa');

            Route::post('/Financeiro/Fluxocaixa/gravarFcaixa', [Modules\Financeiro\Http\Controllers\FluxocaixaController::class, 'gravarMfcaixa'])->name('Financeiro.Fluxocaixa.gravarMfcaixa');

            Route::get('/Financeiro/Fluxocaixa/apagarFcaixa/{id}', [Modules\Financeiro\Http\Controllers\FluxocaixaController::class, 'apagarMfcaixa'])->name('Financeiro.Fluxocaixa.apagarMfcaixa');

            Route::get('/Financeiro/Fluxocaixa/relatorioFcaixa', [Modules\Financeiro\Http\Controllers\FluxocaixaController::class, 'relatorioMfcaixa'])->name('Financeiro.Fluxocaixa.relatorioMfcaixa');

            Route::post('/Financeiro/Fluxocaixa/imprelatorioFcaixa1', [Modules\Financeiro\Http\Controllers\FluxocaixaController::class, 'impRelatorioMfcaixa1'])->name('Financeiro.Fluxocaixa.imprelatorioMfcaixa1');

        });

});
// Final do grupo financeiro

// Inicio do grupo contabilidade
Route::group(['middleware' => 'contabilidade'], function(){

    //CRUD estatistica
    Route::group(['namespace' => 'Planocontas'], function(){

        Route::get('/Contabilidade/Planocontas/listarPlanoconta', [Modules\Contabilidade\Http\Controllers\PlanocontaController::class, 'listarMplanoconta'])->name('Contabilidade.Planocontas.listarMplanoconta');

        Route::get('/Contabilidade/Planocontas/createPlanoconta', [Modules\Contabilidade\Http\Controllers\PlanocontaController::class, 'createMplanoconta'])->name('Contabilidade.Planocontas.createMplanoconta');

        Route::post('/Contabilidade/Planocontas/storePlanoconta', [Modules\Contabilidade\Http\Controllers\PlanocontaController::class, 'storeMplanoconta'])->name('Contabilidade.Planocontas.storeMplanoconta');

        Route::get('/Contabilidade/Planocontas/editPlanoconta/{id}', [Modules\Contabilidade\Http\Controllers\PlanocontaController::class, 'editMplanoconta'])->name('Contabilidade.Planocontas.editMplanoconta');

        Route::post('/Contabilidade/Planocontas/updatePlanoconta', [Modules\Contabilidade\Http\Controllers\PlanocontaController::class, 'updateMplanoconta'])->name('Contabilidade.Planocontas.updateMplanoconta');
    });

});
// Final do grupo financeiro
