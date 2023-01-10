<?php

namespace Modules\Pedidocompra\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

use App\Models\User;
use Carbon\Carbon;
use Modules\Fornecedor\Entities\Fornecedor;
use Modules\Estoque\Entities\Estoque;
use Modules\Pedidocompra\Entities\Pedidocompra;
use Modules\Pedidocompra\Entities\PedidoCompraItem;
use Modules\Pedidocompra\Entities\Balancopdc;

class PedidocompraController extends Controller
{

    public $request;
    public $usuarios;
    public $mfornecedor;
    public $mestoque;
    public $mpedidoCompra;
    public $mpedidoCompraItem;
    public $mbalancoPdc;

    public function __construct(
        Request $request,
        User $usuarios,
        Fornecedor $mfornecedor,
        Estoque $mestoque,
        Pedidocompra $mpedidoCompra,
        PedidoCompraItem $mpedidoCompraItem,
        Balancopdc $mbalancoPdc
    ) {

        $this->middleware('auth');
        $this->request = $request;
        $this->usuarios = $usuarios;
        $this->mfornecedor = $mfornecedor;
        $this->mestoque = $mestoque;
        $this->mpedidoCompra = $mpedidoCompra;
        $this->mpedidoCompraItem = $mpedidoCompraItem;
        $this->mbalancoPdc = $mbalancoPdc;
    }

    public function listarMpdc()
    {

        if (Auth::check()) {
            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/', $uri);

            $urlAtual = $exploder[1];

            $mpedidoCompra = Pedidocompra::all();

            return view('Comercial.Compra.listarPdc', compact(
                'user',
                'urlAtual',
                'mpedidoCompra'
            ));
        }

        return redirect()->route('admin.painelprincipal');
    }

    public function createMpdc()
    {

        //dd('teste createpdc');
        //Alert::error('Ops!','Em desenvolvimento!');
        //return redirect()->back();

        if (Auth::check()) {

            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/',$uri);

            $urlAtual = $exploder[1];

            $mfornecedor = Cache::get('$mfornecedor',$this->mfornecedor->all(), 1);

            //dd($mfornecedor);

            $mestoque = Estoque::all();

            return view('Comercial.Compra.pedidoPdc', compact(
                'user',
                'urlAtual',
                'mfornecedor',
                'mestoque'
            ));

        }

        return redirect()->route('Comercial.Compra.listarMpdc');
    }

    public function storeMpdc(
        Request $RequestPc
    ){

        $id_pedido = $RequestPc->id_pedido;

        if(!$id_pedido){

            //dd($id_pedido);

            //Trata data de emissão de brasileiro para americano
            $dt_emissao = Carbon::parse(now());

            Pedidocompra::create([

                'id_responsavel' => $RequestPc->input('id_responsavel'),
                'id_fornecedor' => $RequestPc->input('id_fornecedor'),
                'nomeFantasia' => $RequestPc->input('nomeFantasia'),
                'razaoSocial' => $RequestPc->input('razaoSocial'),
                'cpfcnpj' => $RequestPc->input('cpfcnpj'),
                'insestadual' => $RequestPc->input('insestadual'),
                'insmunicipal' => $RequestPc->input('insmunicipal'),
                'end_cep' => $RequestPc->input('end_cep'),
                'end_cidade' => $RequestPc->input('end_cidade'),
                'end_bairro' => $RequestPc->input('end_bairro'),
                'end_logradouro' => $RequestPc->input('end_logradouro'),
                'end_numero' => $RequestPc->input('end_numero'),
                'end_complemento' => $RequestPc->input('end_complemento'),
                'end_uf' => $RequestPc->input('end_uf'),
                'dt_emissao' => $dt_emissao,

            ]);

        }else{

            Alert::error('Ops!','Pedido já existe');
            return redirect()->back();

        }

        $mfornecedor = Cache::get('$mfornecedor',$this->mfornecedor->all(), 1);

        //dd($mfornecedor);

        $mestoque = Estoque::all();

        //Trata data de emissão de americano para brasileiro

        $trataemissao = Carbon::parse(now());
        $dt_emissao = Carbon::parse($trataemissao)->format('d/m/Y');

        //Procurar ultimo registro
        $mpedidoCompra = Pedidocompra::orderBy('id', 'desc')->first();

        $id_pedido = $mpedidoCompra->id;
        $id_responsavel = $mpedidoCompra->responsavel;
        $id_fornecedor = $mpedidoCompra->id_fornecedor;
        $razaoSocial = $mpedidoCompra->razaoSocial;
        $nomeFantasia = $mpedidoCompra->nomeFantasia;
        $cpfcnpj = $mpedidoCompra->cpfcnpj;
        $insestadual = $mpedidoCompra->insestadual;
        $insmunicipal = $mpedidoCompra->insmunicipal;
        $telefone = $mpedidoCompra->telefone;
        $email = $mpedidoCompra->email;
        $end_cep = $mpedidoCompra->end_cep;
        $end_cidade = $mpedidoCompra->end_cidade;
        $end_bairro = $mpedidoCompra->end_bairro;
        $end_logradouro = $mpedidoCompra->end_logradouro;
        $end_numero = $mpedidoCompra->end_numero;
        $end_complemento = $mpedidoCompra->end_complemento;
        $end_uf = $mpedidoCompra->end_uf;
        $valorTotalsemDesconto = $mpedidoCompra->valorTotalsemDesconto;
        $valorTotalDesconto = $mpedidoCompra->valorTotalDesconto;
        $valorTotalPedido = $mpedidoCompra->valorTotalPedido;
        $formaPgto1 = $mpedidoCompra->formaPgto1;
        $dt_emissao = $dt_emissao;

        //dd($mpedidoCompra);

        $mpedidoCompraItem = PedidoCompraItem::where('id_pedido_item','=',$id_pedido)->get();

        return view('Comercial.Compra.pedidoPdc', compact(
            'mfornecedor',
            'mestoque',
            'mpedidoCompra',
            'mpedidoCompraItem'
        ))->with(
            [
                'id_pedido' => $id_pedido,
                'id_responsavel' => $id_responsavel,
                'id_fornecedor' => $id_fornecedor,
                'razaoSocial' => $razaoSocial,
                'nomeFantasia' => $nomeFantasia,
                'cpfcnpj' => $cpfcnpj,
                'insestadual' => $insestadual,
                'insmunicipal' => $insmunicipal,
                'telefone' => $telefone,
                'email' => $email,
                'end_cep' => $end_cep,
                'end_cidade' => $end_cidade,
                'end_bairro' => $end_bairro,
                'end_logradouro' => $end_logradouro,
                'end_numero' => $end_numero,
                'end_complemento' => $end_complemento,
                'end_uf' => $end_uf,
                'valorTotalsemDesconto' => $valorTotalsemDesconto,
                'valorTotalDesconto' => $valorTotalDesconto,
                'valorTotalPedido' => $valorTotalPedido,
                'formaPgto1' => $formaPgto1,
                'dt_emissao' => $dt_emissao,
            ]);

    }

