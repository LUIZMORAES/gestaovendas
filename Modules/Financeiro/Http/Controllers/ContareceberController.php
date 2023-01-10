<?php

namespace Modules\Financeiro\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

use App\Models\User;
use Carbon\Carbon;
use Modules\Cliente\Entities\Cliente;
use Modules\Pedidovenda\Entities\Pedidovenda;
use Modules\Financeiro\Entities\Contareceber;

class ContareceberController extends Controller
{
    public $request;
    public $usuarios;
    public $mcliente;
    public $mreceber;
    public $mpedidoVenda;

    public function __construct(
        Request $request,
        User $usuarios,
        Cliente $mcliente,
        Contareceber $mreceber,
        Pedidovenda $mpedidoVenda
    ) {

        $this->middleware('auth');
        $this->request = $request;
        $this->usuarios = $usuarios;
        $this->mcliente = $mcliente;
        $this->mreceber = $mreceber;
        $this->mpedidoVenda = $mpedidoVenda;

    }

    public function listarMreceber()
    {

        if (Auth::check()) {
            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/', $uri);

            $urlAtual = $exploder[1];

            $mreceber = Contareceber::all();

            return view('Financeiro.Receber.listarReceber', compact(
                'user',
                'urlAtual',
                'mreceber'
            ));
        }

        return redirect()->route('admin.painelprincipal');
    }

    public function createMreceber()
    {

        if (Auth::check()) {

            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/',$uri);

            $urlAtual = $exploder[1];

            $mcliente = Cache::get('$mcliente',$this->mcliente->all(), 1);

            $mpedidoVenda = Cache::get('$mpedidoVenda',$this->mpedidoVenda->all(), 1);

            return view('Financeiro.Receber.formReceber', compact(
                'user',
                'urlAtual',
                'mcliente',
                'mpedidoVenda'
            ));

        }

        return redirect()->route('Financeiro.Receber.listarMreceber');
    }

    public function buscarpedidoMreceber(
        $pedido,
        Request $request
    ){

        //dd($request);

        $registro = $request->registro;

        if (Auth::check()) {

            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/',$uri);

            $urlAtual = $exploder[1];

            $mcliente = Cache::get('$mcliente',$this->mcliente->all(), 1);

            $mpedidoVenda = Cache::get('$mpedidoVenda',$this->mpedidoVenda->all(), 1);

            $dadosPedido = Pedidovenda::where('id',$pedido)->first();

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

            return view('Financeiro.Receber.formReceber', compact(
                'user',
                'urlAtual',
                'mcliente',
                'mpedidoVenda'
            ))->with(
                [
                    'registro' => $registro,
                    'id_pedido' => $pedido,
                    'id_responsavel' => $dadosPedido->id_responsavel,
                    'id_cliente' => $dadosPedido->id_cliente,
                    'razaoSocial' => $dadosPedido->razaoSocial,
                    'nomeFantasia' => $dadosPedido->nomeFantasia,
                    'vlrTsDesconto' => $valorTotalsemDesconto,
                    'vlrTDesconto' => $valorTotalDesconto,
                    'vlrTPedido' => $valorTotalPedido,
                    'dt_emissao' => $dt_emissao,
                    'formaPgto1' => $dadosPedido->formaPgto1,

                ]);

        }

        return redirect()->route('Financeiro.Receber.listarMreceber');
    }

