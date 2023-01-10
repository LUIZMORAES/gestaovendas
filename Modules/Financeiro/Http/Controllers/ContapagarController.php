<?php

namespace Modules\Financeiro\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

use App\Models\User;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Modules\Fornecedor\Entities\Fornecedor;
use Modules\Pedidocompra\Entities\Pedidocompra;
use Modules\Financeiro\Entities\Contapagar;

class ContapagarController extends Controller
{

    public $request;
    public $usuarios;
    public $mfornecedor;
    public $mpagar;
    public $mpedidoVenda;

    public function __construct(
        Request $request,
        User $usuarios,
        Fornecedor $mfornecedor,
        Contapagar $mpagar,
        Pedidocompra $mpedidoCompra
    ) {

        $this->middleware('auth');
        $this->request = $request;
        $this->User = $usuarios;
        $this->mfornecedor = $mfornecedor;
        $this->mpagar = $mpagar;
        $this->mpedidoCompra = $mpedidoCompra;

    }

    public function listarMpagar()
    {

        if (Auth::check()) {
            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/', $uri);

            $urlAtual = $exploder[1];

            $mpagar = Contapagar::all();

            return view('Financeiro.Pagar.listarPagar', compact(
                'user',
                'urlAtual',
                'mpagar'
            ));
        }

        return redirect()->route('admin.painelprincipal');
    }

    public function createMpagar()
    {

        if (Auth::check()) {

            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/',$uri);

            $urlAtual = $exploder[1];

            $mfornecedor = Cache::get('$mfornecedor',$this->mfornecedor->all(), 1);

            $mpedidoCompra = Cache::get('$mpedidoCompra',$this->mpedidoCompra->all(), 1);

            return view('Financeiro.Pagar.formPagar', compact(
                'user',
                'urlAtual',
                'mfornecedor',
                'mpedidoCompra'
            ));

        }

        return redirect()->route('Financeiro.Pagar.listarMpagar');
    }

    public function buscarpedidoMpagar(
        $pedido,
        Request $request
    ){

        //dd($request);

        //dd($pedido);

        $registro = $request->registro;

        if (Auth::check()) {

            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/',$uri);

            $urlAtual = $exploder[1];

            $mfornecedor = Cache::get('$mfornecedor',$this->mfornecedor->all(), 1);

            $mpedidoCompra = Cache::get('$mpedidoCompra',$this->mpedidoCompra->all(), 1);

            $dadosPedido = Pedidocompra::where('id',$pedido)->first();

            //dd($dadosPedido);

            //Trata data de emissão de americano para brasileiro

            $trataemissao = $dadosPedido->dt_emissao;

            $dt_emissao = Carbon::parse($trataemissao)->format('d/m/Y');

            //Trata valor de americano para brasileiro

            $trataVsemDesconto = $dadosPedido->valorTotalsemDesconto;

            $valorTotalsemDesconto = trim(str_replace(".",",",$trataVsemDesconto));

            //dd($mvalorsemDesconto);

            $trataVTotalDesconto = $dadosPedido->valorTotalDesconto;

            $valorTotalDesconto = trim(str_replace(".",",",$trataVTotalDesconto));

            //dd($mvalorTotalDesconto);

            $trataVTotalProduto = $dadosPedido->valorTotalPedido;

            $valorTotalPedido = trim(str_replace(".",",",$trataVTotalProduto));

            return view('Financeiro.Pagar.formPagar', compact(
                'user',
                'urlAtual',
                'mfornecedor',
                'mpedidoCompra'
            ))->with(
                [

                    'registro' => $registro,
                    'id_pedido' => $pedido,
                    'id_responsavel' => $dadosPedido->id_responsavel,
                    'id_fornecedor' => $dadosPedido->id_fornecedor,
                    'razaoSocial' => $dadosPedido->razaoSocial,
                    'nomeFantasia' => $dadosPedido->nomeFantasia,
                    'vlrTsDesconto' => $valorTotalsemDesconto,
                    'vlrTDesconto' => $valorTotalDesconto,
                    'vlrTPedido' => $valorTotalPedido,
                    'dt_emissao' => $dt_emissao,
                    'formaPgto1' => $dadosPedido->formaPgto1,

                ]);

        }

        return redirect()->route('Financeiro.Pagar.listarMpagar');

    }