    public function updateMpdc(
        Request $RequestPc){

        //dd($RequestPc);

        try {

            //dd($RequestPc);
            $id_pedido = $RequestPc->id_pedido;

            $mpedidoCompra = Pedidocompra::where('id',$id_pedido)->first();

            if ($mpedidoCompra) {

                $id_pedido = $RequestPc->id_pedido;

                //Trata data de emissão de brasileiro para americano

                $dt_emissao = trim($RequestPc->dt_emissao);

                $trataemissao = empty(trim($dt_emissao));

                if($trataemissao){

                    return view('Comercial.Compra.pedidoPdc')->with(
                        [
                            'id_pedido' => $id_pedido,
                        ]);
                }

                $dt_emissao = Carbon::createFromFormat('d/m/Y', $dt_emissao)->format('Y-m-d');

                //dd($dt_emissao);

                //Trata valor de brasileiro para americano

                $valorTotalsemDesconto = $RequestPc->input('valorTotalsemDesconto');

                //dd($valorTotalsemDesconto);

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

                $valorTotalDesconto = $RequestPc->input('valorTotalDesconto');

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

                $valorTotalPedido = $RequestPc->input('valorTotalPedido');

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

                Pedidocompra::whereId($id_pedido)->update([

                    'id_responsavel' => $RequestPc->input('id_responsavel'),
                    'id_fornecedor' => $RequestPc->input('id_fornecedor'),
                    'razaoSocial' => $RequestPc->input('razaoSocial'),
                    'nomeFantasia' => $RequestPc->input('nomeFantasia'),
                    'cpfcnpj' => $RequestPc->input('cpfcnpj'),
                    'insestadual' => $RequestPc->input('insestadual'),
                    'insmunicipal' => $RequestPc->input('insmunicipal'),
                    'end_cep' => $RequestPc->input('end_cep'),
                    'end_cidade' => $RequestPc->input('end_cidade'),
                    'end_bairro' => $RequestPc->input('end_bairro'),
                    'end_logradouro' => $RequestPc->input('end_logradouro'),
                    'end_numero' => $RequestPc->input('end_numero'),
                    'end_complemento' => $RequestPc->input('end_complemento'),
                    'end_uf' => $RequestPc->input('end_uf'),
                    'valorTotalsemDesconto' => $valorTotalsemDesconto,
                    'valorTotalDesconto' => $valorTotalDesconto,
                    'valorTotalPedido' => $valorTotalPedido,
                    'formaPgto1' => $RequestPc->input('formaPgto1'),
                    'dt_emissao' => $dt_emissao,

                ]);

            }

            $mpedidoCompra = Pedidocompra::where('id',$id_pedido)->first();

            //Trata data de emissão de americano para brasileiro

            $trataemissao = $mpedidoCompra->dt_emissao;

            $dt_emissao = Carbon::parse($trataemissao)->format('d/m/Y');

            //Trata valor de americano para brasileiro

            $trataVsemDesconto = pedidoCompraItem::where('id_pedido_item','=',$id_pedido)->get()->sum('valor_semDesconto');

            $valorTotalsemDesconto = trim(str_replace(".",",",$trataVsemDesconto));

            //dd($mvalorsemDesconto);

            $trataVTotalDesconto = pedidoCompraItem::where('id_pedido_item','=',$id_pedido)->get()->sum('valor_desconto');

            $valorTotalDesconto = trim(str_replace(".",",",$trataVTotalDesconto));

            //dd($mvalorTotalDesconto);

            $trataVTotalProduto = pedidoCompraItem::where('id_pedido_item','=',$id_pedido)->get()->sum('valor_totalProduto');

            $valorTotalPedido = trim(str_replace(".",",",$trataVTotalProduto));

            $mfornecedor = Cache::get('$mfornecedor',$this->mfornecedor->all(), 1);

            //dd($mfornecedor);

            $mestoque = Estoque::all();

            $mpedidoCompraItem = PedidoCompraItem::where('id_pedido_item','=',$id_pedido)->get();

            $disp_android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");

            if($disp_android == true){

                return view('Comercial.Android.Compra.pedidoApdc', compact(
                    'mfornecedor',
                    'mestoque',
                    'mpedidoCompraItem'
                ))->with(
                    [
                        'id_pedido' => $id_pedido,
                        'id_responsavel' => $mpedidoCompra->id_responsavel,
                        'id_fornecedor' => $mpedidoCompra->id_fornecedor,
                        'razaoSocial' => $mpedidoCompra->razaoSocial,
                        'nomeFantasia' => $mpedidoCompra->nomeFantasia,
                        'cpfcnpj' => $mpedidoCompra->cpfcnpj,
                        'insestadual' => $mpedidoCompra->insestadual,
                        'insmunicipal' => $mpedidoCompra->insmunicipal,
                        'telefone' => $mpedidoCompra->telefone,
                        'email' => $mpedidoCompra->email,
                        'end_cep' => $mpedidoCompra->end_cep,
                        'end_cidade' => $mpedidoCompra->end_cidade,
                        'end_bairro' => $mpedidoCompra->end_bairro,
                        'end_logradouro' => $mpedidoCompra->end_logradouro,
                        'end_numero' => $mpedidoCompra->end_numero,
                        'end_complemento' => $mpedidoCompra->end_complemento,
                        'end_uf' => $mpedidoCompra->end_uf,
                        'valorTotalsemDesconto' => $valorTotalsemDesconto,
                        'valorTotalDesconto' => $valorTotalDesconto,
                        'valorTotalPedido' => $valorTotalPedido,
                        'dt_emissao' => $dt_emissao,
                        'formaPgto1' => $mpedidoCompra->formaPgto1,
                        'situacao' => $mpedidoCompra->situacao,
                    ]);

            }else{

                return view('Comercial.Compra.pedidoPdc', compact(
                    'mfornecedor',
                    'mestoque',
                    'mpedidoCompraItem'
                ))->with(
                    [
                        'id_pedido' => $id_pedido,
                        'id_responsavel' => $mpedidoCompra->id_responsavel,
                        'id_fornecedor' => $mpedidoCompra->id_fornecedor,
                        'razaoSocial' => $mpedidoCompra->razaoSocial,
                        'nomeFantasia' => $mpedidoCompra->nomeFantasia,
                        'cpfcnpj' => $mpedidoCompra->cpfcnpj,
                        'insestadual' => $mpedidoCompra->insestadual,
                        'insmunicipal' => $mpedidoCompra->insmunicipal,
                        'telefone' => $mpedidoCompra->telefone,
                        'email' => $mpedidoCompra->email,
                        'end_cep' => $mpedidoCompra->end_cep,
                        'end_cidade' => $mpedidoCompra->end_cidade,
                        'end_bairro' => $mpedidoCompra->end_bairro,
                        'end_logradouro' => $mpedidoCompra->end_logradouro,
                        'end_numero' => $mpedidoCompra->end_numero,
                        'end_complemento' => $mpedidoCompra->end_complemento,
                        'end_uf' => $mpedidoCompra->end_uf,
                        'valorTotalsemDesconto' => $valorTotalsemDesconto,
                        'valorTotalDesconto' => $valorTotalDesconto,
                        'valorTotalPedido' => $valorTotalPedido,
                        'dt_emissao' => $dt_emissao,
                        'formaPgto1' => $mpedidoCompra->formaPgto1,
                        'situacao' => $mpedidoCompra->situacao,
                    ]);

            }

        return redirect()->back()->with('success', 'Pedido não encontrado!');

        } catch (\Exception $e){

            return redirect()->back()->with('success', 'Verifique os dados digitados!');

        }

    }