    public function storeMreceber(
        Request $RequestReceber
    ){

        //dd($RequestReceber);

        $id_pedido = $RequestReceber->id_pedido;

        $receberBuscar = Contareceber::where('id',$id_pedido)->first();

        if (!$receberBuscar) {

            //Trata data de emissão de brasileiro para americano

            $dt_emissao = trim($RequestReceber->dt_emissao);

            $dt_emissao = Carbon::createFromFormat('d/m/Y', $dt_emissao)->format('Y-m-d H:i:s');

            //dd($dt_emissao);

            $dt_vencimento = trim($RequestReceber->dt_vencimento);

            if($dt_vencimento){

                $dt_vencimento = Carbon::createFromFormat('d/m/Y', $dt_vencimento)->format('Y-m-d H:i:s');

            }else{

                $dt_vencimento = null;

            }

            $dt_pagamento = trim($RequestReceber->dt_pagamento);

            if($dt_pagamento){

                $dt_pagamento = Carbon::createFromFormat('d/m/Y', $dt_pagamento)->format('Y-m-d H:i:s');
                $situacao = 'FINALIZADO';
            }else{

                $dt_pagamento = null;
                $situacao = 'EM PROCESSO';
            }

            //Trata valor de brasileiro para americano

            $valorTotalsemDesconto = $RequestReceber->vlrTsDesconto;

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

            $valorTotalDesconto = $RequestReceber->vlrTDesconto;

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

            $valorTotalPedido = $RequestReceber->vlrTPedido;

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

            $valorformaPgto1 = $RequestReceber->valorformaPgto1;

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

            $valorformaPgto2 = $RequestReceber->valorformaPgto2;

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

            $vlrJuros = $RequestReceber->vlrJuros;

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

            Contareceber::create([

                'id_responsavel' => $RequestReceber->input('id_responsavel'),
                'id_cliente' => $RequestReceber->input('id_cliente'),
                'razaoSocial' => $RequestReceber->input('razaoSocial'),
                'nomeFantasia' => $RequestReceber->input('nomeFantasia'),
                'cod_conta' => $RequestReceber->input('cod_conta'),
                'id_pedido' => $RequestReceber->input('id_pedido'),
                'id_notafiscal' => $RequestReceber->input('id_notafiscal'),
                'documento' => $RequestReceber->input('documento'),
                'dt_emissao' => $dt_emissao,
                'dt_vencimento' => $dt_vencimento,
                'dt_pagamento' => $dt_pagamento,
                'valorTotalsemDesconto' => $valorTotalsemDesconto,
                'valorTotalDesconto' => $valorTotalDesconto,
                'valorTotal' => $valorTotalPedido,
                'parcelas' => $RequestReceber->input('parcelas'),
                'formaPgto1' => $RequestReceber->input('formaPgto1'),
                'valorformaPgto1' => $valorformaPgto1,
                'formaPgto2' => $RequestReceber->input('formaPgto2'),
                'valorformaPgto2' => $valorformaPgto2,
                'porcentagem' => $RequestReceber->input('porcentagem'),
                'valorJuros' => $vlrJuros,
                'situacao' => $situacao,

            ]);

            return redirect()->route('Financeiro.Receber.listarMreceber')->with('success', 'Contas a receber cadastrado com sucesso!');

        }

        return redirect()->route('Financeiro.Receber.listarMreceber')->with('erro', 'Pedido já existe no contas a receber!');

    }

