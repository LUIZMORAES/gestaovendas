<?php

namespace Modules\Pedidovenda\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

use App\Models\User;
use Carbon\Carbon;
use Modules\Cliente\Entities\Cliente;
use Modules\Estoque\Entities\Estoque;
use Modules\Pedidovenda\Entities\Pedidovenda;
use Modules\Pedidovenda\Entities\PedidoVendaItem;
use Modules\Pedidovenda\Entities\Balancopdv;

class PedidovendaController extends Controller
{

    public $request;
    public $usuarios;
    public $mcliente;
    public $mestoque;
    public $mpedidoVenda;
    public $mpedidoVendaItem;
    public $mbalancoPdv;

    public function __construct(
        Request $request,
        User $usuarios,
        Cliente $mcliente,
        Estoque $mestoque,
        Pedidovenda $mpedidoVenda,
        PedidoVendaItem $mpedidoVendaItem,
        Balancopdv $mbalancoPdv
    ) {

        $this->middleware('auth');
        $this->request = $request;
        $this->usuarios = $usuarios;
        $this->mcliente = $mcliente;
        $this->mestoque = $mestoque;
        $this->mpedidoVenda = $mpedidoVenda;
        $this->mpedidoVendaItem = $mpedidoVendaItem;
        $this->mbalancoPdv = $mbalancoPdv;
    }

    public function listarMpdv()
    {

        //dd('listarMpdv');

        if (Auth::check()) {
            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/', $uri);

            $urlAtual = $exploder[1];

            $mpedidoVenda = Pedidovenda::all();

           //dd($mpedidoVenda);

            return view('Comercial.Venda.listarPdv', compact(
                'user',
                'urlAtual',
                'mpedidoVenda'
            ));
        }

        return redirect()->route('admin.painelprincipal');
    }

    public function createMpdv()
    {

        //dd('teste createPDV');

        if (Auth::check()) {

            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/',$uri);

            $urlAtual = $exploder[1];

            $mcliente = Cache::get('$mcliente',$this->mcliente->all(), 1);

            $mestoque = Estoque::all();

            return view('Comercial.Venda.pedidoPdv', compact(
                'user',
                'urlAtual',
                'mcliente',
                'mestoque'
            ));

        }

        return redirect()->route('Comercial.Venda.listarMpdv');
    }

    public function storeMpdv(
        Request $RequestPvd
    ){

        //dd($RequestPvd);
        $id_pedido = $RequestPvd->id_pedido;

        //Trata data de emissão de brasileiro para americano

        $mpedidoBuscar = Pedidovenda::where('id',$id_pedido)->first();

        if (!$mpedidoBuscar) {

            PedidoVenda::create([

                'id_responsavel' => $RequestPvd->input('id_responsavel'),
                'id_cliente' => $RequestPvd->input('id_cliente'),
                'razaoSocial' => $RequestPvd->input('razaoSocial'),
                'nomeFantasia' => $RequestPvd->input('nomeFantasia'),
                'cpfcnpj' => $RequestPvd->input('cpfcnpj'),
                'insestadual' => $RequestPvd->input('insestadual'),
                'insmunicipal' => $RequestPvd->input('insmunicipal'),
                'end_cep' => $RequestPvd->input('end_cep'),
                'end_cidade' => $RequestPvd->input('end_cidade'),
                'end_bairro' => $RequestPvd->input('end_bairro'),
                'end_logradouro' => $RequestPvd->input('end_logradouro'),
                'end_numero' => $RequestPvd->input('end_numero'),
                'end_complemento' => $RequestPvd->input('end_complemento'),
                'end_uf' => $RequestPvd->input('end_uf'),

            ]);

        }

        $mcliente = Cache::get('$mcliente',$this->mcliente->all(), 1);

        $mestoque = Estoque::all();

        //Procurar ultimo registro
        $mpedidoVenda = Pedidovenda::orderBy('id', 'desc')->first();

        $id_pedido = $mpedidoVenda->id;
        $id_responsavel = $mpedidoVenda->responsavel;
        $id_cliente = $mpedidoVenda->id_cliente;
        $razaoSocial = $mpedidoVenda->razaoSocial;
        $nomeFantasia = $mpedidoVenda->nomeFantasia;
        $cpfcnpj = $mpedidoVenda->cpfcnpj;
        $insestadual = $mpedidoVenda->insestadual;
        $insmunicipal = $mpedidoVenda->insmunicipal;
        $telefone = $mpedidoVenda->telefone;
        $email = $mpedidoVenda->email;
        $end_cep = $mpedidoVenda->end_cep;
        $end_cidade = $mpedidoVenda->end_cidade;
        $end_bairro = $mpedidoVenda->end_bairro;
        $end_logradouro = $mpedidoVenda->end_logradouro;
        $end_numero = $mpedidoVenda->end_numero;
        $end_complemento = $mpedidoVenda->end_complemento;
        $end_uf = $mpedidoVenda->end_uf;
        $valorTotalsemDesconto = $mpedidoVenda->valorTotalsemDesconto;
        $valorTotalDesconto = $mpedidoVenda->valorTotalDesconto;
        $valorTotalPedido = $mpedidoVenda->valorTotalPedido;
        $formaPgto1 = $mpedidoVenda->formaPgto1;

        $mpedidoVendaItem = PedidoVendaItem::where('id_pedido_item','=',$id_pedido)->get();

        return view('Comercial.Venda.pedidoPdv', compact(
            'mcliente',
            'mestoque',
            'mpedidoVenda',
            'mpedidoVendaItem'
        ))->with(
            [
                'id_pedido' => $id_pedido,
                'id_responsavel' => $id_responsavel,
                'id_cliente' => $id_cliente,
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

            ]);

    }