    public function buscarEfornecedor(
        Request $request
    ){

        //dd($request);

        $id_pedido = $request->id_pedido;

        $mfornecedorBuscar = Fornecedor::where('id',$request->id_fornecedor)->first();

        //dd($mfornecedorBuscar);

        if ($mfornecedorBuscar) {

            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/',$uri);

            $urlAtual = $exploder[1];

            Pedidocompra::whereId($id_pedido)->update([

                'id_fornecedor' => $mfornecedorBuscar->id,
                'nomeFantasia' => $mfornecedorBuscar->nomeFantasia,
                'razaoSocial' => $mfornecedorBuscar->razaoSocial,
                'cpfcnpj' => $mfornecedorBuscar->cpfcnpj,
                'insestadual' => $mfornecedorBuscar->insestadual,
                'insmunicipal' => $mfornecedorBuscar->insmunicipal,
                'end_cep' => $mfornecedorBuscar->end_cep,
                'end_cidade' => $mfornecedorBuscar->end_cidade,
                'end_bairro' => $mfornecedorBuscar->end_bairro,
                'end_logradouro' => $mfornecedorBuscar->end_logradouro,
                'end_numero' => $mfornecedorBuscar->end_numero,
                'end_complemento' => $mfornecedorBuscar->end_complemento,
                'end_uf' => $mfornecedorBuscar->end_uf,
                'situacao' => $mfornecedorBuscar->status,

            ]);

            $mfornecedor = Cache::get('$mfornecedor',$this->mfornecedor->all(), 1);

            //dd($mfornecedor);

            $mestoque = Estoque::all();

            $mpedidoCompra = Pedidocompra::where('id',$id_pedido)->first();

            $mpedidoCompraItem = PedidoCompraItem::where('id_pedido_item','=',$id_pedido)->get();

            $formaPgto1 = 'Dinheiro';
            $dt_emissao = Carbon::parse(now())->format('d/m/Y');

            return view('Comercial.Compra.pedidoPdc', compact(
                'user',
                'urlAtual',
                'mfornecedor',
                'mestoque',
                'mpedidoCompra',
                'mpedidoCompraItem'
            ))->with(
                [
                    'id_pedido' => $id_pedido,
                    'id_fornecedor' => $mfornecedorBuscar->id,
                    'nomeFantasia' => $mfornecedorBuscar->nomeFantasia,
                    'razaoSocial' => $mfornecedorBuscar->razaoSocial,
                    'cpfcnpj' => $mfornecedorBuscar->cpfcnpj,
                    'insestadual' => $mfornecedorBuscar->insestadual,
                    'insmunicipal' => $mfornecedorBuscar->insmunicipal,
                    'telefone' => $mfornecedorBuscar->telefone,
                    'email' => $mfornecedorBuscar->email,
                    'end_cep' => $mfornecedorBuscar->end_cep,
                    'end_cidade' => $mfornecedorBuscar->end_cidade,
                    'end_bairro' => $mfornecedorBuscar->end_bairro,
                    'end_logradouro' => $mfornecedorBuscar->end_logradouro,
                    'end_numero' => $mfornecedorBuscar->end_numero,
                    'end_complemento' => $mfornecedorBuscar->end_complemento,
                    'end_uf' => $mfornecedorBuscar->end_uf,
                    'formaPgto1' => $formaPgto1,
                    'dt_emissao' => $dt_emissao,
                    'situacao' => $mfornecedorBuscar->status,
                    'error' => 'Houve um erro ao incluir pedido e compra!',
                ]);

        }

        return redirect()->back()->with('error', 'Houve um erro ao incluir pedido e compra!');

    }