    public function storeMpagar(
        Request $RequestPagar
    ){

        //dd($RequestPagar);

        $id_pedido = $RequestPagar->registro;

        $pagarBuscar = Contapagar::where('id',$id_pedido)->first();

        if (!$pagarBuscar) {

            //Trata data de emissão de brasileiro para americano

            $dt_emissao = trim($RequestPagar->dt_emissao);

            $dt_emissao = Carbon::createFromFormat('d/m/Y', $dt_emissao)->format('Y-m-d H:i:s');

            //dd($dt_emissao);

            $dt_vencimento = trim($RequestPagar->dt_vencimento);

            if($dt_vencimento){

                $dt_vencimento = Carbon::createFromFormat('d/m/Y', $dt_vencimento)->format('Y-m-d H:i:s');

            }else{

                $dt_vencimento = null;

            }

            $dt_pagamento = trim($RequestPagar->dt_pagamento);

            if($dt_pagamento){

                $dt_pagamento = Carbon::createFromFormat('d/m/Y', $dt_pagamento)->format('Y-m-d H:i:s');
                $situacao = 'FINALIZADO';
            }else{

                $dt_pagamento = null;
                $situacao = 'EM PROCESSO';
            }

            //Trata valor de brasileiro para americano

            $valorTotalsemDesconto = $RequestPagar->vlrTsDesconto;

            $trataVtsDesconto = ( strpos($valorTotalsemDesconto,'R$')!== false );

            if ($trataVtsDesconto) {
                //dd('Encontrado');
                $trataVtsDesconto = trim($valorTotalsemDesconto,'R$');
                $trataVtsDesconto = trim(str_replace(".","",$trataVtsDesconto));
                $trataVtsDesconto = trim(str_replace(",",".",$trataVtsDesconto));
                $trataVtsDesconto = floatval($trataVtsDesconto);
            } else {
                //dd('Não encontrado');
                $trataVtsDesconto = trim($valorTotalsemDesconto,'0$');
                $trataVtsDesconto = trim(str_replace(","," ",$trataVtsDesconto));
            }

            $valorTotalsemDesconto = $trataVtsDesconto;

            //dd($valorTotalsemDesconto);

            $valorTotalDesconto = $RequestPagar->vlrTDesconto;

            $trataVtDesconto = ( strpos($valorTotalDesconto,'R$')!== false );

            if ($trataVtDesconto) {
                //dd('Encontrado');
                $trataVtDesconto = trim($valorTotalDesconto,'R$');
                $trataVtDesconto = trim(str_replace(".","",$trataVtDesconto));
                $trataVtDesconto = trim(str_replace(",",".",$trataVtDesconto));
                $trataVtDesconto = floatval($trataVtDesconto);
            } else {
                //dd('Não encontrado');
                $trataVtDesconto = trim($valorTotalDesconto,'0$');
                $trataVtDesconto = trim(str_replace(","," ",$trataVtDesconto));
            }

            $valorTotalDesconto = $trataVtDesconto;

            //dd($valorTotalDesconto);

            $valorTotalPedido = $RequestPagar->vlrTPedido;

            $trataVtPedido = ( strpos($valorTotalPedido,'R$')!== false );

            if ($trataVtPedido) {
                //dd('Encontrado');
                $trataVtPedido = trim($valorTotalPedido,'R$');
                $trataVtPedido = trim(str_replace(".","",$trataVtPedido));
                $trataVtPedido = trim(str_replace(",",".",$trataVtPedido));
                $trataVtPedido = floatval($trataVtPedido);
            } else {
                //dd('Não encontrado');
                $trataVtPedido = trim($valorTotalPedido,'0$');
                $trataVtPedido = trim(str_replace(","," ",$trataVtPedido));
            }

            $valorTotalPedido = $trataVtPedido;

            //dd($valorTotalPedido);

            $valorformaPgto1 = $RequestPagar->valorformaPgto1;

            $trataVtpgto1 = ( strpos($valorformaPgto1,'R$')!== false );

            if ($trataVtpgto1) {
                //dd('Encontrado');
                $trataVtpgto1 = trim($valorformaPgto1,'R$');
                $trataVtpgto1 = trim(str_replace(".","",$trataVtpgto1));
                $trataVtpgto1 = trim(str_replace(",",".",$trataVtpgto1));
                $trataVtpgto1 = floatval($trataVtpgto1);
            } else {
                //dd('Não encontrado');
                $trataVtpgto1 = trim($valorformaPgto1,'0$');
                $trataVtpgto1 = trim(str_replace(","," ",$trataVtpgto1));
            }

            $valorformaPgto1 = $trataVtpgto1;

            $valorformaPgto2 = $RequestPagar->valorformaPgto2;

            $trataVtpgto2 = ( strpos($valorformaPgto2,'R$')!== false );

            if ($trataVtpgto2) {
                //dd('Encontrado');
                $trataVtpgto2 = trim($valorformaPgto2,'R$');
                $trataVtpgto2 = trim(str_replace(".","",$trataVtpgto2));
                $trataVtpgto2 = trim(str_replace(",",".",$trataVtpgto2));
                $trataVtpgto2 = floatval($trataVtpgto2);
            } else {
                //dd('Não encontrado');
                $trataVtpgto2 = trim($valorformaPgto2,'0$');
                $trataVtpgto2 = trim(str_replace(","," ",$trataVtpgto2));
            }

            $valorformaPgto2 = $trataVtpgto2;

            $vlrJuros = $RequestPagar->vlrJuros;

            $tratavlrJuros = ( strpos($vlrJuros,'R$')!== false );

            if ($tratavlrJuros) {
                //dd('Encontrado');
                $tratavlrJuros = trim($vlrJuros,'R$');
                $tratavlrJuros = trim(str_replace(".","",$tratavlrJuros));
                $tratavlrJuros = trim(str_replace(",",".",$tratavlrJuros));
                $tratavlrJuros = floatval($trataVtPedido);
            } else {
                //dd('Não encontrado');
                $tratavlrJuros = trim($vlrJuros,'0$');
                $tratavlrJuros = trim(str_replace(","," ",$tratavlrJuros));
            }

            $vlrJuros = $tratavlrJuros;

            Contapagar::create([

                'id_responsavel' => $RequestPagar->input('id_responsavel'),
                'id_fornecedor' => $RequestPagar->input('id_fornecedor'),
                'razaoSocial' => $RequestPagar->input('razaoSocial'),
                'nomeFantasia' => $RequestPagar->input('nomeFantasia'),
                'cod_conta' => $RequestPagar->input('cod_conta'),
                'id_pedido' => $RequestPagar->input('id_pedido'),
                'id_notafiscal' => $RequestPagar->input('id_notafiscal'),
                'documento' => $RequestPagar->input('documento'),
                'dt_emissao' => $dt_emissao,
                'dt_vencimento' => $dt_vencimento,
                'dt_pagamento' => $dt_pagamento,
                'valorTotalsemDesconto' => $valorTotalsemDesconto,
                'valorTotalDesconto' => $valorTotalDesconto,
                'valorTotal' => $valorTotalPedido,
                'parcelas' => $RequestPagar->input('parcelas'),
                'formaPgto1' => $RequestPagar->input('formaPgto1'),
                'valorformaPgto1' => $valorformaPgto1,
                'formaPgto2' => $RequestPagar->input('formaPgto2'),
                'valorformaPgto2' => $valorformaPgto2,
                'porcentagem' => $RequestPagar->input('porcentagem'),
                'valorJuros' => $vlrJuros,
                'situacao' => $situacao,

            ]);

            return redirect()->route('Financeiro.Pagar.listarMpagar')->with('success', 'Contas a pagar cadastrado com sucesso!');

        }

        Alert::error('Ops!','Pedido já existe no contas a pagar !');
        return redirect()->route('Financeiro.Pagar.listarMpagar');

    }