    public function updateMpdv(
        Request $RequestPvd){

        try {

            //dd($RequestPvd);
            $id_pedido = $RequestPvd->id_pedido;

            $mpedidoVenda = Pedidovenda::where('id',$id_pedido)->first();

            if ($mpedidoVenda) {

                //Trata data de emissão de brasileiro para americano

                $dt_emissao = trim($RequestPvd->dt_emissao);

                $dt_emissao = Carbon::createFromFormat('d/m/Y', $dt_emissao)->format('Y-m-d');

                //Trata valor de brasileiro para americano

                $valorTotalsemDesconto = $RequestPvd->input('valorTotalsemDesconto');

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

                $valorTotalDesconto = $RequestPvd->input('valorTotalDesconto');

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

                $valorTotalPedido = $RequestPvd->input('valorTotalPedido');

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

                Pedidovenda::whereId($id_pedido)->update([

                    'id_responsavel' => $RequestPvd->input('id_responsavel'),
                    'id_cliente' => $RequestPvd->input('id_cliente'),
                    'razaoSocial' => $RequestPvd->input('razaoSocial'),
                    'nomeFantasia' => $RequestPvd->input('nomeFantasia'),
                    'cpfcnpj' => $RequestPvd->input('cpfcnpj'),
                    'insestadual' => $RequestPvd->input('insestadual'),
                    'insmunicipal' => $RequestPvd->input('insmunicipal'),
                    'end_cep' => $RequestPvd->input('end_cep'),
                    'end_cidade' => $RequestPvd->input('end_cidade'),
                    'end_bairro' => $RequestPvd->input('end_bairro'),
                    'end_logradouro' => $RequestPvd->input('end_logradouro'),
                    'end_numero' => $RequestPvd->input('end_numero'),
                    'end_complemento' => $RequestPvd->input('end_complemento'),
                    'end_uf' => $RequestPvd->input('end_uf'),
                    'valorTotalsemDesconto' => $valorTotalsemDesconto,
                    'valorTotalDesconto' => $valorTotalDesconto,
                    'valorTotalPedido' => $valorTotalPedido,
                    'formaPgto1' => $RequestPvd->input('formaPgto1'),
                    'dt_emissao' => $dt_emissao,

                ]);

                $mpedidoVenda = Pedidovenda::where('id',$id_pedido)->first();

                //Trata data de emissão de americano para brasileiro

                $trataemissao = $mpedidoVenda->dt_emissao;

                $dt_emissao = Carbon::parse($trataemissao)->format('d/m/Y');

                //Trata valor de americano para brasileiro

                $trataVsemDesconto = pedidoVendaItem::where('id_pedido_item','=',$id_pedido)->get()->sum('valor_semDesconto');

                $valorTotalsemDesconto = trim(str_replace(".",",",$trataVsemDesconto));

                //dd($mvalorsemDesconto);

                $trataVTotalDesconto = pedidoVendaItem::where('id_pedido_item','=',$id_pedido)->get()->sum('valor_desconto');

                $valorTotalDesconto = trim(str_replace(".",",",$trataVTotalDesconto));

                //dd($mvalorTotalDesconto);

                $trataVTotalProduto = pedidoVendaItem::where('id_pedido_item','=',$id_pedido)->get()->sum('valor_totalProduto');

                $valorTotalPedido = trim(str_replace(".",",",$trataVTotalProduto));

                $mcliente = Cache::get('$mcliente',$this->mcliente->all(), 1);

                $mestoque = Estoque::all();

                $mpedidoVendaItem = PedidoVendaItem::where('id_pedido_item','=',$id_pedido)->get();

                $disp_android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");

                if($disp_android == true){

                    return view('Comercial.Android.Venda.pedidoApdv', compact(
                        'mcliente',
                        'mestoque',
                        'mpedidoVendaItem'
                    ))->with(
                        [
                            'id_pedido' => $id_pedido,
                            'id_responsavel' => $mpedidoVenda->id_responsavel,
                            'id_cliente' => $mpedidoVenda->id_cliente,
                            'razaoSocial' => $mpedidoVenda->razaoSocial,
                            'nomeFantasia' => $mpedidoVenda->nomeFantasia,
                            'cpfcnpj' => $mpedidoVenda->cpfcnpj,
                            'insestadual' => $mpedidoVenda->insestadual,
                            'insmunicipal' => $mpedidoVenda->insmunicipal,
                            'telefone' => $mpedidoVenda->telefone,
                            'email' => $mpedidoVenda->email,
                            'end_cep' => $mpedidoVenda->end_cep,
                            'end_cidade' => $mpedidoVenda->end_cidade,
                            'end_bairro' => $mpedidoVenda->end_bairro,
                            'end_logradouro' => $mpedidoVenda->end_logradouro,
                            'end_numero' => $mpedidoVenda->end_numero,
                            'end_complemento' => $mpedidoVenda->end_complemento,
                            'end_uf' => $mpedidoVenda->end_uf,
                            'valorTotalsemDesconto' => $valorTotalsemDesconto,
                            'valorTotalDesconto' => $valorTotalDesconto,
                            'valorTotalPedido' => $valorTotalPedido,
                            'dt_emissao' => $dt_emissao,
                            'formaPgto1' => $mpedidoVenda->formaPgto1,
                            'situacao' => $mpedidoVenda->situacao,
                        ]);

                }else{

                    return view('Comercial.Venda.pedidoPdv', compact(
                        'mcliente',
                        'mestoque',
                        'mpedidoVendaItem'
                    ))->with(
                        [
                            'id_pedido' => $id_pedido,
                            'id_responsavel' => $mpedidoVenda->id_responsavel,
                            'id_cliente' => $mpedidoVenda->id_cliente,
                            'razaoSocial' => $mpedidoVenda->razaoSocial,
                            'nomeFantasia' => $mpedidoVenda->nomeFantasia,
                            'cpfcnpj' => $mpedidoVenda->cpfcnpj,
                            'insestadual' => $mpedidoVenda->insestadual,
                            'insmunicipal' => $mpedidoVenda->insmunicipal,
                            'telefone' => $mpedidoVenda->telefone,
                            'email' => $mpedidoVenda->email,
                            'end_cep' => $mpedidoVenda->end_cep,
                            'end_cidade' => $mpedidoVenda->end_cidade,
                            'end_bairro' => $mpedidoVenda->end_bairro,
                            'end_logradouro' => $mpedidoVenda->end_logradouro,
                            'end_numero' => $mpedidoVenda->end_numero,
                            'end_complemento' => $mpedidoVenda->end_complemento,
                            'end_uf' => $mpedidoVenda->end_uf,
                            'valorTotalsemDesconto' => $valorTotalsemDesconto,
                            'valorTotalDesconto' => $valorTotalDesconto,
                            'valorTotalPedido' => $valorTotalPedido,
                            'dt_emissao' => $dt_emissao,
                            'formaPgto1' => $mpedidoVenda->formaPgto1,
                            'situacao' => $mpedidoVenda->situacao,
                        ]);

                }
            }

            return redirect()->back()->with('success', 'Pedido não encontrado!');

    } catch (\Exception $e){

        return redirect()->back()->with('success', 'Verifique os dados digitados!');

    }

    }