    public function pedidoMpdc(
        Int $id_pedido
    ){

        //dd($id_pedido);

        $mpedidoCompra = Pedidocompra::where('id',$id_pedido)->first();

        //dd($mpedidoCompra);

        if($mpedidoCompra)
        {

            if (Auth::check()) {

                $user = Auth::check();

                $uri = $this->request->route()->uri();

                $exploder = explode('/',$uri);

                $urlAtual = $exploder[1];

                //Trata data de emissão de americano para brasileiro

                $trataemissao = $mpedidoCompra->dt_emissao;

                $dt_emissao = Carbon::parse($trataemissao)->format('d/m/Y');

                //Trata valor de americano para brasileiro

                $valorTotalsemDesconto = $mpedidoCompra->valorTotalsemDesconto;

                $trataVTsDesconto = trim(str_replace(".",",",$valorTotalsemDesconto));
                $trataVTsDesconto = floatval($trataVTsDesconto);

                $valorTotalsemDesconto = $trataVTsDesconto;

                //dd($valorTotalsemDesconto);

                $valorTotalDesconto = $mpedidoCompra->valorTotalDesconto;

                $trataVTDesconto = trim(str_replace(".",",",$valorTotalDesconto));
                $trataVTDesconto = floatval($trataVTDesconto);

                $valorTotalDesconto = $trataVTDesconto;

                //dd($valorTotalDesconto);

                $valorTotalPedido = $mpedidoCompra->valorTotalPedido;

                $trataVTPedido = trim(str_replace(".",",",$valorTotalPedido));
                $trataVTPedido = floatval($trataVTPedido);

                $valorTotalPedido = $trataVTPedido;

                //dd($valorTotalsemDesconto,$valorTotalDesconto,$valorTotalPedido);

                $mfornecedor = Cache::get('$mfornecedor',$this->mfornecedor->all(), 1);

                //dd($mfornecedor);

                $mpedidoCompraItem = PedidoCompraItem::where('id_pedido_item','=',$id_pedido)->get();

                $mestoque = Estoque::all();

                return view('Comercial.Compra.pedidoPdc', compact(
                    'user',
                    'urlAtual',
                    'mfornecedor',
                    'mestoque',
                    'mpedidoCompra',
                    'mpedidoCompraItem'
                ))->with(
                    [
                        'id_pedido' => $id_pedido,
                        'id_fornecedor' => $mpedidoCompra->id_fornecedor,
                        'razaoSocial' => $mpedidoCompra->razaoSocial,
                        'nomeFantasia' => $mpedidoCompra->nomeFantasia,
                        'cpfcnpj' => $mpedidoCompra->cpfcnpj,
                        'insestadual' => $mpedidoCompra->insestadual,
                        'insmunicipal' => $mpedidoCompra->insmunicipal,
                        'end_cep' => $mpedidoCompra->end_cep,
                        'end_logradouro' => $mpedidoCompra->end_logradouro,
                        'end_numero' => $mpedidoCompra->end_numero,
                        'end_complemento' => $mpedidoCompra->end_complemento,
                        'end_bairro' => $mpedidoCompra->end_bairro,
                        'end_cidade' => $mpedidoCompra->end_cidade,
                        'end_uf' => $mpedidoCompra->end_uf,
                        'valorTotalsemDesconto' => $valorTotalsemDesconto,
                        'valorTotalDesconto' => $valorTotalDesconto,
                        'valorTotalPedido' => $valorTotalPedido,
                        'dt_emissao' => $dt_emissao,
                        'formaPgto1' => $mpedidoCompra->formaPgto1,
                        'situacao' => $mpedidoCompra->situacao,
                    ]);
            }

        }

        return redirect()->back()->with('error', 'Houve um erro ao incluir pedido de compra!');
    }

    public function buscarPestoque(
    Request $request,
    Int $id_produto
    ){

        //dd($request);

        $id_pedido = $request->id_pedido;

        //dd($id_produto);

        $mestoqueBuscar = Estoque::where('id',$id_produto)->first();

        //dd($mestoqueBuscar);

        if ($mestoqueBuscar) {

            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/',$uri);

            $urlAtual = $exploder[1];

            $mfornecedor = Cache::get('$mfornecedor',$this->mfornecedor->all(), 1);

            //dd($mfornecedor);

            $mestoque = Estoque::all();

            $mpedidoCompra = Pedidocompra::where('id',$id_pedido)->first();
            //dd($mpedidoCompra);

            //Trata data de emissão de americano para brasileiro

            $trataemissao = $mpedidoCompra->dt_emissao;

            $dt_emissao = Carbon::parse($trataemissao)->format('d/m/Y');

            //Trata valor de americano para brasileiro

            $trataVunitario = $mestoqueBuscar->preco_venda;

            $trataVunitario = trim(str_replace(".",",",$trataVunitario));

            //dd($trataVunitario);

            $valor_unitario = $trataVunitario;

            //dd($valor_unitario);

            $trataVsemDesconto = PedidoCompraItem::where('id_pedido_item','=',$id_pedido)->get()->sum('valor_semDesconto');

            $mvalorsemDesconto = trim(str_replace(".",",",$trataVsemDesconto));

            //dd($mvalorsemDesconto);

            $trataVTotalDesconto = PedidoCompraItem::where('id_pedido_item','=',$id_pedido)->get()->sum('valor_desconto');

            $mvalorTotalDesconto = trim(str_replace(".",",",$trataVTotalDesconto));

            //dd($mvalorTotalDesconto);

            $trataVTotalProduto = PedidoCompraItem::where('id_pedido_item','=',$id_pedido)->get()->sum('valor_totalProduto');

            $mvalorTotalProduto = trim(str_replace(".",",",$trataVTotalProduto));

            $mpedidoCompraItem = PedidoCompraItem::where('id_pedido_item','=',$id_pedido)->get();

            return view('Comercial.Compra.pedidoPdc', compact(
                    'user',
                    'urlAtual',
                    'mfornecedor',
                    'mestoque',
                    'mpedidoCompra',
                    'mpedidoCompraItem'
                 ))->with(
                    [
                        'id_pedido' => $id_pedido,
                        'id_fornecedor' => $mpedidoCompra->id,
                        'nomeFantasia' => $mpedidoCompra->nomeFantasia,
                        'razaoSocial' => $mpedidoCompra->razaoSocial,
                        'cpfcnpj' => $mpedidoCompra->cpfcnpj,
                        'insestadual' => $mpedidoCompra->insestadual,
                        'insmunicipal' => $mpedidoCompra->insmunicipal,
                        'end_cep' => $mpedidoCompra->end_cep,
                        'end_logradouro' => $mpedidoCompra->end_logradouro,
                        'end_numero' => $mpedidoCompra->end_numero,
                        'end_complemento' => $mpedidoCompra->end_complemento,
                        'end_bairro' => $mpedidoCompra->end_bairro,
                        'end_cidade' => $mpedidoCompra->end_cidade,
                        'end_uf' => $mpedidoCompra->end_uf,
                        'dt_emissao' => $dt_emissao,
                        'id_produto' => $mestoqueBuscar->id,
                        'nome_produto' => $mestoqueBuscar->nome_produto,
                        'valor_unitario' => $valor_unitario,
                        'valorTotalsemDesconto' => $mvalorsemDesconto,
                        'valorTotalDesconto' => $mvalorTotalDesconto,
                        'valorTotalPedido' => $mvalorTotalProduto,
                    ]);
        }

        return redirect()->back()->with('error', 'Houve um erro ao alterar produto!');

    }

