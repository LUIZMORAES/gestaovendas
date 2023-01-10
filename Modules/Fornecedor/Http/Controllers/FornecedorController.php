<?php

namespace Modules\Fornecedor\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use App\Models\User;
use Modules\Fornecedor\Entities\Fornecedor;

class FornecedorController extends Controller
{

    public $request;
    public $usuarios;
    public $mfornecedor;

    public function __construct(
        Request $request,
        User $usuarios,
        Fornecedor $mfornecedor

        ){

        $this->middleware('auth');
        $this->request = $request;
        $this->usuarios = $usuarios;
        $this->mfornecedor = $mfornecedor;

    }

    public function listarMFornecedor()
    {

//        dd('listarmfornecedor');

        if (Auth::check()) {

            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/',$uri);

            $urlAtual = $exploder[1];

            $mfornecedor = Fornecedor::all();

            return view('Comercial.Fornecedor.listarFornecedor', compact(
                'user',
                'urlAtual',
                'mfornecedor'
            ));
        }

        return redirect()->route('admin.painelprincipal');
    }

    public function createMfornecedor()
    {
//       dd('createmfornecedor');

        if (Auth::check()) {

            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/',$uri);

            $urlAtual = $exploder[1];

            return view('Comercial.Fornecedor.formFornecedor', compact('user','urlAtual'));
        }

        return redirect()->route('Comercial.Fornecedor.listarMfornecedor');
    }

    public function editMfornecedor($id)
    {

//        dd('editFornecedor');
        $mfornecedor = Fornecedor::where('id',$id)->first();

        if ($mfornecedor){

            if (Auth::check()) {

                $user = Auth::check();

                $uri = $this->request->route()->uri();

                $exploder = explode('/',$uri);

                $urlAtual = $exploder[1];

                return view('Comercial.Fornecedor.formFornecedor', compact('user','urlAtual'))->with(
                    [
                        'registro' => $mfornecedor->id,
                        'razaosocial' => $mfornecedor->razaoSocial,
                        'nomeFantasia' => $mfornecedor->nomeFantasia,
                        'cpfcnpj' => $mfornecedor->cpfcnpj,
                        'telefone' => $mfornecedor->telefone,
                        'email' => $mfornecedor->email,
                        'end_cep' => $mfornecedor->end_cep,
                        'end_logradouro' => $mfornecedor->end_logradouro,
                        'end_numero' => $mfornecedor->end_numero,
                        'end_complemento' => $mfornecedor->end_complemento,
                        'end_bairro' => $mfornecedor->end_bairro,
                        'end_cidade' => $mfornecedor->end_cidade,
                        'end_uf' => $mfornecedor->end_uf,
                        'contrato_numero' => $mfornecedor->contrato_numero,
                        'contrato_valor' => $mfornecedor->contrato_valor,
                        'obs' => $mfornecedor->obs,
                        'status' => $mfornecedor->status,
                    ]);
            }
        }

        return redirect()->route('admin.painelprincipal');
    }

    public function storeMfornecedor(Request $request)
    {

//       dd('storeFornecedor');

        $id_fornecedor = Fornecedor::where('id', $request->input('id'))->first();

        if (!$id_fornecedor) {

            Fornecedor::create([

                'id_responsavel' => $request->input('id_responsavel'),
                'razaoSocial' => $request->input('razaosocial'),
                'nomeFantasia' => $request->input('nomeFantasia'),
                'cpfcnpj' => $request->input('cpfcnpj'),
                'contrato_numero' => $request->input('contrato_numero'),
                'telefone' => $request->input('telefone'),
                'email' => $request->input('email'),
                'end_cep' => $request->input('end_cep'),
                'end_logradouro' => $request->input('end_logradouro'),
                'end_numero' => $request->input('end_numero'),
                'end_complemento' => $request->input('end_complemento'),
                'end_bairro' => $request->input('end_bairro'),
                'end_cidade' => $request->input('end_cidade'),
                'end_uf' => $request->input('end_uf'),
                'obs' => $request->input('obs'),
                'status' => $request->input('status'),
            ]);

            return redirect()->route('Comercial.Fornecedor.listarMfornecedor')->with('success', 'Fornecedor cadastrada com sucesso!');

        }

        return redirect()->back()->with('error', 'Houve um erro ao cadastrar Fornecedor!');

    }

    public function updateMfornecedor(Request $request)
    {

//        dd('updateFornecedor');

        $id_fornecedor = Fornecedor::where('id', $request->input('registro'))->first();

        if ($id_fornecedor) {

            Fornecedor::whereId($request->registro)->update([

                'id_responsavel' => $request->input('id_responsavel'),
                'razaoSocial' => $request->input('razaosocial'),
                'nomeFantasia' => $request->input('nomeFantasia'),
                'cpfcnpj' => $request->input('cpfcnpj'),
                'telefone' => $request->input('telefone'),
                'email' => $request->input('email'),
                'end_cep' => $request->input('end_cep'),
                'end_logradouro' => $request->input('end_logradouro'),
                'end_numero' => $request->input('end_numero'),
                'end_complemento' => $request->input('end_complemento'),
                'end_bairro' => $request->input('end_bairro'),
                'end_cidade' => $request->input('end_cidade'),
                'end_uf' => $request->input('end_uf'),
                'contrato_numero' => $request->input('contrato_numero'),
                'obs' => $request->input('obs'),
                'status' => $request->input('status'),
            ]);


            return redirect()->route('Comercial.Fornecedor.listarMfornecedor')->with('success', 'Fornecedor alterarado com sucesso!');

        }

        return redirect()->back()->with('error', 'Houve um erro ao cadastrar Fornecedor!');

    }

//Final da classe
}