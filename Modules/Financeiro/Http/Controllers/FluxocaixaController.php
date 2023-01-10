<?php

namespace Modules\Financeiro\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

use App\Models\User;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Modules\Financeiro\Entities\Contafluxocaixa;
use Modules\Financeiro\Entities\Contareceber;
use Modules\Financeiro\Entities\Contapagar;

class FluxocaixaController extends Controller
{

    public $request;
    public $usuarios;
    public $mfluxocaixa;
    public $mreceber;
    public $mpagar;


    public function __construct(
        Request $request,
        User $usuarios,
        Contafluxocaixa $mfluxocaixa,
        Contareceber $mreceber,
        Contapagar $mpagar

    ) {

        $this->middleware('auth');
        $this->request = $request;
        $this->User = $usuarios;
        $this->mfluxocaixa = $mfluxocaixa;
        $this->mreceber = $mreceber;
        $this->mpagar = $mpagar;

    }

    public function listarMfcaixa()
    {

        if (Auth::check()) {
            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/', $uri);

            $urlAtual = $exploder[1];

            $mfluxocaixa = Cache::get('$mfluxocaixa',$this->mfluxocaixa->all(), 1);

            return view('Financeiro.Fluxocaixa.listarFluxocaixa', compact(
                'user',
                'urlAtual',
                'mfluxocaixa'
            ));
        }

        return redirect()->route('admin.painelprincipal');
    }

    public function iniciarMfcaixa()
    {

        if (Auth::check()) {

            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/',$uri);

            $urlAtual = $exploder[1];

//            $mfluxocaixa = Contafluxocaixa::all();

//            $mreceber = Contareceber::all();

//            $mpagar  = Contapagar::all();

            return view('Financeiro.Fluxocaixa.formFluxocaixa', compact(
                'user',
                'urlAtual'
//              '$mfluxocaixa',
//              '$mreceber',
//                '$mpagar'
            ));

        }

        return redirect()->route('Financeiro.Fluxocaixa.listarMfcaixa');
    }

    public function gravarMfcaixa(Request $recebedados)
    {

        //dd($recebedados);


        $data_gerado = Carbon::now();
        //ddd($data_gerado);
        $data_inicial = $recebedados->periodotime1;
        $data_final = $recebedados->periodotime2;
        $situacao = $recebedados->situacao;

        $mtotalreceber = Contareceber::where('dt_pagamento','>=',$data_inicial)
                        ->where('dt_pagamento','<=',$data_final)
                        ->where('situacao','=',$situacao)
                        ->get()
                        ->sum('valorTotal');

        $mtotalpagar = Contapagar::where('dt_pagamento','>=',$data_inicial)
        ->where('dt_pagamento','<=',$data_final)
        ->where('situacao','=',$situacao)
        ->get()
        ->sum('valorTotal');

        $somarfcaixa = $mtotalreceber - $mtotalpagar;

        //ddd($somarfcaixa);

        if ($somarfcaixa){

            if (Auth::check()) {

                $user = Auth::check();

                $uri = $this->request->route()->uri();

                $exploder = explode('/',$uri);

                $urlAtual = $exploder[1];

                Contafluxocaixa::create([

                    'id_responsavel' => $recebedados->input('id_responsavel'),
                    'nome_responsavel' => $recebedados->input('nome_responsavel'),
                    'dt_gerado' => $data_gerado,
                    'dt_inicial' => $data_inicial,
                    'dt_final' => $data_final,
                    'valorTrecebe' => $mtotalreceber,
                    'valorTpagar' => $mtotalpagar,
                    'valorTotal' => $somarfcaixa,
                    'situacao' => $situacao,

                ]);

                Alert::success('Sucesso!','Fluxo de caixa gerado !');
                return redirect()->route('Financeiro.Fluxocaixa.listarMfcaixa');

            }
        }

        return redirect()->route('Comercial.Venda.listarMpdv');
    }

    public function apagarMfcaixa($id_fcaixa)
    {

        //dd($id_fcaixa);

        if (Auth::check()) {

            $dadosfluxocaixa = Contafluxocaixa::where('id',$id_fcaixa)->first();

            if ($dadosfluxocaixa) {

                $dadosfluxocaixa->delete();

                Alert::success('Sucesso!','Fluxo de caixa apagado com sucesso !');
                return redirect()->route('Financeiro.Fluxocaixa.listarMfcaixa');

            }

        }

    }
//Final da classe
}