    public function incluirItempdc(
        Request $request
    )
    {

        //dd($request);

        $id_pedido = $request->id_pedido;

        $mpedidoCompra = pedidoCompra::where('id',$id_pedido)->first();

        if ($mpedidoCompra) {

            $id_produto = $request->input('id_produto');
            $nome_produto = $request->input('nome_produto');

            //Trata quantidade, valor unitário e desconto
            $quantidade = intval($request->input('quantidade'));

            // Trata valor brasileiro para americano;

            $valor_unitario = $request->input('valor_unitario');

            $trataVunitario = ( strpos($valor_unitario,'R$')!== false );

            if ($trataVunitario) {
                $trataVunitario = trim($valor_unitario,'R$');
                $trataVunitario = trim(str_replace(".","",$trataVunitario));
                $trataVunitario = trim(str_replace(",",".",$trataVunitario));
                $trataVunitario = floatval($trataVunitario);
            } else {
                //dd('Não encontrado');
                $trataVunitario = trim($valor_unitario,'0$');
                $trataVunitario = trim(str_replace(","," ",$trataVunitario));
                $trataVunitario = floatval($trataVunitario);
            }

            $valor_unitario = $trataVunitario;

            //dd($valor_unitario);

            $valor_desconto = $request->input('valor_desconto');

            $trataVdesconto = ( strpos($valor_desconto,'R$')!== false );

            if ($trataVdesconto) {
                $trataVdesconto = trim($valor_desconto,'R$');
                $trataVdesconto = trim(str_replace(".","",$trataVdesconto));
                $trataVdesconto = trim(str_replace(",",".",$trataVdesconto));
                $trataVdesconto = floatval($trataVdesconto);
            } else {
                $trataVdesconto = trim($valor_desconto,'0$');
                $trataVdesconto = trim(str_replace(","," ",$trataVdesconto));
                $trataVdesconto = floatval($trataVdesconto);
            }

            $valor_desconto = $trataVdesconto;

            //dd($valor_desconto);

            $valor_semDesconto = $quantidade*$valor_unitario;
            $valor_totalProduto = ($quantidade*$valor_unitario)-$valor_desconto;

            //dd($valor_semDesconto, $valor_totalProduto);

            PedidoCompraItem::create([

                 'id_pedido_item'    => $id_pedido,
                 'id_prod_item'      => $id_produto,
                 'nome_produto'      => $nome_produto,
                 'quantidade'        => $quantidade,
                 'valor_unitario'    => $valor_unitario,
                 'valor_desconto'    => $valor_desconto,
                 'valor_semDesconto' => $valor_semDesconto,
                 'valor_totalProduto' => $valor_totalProduto,

            ]);

            $mvalorsemDesconto = PedidoCompraItem::where('id_pedido_item','=',$id_pedido)->get()->sum('valor_semDesconto');
            $mvalorTotalDesconto = PedidoCompraItem::where('id_pedido_item','=',$id_pedido)->get()->sum('valor_desconto');
            $mvalorTotalProduto = PedidoCompraItem::where('id_pedido_item','=',$id_pedido)->get()->sum('valor_totalProduto');

            pedidoCompra::whereId($id_pedido )->update([
                 'id_responsavel' => $request->input('id_responsavel'),
                 'situacao' => 'EM PROCESSO',
                 'valorTotalsemDesconto' => $mvalorsemDesconto,
                 'valorTotalDesconto' => $mvalorTotalDesconto,
                 'valorTotalPedido' => $mvalorTotalProduto,
                 'valorTotalRecebido' => 0,
                 'valorTroco' => 0,
            ]);

            $trataVsemdesconto = trim(str_replace(".",",",$mvalorsemDesconto));

            $trataVTdesconto = trim(str_replace(".",",",$mvalorTotalDesconto));

            $trataVTProduto = trim(str_replace(".",",",$mvalorTotalProduto));

            //dd($mvalorsemDesconto, $trataVsemdesconto );

            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/',$uri);

            $urlAtual = $exploder[1];

            $mfornecedor = Cache::get('$mfornecedor',$this->mfornecedor->all(), 1);

            //dd($mfornecedor);

            $mestoque = Estoque::all();

            $mpedidoCompraItem = pedidoCompraItem::where('id_pedido_item','=',$id_pedido)->get();

            return view('Comercial.Compra.pedidoPdc', compact(
                 'user',
                 'urlAtual',
                 'mfornecedor',
                 'mestoque',
                 'mpedidoCompra',
                 'mpedidoCompraItem'
                 ))->with(
                    [
                        'id_pedido' => $id_pedido,
                        'id_fornecedor' => $mpedidoCompra->id,
                        'nomeFantasia' => $mpedidoCompra->nomeFantasia,
                        'razaoSocial' => $mpedidoCompra->razaoSocial,
                        'cpfcnpj' => $mpedidoCompra->cpfcnpj,
                        'insestadual' => $mpedidoCompra->insestadual,
                        'insmunicipal' => $mpedidoCompra->insmunicipal,
                        'end_cep' => $mpedidoCompra->end_cep,
                        'end_logradouro' => $mpedidoCompra->end_logradouro,
                        'end_numero' => $mpedidoCompra->end_numero,
                        'end_complemento' => $mpedidoCompra->end_complemento,
                        'end_bairro' => $mpedidoCompra->end_bairro,
                        'end_cidade' => $mpedidoCompra->end_cidade,
                        'end_uf' => $mpedidoCompra->end_uf,
                        'valorTotalsemDesconto' => $trataVsemdesconto,
                        'valorTotalDesconto' => $trataVTdesconto,
                        'valorTotalPedido' => $trataVTProduto,
                        'id_produto' => "",
                        'nome_produto' => "",
                        'quantidade' => "",
                        'valor_unitario' => "",
                        'valor_desconto' => "",

                    ]);

        }

        return redirect()->back()->with('error', 'Houve um erro ao incluir item produto!');

    }