    public function editMpagar(
        $id_pagar
    ){

        //dd($id_pagar);

        $pagarBuscar = Contapagar::where('id',$id_pagar)->first();

        //dd($pagarBuscar);

        if ($pagarBuscar) {

            if (Auth::check()) {

                $user = Auth::check();

                $uri = $this->request->route()->uri();

                $exploder = explode('/',$uri);

                $urlAtual = $exploder[1];

                $registro = $pagarBuscar->id;
                $id_fornecedor = $pagarBuscar->id_fornecedor;
                $razaoSocial = $pagarBuscar->razaoSocial;
                $nomeFantasia = $pagarBuscar->nomeFantasia;
                $cod_conta = $pagarBuscar->cod_conta;
                $id_pedido = $pagarBuscar->id_pedido;
                $id_notafiscal = $pagarBuscar->id_notafiscal;
                $documento = $pagarBuscar->documento;

                //Trata data de emissão de americano para brasileiro

                $trataemissao = $pagarBuscar->dt_emissao;

                $dt_emissao = Carbon::parse($trataemissao)->format('d/m/Y');

                $dt_vencimento = trim($pagarBuscar->dt_vencimento);

                if($dt_vencimento){

                    $dt_vencimento = Carbon::parse($dt_vencimento)->format('d/m/Y');

                }else{

                    $dt_vencimento = null;

                }

                $dt_pagamento = trim($pagarBuscar->dt_pagamento);

                if($dt_pagamento){

                    $dt_pagamento = Carbon::parse($dt_pagamento)->format('d/m/Y');
                    $situacao = 'FINALIZADO';

                }else{

                    $dt_pagamento = null;
                    $situacao = 'EM PROCESSO';

                }

                //Trata valor de americano para brasileiro

                $valorTotalsemDesconto = $pagarBuscar->valorTotalsemDesconto;
                $trataVTsDesconto = trim(str_replace(".",",",$valorTotalsemDesconto));
                $trataVTsDesconto = floatval($trataVTsDesconto);
                $valorTotalsemDesconto = $trataVTsDesconto;

                //ddd($valorTotalsemDesconto);

                $valorTotalDesconto = $pagarBuscar->valorTotalDesconto;

                $trataVTDesconto = trim(str_replace(".",",",$valorTotalDesconto));
                $trataVTDesconto = floatval($trataVTDesconto);
                $valorTotalDesconto = $trataVTDesconto;

                $valorTotalPedido = $pagarBuscar->valorTotal;
                $trataVTPedido = trim(str_replace(".",",",$valorTotalPedido));
                $trataVTPedido = floatval($trataVTPedido);
                $valorTotal = $trataVTPedido;

                $parcelas = $pagarBuscar->parcelas;
                $formaPgto1 = $pagarBuscar->formaPgto1;

                $valorformaPgto1 = $pagarBuscar->valorformaPgto1;
                if($valorformaPgto1){

                    $trataVTPgto1 = trim(str_replace(".",",",$valorformaPgto1));
                    $trataVTPgto1 = floatval($trataVTPgto1);
                    $valorformaPgto1 = $trataVTPgto1;

                }else{
                    $valorformaPgto1 = 0;
                }

                $formaPgto2 = $pagarBuscar->formaPgto2;

                $valorformaPgto2 = $pagarBuscar->valorformaPgto2;
                if($valorformaPgto2){

                    $trataVTPgto2 = trim(str_replace(".",",",$valorformaPgto2));
                    $trataVTPgto2 = floatval($trataVTPgto2);
                    $valorformaPgto2 = $trataVTPgto2;

                }else{

                    $valorformaPgto2 = 0;
                }

                $porcentagem = $pagarBuscar->porcentagem;

                $vlrJuros = $pagarBuscar->valorJuros;
                $tratavlrJuros = trim(str_replace(".",",",$vlrJuros));
                $tratavlrJuros = floatval($tratavlrJuros);
                $vlrJuros = $tratavlrJuros;

                $situacao = $situacao;

                $mfornecedor = Cache::get('$mfornecedor',$this->mfornecedor->all(), 1);

                $mpedidoCompra = Cache::get('$mpedidoCompra',$this->mpedidoCompra->all(), 1);

                return view('Financeiro.Pagar.formPagar', compact(
                    'user',
                    'urlAtual',
                    'mfornecedor',
                    'mpedidoCompra'
                ))->with(
                    [
                        'registro' =>$registro,
                        'id_pedido' => $id_pedido,
                        'id_fornecedor' => $id_fornecedor,
                        'razaoSocial' => $razaoSocial,
                        'nomeFantasia' => $nomeFantasia,
                        'cod_conta' => $cod_conta,
                        'id_pedido' => $id_pedido,
                        'id_notafiscal' => $id_notafiscal,
                        'documento' => $documento,
                        'dt_emissao' => $dt_emissao,
                        'dt_vencimento' => $dt_vencimento,
                        'dt_pagamento' => $dt_pagamento,
                        'vlrTsDesconto' => $valorTotalsemDesconto,
                        'vlrTDesconto' => $valorTotalDesconto,
                        'vlrTPedido' => $valorTotal,
                        'parcelas' => $parcelas,
                        'formaPgto1' => $formaPgto1,
                        'valorformaPgto1' => $valorformaPgto1,
                        'formaPgto2' => $formaPgto2,
                        'valorformaPgto2' => $valorformaPgto2,
                        'porcentagem' => $porcentagem,
                        'vlrJuros' => $vlrJuros,
                        'situacao' => $situacao,

                    ]);

            }
        }

        Alert::error('Ops!','Conta a pagar não existe !');
        return redirect()->route('Financeiro.Pagar.listarMpagar');

    }

