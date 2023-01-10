<?php

namespace Modules\Cliente\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Modules\Cliente\Entities\Cliente;

class ClienteController extends Controller
{

    public $request;
    public $usuarios;
    public $mcliente;

    public function __construct(
        Request $request,
        User $usuarios,
        Cliente $mcliente
    ) {

        $this->middleware('auth');
        $this->request = $request;
        $this->usuarios = $usuarios;
        $this->mcliente = $mcliente;
    }

    public function listarMcliente()
    {

        //dd('listarMcliente');

        if (Auth::check()) {
            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/', $uri);

            $urlAtual = $exploder[1];

            $mcliente = Cliente::all();

            return view('Comercial.Cliente.listarCliente', compact(
                'user',
                'urlAtual',
                'mcliente'
            ));
        }

        return redirect()->route('admin.painelprincipal');
    }

    public function createMcliente()
    {
//       dd('createMcliente');

        if (Auth::check()) {
            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/', $uri);

            $urlAtual = $exploder[1];

            return view('Comercial.Cliente.formCliente', compact('user', 'urlAtual'));
        }

        return redirect()->route('Comercial.Cliente.listarMcliente');
    }

    public function editMcliente($id)
    {

//        dd('editcliente');
        $mcliente = Cliente::where('id', $id)->first();

        if ($mcliente) {
            if (Auth::check()) {
                $user = Auth::check();

                $uri = $this->request->route()->uri();

                $exploder = explode('/', $uri);

                $urlAtual = $exploder[1];

                return view('Comercial.Cliente.formCliente', compact('user', 'urlAtual'))->with(
                    [
                        'registro' => $mcliente->id,
                        'razaosocial' => $mcliente->razaoSocial,
                        'nomeFantasia' => $mcliente->nomeFantasia,
                        'cpfcnpj' => $mcliente->cpfcnpj,
                        'insestadual' => $mcliente->insestadual,
                        'insmunicipal' => $mcliente->insmunicipal,
                        'telefone' => $mcliente->telefone,
                        'celular' => $mcliente->celular,
                        'celular' => $mcliente->celular,
                        'email' => $mcliente->email,
                        'end_cep' => $mcliente->end_cep,
                        'end_logradouro' => $mcliente->end_logradouro,
                        'end_numero' => $mcliente->end_numero,
                        'end_complemento' => $mcliente->end_complemento,
                        'end_bairro' => $mcliente->end_bairro,
                        'end_cidade' => $mcliente->end_cidade,
                        'end_uf' => $mcliente->end_uf,
                        'contrato_numero' => $mcliente->contrato_numero,
                        'contrato_valor' => $mcliente->contrato_valor,
                        'status' => $mcliente->status,
                    ]
                );
            }
        }

        return redirect()->route('admin.painelprincipal');
    }

    public function storeMcliente(Request $request)
    {

//       dd('storecliente');

        $id_cliente = Cliente::where('id', $request->input('id'))->first();

        if (!$id_cliente) {
            Cliente::create([

                'id_responsavel' => $request->input('id_responsavel'),
                'razaoSocial' => $request->input('razaosocial'),
                'nomeFantasia' => $request->input('nomeFantasia'),
                'cpfcnpj' => $request->input('cpfcnpj'),
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

            return redirect()->route('Comercial.Cliente.listarMcliente')->with('success', 'Cliente cadastrada com sucesso!');
        }

        return redirect()->back()->with('error', 'Houve um erro ao cadastrar cliente!');
    }

    public function updateMcliente(Request $request)
    {

    //dd($request);

    //    dd('updatecliente');

        $id_cliente = Cliente::where('id', $request->input('registro'))->first();

        if ($id_cliente) {
            Cliente::whereId($request->registro)->update([

                'id_responsavel' => $request->input('id_responsavel'),
                'razaoSocial' => $request->input('razaosocial'),
                'nomeFantasia' => $request->input('nomeFantasia'),
                'cpfcnpj' => $request->input('cpfcnpj'),
                'insestadual' => $request->input('insestadual'),
                'insmunicipal' => $request->input('insmunicipal'),
                'telefone' => $request->input('telefone'),
                'celular' => $request->input('celular'),
                'email' => $request->input('email'),
                'end_cep' => $request->input('end_cep'),
                'end_logradouro' => $request->input('end_logradouro'),
                'end_numero' => $request->input('end_numero'),
                'end_complemento' => $request->input('end_complemento'),
                'end_bairro' => $request->input('end_bairro'),
                'end_cidade' => $request->input('end_cidade'),
                'end_uf' => $request->input('end_uf'),
                'contrato_numero' => $request->input('contrato_numero'),
                'status' => $request->input('status'),
            ]);


            return redirect()->route('Comercial.Cliente.listarMcliente')->with('success', 'Cliente alterado com sucesso!');
        }

        return redirect()->back()->with('error', 'Houve um erro ao cadastrar Cliente!');
    }

//Final da classe
}