    public function conferirItemMpdc($id_pedido)
    {

        $mpedidoCompra = Pedidocompra::where('id',$id_pedido)->first();

//        dd($mpedidoCompra);

        if ($mpedidoCompra){

            if (Auth::check()) {

                $user = Auth::check();

                $uri = $this->request->route()->uri();

                $exploder = explode('/',$uri);

                $urlAtual = $exploder[1];

                $mfornecedor = Cache::get('$mfornecedor',$this->mfornecedor->all(), 1);

                dd($mfornecedor);

                $mestoque = Estoque::all();

                $mvalorTotalDesconto = pedidoCompraItem::where('id_pedido_item','=',$id_pedido)->get()->sum('valor_desconto');
                $mvalorsemDesconto = pedidoCompraItem::where('id_pedido_item','=',$id_pedido)->get()->sum('valor_semDesconto');
                $mvalorTotalProduto = pedidoCompraItem::where('id_pedido_item','=',$id_pedido)->get()->sum('valor_totalProduto');

                Pedidocompra::whereId($id_pedido)->update([
                    'situacao' => 'EM PROCESSO',
                    'valorTotalsemDesconto' => $mvalorsemDesconto,
                    'valorTotalDesconto' => $mvalorTotalDesconto,
                    'valorTotalPedido' => $mvalorTotalProduto,
               ]);

                $mpedidoCompraItem = pedidoCompraItem::where('id_pedido_item','=',$id_pedido)->get();

                return view('Comercial.Compra.pedidoPdc', compact(
                    'user',
                    'urlAtual',
                    'mfornecedor',
                    'mestoque',
                    'mestoqueBuscar',
                    'mpedidoCompra',
                    'mpedidoCompraItem'
                    ))->with(
                       [
                           'id_fornecedor' => $mpedidoCompra->id,
                           'nomeFantasia' => $mpedidoCompra->nomeFantasia,
                           'razaoSocial' => $mpedidoCompra->razaoSocial,
                           'cpfcnpj' => $mpedidoCompra->cpfcnpj,
                           'insestadual' => $mpedidoCompra->insestadual,
                           'insmunicipal' => $mpedidoCompra->insmunicipal,
                           'end_cep' => $mpedidoCompra->end_cep,
                           'end_logradouro' => $mpedidoCompra->end_logradouro,
                           'end_numero' => $mpedidoCompra->end_numero,
                           'end_complemento' => $mpedidoCompra->end_complemento,
                           'end_bairro' => $mpedidoCompra->end_bairro,
                           'end_cidade' => $mpedidoCompra->end_cidade,
                           'end_uf' => $mpedidoCompra->end_uf,
                           'dt_emissão' => $mpedidoCompra->dt_emissão,
                           'created_at' => $mpedidoCompra->created_at,

                       ]);

            }
        }

        return redirect()->route('Comercial.Compra.listarMpdc')->with('sucess', 'Pedido finalizado e estoque atualizado!');

    }

    public function finalizaMpdc(
        Int $id_pedido
    ){

        //dd($id_pedido);

        $mpedidoCompraItem = pedidoCompraItem::where('id_pedido_item',$id_pedido)->first();

        //dd($mpedidoCompraItem);

         if ($mpedidoCompraItem) {

            if (Auth::check()) {

                $user = Auth::check();

                $uri = $this->request->route()->uri();

                $exploder = explode('/',$uri);

                $urlAtual = $exploder[1];

                Pedidocompra::whereId($id_pedido)->update([
                    'situacao' => 'FINALIZADO',
               ]);

                $mpedidoCompra = pedidoCompra::all();

                $mpedidoCompraItem = pedidoCompraItem::where('id_pedido_item','=',$id_pedido)->get();

                foreach ($mpedidoCompraItem as $prod_item) {

                    $mestoqueBuscar = Estoque::where('id','=',$prod_item->id_prod_item)->first();

                    if($mestoqueBuscar){

                        $aumentaEstoque = $mestoqueBuscar->estoque + $prod_item->quantidade;

                        Estoque::whereId($prod_item->id_prod_item )->update([
                             'estoque' => $aumentaEstoque,
                         ]);

                    }
                }

                return redirect()->route('Comercial.Compra.listarMpdc', compact(
                    'user',
                    'urlAtual',
                    'mpedidoCompra'
                ))->with('success', 'Pedido de compra finalizado e estoque atualizado!');

            }
        }
    }

    public function imprimirMpdc($id_pedido)
    {

        $mpedidoCompra = Pedidocompra::where('id',$id_pedido)->first();

        //dd($mpedidoCompra);

        if ($mpedidoCompra){

            if (Auth::check()) {

                $user = Auth::check();

                $uri = $this->request->route()->uri();

                $exploder = explode('/',$uri);

                $urlAtual = $exploder[1];

                $mpedidoCompraItem = PedidoCompraItem::where('id_pedido_item','=',$id_pedido)->get();

                 return view('Comercial.Compra.imprimirPdc', compact(
                     'user',
                     'urlAtual',
                     'mpedidoCompra',
                     'mpedidoCompraItem'
                 ));
            }
        }

        return redirect()->route('Comercial.Compra.listarMpdc');
    }

    public function cancelaMpdc($id_pedido)
    {

        $mpedidoCompra = Pedidocompra::where('id',$id_pedido)->first();

        //dd($mpedidoCompra);

        if ($mpedidoCompra){

            if (Auth::check()) {

                $user = Auth::check();

                $uri = $this->request->route()->uri();

                $exploder = explode('/',$uri);

                $urlAtual = $exploder[1];

                $situacao = $mpedidoCompra->situacao;

                if($situacao == "FINALIZADO" or $situacao == "DEVOLUÇÃO"){

                    return redirect()->route('Comercial.Compra.listarMpdc', compact(
                              'user',
                              'urlAtual',
                          ))->with('success', 'Pedido finalizado ou devolvido, não pode ser cancelado, criar outro pedido !');

                }

                Pedidocompra::whereId($id_pedido)->update([
                    'situacao' => 'CANCELADO',
               ]);

                return redirect()->route('Comercial.Compra.listarMpdc')->with('success', 'Pedido cancelado !');

            }
        }

        return redirect()->route('Comercial.Compra.listarMpdc')->with('success', 'Pedido não encontrado !');

    }