    public function updateMpagar(
        Request $RequestPagar
    ){

        //dd($RequestPagar);

        $id_pagar = $RequestPagar->registro;

        $pagarBuscar = Contapagar::where('id',$id_pagar)->first();

        if ($pagarBuscar) {

            $id_responsavel = $RequestPagar->id_responsavel;
            $id_fornecedor = $RequestPagar->id_fornecedor;
            $razaoSocial = $RequestPagar->razaoSocial;
            $nomeFantasia = $RequestPagar->nomeFantasia;
            $cod_conta = $RequestPagar->cod_conta;
            $id_pedido = $RequestPagar->id_pedido;
            $id_notafiscal = $RequestPagar->id_notafiscal;
            $documento = $RequestPagar->documento;

            //Trata data de emissão de brasileiro para americano

            $dt_emissao = trim($RequestPagar->dt_emissao);

            $dt_emissao = Carbon::createFromFormat('d/m/Y', $dt_emissao)->format('Y-m-d H:i:s');

            //dd($dt_emissao);

            $dt_vencimento = trim($RequestPagar->dt_vencimento);

            if($dt_vencimento){

                $dt_vencimento = Carbon::createFromFormat('d/m/Y', $dt_vencimento)->format('Y-m-d H:i:s');

            }else{

                $dt_vencimento = null;

            }

            $dt_pagamento = trim($RequestPagar->dt_pagamento);

            if($dt_pagamento){

                $dt_pagamento = Carbon::createFromFormat('d/m/Y', $dt_pagamento)->format('Y-m-d H:i:s');
                $situacao = 'FINALIZADO';
            }else{

                $dt_pagamento = null;
                $situacao = 'EM PROCESSO';
            }

            //Trata valor de brasileiro para americano

            $valorTotalsemDesconto = $RequestPagar->vlrTsDesconto;

            $trataVtsDesconto = ( strpos($valorTotalsemDesconto,'R$')!== false );

            if ($trataVtsDesconto) {
                //dd('Encontrado');
                $trataVtsDesconto = trim($valorTotalsemDesconto,'R$');
                $trataVtsDesconto = trim(str_replace(".","",$trataVtsDesconto));
                $trataVtsDesconto = trim(str_replace(",",".",$trataVtsDesconto));
                $trataVtsDesconto = floatval($trataVtsDesconto);
            } else {
                //dd('Não encontrado');
                $trataVtsDesconto = trim($valorTotalsemDesconto,'0$');
                $trataVtsDesconto = trim(str_replace(","," ",$trataVtsDesconto));
            }

            $valorTotalsemDesconto = $trataVtsDesconto;

            //dd($valorTotalsemDesconto);

            $valorTotalDesconto = $RequestPagar->vlrTDesconto;

            $trataVtDesconto = ( strpos($valorTotalDesconto,'R$')!== false );

            if ($trataVtDesconto) {
                //dd('Encontrado');
                $trataVtDesconto = trim($valorTotalDesconto,'R$');
                $trataVtDesconto = trim(str_replace(".","",$trataVtDesconto));
                $trataVtDesconto = trim(str_replace(",",".",$trataVtDesconto));
                $trataVtDesconto = floatval($trataVtDesconto);
            } else {
                //dd('Não encontrado');
                $trataVtDesconto = trim($valorTotalDesconto,'0$');
                $trataVtDesconto = trim(str_replace(","," ",$trataVtDesconto));
            }

            $valorTotalDesconto = $trataVtDesconto;

            //dd($valorTotalDesconto);

            $valorTotalPedido = $RequestPagar->vlrTPedido;

            $trataVtPedido = ( strpos($valorTotalPedido,'R$')!== false );

            if ($trataVtPedido) {
                //dd('Encontrado');
                $trataVtPedido = trim($valorTotalPedido,'R$');
                $trataVtPedido = trim(str_replace(".","",$trataVtPedido));
                $trataVtPedido = trim(str_replace(",",".",$trataVtPedido));
                $trataVtPedido = floatval($trataVtPedido);
            } else {
                //dd('Não encontrado');
                $trataVtPedido = trim($valorTotalPedido,'0$');
                $trataVtPedido = trim(str_replace(","," ",$trataVtPedido));
            }

            $valorTotalPedido = $trataVtPedido;

            $parcelas = $RequestPagar->parcelas;
            $formaPgto1 = $RequestPagar->formaPgto1;

            //dd($valorTotalPedido);

            $valorformaPgto1 = $RequestPagar->valorformaPgto1;

            $trataVtpgto1 = ( strpos($valorformaPgto1,'R$')!== false );

            if ($trataVtpgto1) {
                //dd('Encontrado');
                $trataVtpgto1 = trim($valorformaPgto1,'R$');
                $trataVtpgto1 = trim(str_replace(".","",$trataVtpgto1));
                $trataVtpgto1 = trim(str_replace(",",".",$trataVtpgto1));
                $trataVtpgto1 = floatval($trataVtpgto1);
            } else {
                //dd('Não encontrado');
                $trataVtpgto1 = trim($valorformaPgto1,'0$');
                $trataVtpgto1 = trim(str_replace(","," ",$trataVtpgto1));
            }

            $valorformaPgto1 = $trataVtpgto1;

            $formaPgto2 = $RequestPagar->formaPgto2;
            $valorformaPgto2 = $RequestPagar->valorformaPgto2;

            $trataVtpgto2 = ( strpos($valorformaPgto2,'R$')!== false );

            if ($trataVtpgto2) {
                //dd('Encontrado');
                $trataVtpgto2 = trim($valorformaPgto2,'R$');
                $trataVtpgto2 = trim(str_replace(".","",$trataVtpgto2));
                $trataVtpgto2 = trim(str_replace(",",".",$trataVtpgto2));
                $trataVtpgto2 = floatval($trataVtpgto2);
            } else {
                //dd('Não encontrado');
                $trataVtpgto2 = trim($valorformaPgto2,'0$');
                $trataVtpgto2 = trim(str_replace(","," ",$trataVtpgto2));
            }

            $valorformaPgto2 = $trataVtpgto2;

            $porcentagem = $RequestPagar->porcentagem;

            $vlrJuros = $RequestPagar->vlrJuros;

            $tratavlrJuros = ( strpos($vlrJuros,'R$')!== false );

            if ($tratavlrJuros) {
                //dd('Encontrado');
                $tratavlrJuros = trim($vlrJuros,'R$');
                $tratavlrJuros = trim(str_replace(".","",$tratavlrJuros));
                $tratavlrJuros = trim(str_replace(",",".",$tratavlrJuros));
                $tratavlrJuros = floatval($trataVtPedido);
            } else {
                //dd('Não encontrado');
                $tratavlrJuros = trim($vlrJuros,'0$');
                $tratavlrJuros = trim(str_replace(","," ",$tratavlrJuros));
            }

            $vlrJuros = $tratavlrJuros;

            Contapagar::whereId($id_pagar)->update([

                'id_responsavel' => $id_responsavel,
                'id_fornecedor' => $id_fornecedor,
                'razaoSocial' => $razaoSocial,
                'nomeFantasia' => $nomeFantasia,
                'cod_conta' => $cod_conta,
                'id_pedido' => $id_pedido,
                'id_notafiscal' => $id_notafiscal,
                'documento' => $documento,
                'dt_emissao' => $dt_emissao,
                'dt_vencimento' => $dt_vencimento,
                'dt_pagamento' => $dt_pagamento,
                'valorTotalsemDesconto' => $valorTotalsemDesconto,
                'valorTotalDesconto' => $valorTotalDesconto,
                'valorTotal' => $valorTotalPedido,
                'parcelas' => $parcelas,
                'formaPgto1' => $formaPgto1,
                'valorformaPgto1' => $valorformaPgto1,
                'formaPgto2' => $formaPgto2,
                'valorformaPgto2' => $valorformaPgto2,
                'porcentagem' => $porcentagem,
                'valorJuros' => $vlrJuros,
                'situacao' => $situacao,

            ]);

            return redirect()->route('Financeiro.Pagar.listarMpagar')->with('success', 'Contas a pagar alterado com sucesso!');

        }

        return redirect()->route('Financeiro.Pagar.listarMpagar')->with('erro', 'Contas a pagar não existe!');

    }