    public function buscarEcliente(
        Request $request
    ){

        //dd($request);

        $id_pedido = $request->id_pedido;

        $mclienteBuscar = Cliente::where('id',$request->id_cliente)->first();

        //dd($mclienteBuscar);

        if ($mclienteBuscar) {

            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/',$uri);

            $urlAtual = $exploder[1];

            Pedidovenda::whereId($id_pedido)->update([

                'id_cliente' => $mclienteBuscar->id,
                'razaoSocial' => $mclienteBuscar->razaoSocial,
                'nomeFantasia' => $mclienteBuscar->nomeFantasia,
                'cpfcnpj' => $mclienteBuscar->cpfcnpj,
                'insestadual' => $mclienteBuscar->insestadual,
                'insmunicipal' => $mclienteBuscar->insmunicipal,
                'end_cep' => $mclienteBuscar->end_cep,
                'end_cidade' => $mclienteBuscar->end_cidade,
                'end_bairro' => $mclienteBuscar->end_bairro,
                'end_logradouro' => $mclienteBuscar->end_logradouro,
                'end_numero' => $mclienteBuscar->end_numero,
                'end_complemento' => $mclienteBuscar->end_complemento,
                'end_uf' => $mclienteBuscar->end_uf,

            ]);

            $mcliente = Cache::get('$mcliente',$this->mcliente->all(), 1);

            $mestoque = Estoque::all();

            $mpedidoVenda = Pedidovenda::where('id',$id_pedido)->first();

            $mpedidoVendaItem = PedidoVendaItem::where('id_pedido_item','=',$id_pedido)->get();

            $formaPgto1 = 'Dinheiro';
            $dt_emissao = Carbon::parse(now())->format('d/m/Y');

            $disp_android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");

            if($disp_android == true){

                return view('Comercial.Venda.pedidoApdv', compact(
                    'user',
                    'urlAtual',
                    'mcliente',
                    'mestoque',
                    'mpedidoVenda',
                    'mpedidoVendaItem'
                ))->with(
                    [
                        'id_pedido' => $id_pedido,
                        'id_cliente' => $mclienteBuscar->id,
                        'razaoSocial' => $mclienteBuscar->razaoSocial,
                        'nomeFantasia' => $mclienteBuscar->nomeFantasia,
                        'cpfcnpj' => $mclienteBuscar->cpfcnpj,
                        'insestadual' => $mclienteBuscar->insestadual,
                        'insmunicipal' => $mclienteBuscar->insmunicipal,
                        'telefone' => $mclienteBuscar->telefone,
                        'email' => $mclienteBuscar->email,
                        'end_cep' => $mclienteBuscar->end_cep,
                        'end_cidade' => $mclienteBuscar->end_cidade,
                        'end_bairro' => $mclienteBuscar->end_bairro,
                        'end_logradouro' => $mclienteBuscar->end_logradouro,
                        'end_numero' => $mclienteBuscar->end_numero,
                        'end_complemento' => $mclienteBuscar->end_complemento,
                        'end_uf' => $mclienteBuscar->end_uf,
                        'formaPgto1' => $formaPgto1,
                        'dt_emissao' => $dt_emissao,

                    ]);

            }else{

                return view('Comercial.Venda.pedidoPdv', compact(
                    'user',
                    'urlAtual',
                    'mcliente',
                    'mestoque',
                    'mpedidoVenda',
                    'mpedidoVendaItem'
                ))->with(
                    [
                        'id_pedido' => $id_pedido,
                        'id_cliente' => $mclienteBuscar->id,
                        'razaoSocial' => $mclienteBuscar->razaoSocial,
                        'nomeFantasia' => $mclienteBuscar->nomeFantasia,
                        'cpfcnpj' => $mclienteBuscar->cpfcnpj,
                        'insestadual' => $mclienteBuscar->insestadual,
                        'insmunicipal' => $mclienteBuscar->insmunicipal,
                        'telefone' => $mclienteBuscar->telefone,
                        'email' => $mclienteBuscar->email,
                        'end_cep' => $mclienteBuscar->end_cep,
                        'end_cidade' => $mclienteBuscar->end_cidade,
                        'end_bairro' => $mclienteBuscar->end_bairro,
                        'end_logradouro' => $mclienteBuscar->end_logradouro,
                        'end_numero' => $mclienteBuscar->end_numero,
                        'end_complemento' => $mclienteBuscar->end_complemento,
                        'end_uf' => $mclienteBuscar->end_uf,
                        'formaPgto1' => $formaPgto1,
                        'dt_emissao' => $dt_emissao,

                    ]);

            }


        }

        return redirect()->back()->with('error', 'Houve um erro ao incluir pedido e venda!');

    }

    public function cadastrarMcliente(Request $request)
    {

        //dd($request);

        $id_pedido = $request->id_pedido;

        //Primeiro retira os espaços do começo e do final.
        $cpf = ltrim(rtrim($request->cpfcnpj));

        //Substitui o ponto por nada
        $tratacpf1 = str_replace(".", "", $cpf);

        //Troca o traço por nada
        $$tratacpf1 = str_replace("-", "", $tratacpf1);

        //Troca o espaço por nada
        $tratacpf1 = str_replace(" ", "", $tratacpf1);

        //Troca a barra por nada
        $tratacpf1 = str_replace("-", "", $tratacpf1);

        $cpf = $tratacpf1;

        //dd($cpf);

        $user = Auth::check();

        $uri = $this->request->route()->uri();

        $exploder = explode('/',$uri);

        $urlAtual = $exploder[1];

        $mcliente = Cache::get('$mcliente',$this->mcliente->all(), 1);

        $mestoque = Estoque::all();

        $mpedidoVenda = Pedidovenda::where('id',$id_pedido)->first();

        $mpedidoVendaItem = PedidoVendaItem::where('id_pedido_item','=',$id_pedido)->get();

        $buscarcliente = Cliente::where('cpfcnpj',$cpf)->first();

        //dd($buscarcliente);

        if($buscarcliente){

            $id_responsavel = $buscarcliente->id_responsavel;
            $id_cliente  = $buscarcliente->id;
            $razaoSocial  = $buscarcliente->razaoSocial;
            $nomeFantasia  = $buscarcliente->nomeFantasia;
            $cpfcnpj = $cpf;
            $insestadual = $buscarcliente->insestadual;
            $insmunicipal = $buscarcliente->insmunicipal;
            $contrato_numero = $buscarcliente->contrato_numero;
            $telefone = $buscarcliente->telefone;
            $celular = $buscarcliente->celular;
            $celular = $buscarcliente->celular;
            $email = $buscarcliente->email;
            $end_cep = $buscarcliente->end_cep;
            $end_logradouro = $buscarcliente->end_logradouro;
            $end_numero = $buscarcliente->end_numero;
            $end_complemento = $buscarcliente->end_complemento;
            $end_bairro = $buscarcliente->end_bairro;
            $end_cidade = $buscarcliente->end_cidade;
            $end_uf = $buscarcliente->end_uf;
            $status = $buscarcliente->status;

            $disp_android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");

            if($disp_android == true){

                return view('Comercial.Venda.pedidoApdv', compact(
                    'user',
                    'urlAtual',
                    'mcliente',
                    'mestoque',
                    'mpedidoVenda',
                    'mpedidoVendaItem'
                ))->with(
                [

                        'id_pedido' => $id_pedido,
                        'id_responsavel' => $id_responsavel,
                        'id_cliente' => $id_cliente,
                        'razaoSocial' => $razaoSocial,
                        'nomeFantasia' => $nomeFantasia,
                        'cpfcnpj' => $cpf,

                ]);

            }else{

                return view('Comercial.Venda.pedidoPdv', compact(
                    'user',
                    'urlAtual',
                    'mcliente',
                    'mestoque',
                    'mpedidoVenda',
                    'mpedidoVendaItem'
                ))->with(
                [

                        'id_pedido' => $id_pedido,
                        'id_responsavel' => $id_responsavel,
                        'id_cliente' => $id_cliente,
                        'razaoSocial' => $razaoSocial,
                        'nomeFantasia' => $nomeFantasia,
                        'cpfcnpj' => $cpf,
                        'insestadual' => $insestadual,
                        'insmunicipal' => $insmunicipal,
                        'contrato_numero' => $contrato_numero,
                        'telefone' => $telefone,
                        'celular' => $celular,
                        'celular' => $celular,
                        'email' => $email,
                        'end_cep' => $end_cep,
                        'end_logradouro' => $end_logradouro,
                        'end_numero' => $end_numero,
                        'end_complemento' => $end_complemento,
                        'end_bairro' => $end_bairro,
                        'end_cidade' => $end_cidade,
                        'end_uf' => $end_uf,
                        'status' => $status,

                ]);

            }

        }else{

            Cliente::create([

                'id_responsavel' => $request->input('id_responsavel'),
                'razaoSocial' => $request->input('razaoSocial'),
                'nomeFantasia' => $request->input('nomeFantasia'),
                'cpfcnpj' => $cpf,
                'insestadual' => $request->input('insestadual'),
                'insmunicipal' => $request->input('insmunicipal'),
                'contrato_numero' => $request->input('contrato_numero'),
                'telefone' => $request->input('telefone'),
                'celular' => $request->input('celular'),
                'celular' => $request->input('celular'),
                'email' => $request->input('email'),
                'end_cep' => $request->input('end_cep'),
                'end_logradouro' => $request->input('end_logradouro'),
                'end_numero' => $request->input('end_numero'),
                'end_complemento' => $request->input('end_complemento'),
                'end_bairro' => $request->input('end_bairro'),
                'end_cidade' => $request->input('end_cidade'),
                'end_uf' => $request->input('end_uf'),
                'status' => $request->input('status'),
            ]);

            $disp_android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");

            if($disp_android == true){

                return view('Comercial.Venda.pedidoApdv', compact(
                    'user',
                    'urlAtual',
                    'mcliente',
                    'mestoque',
                    'mpedidoVenda',
                    'mpedidoVendaItem'
                ))->with(
                [

                        'id_pedido' => $id_pedido,
                        'id_responsavel' => $request->input('id_responsavel'),
                        'id_cliente' => $request->input('id_cliente'),
                        'razaoSocial' => $request->input('razaoSocial'),
                        'nomeFantasia' => $request->input('nomeFantasia'),
                        'cpfcnpj' => $cpf,

                ]);

            }else{

                return view('Comercial.Venda.pedidoPdv', compact(
                    'user',
                    'urlAtual',
                    'mcliente',
                    'mestoque',
                    'mpedidoVenda',
                    'mpedidoVendaItem'
                ))->with(
                [

                        'id_pedido' => $id_pedido,
                        'id_responsavel' => $request->input('id_responsavel'),
                        'razaoSocial' => $request->input('razaoSocial'),
                        'nomeFantasia' => $request->input('nomeFantasia'),
                        'cpfcnpj' => $cpf,
                        'insestadual' => $request->input('insestadual'),
                        'insmunicipal' => $request->input('insmunicipal'),
                        'contrato_numero' => $request->input('contrato_numero'),
                        'telefone' => $request->input('telefone'),
                        'celular' => $request->input('celular'),
                        'celular' => $request->input('celular'),
                        'email' => $request->input('email'),
                        'end_cep' => $request->input('end_cep'),
                        'end_logradouro' => $request->input('end_logradouro'),
                        'end_numero' => $request->input('end_numero'),
                        'end_complemento' => $request->input('end_complemento'),
                        'end_bairro' => $request->input('end_bairro'),
                        'end_cidade' => $request->input('end_cidade'),
                        'end_uf' => $request->input('end_uf'),
                        'status' => $request->input('status'),

                ]);

            }

        }


    }