    public function devolucaoMpdc($id_pedido)
    {

        $mpedidoCompra = Pedidocompra::where('id',$id_pedido)->first();

        if ($mpedidoCompra){

            if (Auth::check()) {

                Pedidocompra::whereId($id_pedido)->update([
                    'situacao' => 'DEVOLUÇÃO',
               ]);

               $mpedidoCompraItem = PedidoCompraItem::where('id_pedido_item','=',$id_pedido)->get();

               foreach ($mpedidoCompraItem as $prod_item) {

                   $mestoqueBuscar = Estoque::where('id','=',$prod_item->id_prod_item)->first();

                   if($mestoqueBuscar){

                       $aumentaEstoque = $mestoqueBuscar->estoque - $prod_item->quantidade;

                       Estoque::whereId($prod_item->id_prod_item )->update([
                            'estoque' => $aumentaEstoque,
                        ]);

                   }
               }

                return redirect()->route('Comercial.Compra.listarMpdc')->with('success', 'Pedido devolvido e estoque atualizado!');

            }
        }

        return redirect()->route('Comercial.Compra.listarMpdc')->with('success', 'Pedido não encontrado !');

    }

    public function apagarItemMpdc(
        $id_item,
        Request $requestItemMpdc
        ){

        if (Auth::check()) {

            $id_pedido = $requestItemMpdc->id_pedido;
            //dd($id_pedido);
            //dd($id_item);

            $mpedidoCompraItem = PedidoCompraItem::where('id',$id_item)->first();

            if ($mpedidoCompraItem) {

                $mpedidoCompraItem->delete();

            }

            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/',$uri);

            $urlAtual = $exploder[1];

            $mvalorsemDesconto = PedidoCompraItem::where('id_pedido_item','=',$id_pedido)->get()->sum('valor_semDesconto');
            $mvalorTotalDesconto = PedidoCompraItem::where('id_pedido_item','=',$id_pedido)->get()->sum('valor_desconto');
            $mvalorTotalProduto = PedidoCompraItem::where('id_pedido_item','=',$id_pedido)->get()->sum('valor_totalProduto');

            //dd($mvalorTotalDesconto,$mvalorsemDesconto,$mvalorTotalProduto);

            Pedidocompra::whereId($id_pedido)->update([
                'situacao' => 'EM PROCESSO',
                'valorTotalsemDesconto' => $mvalorsemDesconto,
                'valorTotalDesconto' => $mvalorTotalDesconto,
                'valorTotalPedido' => $mvalorTotalProduto,
            ]);

            //dd($mvalorsemDesconto);

            $trataVsemdesconto = trim(str_replace(".",",",$mvalorsemDesconto));

            $trataVTdesconto = trim(str_replace(".",",",$mvalorTotalDesconto));

            $trataVTProduto = trim(str_replace(".",",",$mvalorTotalProduto));

            $mfornecedor = Cache::get('$mfornecedor',$this->mfornecedor->all(), 1);

            //dd($mfornecedor);

            $mestoque = Estoque::all();

            $mpedidoCompra = Pedidocompra::where('id',$id_pedido)->first();

            //Trata data de emissão de americano para brasileiro

            $trataemissao = $mpedidoCompra->dt_emissao;

            $dt_emissao = Carbon::parse($trataemissao)->format('d/m/Y');

            $mpedidoCompraItem = PedidoCompraItem::where('id_pedido_item','=',$id_pedido)->get();

            return view('Comercial.Compra.pedidoPdc', compact(
            'user',
            'urlAtual',
            'mfornecedor',
            'mestoque',
            'mpedidoCompra',
            'mpedidoCompraItem'
            ))->with(
                [

                    'id_pedido' => $id_pedido,
                    'id_fornecedor' => $mpedidoCompra->id_fornecedor,
                    'nomeFantasia' => $mpedidoCompra->nomeFantasia,
                    'razaoSocial' => $mpedidoCompra->razaoSocial,
                    'cpfcnpj' => $mpedidoCompra->cpfcnpj,
                    'insestadual' => $mpedidoCompra->insestadual,
                    'insmunicipal' => $mpedidoCompra->insmunicipal,
                    'end_cep' => $mpedidoCompra->end_cep,
                    'end_logradouro' => $mpedidoCompra->end_logradouro,
                    'end_numero' => $mpedidoCompra->end_numero,
                    'end_complemento' => $mpedidoCompra->end_complemento,
                    'end_bairro' => $mpedidoCompra->end_bairro,
                    'end_cidade' => $mpedidoCompra->end_cidade,
                    'end_uf' => $mpedidoCompra->end_uf,
                    'valorTotalsemDesconto' => $trataVsemdesconto,
                    'valorTotalDesconto' => $trataVTdesconto,
                    'valorTotalPedido' => $trataVTProduto,
                    'dt_emissao' => $dt_emissao,
                    'formaPgto1' => $mpedidoCompra->formaPgto1,
                    'situacao' => $mpedidoCompra->situacao,

                ]);

        }

        return redirect()->back()->with('success', 'Item produto excluido!');
    }

    public function balancoMpdc()
    {

        dd('balacno pdc');

        if (Auth::check()) {

            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/',$uri);

            $urlAtual = $exploder[1];

            $mbalancopdc = Balancopdc::all();

            return view('pedidocompra::Balancopdc', compact(
                'user',
                'urlAtual',
                'mbalancopdc',
            ));
        }

        return redirect()->route('admin.painelprincipal');
    }

    public function zerarbalancoMpdc()
    {

        dd('Zerar balanço pdc');

        if (Auth::check()) {

            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/',$uri);

            $urlAtual = $exploder[1];

            $mbalancopdc = Balancopdc::truncate();

            return view('pedidocompra::Balancopdc', compact(
                'user',
                'urlAtual',
                'mbalancopdc',
            ));
        }

        return redirect()->route('admin.painelprincipal');
    }