    public function relatorioMpagar()
    {

        //dd('Relatorio pdv');

        if (Auth::check()) {

            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/',$uri);

            $urlAtual = $exploder[1];

            return view('Financeiro.Pagar.relatorioPagar', compact(
                'user',
                'urlAtual'
            ));

       }

       return redirect()->route('Financeiro.Pagar.listarMpagar');

    }

    public function impRelatorioMpagar1(Request $relatorio)
    {

        $data_inicial = $relatorio->periodotime1;
        $data_final = $relatorio->periodotime2;
        $situacao = $relatorio->situacao;

        $mdadospagar = Contapagar::where('dt_emissao','>=',$data_inicial)
                        ->where('dt_emissao','<=',$data_final)
                        ->where('situacao','=',$situacao)
                        ->get();

        $mtotalpagar = Contapagar::where('dt_emissao','>=',$data_inicial)
                        ->where('dt_emissao','<=',$data_final)
                        ->where('situacao','=',$situacao)
                        ->get()
                        ->sum('valorTotal');

        if ($mdadospagar){

            if (Auth::check()) {

                $user = Auth::check();

                $uri = $this->request->route()->uri();

                $exploder = explode('/',$uri);

                $urlAtual = $exploder[1];

                 return view('Financeiro.Pagar.imprelatorioPagar', compact(
                     'user',
                     'urlAtual',
                     'data_inicial',
                     'data_final',
                     'situacao',
                     'mdadospagar',
                     'mtotalpagar'
                 ));
            }
        }

        return redirect()->route('Financeiro.Pagar.listarMpagar');
    }

//FIM DA CLASSE
}