    public function pedidoMpdv(
        Int $id_pedido
    ){

        //dd($request_pedido);

        $mpedidoVenda = Pedidovenda::where('id',$id_pedido)->first();

        //dd($mpedidoVenda);

        if ($mpedidoVenda){

            if (Auth::check()) {

                $user = Auth::check();

                $uri = $this->request->route()->uri();

                $exploder = explode('/',$uri);

                $urlAtual = $exploder[1];

                //Trata data de emissão de americano para brasileiro

                $trataemissao = $mpedidoVenda->dt_emissao;

                $dt_emissao = Carbon::parse($trataemissao)->format('d/m/Y');

                //Trata valor de americano para brasileiro

                $valorTotalsemDesconto = $mpedidoVenda->valorTotalsemDesconto;

                $trataVTsDesconto = trim(str_replace(".",",",$valorTotalsemDesconto));
                $trataVTsDesconto = floatval($trataVTsDesconto);

                $valorTotalsemDesconto = $trataVTsDesconto;

                //dd($valorTotalsemDesconto);

                $valorTotalDesconto = $mpedidoVenda->valorTotalDesconto;

                $trataVTDesconto = trim(str_replace(".",",",$valorTotalDesconto));
                $trataVTDesconto = floatval($trataVTDesconto);

                $valorTotalDesconto = $trataVTDesconto;

                //dd($valorTotalDesconto);

                $valorTotalPedido = $mpedidoVenda->valorTotalPedido;

                $trataVTPedido = trim(str_replace(".",",",$valorTotalPedido));
                $trataVTPedido = floatval($trataVTPedido);

                $valorTotalPedido = $trataVTPedido;

                //dd($valorTotalsemDesconto,$valorTotalDesconto,$valorTotalPedido);

                $mcliente = Cache::get('$mcliente',$this->mcliente->all(), 1);

                $mpedidoVendaItem = PedidoVendaItem::where('id_pedido_item','=',$id_pedido)->get();

                $mestoque = Estoque::all();

                $disp_android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");

                if($disp_android == true){

                    return view('Comercial.Venda.pedidoApdv', compact(
                        'user',
                        'urlAtual',
                        'mcliente',
                        'mestoque',
                        'mpedidoVenda',
                        'mpedidoVendaItem'
                    ))->with(
                        [
                            'id_pedido' => $id_pedido,
                            'id_cliente' => $mpedidoVenda->id_cliente,
                            'razaoSocial' => $mpedidoVenda->razaoSocial,
                            'nomeFantasia' => $mpedidoVenda->nomeFantasia,
                            'cpfcnpj' => $mpedidoVenda->cpfcnpj,
                            'insestadual' => $mpedidoVenda->insestadual,
                            'insmunicipal' => $mpedidoVenda->insmunicipal,
                            'end_cep' => $mpedidoVenda->end_cep,
                            'end_logradouro' => $mpedidoVenda->end_logradouro,
                            'end_numero' => $mpedidoVenda->end_numero,
                            'end_complemento' => $mpedidoVenda->end_complemento,
                            'end_bairro' => $mpedidoVenda->end_bairro,
                            'end_cidade' => $mpedidoVenda->end_cidade,
                            'end_uf' => $mpedidoVenda->end_uf,
                            'valorTotalsemDesconto' => $valorTotalsemDesconto,
                            'valorTotalDesconto' => $valorTotalDesconto,
                            'valorTotalPedido' => $valorTotalPedido,
                            'dt_emissao' => $dt_emissao,
                            'formaPgto1' => $mpedidoVenda->formaPgto1,
                            'situacao' => $mpedidoVenda->situacao,

                        ]);

                }else{

                    return view('Comercial.Venda.pedidoPdv', compact(
                        'user',
                        'urlAtual',
                        'mcliente',
                        'mestoque',
                        'mpedidoVenda',
                        'mpedidoVendaItem'
                    ))->with(
                        [
                            'id_pedido' => $id_pedido,
                            'id_cliente' => $mpedidoVenda->id_cliente,
                            'razaoSocial' => $mpedidoVenda->razaoSocial,
                            'nomeFantasia' => $mpedidoVenda->nomeFantasia,
                            'cpfcnpj' => $mpedidoVenda->cpfcnpj,
                            'insestadual' => $mpedidoVenda->insestadual,
                            'insmunicipal' => $mpedidoVenda->insmunicipal,
                            'end_cep' => $mpedidoVenda->end_cep,
                            'end_logradouro' => $mpedidoVenda->end_logradouro,
                            'end_numero' => $mpedidoVenda->end_numero,
                            'end_complemento' => $mpedidoVenda->end_complemento,
                            'end_bairro' => $mpedidoVenda->end_bairro,
                            'end_cidade' => $mpedidoVenda->end_cidade,
                            'end_uf' => $mpedidoVenda->end_uf,
                            'valorTotalsemDesconto' => $valorTotalsemDesconto,
                            'valorTotalDesconto' => $valorTotalDesconto,
                            'valorTotalPedido' => $valorTotalPedido,
                            'dt_emissao' => $dt_emissao,
                            'formaPgto1' => $mpedidoVenda->formaPgto1,
                            'situacao' => $mpedidoVenda->situacao,

                        ]);

                }

            }
        }

        return redirect()->back()->with('error', 'Houve um erro ao incluir pedido de venda!');
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

            $mcliente = Cache::get('$mcliente',$this->mcliente->all(), 1);

            $mestoque = Estoque::all();

            $mpedidoVenda = Pedidovenda::where('id',$id_pedido)->first();
//            dd($mpedidoVenda);

            //Trata data de emissão de americano para brasileiro

            $trataemissao = $mpedidoVenda->dt_emissao;

            $dt_emissao = Carbon::parse($trataemissao)->format('d/m/Y');

            //Trata valor de americano para brasileiro

            $trataVunitario = $mestoqueBuscar->preco_venda;

            $trataVunitario = trim(str_replace(".",",",$trataVunitario));

            //dd($trataVunitario);

            $valor_unitario = $trataVunitario;

            //dd($valor_unitario);

            $trataVsemDesconto = pedidoVendaItem::where('id_pedido_item','=',$id_pedido)->get()->sum('valor_semDesconto');

            $mvalorsemDesconto = trim(str_replace(".",",",$trataVsemDesconto));

            //dd($mvalorsemDesconto);

            $trataVTotalDesconto = pedidoVendaItem::where('id_pedido_item','=',$id_pedido)->get()->sum('valor_desconto');

            $mvalorTotalDesconto = trim(str_replace(".",",",$trataVTotalDesconto));

            //dd($mvalorTotalDesconto);

            $trataVTotalProduto = pedidoVendaItem::where('id_pedido_item','=',$id_pedido)->get()->sum('valor_totalProduto');

            $mvalorTotalProduto = trim(str_replace(".",",",$trataVTotalProduto));

            $mpedidoVendaItem = PedidoVendaItem::where('id_pedido_item','=',$id_pedido)->get();

            $disp_android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");

            if($disp_android == true){

                return view('Comercial.Venda.pedidoApdv', compact(
                    'user',
                    'urlAtual',
                    'mcliente',
                    'mestoque',
                    'mpedidoVenda',
                    'mpedidoVendaItem'
                 ))->with(
                    [
                        'id_pedido' => $id_pedido,
                        'id_cliente' => $mpedidoVenda->id,
                        'razaoSocial' => $mpedidoVenda->razaoSocial,
                        'nomeFantasia' => $mpedidoVenda->nomeFantasia,
                        'cpfcnpj' => $mpedidoVenda->cpfcnpj,
                        'insestadual' => $mpedidoVenda->insestadual,
                        'insmunicipal' => $mpedidoVenda->insmunicipal,
                        'end_cep' => $mpedidoVenda->end_cep,
                        'end_logradouro' => $mpedidoVenda->end_logradouro,
                        'end_numero' => $mpedidoVenda->end_numero,
                        'end_complemento' => $mpedidoVenda->end_complemento,
                        'end_bairro' => $mpedidoVenda->end_bairro,
                        'end_cidade' => $mpedidoVenda->end_cidade,
                        'end_uf' => $mpedidoVenda->end_uf,
                        'dt_emissao' => $dt_emissao,
                        'id_produto' => $mestoqueBuscar->id,
                        'nome_produto' => $mestoqueBuscar->nome_produto,
                        'valor_unitario' => $valor_unitario,
                        'valorTotalsemDesconto' => $mvalorsemDesconto,
                        'valorTotalDesconto' => $mvalorTotalDesconto,
                        'valorTotalPedido' => $mvalorTotalProduto,
                    ]);

            }else{

                return view('Comercial.Venda.pedidoPdv', compact(
                    'user',
                    'urlAtual',
                    'mcliente',
                    'mestoque',
                    'mpedidoVenda',
                    'mpedidoVendaItem'
                 ))->with(
                    [
                        'id_pedido' => $id_pedido,
                        'id_cliente' => $mpedidoVenda->id,
                        'razaoSocial' => $mpedidoVenda->razaoSocial,
                        'nomeFantasia' => $mpedidoVenda->nomeFantasia,
                        'cpfcnpj' => $mpedidoVenda->cpfcnpj,
                        'insestadual' => $mpedidoVenda->insestadual,
                        'insmunicipal' => $mpedidoVenda->insmunicipal,
                        'end_cep' => $mpedidoVenda->end_cep,
                        'end_logradouro' => $mpedidoVenda->end_logradouro,
                        'end_numero' => $mpedidoVenda->end_numero,
                        'end_complemento' => $mpedidoVenda->end_complemento,
                        'end_bairro' => $mpedidoVenda->end_bairro,
                        'end_cidade' => $mpedidoVenda->end_cidade,
                        'end_uf' => $mpedidoVenda->end_uf,
                        'dt_emissao' => $dt_emissao,
                        'id_produto' => $mestoqueBuscar->id,
                        'nome_produto' => $mestoqueBuscar->nome_produto,
                        'valor_unitario' => $valor_unitario,
                        'valorTotalsemDesconto' => $mvalorsemDesconto,
                        'valorTotalDesconto' => $mvalorTotalDesconto,
                        'valorTotalPedido' => $mvalorTotalProduto,
                    ]);

            }
        }