    public function iniciarbalancoMpdc()
    {

        dd('Iniciar balanço ');

        if (Auth::check()) {

            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/',$uri);

            $urlAtual = $exploder[1];

            $mpedidoCompra = Pedidocompra::all();

            //1 etapa: montar os anos na tabela de balanço;

            if ($mpedidoCompra);
            {

                //dd($mpedidoCompra);

                foreach ($mpedidoCompra as $mbalancopdc)
                {

                    $situacao = $mbalancopdc->situacao;

                    //dd($situacao);

                    if ($situacao === "FINALIZADO")
                    {

                        $ano = $mbalancopdc->created_at->year;

                        $id_responsavel = $mbalancopdc->id_responsavel;

                        $nome_responsavel = $mbalancopdc->nome_responsavel;

                        //$valorpdc = $mbalancopdc->valorTotalPedido;

                        //dd($ano, $mes, $valorpdc);

                        $mbalancopdc = Balancopdc::where('ano',$ano)->first();

                        if(!$mbalancopdc){
                           //dd('Não Achou ano');

                            Balancopdc::whereId($ano)->create([
                                'ano' => $ano,
                                'id_responsavel' => $id_responsavel,
                                'nome_responsavel' => $nome_responsavel
                            ]);

                        }

                    }
                }

            }

            //2 etapa: alientar com valores a tabela de balanço;

            //dd('2 etapa: alientar com valores a tabela de balanço');

            $mbalancopdc = Balancopdc::all();

            if ($mbalancopdc);
            {

                //dd($mbalancopdc);

                foreach ($mbalancopdc as $balancopdc)
                {

                    $ano = $balancopdc->ano;

                    //dd($ano);

                    $mvalorTpdc1 = Pedidocompra::whereYear('created_at','=',$ano)
                    ->whereMonth('created_at','=',1)
                    ->get()->sum('valorTotalPedido');

                    $mvalorTpdc2 = Pedidocompra::whereYear('created_at','=',$ano)
                    ->whereMonth('created_at','=',2)
                    ->get()->sum('valorTotalPedido');

                    $mvalorTpdc3 = Pedidocompra::whereYear('created_at','=',$ano)
                    ->whereMonth('created_at','=',3)
                    ->get()->sum('valorTotalPedido');

                    $mvalorTpdc4 = Pedidocompra::whereYear('created_at','=',$ano)
                    ->whereMonth('created_at','=',4)
                    ->get()->sum('valorTotalPedido');

                    $mvalorTpdc5 = Pedidocompra::whereYear('created_at','=',$ano)
                    ->whereMonth('created_at','=',5)
                    ->get()->sum('valorTotalPedido');

                    $mvalorTpdc6 = Pedidocompra::whereYear('created_at','=',$ano)
                    ->whereMonth('created_at','=',6)
                    ->get()->sum('valorTotalPedido');

                    $mvalorTpdc7 = Pedidocompra::whereYear('created_at','=',$ano)
                    ->whereMonth('created_at','=',7)
                    ->get()->sum('valorTotalPedido');

                    $mvalorTpdc8 = Pedidocompra::whereYear('created_at','=',$ano)
                    ->whereMonth('created_at','=',8)
                    ->get()->sum('valorTotalPedido');

                    $mvalorTpdc9 = Pedidocompra::whereYear('created_at','=',$ano)
                    ->whereMonth('created_at','=',9)
                    ->get()->sum('valorTotalPedido');

                    $mvalorTpdc10 = Pedidocompra::whereYear('created_at','=',$ano)
                    ->whereMonth('created_at','=',10)
                    ->get()->sum('valorTotalPedido');

                    $mvalorTpdc11 = Pedidocompra::whereYear('created_at','=',$ano)
                    ->whereMonth('created_at','=',11)
                    ->get()->sum('valorTotalPedido');

                    $mvalorTpdc12 = Pedidocompra::whereYear('created_at','=',$ano)
                    ->whereMonth('created_at','=',12)
                    ->get()->sum('valorTotalPedido');

                    $mvalortotal = Pedidocompra::whereYear('created_at','=',$ano)
                    ->get()->sum('valorTotalPedido');


                    //dd($mvalorTpdc11);

                    Balancopdc::where('ano','=',$ano)->update([
                        'valormes1' => $mvalorTpdc1,
                        'valormes2' => $mvalorTpdc2,
                        'valormes3' => $mvalorTpdc3,
                        'valormes4' => $mvalorTpdc4,
                        'valormes5' => $mvalorTpdc5,
                        'valormes6' => $mvalorTpdc6,
                        'valormes7' => $mvalorTpdc7,
                        'valormes8' => $mvalorTpdc8,
                        'valormes9' => $mvalorTpdc9,
                        'valormes10' => $mvalorTpdc10,
                        'valormes11' => $mvalorTpdc11,
                        'valormes12' => $mvalorTpdc12,
                        'valortotal' => $mvalortotal,
                    ]);

                }

                return redirect()->route('Comercial.Compra.balancoMpdc')->with('success', 'Cálculo realizado com sucesso!');

            }

            return redirect()->route('admin.painelprincipal')->with('success', 'Não tem PEDIDO DE COMPRA PARA BALANÇO!');
      }
       return redirect()->route('admin.painelprincipal')->with('success', 'Não esta logado ou não tem permissão de acesso!');
    }

    public function imprimirbalancoMpdc()
    {

        //dd('Imprimir balanço imprimirbalancoMpdc');

        if (Auth::check()) {

            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/',$uri);

            $urlAtual = $exploder[1];

            $mbalancopdc = Balancopdc::all();

            //dd($mbalancopdc);

            $mvalortotal = Balancopdc::where('valortotal','<>',0)->get()->sum('valortotal');

           return view('Pedidocompra::imprimirbalancopdc', compact(
            'mbalancopdc'
         ))->with(
            [
                'mvalortotal' => $mvalortotal,
            ]);


       }
       return redirect()->route('admin.painelprincipal');

    }

    public function relatorioMpdc()
    {

        //dd('Relatorio Pdc');

        if (Auth::check()) {

            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/',$uri);

            $urlAtual = $exploder[1];

            return view('Comercial.Compra.relatorioPdc', compact(
                'user',
                'urlAtual',
            ));

       }
       return redirect()->route('admin.painelprincipal');

    }

    public function impRelatorioMpdc(Request $relatorio)
    {

        //dd($relatorio);

        $data_inicial = $relatorio->periodotime1;
        $data_final = $relatorio->periodotime2;

        //dd($data1,$data2);

        $mdadospdc = Pedidocompra::where('dt_emissao','>=',$data_inicial)
                        ->where('dt_emissao','<=',$data_final)
                        ->get();

        $mtotalpdc = Pedidocompra::where('dt_emissao','>=',$data_inicial)
                        ->where('dt_emissao','<=',$data_final)
                        ->get()
                        ->sum('valorTotalPedido');

        //dd($mtotalpdc);

        if ($mdadospdc){

            if (Auth::check()) {

                $user = Auth::check();

                $uri = $this->request->route()->uri();

                $exploder = explode('/',$uri);

                $urlAtual = $exploder[1];

                 return view('Comercial.Compra.imprelatorioPdc', compact(
                     'user',
                     'urlAtual',
                     'data_inicial',
                     'data_final',
                     'mdadospdc',
                     'mtotalpdc'
                 ));
            }
        }

        return redirect()->route('Comercial.Venda.listarMpdv');
    }

// Final da classe
}