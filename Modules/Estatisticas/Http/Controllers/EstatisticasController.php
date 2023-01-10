<?php

namespace Modules\Estatisticas\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

use Carbon\Carbon;
use App\Models\User;
use Modules\Estatisticas\Entities\Estatistica;
use Modules\Estatisticas\Entities\EstatisticaGeral;
use Modules\Estatisticas\Entities\EstatisticaCliente;

class EstatisticasController extends Controller
{
    public $request;
    public $usuarios;
    public $mestatistica;
    public $mestatisticaGeral;
    public $mestatisticaCliente;

    public function __construct(
        Request $request,
        User $usuarios,
        Estatistica $mestatistica,
        EstatisticaGeral $mestatisticaGeral,
        EstatisticaCliente $mestatisticaCliente
    ) {

        $this->middleware('auth');
        $this->request = $request;
        $this->usuarios = $usuarios;
        $this->mestatistica = $mestatistica;
        $this->mestatisticaGeral = $mestatisticaGeral;
        $this->mestatisticaCliente = $mestatisticaCliente;

    }

    public function listarMlink()
    {
        //dd('lista de link');

        if (Auth::check()) {
            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/', $uri);

            $urlAtual = $exploder[1];

            $mestatistica = Estatistica::all();

            return view('Estatistica.listarEstatistica', compact(
                'user',
                'urlAtual',
                'mestatistica'
            ));
        }

        return redirect()->route('admin.painelprincipal');

    }

    public function createMlink()
    {
        //dd('Criar de link');

        if (Auth::check()) {
            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/', $uri);

            $urlAtual = $exploder[1];

            return view('Estatistica.formEstatistica', compact('user', 'urlAtual'));
        }

        return redirect()->route('Estatistica.listarMlink');

    }

    public function storeMlink(Request $request)
    {
        //dd('Salvar de link');

        $id_estatistica = Estatistica::where('id', $request->input('id'))->first();

        if (!$id_estatistica) {
            Estatistica::create([

                'id_responsavel' => $request->input('id_responsavel'),
                'razaoSocial' => $request->input('razaosocial'),
                'nomeFantasia' => $request->input('nomeFantasia'),
                'link' => $request->input('link'),
            ]);

            return redirect()->route('Estatistica.listarMlink')->with('success', 'Estatística cadastrada com sucesso!');

        }

        return redirect()->back()->with('error', 'Houve um erro ao cadastrar estatística!');

    }

    public function editMlink($id)
    {
        //dd($id);

        $id_estatistica = Estatistica::where('id', $id)->first();

        if ($id_estatistica) {
            if (Auth::check()) {
                $user = Auth::check();

                $uri = $this->request->route()->uri();

                $exploder = explode('/', $uri);

                $urlAtual = $exploder[1];

                return view('Estatistica.formEstatistica', compact('user', 'urlAtual'))->with(
                    [
                        'registro' => $id_estatistica->id,
                        'id_responsavel' => $id_estatistica->id_responsavel,
                        'razaoSocial' => $id_estatistica->razaoSocial,
                        'nomeFantasia' => $id_estatistica->nomeFantasia,
                        'link' => $id_estatistica->link,
                    ]
                );
            }
        }

        return redirect()->back()->with('error', 'Houve um erro ao cadastrar estatística!');

    }

    public function updateMlink(Request $request)
    {
        //dd($request);

        $id_estatistica = Estatistica::where('id', $request->input('registro'))->first();

        if ($id_estatistica) {
            Estatistica::whereId($request->registro)->update([

                'id_responsavel' => $request->input('id_responsavel'),
                'razaoSocial' => $request->input('razaoSocial'),
                'nomeFantasia' => $request->input('nomeFantasia'),
                'link' => $request->input('link'),
            ]);


            return redirect()->route('Estatistica.listarMlink')->with('success', 'Estatística alterado com sucesso!');
        }

        return redirect()->back()->with('error', 'Houve um erro ao cadastrar Estatística!');

    }