        return redirect()->back()->with('error', 'Houve um erro ao alterar produto!');

    }

    public function incluirItemPdv(
        Request $request
    )
    {

        //dd($request);

        $id_pedido = $request->id_pedido;

        $mpedidoVenda = pedidoVenda::where('id',$id_pedido)->first();

        if ($mpedidoVenda) {

            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/',$uri);

            $urlAtual = $exploder[1];

            $mcliente = Cache::get('$mcliente',$this->mcliente->all(), 1);

            $mestoque = Estoque::all();

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

            pedidoVendaItem::create([

                 'id_pedido_item'    => $id_pedido,
                 'id_prod_item'      => $id_produto,
                 'nome_produto'      => $nome_produto,
                 'quantidade'        => $quantidade,
                 'valor_unitario'    => $valor_unitario,
                 'valor_desconto'    => $valor_desconto,
                 'valor_semDesconto' => $valor_semDesconto,
                 'valor_totalProduto' => $valor_totalProduto,

            ]);

            $mvalorsemDesconto = pedidoVendaItem::where('id_pedido_item','=',$id_pedido)->get()->sum('valor_semDesconto');
            $mvalorTotalDesconto = pedidoVendaItem::where('id_pedido_item','=',$id_pedido)->get()->sum('valor_desconto');
            $mvalorTotalProduto = pedidoVendaItem::where('id_pedido_item','=',$id_pedido)->get()->sum('valor_totalProduto');

            pedidoVenda::whereId($id_pedido )->update([
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

            $mpedidoVendaItem = pedidoVendaItem::where('id_pedido_item','=',$id_pedido)->get();

            $disp_android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");

            if($disp_android == true){

                return view('Comercial.Venda.pedidoApdv', compact(
                    'user',
                    'urlAtual',
                    'mcliente',
                    'mestoque',
                    'mpedidoVenda',
                    'mpedidoVendaItem'
                    ))->with(
                       [
                           'id_pedido' => $id_pedido,
                           'id_cliente' => $mpedidoVenda->id,
                           'razaoSocial' => $mpedidoVenda->razaoSocial,
                           'nomeFantasia' => $mpedidoVenda->nomeFantasia,
                           'cpfcnpj' => $mpedidoVenda->cpfcnpj,
                           'insestadual' => $mpedidoVenda->insestadual,
                           'insmunicipal' => $mpedidoVenda->insmunicipal,
                           'end_cep' => $mpedidoVenda->end_cep,
                           'end_logradouro' => $mpedidoVenda->end_logradouro,
                           'end_numero' => $mpedidoVenda->end_numero,
                           'end_complemento' => $mpedidoVenda->end_complemento,
                           'end_bairro' => $mpedidoVenda->end_bairro,
                           'end_cidade' => $mpedidoVenda->end_cidade,
                           'end_uf' => $mpedidoVenda->end_uf,
                           'valorTotalsemDesconto' => $trataVsemdesconto,
                           'valorTotalDesconto' => $trataVTdesconto,
                           'valorTotalPedido' => $trataVTProduto,
                           'id_produto' => "",
                           'nome_produto' => "",
                           'quantidade' => "",
                           'valor_unitario' => "",
                           'valor_desconto' => "",

                       ]);

            }else{

                return view('Comercial.Venda.pedidoPdv', compact(
                    'user',
                    'urlAtual',
                    'mcliente',
                    'mestoque',
                    'mpedidoVenda',
                    'mpedidoVendaItem'
                    ))->with(
                       [
                           'id_pedido' => $id_pedido,
                           'id_cliente' => $mpedidoVenda->id,
                           'razaoSocial' => $mpedidoVenda->razaoSocial,
                           'nomeFantasia' => $mpedidoVenda->nomeFantasia,
                           'cpfcnpj' => $mpedidoVenda->cpfcnpj,
                           'insestadual' => $mpedidoVenda->insestadual,
                           'insmunicipal' => $mpedidoVenda->insmunicipal,
                           'end_cep' => $mpedidoVenda->end_cep,
                           'end_logradouro' => $mpedidoVenda->end_logradouro,
                           'end_numero' => $mpedidoVenda->end_numero,
                           'end_complemento' => $mpedidoVenda->end_complemento,
                           'end_bairro' => $mpedidoVenda->end_bairro,
                           'end_cidade' => $mpedidoVenda->end_cidade,
                           'end_uf' => $mpedidoVenda->end_uf,
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


        }

        return redirect()->back()->with('error', 'Houve um erro ao incluir item produto!');

    }

    public function finalizaMpdv(
        Int $id_pedido
    ){

        //dd($id_pedido);

        $mpedidoVendaItem = pedidoVendaItem::where('id_pedido_item',$id_pedido)->first();

        //dd($mpedidoVendaItem);

         if ($mpedidoVendaItem) {

            if (Auth::check()) {

                $user = Auth::check();

                $uri = $this->request->route()->uri();

                $exploder = explode('/',$uri);

                $urlAtual = $exploder[1];

                pedidoVenda::whereId($id_pedido)->update([
                    'situacao' => 'FINALIZADO',
               ]);

                $mpedidoVenda = pedidoVenda::all();

                $mpedidoVendaItem = pedidoVendaItem::where('id_pedido_item','=',$id_pedido)->get();

                foreach ($mpedidoVendaItem as $prod_item) {

                    $mestoqueBuscar = Estoque::where('id','=',$prod_item->id_prod_item)->first();

                    if($mestoqueBuscar){

                        $diminueEstoque = $mestoqueBuscar->estoque - $prod_item->quantidade;

                        Estoque::whereId($prod_item->id_prod_item )->update([
                             'estoque' => $diminueEstoque,
                         ]);

                    }
                }

                return redirect()->route('Comercial.Venda.listarMpdv', compact(
                    'user',
                    'urlAtual',
                    'mpedidoVenda'
                ))->with('success', 'Pedido finalizado e estoque atualizado!');

            }
        }
    }

    public function imprimirMpdv($id_pedido)
    {

        $mpedidoVenda = pedidoVenda::where('id',$id_pedido)->first();

        //dd($mpedidoVenda);

        if ($mpedidoVenda){

            if (Auth::check()) {

                $user = Auth::check();

                $uri = $this->request->route()->uri();

                $exploder = explode('/',$uri);

                $urlAtual = $exploder[1];

                $mpedidoVendaItem = pedidoVendaItem::where('id_pedido_item','=',$id_pedido)->get();

                 return view('Comercial.Venda.imprimirPdv', compact(
                     'user',
                     'urlAtual',
                     'mpedidoVenda',
                     'mpedidoVendaItem'
                 ));
            }
        }

        return redirect()->route('Comercial.Venda.listarMpdv');
    }

    public function reciboMpdv($id_pedido)
    {

        $mpedidoVenda = pedidoVenda::where('id',$id_pedido)->first();

        //dd($mpedidoVenda);

        if ($mpedidoVenda){

            if (Auth::check()) {

                $user = Auth::check();

                $uri = $this->request->route()->uri();

                $exploder = explode('/',$uri);

                $urlAtual = $exploder[1];

                $mpedidoVendaItem = pedidoVendaItem::where('id_pedido_item','=',$id_pedido)->get();

                 return view('Comercial.Venda.reciboPdv', compact(
                     'user',
                     'urlAtual',
                     'mpedidoVenda',
                     'mpedidoVendaItem'
                 ));
            }
        }

        return redirect()->route('Comercial.Venda.listarMpdv');
    }

    public function cancelaMpdv($id_pedido)
    {

        $mpedidoVenda = pedidoVenda::where('id',$id_pedido)->first();

        //dd($mpedidoVenda);

        if ($mpedidoVenda){

            if (Auth::check()) {

                $user = Auth::check();

                $uri = $this->request->route()->uri();

                $exploder = explode('/',$uri);

                $urlAtual = $exploder[1];

                $situacao = $mpedidoVenda->situacao;

                if($situacao == "FINALIZADO" or $situacao == "DEVOLUÇÃO"){

                    return redirect()->route('Comercial.Venda.listarMpdv', compact(
                              'user',
                              'urlAtual',
                          ))->with('success', 'Pedido finalizado ou devolvido, não pode ser cancelado, criar outro pedido !');

                }

                pedidoVenda::whereId($id_pedido)->update([
                    'situacao' => 'CANCELADO',
               ]);

                return redirect()->route('Comercial.Venda.listarMpdv')->with('success', 'Pedido cancelado !');

            }
        }

        return redirect()->route('Comercial.Venda.listarMpdv')->with('success', 'Pedido não encontrado !');

    }

    public function devolucaoMpdv($id_pedido)
    {

        $mpedidoVenda = pedidoVenda::where('id',$id_pedido)->first();

        if ($mpedidoVenda){

            if (Auth::check()) {

                pedidoVenda::whereId($id_pedido)->update([
                    'situacao' => 'DEVOLUÇÃO',
               ]);

               $mpedidoVendaItem = pedidoVendaItem::where('id_pedido_item','=',$id_pedido)->get();

               foreach ($mpedidoVendaItem as $prod_item) {

                   $mestoqueBuscar = Estoque::where('id','=',$prod_item->id_prod_item)->first();

                   if($mestoqueBuscar){

                       $aumentaEstoque = $mestoqueBuscar->estoque + $prod_item->quantidade;

                       Estoque::whereId($prod_item->id_prod_item )->update([
                            'estoque' => $aumentaEstoque,
                        ]);

                   }
               }

                return redirect()->route('Comercial.Venda.listarMpdv')->with('success', 'Pedido devolvido e estoque atualizado!');

            }
        }

        return redirect()->route('Comercial.Venda.listarMpdv')->with('success', 'Pedido não encontrado !');

    }

    public function apagarItemMpdv(
        $id_item,
        Request $requestItemMpdv
        ){

        if (Auth::check()) {

            $id_pedido = $requestItemMpdv->id_pedido;
            //dd($id_pedido);
            //dd($id_item);

            $mpedidoVendaItem = PedidoVendaItem::where('id',$id_item)->first();

            if ($mpedidoVendaItem) {

                $mpedidoVendaItem->delete();

            }

            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/',$uri);

            $urlAtual = $exploder[1];

            $mvalorsemDesconto = pedidoVendaItem::where('id_pedido_item','=',$id_pedido)->get()->sum('valor_semDesconto');
            $mvalorTotalDesconto = pedidoVendaItem::where('id_pedido_item','=',$id_pedido)->get()->sum('valor_desconto');
            $mvalorTotalProduto = pedidoVendaItem::where('id_pedido_item','=',$id_pedido)->get()->sum('valor_totalProduto');

            //dd($mvalorTotalDesconto,$mvalorsemDesconto,$mvalorTotalProduto);

            pedidoVenda::whereId($id_pedido)->update([
                'situacao' => 'EM PROCESSO',
                'valorTotalsemDesconto' => $mvalorsemDesconto,
                'valorTotalDesconto' => $mvalorTotalDesconto,
                'valorTotalPedido' => $mvalorTotalProduto,
            ]);

            //dd($mvalorsemDesconto);

            $trataVsemdesconto = trim(str_replace(".",",",$mvalorsemDesconto));

            $trataVTdesconto = trim(str_replace(".",",",$mvalorTotalDesconto));

            $trataVTProduto = trim(str_replace(".",",",$mvalorTotalProduto));

            $mcliente = Cache::get('$mcliente',$this->mcliente->all(), 1);

            $mestoque = Estoque::all();

            $mpedidoVenda = Pedidovenda::where('id',$id_pedido)->first();

            //Trata data de emissão de americano para brasileiro

            $trataemissao = $mpedidoVenda->dt_emissao;

            $dt_emissao = Carbon::parse($trataemissao)->format('d/m/Y');

            $mpedidoVendaItem = PedidoVendaItem::where('id_pedido_item','=',$id_pedido)->get();

            $disp_android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");

            if($disp_android == true){

                return view('Comercial.Venda.pedidoApdv', compact(
                    'user',
                    'urlAtual',
                    'mcliente',
                    'mestoque',
                    'mpedidoVenda',
                    'mpedidoVendaItem'
                    ))->with(
                        [

                            'id_pedido' => $id_pedido,
                            'id_cliente' => $mpedidoVenda->id_cliente,
                            'razaoSocial' => $mpedidoVenda->razaoSocial,
                            'nomeFantasia' => $mpedidoVenda->nomeFantasia,
                            'cpfcnpj' => $mpedidoVenda->cpfcnpj,
                            'insestadual' => $mpedidoVenda->insestadual,
                            'insmunicipal' => $mpedidoVenda->insmunicipal,
                            'end_cep' => $mpedidoVenda->end_cep,
                            'end_logradouro' => $mpedidoVenda->end_logradouro,
                            'end_numero' => $mpedidoVenda->end_numero,
                            'end_complemento' => $mpedidoVenda->end_complemento,
                            'end_bairro' => $mpedidoVenda->end_bairro,
                            'end_cidade' => $mpedidoVenda->end_cidade,
                            'end_uf' => $mpedidoVenda->end_uf,
                            'valorTotalsemDesconto' => $trataVsemdesconto,
                            'valorTotalDesconto' => $trataVTdesconto,
                            'valorTotalPedido' => $trataVTProduto,
                            'dt_emissao' => $dt_emissao,
                            'formaPgto1' => $mpedidoVenda->formaPgto1,
                            'situacao' => $mpedidoVenda->situacao,

                        ]);

            }else{

                return view('Comercial.Venda.pedidoPdv', compact(
                    'user',
                    'urlAtual',
                    'mcliente',
                    'mestoque',
                    'mpedidoVenda',
                    'mpedidoVendaItem'
                    ))->with(
                        [

                            'id_pedido' => $id_pedido,
                            'id_cliente' => $mpedidoVenda->id_cliente,
                            'razaoSocial' => $mpedidoVenda->razaoSocial,
                            'nomeFantasia' => $mpedidoVenda->nomeFantasia,
                            'cpfcnpj' => $mpedidoVenda->cpfcnpj,
                            'insestadual' => $mpedidoVenda->insestadual,
                            'insmunicipal' => $mpedidoVenda->insmunicipal,
                            'end_cep' => $mpedidoVenda->end_cep,
                            'end_logradouro' => $mpedidoVenda->end_logradouro,
                            'end_numero' => $mpedidoVenda->end_numero,
                            'end_complemento' => $mpedidoVenda->end_complemento,
                            'end_bairro' => $mpedidoVenda->end_bairro,
                            'end_cidade' => $mpedidoVenda->end_cidade,
                            'end_uf' => $mpedidoVenda->end_uf,
                            'valorTotalsemDesconto' => $trataVsemdesconto,
                            'valorTotalDesconto' => $trataVTdesconto,
                            'valorTotalPedido' => $trataVTProduto,
                            'dt_emissao' => $dt_emissao,
                            'formaPgto1' => $mpedidoVenda->formaPgto1,
                            'situacao' => $mpedidoVenda->situacao,

                        ]);

            }

        }

        return redirect()->back()->with('success', 'Item produto excluido!');
    }

    public function balancoMpdv()
    {

        //dd('balacno pdv');

        if (Auth::check()) {

            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/',$uri);

            $urlAtual = $exploder[1];

            $mbalancoPdv = Balancopdv::all();

            return view('pedidovenda::Balancopdv', compact(
                'user',
                'urlAtual',
                'mbalancoPdv',
            ));
        }

        return redirect()->route('admin.painelprincipal');
    }

    public function zerarbalancoMpdv()
    {

        //dd('Zerar balanço pdv');

        if (Auth::check()) {

            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/',$uri);

            $urlAtual = $exploder[1];

            $mbalancoPdv = Balancopdv::truncate();

            return view('pedidovenda::Balancopdv', compact(
                'user',
                'urlAtual',
                'mbalancoPdv',
            ));
        }

        return redirect()->route('admin.painelprincipal');
    }

    public function iniciarbalancoMpdv()
    {

        //dd('Iniciar balanço ');

        if (Auth::check()) {

            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/',$uri);

            $urlAtual = $exploder[1];

            $mpedidovenda = Pedidovenda::all();

            //1 etapa: montar os anos na tabela de balanço;

            if ($mpedidovenda);
            {

                //dd($mpedidovenda);

                foreach ($mpedidovenda as $mbalancopdv)
                {

                    $situacao = $mbalancopdv->situacao;

                    //dd($situacao);

                    if ($situacao === "FINALIZADO")
                    {

                        $ano = $mbalancopdv->created_at->year;

                        $id_responsavel = $mbalancopdv->id_responsavel;

                        $nome_responsavel = $mbalancopdv->nome_responsavel;

                        //$valorPdv = $mbalancopdv->valorTotalPedido;

                        //dd($ano, $mes, $valorPdv);

                        $mbalancopdv = Balancopdv::where('ano',$ano)->first();

                        if(!$mbalancopdv){
                           //dd('Não Achou ano');

                            Balancopdv::whereId($ano)->create([
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

            $mbalancopdv = Balancopdv::all();

            if ($mbalancopdv);
            {

                //dd($mbalancopdv);

                foreach ($mbalancopdv as $balancopdv)
                {

                    $ano = $balancopdv->ano;

                    //dd($ano);

                    $mvalorTpdv1 = pedidoVenda::whereYear('created_at','=',$ano)
                    ->whereMonth('created_at','=',1)
                    ->get()->sum('valorTotalPedido');

                    $mvalorTpdv2 = pedidoVenda::whereYear('created_at','=',$ano)
                    ->whereMonth('created_at','=',2)
                    ->get()->sum('valorTotalPedido');

                    $mvalorTpdv3 = pedidoVenda::whereYear('created_at','=',$ano)
                    ->whereMonth('created_at','=',3)
                    ->get()->sum('valorTotalPedido');

                    $mvalorTpdv4 = pedidoVenda::whereYear('created_at','=',$ano)
                    ->whereMonth('created_at','=',4)
                    ->get()->sum('valorTotalPedido');

                    $mvalorTpdv5 = pedidoVenda::whereYear('created_at','=',$ano)
                    ->whereMonth('created_at','=',5)
                    ->get()->sum('valorTotalPedido');

                    $mvalorTpdv6 = pedidoVenda::whereYear('created_at','=',$ano)
                    ->whereMonth('created_at','=',6)
                    ->get()->sum('valorTotalPedido');

                    $mvalorTpdv7 = pedidoVenda::whereYear('created_at','=',$ano)
                    ->whereMonth('created_at','=',7)
                    ->get()->sum('valorTotalPedido');

                    $mvalorTpdv8 = pedidoVenda::whereYear('created_at','=',$ano)
                    ->whereMonth('created_at','=',8)
                    ->get()->sum('valorTotalPedido');

                    $mvalorTpdv9 = pedidoVenda::whereYear('created_at','=',$ano)
                    ->whereMonth('created_at','=',9)
                    ->get()->sum('valorTotalPedido');

                    $mvalorTpdv10 = pedidoVenda::whereYear('created_at','=',$ano)
                    ->whereMonth('created_at','=',10)
                    ->get()->sum('valorTotalPedido');

                    $mvalorTpdv11 = pedidoVenda::whereYear('created_at','=',$ano)
                    ->whereMonth('created_at','=',11)
                    ->get()->sum('valorTotalPedido');

                    $mvalorTpdv12 = pedidoVenda::whereYear('created_at','=',$ano)
                    ->whereMonth('created_at','=',12)
                    ->get()->sum('valorTotalPedido');

                    $mvalortotal = pedidoVenda::whereYear('created_at','=',$ano)
                    ->get()->sum('valorTotalPedido');


                    //dd($mvalorTpdv11);

                    Balancopdv::where('ano','=',$ano)->update([
                        'valormes1' => $mvalorTpdv1,
                        'valormes2' => $mvalorTpdv2,
                        'valormes3' => $mvalorTpdv3,
                        'valormes4' => $mvalorTpdv4,
                        'valormes5' => $mvalorTpdv5,
                        'valormes6' => $mvalorTpdv6,
                        'valormes7' => $mvalorTpdv7,
                        'valormes8' => $mvalorTpdv8,
                        'valormes9' => $mvalorTpdv9,
                        'valormes10' => $mvalorTpdv10,
                        'valormes11' => $mvalorTpdv11,
                        'valormes12' => $mvalorTpdv12,
                        'valortotal' => $mvalortotal,
                    ]);

                }

                return redirect()->route('Comercial.Venda.balancoMpdv')->with('success', 'Cálculo realizado com sucesso!');

            }

            return redirect()->route('admin.painelprincipal')->with('success', 'Não tem PEDIDO DE VENDA PARA BALANÇO!');
      }
       return redirect()->route('admin.painelprincipal')->with('success', 'Não esta logado ou não tem permissão de acesso!');
    }

    public function imprimirbalancoMpdv()
    {

        //dd('Imprimir balanço imprimirbalancoMpdv');

        if (Auth::check()) {

            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/',$uri);

            $urlAtual = $exploder[1];

            $mbalancopdv = Balancopdv::all();

            //dd($mbalancopdv);

            $mvalortotal = Balancopdv::where('valortotal','<>',0)->get()->sum('valortotal');

           return view('pedidovenda::imprimirbalancoPdv', compact(
            'mbalancopdv'
         ))->with(
            [
                'mvalortotal' => $mvalortotal,
            ]);


       }
       return redirect()->route('admin.painelprincipal');

    }

    public function relatorioMpdv()
    {

        //dd('Relatorio pdv');

        if (Auth::check()) {

            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/',$uri);

            $urlAtual = $exploder[1];

            return view('Comercial.Venda.relatorioPdv', compact(
                'user',
                'urlAtual',
            ));

       }
       return redirect()->route('admin.painelprincipal');

    }

    public function impRelatorioMpdv(Request $relatorio)
    {

        //dd($relatorio);

        $data_inicial = $relatorio->periodotime1;
        $data_final = $relatorio->periodotime2;
        $situacao = $relatorio->situacao;

        //dd($data1,$data2);

        $mdadospdv = pedidoVenda::where('dt_emissao','>=',$data_inicial)
                        ->where('dt_emissao','<=',$data_final)
                        ->where('situacao','<=',$situacao)
                        ->get();

        $mtotalpdv = pedidoVenda::where('dt_emissao','>=',$data_inicial)
                        ->where('dt_emissao','<=',$data_final)
                        ->where('situacao','<=',$situacao)
                        ->get()
                        ->sum('valorTotalPedido');

        //dd($mtotalpdv);

        if ($mdadospdv){

            if (Auth::check()) {

                $user = Auth::check();

                $uri = $this->request->route()->uri();

                $exploder = explode('/',$uri);

                $urlAtual = $exploder[1];

                 return view('Comercial.Venda.imprelatorioPdv', compact(
                     'user',
                     'urlAtual',
                     'data_inicial',
                     'data_final',
                     'situacao',
                     'mdadospdv',
                     'mtotalpdv'
                 ));
            }
        }

        return redirect()->route('Comercial.Venda.listarMpdv');
    }


// Final da classe
}