    public function editMreceber(
        $id_receber
    ){

        $receberBuscar = Contareceber::where('id',$id_receber)->first();

        //dd($receberBuscar);

        if ($receberBuscar) {

            if (Auth::check()) {

                $user = Auth::check();

                $uri = $this->request->route()->uri();

                $exploder = explode('/',$uri);

                $urlAtual = $exploder[1];

                $registro = $receberBuscar->id;
                $id_cliente = $receberBuscar->id_cliente;
                $razaoSocial = $receberBuscar->razaoSocial;
                $nomeFantasia = $receberBuscar->nomeFantasia;
                $cod_conta = $receberBuscar->cod_conta;
                $id_pedido = $receberBuscar->id_pedido;
                $id_notafiscal = $receberBuscar->id_notafiscal;
                $documento = $receberBuscar->documento;

                //Trata data de emissão de americano para brasileiro

                $trataemissao = $receberBuscar->dt_emissao;

                $dt_emissao = Carbon::parse($trataemissao)->format('d/m/Y');

                $dt_vencimento = trim($receberBuscar->dt_vencimento);

                if($dt_vencimento){

                    $dt_vencimento = Carbon::parse($dt_vencimento)->format('d/m/Y');

                }else{

                    $dt_vencimento = null;

                }

                $dt_pagamento = trim($receberBuscar->dt_pagamento);

                if($dt_pagamento){

                    $dt_pagamento = Carbon::parse($dt_pagamento)->format('d/m/Y');
                    $situacao = 'FINALIZADO';

                }else{

                    $dt_pagamento = null;
                    $situacao = 'EM PROCESSO';

                }

                //Trata valor de americano para brasileiro

                $valorTotalsemDesconto = $receberBuscar->valorTotalsemDesconto;
                $trataVTsDesconto = trim(str_replace(".",",",$valorTotalsemDesconto));
                $trataVTsDesconto = floatval($trataVTsDesconto);
                $valorTotalsemDesconto = $trataVTsDesconto;

                //ddd($valorTotalsemDesconto);

                $valorTotalDesconto = $receberBuscar->valorTotalDesconto;

                $trataVTDesconto = trim(str_replace(".",",",$valorTotalDesconto));
                $trataVTDesconto = floatval($trataVTDesconto);
                $valorTotalDesconto = $trataVTDesconto;

                $valorTotalPedido = $receberBuscar->valorTotal;
                $trataVTPedido = trim(str_replace(".",",",$valorTotalPedido));
                $trataVTPedido = floatval($trataVTPedido);
                $valorTotal = $trataVTPedido;

                $parcelas = $receberBuscar->parcelas;
                $formaPgto1 = $receberBuscar->formaPgto1;

                $valorformaPgto1 = $receberBuscar->valorformaPgto1;
                if($valorformaPgto1){

                    $trataVTPgto1 = trim(str_replace(".",",",$valorformaPgto1));
                    $trataVTPgto1 = floatval($trataVTPgto1);
                    $valorformaPgto1 = $trataVTPgto1;

                }else{
                    $valorformaPgto1 = 0;
                }

                $formaPgto2 = $receberBuscar->formaPgto2;

                $valorformaPgto2 = $receberBuscar->valorformaPgto2;
                if($valorformaPgto2){

                    $trataVTPgto2 = trim(str_replace(".",",",$valorformaPgto2));
                    $trataVTPgto2 = floatval($trataVTPgto2);
                    $valorformaPgto2 = $trataVTPgto2;

                }else{

                    $valorformaPgto2 = 0;
                }

                $porcentagem = $receberBuscar->porcentagem;

                $vlrJuros = $receberBuscar->valorJuros;
                $tratavlrJuros = trim(str_replace(".",",",$vlrJuros));
                $tratavlrJuros = floatval($tratavlrJuros);
                $vlrJuros = $tratavlrJuros;

                $situacao = $situacao;

                $mcliente = Cache::get('$mcliente',$this->mcliente->all(), 1);

                $mpedidoVenda = Cache::get('$mpedidoVenda',$this->mpedidoVenda->all(), 1);

                return view('Financeiro.Receber.formReceber', compact(
                    'user',
                    'urlAtual',
                    'mcliente',
                    'mpedidoVenda'
                ))->with(
                    [
                        'registro' =>$registro,
                        'id_pedido' => $id_pedido,
                        'id_cliente' => $id_cliente,
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
    }

    public function updateMreceber(
        Request $RequestReceber
    ){

        //dd($RequestReceber);

        $id_receber = $RequestReceber->registro;

        $receberBuscar = Contareceber::where('id',$id_receber)->first();

        if ($receberBuscar) {

            $id_responsavel = $RequestReceber->id_responsavel;
            $id_cliente = $RequestReceber->id_cliente;
            $razaoSocial = $RequestReceber->razaoSocial;
            $nomeFantasia = $RequestReceber->nomeFantasia;
            $cod_conta = $RequestReceber->cod_conta;
            $id_pedido = $RequestReceber->id_pedido;
            $id_notafiscal = $RequestReceber->id_notafiscal;
            $documento = $RequestReceber->documento;

            //Trata data de emissão de brasileiro para americano

            $dt_emissao = trim($RequestReceber->dt_emissao);

            $dt_emissao = Carbon::createFromFormat('d/m/Y', $dt_emissao)->format('Y-m-d H:i:s');

            //dd($dt_emissao);

            $dt_vencimento = trim($RequestReceber->dt_vencimento);

            if($dt_vencimento){

                $dt_vencimento = Carbon::createFromFormat('d/m/Y', $dt_vencimento)->format('Y-m-d H:i:s');

            }else{

                $dt_vencimento = null;

            }

            $dt_pagamento = trim($RequestReceber->dt_pagamento);

            if($dt_pagamento){

                $dt_pagamento = Carbon::createFromFormat('d/m/Y', $dt_pagamento)->format('Y-m-d H:i:s');
                $situacao = 'FINALIZADO';
            }else{

                $dt_pagamento = null;
                $situacao = 'EM PROCESSO';
            }

            //Trata valor de brasileiro para americano

            $valorTotalsemDesconto = $RequestReceber->vlrTsDesconto;

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

            $valorTotalDesconto = $RequestReceber->vlrTDesconto;

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

            $valorTotalPedido = $RequestReceber->vlrTPedido;

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

            $parcelas = $RequestReceber->parcelas;
            $formaPgto1 = $RequestReceber->formaPgto1;

            //dd($valorTotalPedido);

            $valorformaPgto1 = $RequestReceber->valorformaPgto1;

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

            $formaPgto2 = $RequestReceber->formaPgto2;
            $valorformaPgto2 = $RequestReceber->valorformaPgto2;

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

            $porcentagem = $RequestReceber->porcentagem;

            $vlrJuros = $RequestReceber->vlrJuros;

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

            Contareceber::whereId($id_receber)->update([

                'id_responsavel' => $id_responsavel,
                'id_cliente' => $id_cliente,
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

            return redirect()->route('Financeiro.Receber.listarMreceber')->with('success', 'Contas a receber alterado com sucesso!');

        }

        return redirect()->route('Financeiro.Receber.listarMreceber')->with('erro', 'Contas a receber não existe!');

    }

    public function relatorioMreceber()
    {

        //dd('Relatorio pdv');

        if (Auth::check()) {

            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/',$uri);

            $urlAtual = $exploder[1];

            return view('Financeiro.Receber.relatorioReceber', compact(
                'user',
                'urlAtual'
            ));

       }

       return redirect()->route('admin.painelprincipal');

    }

    public function impRelatorioMreceber1(Request $relatorio)
    {

        //dd($relatorio);

        $data_inicial = $relatorio->periodotime1;
        $data_final = $relatorio->periodotime2;
        $situacao = $relatorio->situacao;

        //dd($data1,$data2);

        $mdadosreceber = Contareceber::where('dt_emissao','>=',$data_inicial)
                        ->where('dt_emissao','<=',$data_final)
                        ->where('situacao','=',$situacao)
                        ->get();

        $mtotalreceber = Contareceber::where('dt_emissao','>=',$data_inicial)
                        ->where('dt_emissao','<=',$data_final)
                        ->where('situacao','=',$situacao)
                        ->get()
                        ->sum('valorTotal');

        //dd($mtotalpdv);

        if ($mdadosreceber){

            if (Auth::check()) {

                $user = Auth::check();

                $uri = $this->request->route()->uri();

                $exploder = explode('/',$uri);

                $urlAtual = $exploder[1];

                 return view('Financeiro.Receber.imprelatorioReceber', compact(
                     'user',
                     'urlAtual',
                     'data_inicial',
                     'data_final',
                     'situacao',
                     'mdadosreceber',
                     'mtotalreceber'
                 ));
            }
        }

        return redirect()->route('Comercial.Venda.listarMpdv');
    }

// Final da classe
}
