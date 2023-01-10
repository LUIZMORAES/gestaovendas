<?php

namespace Modules\Contabilidade\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

use App\Models\User;
use Carbon\Carbon;
use Modules\Contabilidade\Entities\Planoconta;


class PlanocontaController extends Controller
{

    public $request;
    public $usuarios;
    public $mplanoconta;

    public function __construct(
        Request $request,
        User $usuarios,
        Planoconta $mplanoconta
    ) {

        $this->middleware('auth');
        $this->request = $request;
        $this->usuarios = $usuarios;
        $this->mplanoconta = $mplanoconta;

    }

    public function listarMplanoconta()
    {

        //dd('listarMplanoconta');

        if (Auth::check()) {
            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/', $uri);

            $urlAtual = $exploder[1];

            $mplanoconta = Planoconta::all();

            return view('Contabilidade.Planocontas.listarPlanocontas', compact(
                'user',
                'urlAtual',
                'mplanoconta'
            ));
        }

        return redirect()->route('admin.painelprincipal');
    }

    public function createMplanoconta()
    {

        if (Auth::check()) {
            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/', $uri);

            $urlAtual = $exploder[1];

            return view('Contabilidade.Planocontas.formPlanocontas', compact('user', 'urlAtual'));
        }

        return redirect()->route('Contabilidade.Planocontas.listarPlanocontas');
    }

    public function storeMplanoconta(Request $request)
    {

        $cod_conta = Planoconta::where('cod_conta', $request->input('cod_conta'))->first();

        if (!$cod_conta) {
            Planoconta::create([

                'id_responsavel' => $request->input('id_responsavel'),
                'cod_conta' => $request->input('cod_conta'),
                'descricao' => $request->input('descricao'),
                'condicao' => $request->input('condicao'),
                'classe' => $request->input('classe'),
                'status' => $request->input('status'),
            ]);
            return redirect()->route('Contabilidade.Planocontas.listarMplanoconta')->with('success', 'Plano de conta cadastrada com sucesso!');
        }
        return redirect()->back()->with('error', 'Plano de conta já existe!');
    }

    public function editMplanoconta($id)
    {

        $mplanoconta = Planoconta::where('id', $id)->first();

        if ($mplanoconta) {

            if (Auth::check()) {
                $user = Auth::check();

                $uri = $this->request->route()->uri();

                $exploder = explode('/', $uri);

                $urlAtual = $exploder[1];

                return view('Contabilidade.Planocontas.formPlanocontas', compact('user', 'urlAtual'))->with(
                    [
                        'registro' => $mplanoconta->id,
                        'cod_conta' => $mplanoconta->cod_conta,
                        'descricao' => $mplanoconta->descricao,
                        'condicao' => $mplanoconta->condicao,
                        'classe' => $mplanoconta->classe,
                        'status' => $mplanoconta->status,
                    ]
                );
            }
        }

        return redirect()->back()->with('error', 'Plano de conta não encontrado!');

    }

    public function updateMplanoconta(Request $request)
    {

        $id_planoconta = $request->input('registro');

        $planoconta = Planoconta::where('id', $id_planoconta)->first();

        if ($planoconta) {
            Planoconta::whereId($id_planoconta)->update([

                'id_responsavel' => $request->input('id_responsavel'),
                'cod_conta' => $request->input('cod_conta'),
                'descricao' => $request->input('descricao'),
                'condicao' => $request->input('condicao'),
                'classe' => $request->input('classe'),
                'status' => $request->input('status'),

            ]);


            return redirect()->route('Contabilidade.Planocontas.listarMplanoconta')->with('success', 'Plano de conta alterado com sucesso!');
        }

        return redirect()->back()->with('error', 'Houve um erro ao cadastrar Plano de conta!');

    }

//Final da classe
}