    public function acompanhaMlink(Request $request)
    {
        //dd($request);

//        try {
            $id_estatistica = $request->input('registro');
            $link_estatistica = trim($request->input('link'));

            $buscardados = Http::get($link_estatistica)->throw()->json();

            $colecoes_parametro = collect($buscardados);
            //dd($colecoes_parametro);
            $conta_parametro = collect($buscardados)->count();
            //dd($conta_parametro);

            EstatisticaGeral::truncate();
            EstatisticaCliente::truncate();

            // for($i=0 ; $i < $conta_parametro ; $i++ ){

            //     //dd($i);

            //     $colecoes_estatistica = $colecoes_parametro[$i];
            //     $busca_geral = $colecoes_estatistica['geral'];
            //     dd($busca_geral);



            // }

            // dd('Pause');

            for($i=0 ; $i < $conta_parametro ; $i++ ){

                //dd($i);

                $colecoes_estatistica = $colecoes_parametro[$i];
                $busca_geral = $colecoes_estatistica['geral'];
                //dd($busca_geral);

                $dt_data = Carbon::parse($busca_geral['data'])->format('d/m/Y');

                EstatisticaGeral::create([

                    'data' => $dt_data,
                    'hora' => $busca_geral['hora'],
                    'chamadas_total'=> $busca_geral['chamadas_total'],
                    'chamadas_falha_operadora' => $busca_geral['chamadas_falha_operadora'],
                    'chamadas_telefone_incorreto' => $busca_geral['chamadas_telefone_incorreto'],
                    'chamadas_nao_atendida' => $busca_geral['chamadas_nao_atendida'],
                    'chamadas_atendimento_maquina' => $busca_geral['chamadas_atendimento_maquina'],
                    'chamadas_atendimento_humano' => $busca_geral['chamadas_atendimento_humano'],
                    'chamadas_abandono_pre_fila' => $busca_geral['chamadas_abandono_pre_fila'],
                    'chamadas_abandono_fila' => $busca_geral['chamadas_abandono_fila'],
                    'chamadas_atendimento_pa' => $busca_geral['chamadas_atendimento_pa'],
                    'ocorrencias_total' => $busca_geral['ocorrencias_total'],
                    'ocorrencias_sem_contato' => $busca_geral['ocorrencias_sem_contato'],
                    'ocorrencias_com_contato' => $busca_geral['ocorrencias_com_contato'],
                    'ocorrencias_abordagem' => $busca_geral['ocorrencias_abordagem'],
                    'ocorrencias_fechamento' => $busca_geral['ocorrencias_fechamento'],

                ]);

                $colecao_clientes = $colecoes_estatistica['clientes'];

                //dd($colecao_clientes);

                $contaCliente = 1;

                foreach ($colecao_clientes as $cliente)
                {

                    //dd($cliente);
                    //dd($cliente['data']);

                    $nomeCliente = "Cliente0".$contaCliente;

                    $dt_data = Carbon::parse($cliente['data'])->format('d/m/Y');

                    EstatisticaCliente::create([

                        'cliente' => $nomeCliente,
                        'data' => $dt_data,
                        'hora' => $cliente['hora'],
                        'chamadas_total'=> $cliente['chamadas_total'],
                        'chamadas_falha_operadora' => $cliente['chamadas_falha_operadora'],
                        'chamadas_telefone_incorreto' => $cliente['chamadas_telefone_incorreto'],
                        'chamadas_nao_atendida' => $cliente['chamadas_nao_atendida'],
                        'chamadas_atendimento_maquina' => $cliente['chamadas_atendimento_maquina'],
                        'chamadas_atendimento_humano' => $cliente['chamadas_atendimento_humano'],
                        'chamadas_abandono_pre_fila' => $cliente['chamadas_abandono_pre_fila'],
                        'chamadas_abandono_fila' => $cliente['chamadas_abandono_fila'],
                        'chamadas_atendimento_pa' => $cliente['chamadas_atendimento_pa'],
                        'ocorrencias_total' => $cliente['ocorrencias_total'],
                        'ocorrencias_sem_contato' => $cliente['ocorrencias_sem_contato'],
                        'ocorrencias_com_contato' => $cliente['ocorrencias_com_contato'],
                        'ocorrencias_abordagem' => $cliente['ocorrencias_abordagem'],
                        'ocorrencias_fechamento' => $cliente['ocorrencias_fechamento'],

                    ]);

                    $contaCliente = $contaCliente + 1;

                }

            }

            //dd('Pausa...');

            $estatistica = Estatistica::where('id', $id_estatistica)->first();

            if ($estatistica) {
                if (Auth::check()) {
                    $user = Auth::check();

                    $uri = $this->request->route()->uri();

                    $exploder = explode('/', $uri);

                    $urlAtual = $exploder[1];

                    $mestatisticaGeral = EstatisticaGeral::orderBy('data', 'ASC')->get();
                    $mestatisticaCliente  = EstatisticaCliente::orderBy('data', 'ASC')->get();

                    return view('Estatistica.acompanhaEstatistica', compact(
                        'user', 'urlAtual', 'mestatisticaGeral', 'mestatisticaCliente'
                        ))->with(
                        [
                            'registro' => $estatistica->id,
                            'id_responsavel' => $estatistica->id_responsavel,
                            'razaoSocial' => $estatistica->razaoSocial,
                            'nomeFantasia' => $estatistica->nomeFantasia,
                            'link' => $estatistica->link,
                        ]
                    );
                }
            }

        // } catch (\Throwable $exception) {

        //     Alert::error('Ops!','Houve um erro no acompanhamento Estatístico!, Entrar em contato com suporte!!');
        //     return redirect()->back();
        // }

    }


}