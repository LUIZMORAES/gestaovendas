<?php

namespace Modules\Estoque\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\User;
use Modules\Estoque\Entities\Estoque;
use Modules\Estoque\Entities\Balanco;

class EstoqueController extends Controller
{

    public $request;
    public $usuarios;
    public $mestoque;
    public $mestoqueEditar;
    public $mestoqueBalanco;

    public function __construct(
        Request $request,
        User $usuarios,
        Estoque $mestoque,
        Estoque $mestoqueEditar,
        Balanco $mestoqueBalanco
        ){
        $this->middleware('auth');
        $this->request = $request;
        $this->usuarios = $usuarios;
        $this->mestoque = $mestoque;
        $this->mestoqueEditar = $mestoqueEditar;
        $this->mestoqueBalanco = $mestoqueBalanco;
    }

    public function listarMestoque()
    {

        //dd('Pausa');

        if (Auth::check()) {

            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/',$uri);

            $urlAtual = $exploder[1];

            $mestoque = Estoque::all();

            return view('Comercial.Estoque.listarMestoque', compact(
                'user',
                'urlAtual',
                'mestoque',
            ));
        }

        return redirect()->route('admin.painelprincipal');
    }

    public function createMestoque()
    {

        if (Auth::check()) {

            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/',$uri);

            $urlAtual = $exploder[1];

            return view('Comercial.Estoque.formEstoque', compact(
                'user',
                'urlAtual',
            ));
        }

        return redirect()->route('admin.painelprincipal');
    }

    // handle insert a new employee ajax request
	public function storeMestoque2(Request $request) {
		$file = $request->file('avatar');
		$fileName = time() . '.' . $file->getClientOriginalExtension();
		$file->storeAs('public/images', $fileName);

		$empData = ['first_name' => $request->fname, 'last_name' => $request->lname, 'email' => $request->email, 'phone' => $request->phone, 'post' => $request->post, 'avatar' => $fileName];
		Employee::create($empData);
		return response()->json([
			'status' => 200,
		]);
	}

	// handle edit an employee ajax request
	public function editMestoque2(Request $request) {
		$id = $request->id;
		$emp = Employee::find($id);
		return response()->json($emp);
	}

     public function storeMestoque(Request $request)
     {
        //dd($request);

        if (Auth::check()) {

            $nomeproduto = trim($request->input('nome_produto'));

            $tratanomeproduto = empty(trim($nomeproduto));

            //dd($tratanomeproduto);

            if($tratanomeproduto){

                Alert::error('Ops!','O nome do produto não foi informado !!');
                return redirect()->route('Comercial.Estoque.createMestoque');

            }

            $datavencimento = trim($request->input('data_vencimento'));

            //dd($datavencimento);

            $tratadatavencimento = empty(trim($datavencimento));

            //dd($tratadatavencimento);

            if($tratadatavencimento){

                Alert::error('Ops!','A Data de vencimento não foi informado !!');
                return redirect()->route('Comercial.Estoque.createMestoque');

            }

            //$datavencimento = Carbon::createFromFormat('d/m/Y', $request->input('data_vencimento'))->format('Y-m-d');

            // Trata valor brasileiro para americano;

            $trataVprecocusto = ( strpos($request->preco_custo,'R$')!== false );

            if ($trataVprecocusto) {
                //dd('Encontrado');
                $trataVprecocusto = trim($request->preco_custo,'R$');
                $trataVprecocusto = trim(str_replace(".","",$trataVprecocusto));
                $trataVprecocusto = trim(str_replace(",",".",$trataVprecocusto));
                $trataVprecocusto = floatval($trataVprecocusto);
            } else {
                //dd('Não encontrado');
                $trataVprecocusto = trim($request->preco_custo,'0$');
                $trataVprecocusto = trim(str_replace(","," ",$trataVprecocusto));
            }

            $precocusto = $trataVprecocusto;

            $trataVprecovenda = ( strpos($request->preco_venda,'R$')!== false );

            if ($trataVprecovenda) {
                //dd('Encontrado');
                $trataVprecovenda = trim($request->preco_venda,'R$');
                $trataVprecovenda = trim(str_replace(".","",$trataVprecovenda));
                $trataVprecovenda = trim(str_replace(",",".",$trataVprecovenda));
                $trataVprecovenda = floatval($trataVprecovenda);
            } else {
                //dd('Não encontrado');
                $trataVprecovenda = trim($request->preco_venda,'0$');
                $trataVprecovenda = trim(str_replace(","," ",$trataVprecovenda));
            }

            $precovenda = $trataVprecovenda;

            $mestoqueEditar = Estoque::where('id', $request->input('id'))->first();

            if (!$mestoqueEditar) {

//                dd('Não achou produto!');

                Estoque::create([

                    'id_responsavel' => $request->input('id_responsavel'),
                    'nome_responsavel' => $request->input('nome_responsavel'),
                    'codigo_barra' => $request->input('codigo_barra'),
                    'nome_produto' => $nomeproduto,
                    'data_vencimento' => $datavencimento,
                    'categoria' => $request->input('categoria'),
                    'marca' => $request->input('marca'),
                    'unidade' => $request->input('unidade'),
                    'estoque' => $request->input('estoque'),
                    'estoque_minimo' => $request->input('estoque_minimo'),
                    'preco_custo' => $precocusto,
                    'preco_venda' => $precovenda,
                    'cod_conta' => $request->input('cod_conta'),

                ]);

                return redirect()->route('Comercial.Estoque.listarMestoque')->with('success', 'Produto cadastrado com sucesso!');

                }
            }

        return redirect()->back()->with('error', 'Houve um erro ao cadastrar produto!');

    }

     public function editMestoque($id_produto)
     {

        $mestoqueEditar = Estoque::where('id',$id_produto)->first();

        //dd($mestoqueEditar);

        $datavencimento = Carbon::parse($mestoqueEditar->data_vencimento)->format("d/m/Y");

        //dd($datavencimento);

        if ($mestoqueEditar) {

            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/',$uri);

            $urlAtual = $exploder[1];

            // Trata valor americano para brasileiro;

            //dd($mCatBuscar->valor_contratual);

            $trataVcusto = $mestoqueEditar->preco_custo;
            $trataVcusto = trim(str_replace(".",",",$trataVcusto));
            $preco_custo = $trataVcusto;

            $trataVvenda = $mestoqueEditar->preco_venda;
            $trataVvenda = trim(str_replace(".",",",$trataVvenda));
            $preco_venda = $trataVvenda;

            return view('Comercial.Estoque.formEstoque', compact(
                'user',
                'urlAtual',
                ))->with([

                   'registro' => $mestoqueEditar->id,
                   'codigo_barra' => $mestoqueEditar->codigo_barra,
                   'nome_produto' => $mestoqueEditar->nome_produto,
                   'data_vencimento' => $datavencimento,
                   'categoria' => $mestoqueEditar->categoria,
                   'marca' => $mestoqueEditar->marca,
                   'unidade' => $mestoqueEditar->unidade,
                   'estoque' => $mestoqueEditar->estoque,
                   'estoque_minimo' => $mestoqueEditar->estoque_minimo,
                   'preco_custo' => $preco_custo,
                   'preco_venda' => $preco_venda,
                   'cod_conta' => $mestoqueEditar->cod_conta,

                ]);

        }

        return redirect()->back()->with('error', 'Houve um erro ao alterar produto!');

     }

     public function updateMestoque(
         int $id_produto,
         Request $request
     )
     {

        //dd($request);

            if (Auth::check()) {

                $nomeproduto = trim($request->input('nome_produto'));

                $tratanomeproduto = empty(trim($nomeproduto));

                //dd($tratanomeproduto);

                if($tratanomeproduto){

                    Alert::error('Ops!','O nome do produto não foi informado !!');
                    return redirect()->route('Comercial.Estoque.editMestoque',$id_produto);

                }

                $datavencimento = trim($request->input('data_vencimento'));

                $tratadatavencimento = empty(trim($datavencimento));

                //dd($tratadatavencimento);

                if($tratadatavencimento){

                    Alert::error('Ops!','A Data de vencimento não foi informado !!');
                    return redirect()->route('Comercial.Estoque.editMestoque',$id_produto);

                }

                $datavencimento = Carbon::createFromFormat('d/m/Y', $request->input('data_vencimento'))->format('Y-m-d');

                //dd($datavencimento);

                // Trata valor brasileiro para americano;

                $trataVprecocusto = ( strpos($request->preco_custo,'R$')!== false );

                if ($trataVprecocusto) {
                    //dd('Encontrado');
                    $trataVprecocusto = trim($request->preco_custo,'R$');
                    $trataVprecocusto = trim(str_replace(".","",$trataVprecocusto));
                    $trataVprecocusto = trim(str_replace(",",".",$trataVprecocusto));
                    $trataVprecocusto = floatval($trataVprecocusto);
                } else {
                    //dd('Não encontrado');
                    $trataVprecocusto = trim($request->preco_custo,'0$');
                    $trataVprecocusto = trim(str_replace(","," ",$trataVprecocusto));
                }

                $precocusto = $trataVprecocusto;

                $trataVprecovenda = ( strpos($request->preco_venda,'R$')!== false );

                if ($trataVprecovenda) {
                    //dd('Encontrado');
                    $trataVprecovenda = trim($request->preco_venda,'R$');
                    $trataVprecovenda = trim(str_replace(".","",$trataVprecovenda));
                    $trataVprecovenda = trim(str_replace(",",".",$trataVprecovenda));
                    $trataVprecovenda = floatval($trataVprecovenda);
                } else {
                    //dd('Não encontrado');
                    $trataVprecovenda = trim($request->preco_venda,'0$');
                    $trataVprecovenda = trim(str_replace(","," ",$trataVprecovenda));
                }

                $precovenda = $trataVprecovenda;

                $mestoqueEditar = Estoque::where('id',$id_produto)->first();

                if ($mestoqueEditar) {

                   //dd('Achou produto para alterar');

                    Estoque::whereId($id_produto)->update([
                        'id_responsavel' => $request->input('id_responsavel'),
                        'nome_responsavel' => $request->input('nome_responsavel'),
                        'codigo_barra' => $request->input('codigo_barra'),
                        'nome_produto' => $nomeproduto,
                        'data_vencimento' => $datavencimento,
                        'categoria' => $request->input('categoria'),
                        'marca' => $request->input('marca'),
                        'unidade' => $request->input('unidade'),
                        'estoque' => $request->input('estoque'),
                        'estoque_minimo' => $request->input('estoque_minimo'),
                        'preco_custo' => $precocusto,
                        'preco_venda' => $precovenda,
                        'cod_conta' => $request->input('cod_conta'),
                    ]);

                    return redirect()->route('Comercial.Estoque.listarMestoque')->with('success', 'Produto alterado com sucesso!');

                }
            }

            return redirect()->back()->withSucesso('Produto nâo atualizado !!');

     }

     public function balancoMestoque()
     {

         if (Auth::check()) {

             $user = Auth::check();

             $uri = $this->request->route()->uri();

             $exploder = explode('/',$uri);

             $urlAtual = $exploder[1];

             $mestoqueBalanco = Balanco::all();

             return view('estoque::balancoMestoque', compact(
                 'user',
                 'urlAtual',
                 'mestoqueBalanco',
             ));
         }

         return redirect()->route('admin.painelprincipal');
     }

     public function zerarbalancoMestoque()
     {

//        dd('Zerar balanço');

         if (Auth::check()) {

             $user = Auth::check();

             $uri = $this->request->route()->uri();

             $exploder = explode('/',$uri);

             $urlAtual = $exploder[1];

             $mestoqueBalanco = Balanco::truncate();

             return view('estoque::balancoMestoque', compact(
                 'user',
                 'urlAtual',
                 'mestoqueBalanco',
             ));
         }

         return redirect()->route('admin.painelprincipal');
     }

     public function iniciarbalancoMestoque()
     {

//        dd('Iniciar balanço');

         if (Auth::check()) {

             $user = Auth::check();

             $uri = $this->request->route()->uri();

             $exploder = explode('/',$uri);

             $urlAtual = $exploder[1];

             $mestoque = Estoque::all();

             foreach ($mestoque as $mbalanco)
             {

                $mestoqueBalanco = Balanco::where('id_produto',$mbalanco->id)->first();

                if (!$mestoqueBalanco) {

                    Balanco::whereId($mbalanco->id)->create([
                        'id_produto' => $mbalanco->id,
                        'codigo_barra' => $mbalanco->codigo_barra,
                        'nome_produto' => $mbalanco->nome_produto,
                        'data_vencimento' => $mbalanco->data_vencimento,
                        'categoria' => $mbalanco->categoria,
                        'marca' => $mbalanco->marca,
                        'unidade' => $mbalanco->unidade,
                        'estoque_atual' => $mbalanco->estoque,
                        'preco_venda' => $mbalanco->preco_venda,
                    ]);

                }
            }
             return redirect()->route('Comercial.Estoque.balancoMestoque')->with('success', 'Transferência feita com sucesso!');
        }
        return redirect()->route('admin.painelprincipal');
     }

     public function balancoeditMestoque($id_produto)
     {

        $mestoqueEditar = Balanco::where('id',$id_produto)->first();

//        dd($mestoqueEditar);

        if ($mestoqueEditar) {

            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/',$uri);

            $urlAtual = $exploder[1];

            return view('estoque::balancoeditMestoque', compact(
            'user',
            'urlAtual',
            'mestoqueEditar'
            ))->with([
                'id_produto' => $mestoqueEditar->id_produto,
                'codigo_barra' => $mestoqueEditar->codigo_barra,
                'nome_produto' => $mestoqueEditar->nome_produto,
                'data_vencimento' => $mestoqueEditar->data_vencimento,
                'categoria' => $mestoqueEditar->categoria,
                'estoque_atual' => $mestoqueEditar->estoque_atual,
                'estoque_contagem' => $mestoqueEditar->estoque_contagem,
                'preco_venda' => $mestoqueEditar->preco_venda,
            ]);
        }
        return redirect()->back()->with('error', 'Houve um erro ao alterar produto!');
     }

     public function upbalancoMestoque(
        StoreUpBalanco $request
    )
    {

//        dd($request);

           if (Auth::check()) {

               $user = Auth::check();

               $uri = $this->request->route()->uri();

               $exploder = explode('/',$uri);

               $urlAtual = $exploder[1];

               $mestoqueEditar = Balanco::where('id',$request->id_produto)->first();

               if ($mestoqueEditar) {

//                    dd('Achou produto para alterar');

                    Balanco::whereId($request->id)->update([
                       'codigo_barra' => $request->input('codigo_barra'),
                       'nome_produto' => $request->input('nome_produto'),
                       'data_vencimento' => $request->input('data_vencimento'),
                       'categoria' => $request->input('categoria'),
                       'marca' => $request->input('marca'),
                       'unidade' => $request->input('unidade'),
                       'estoque_atual' => $request->input('estoque_atual'),
                       'estoque_contagem' => $request->input('estoque_contagem'),
                       'preco_venda' => $request->input('preco_venda'),
                   ]);

                   return redirect()->route('Comercial.Estoque.balancoMestoque')->with('success', 'Balanço alterado com sucesso!');

               }
           }

           return redirect()->back()->withSucesso('Produto nâo atualizado !!');

    }

    public function terminarbalancoMestoque()
    {

//        dd('Terminar balanço');

        if (Auth::check()) {

            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/',$uri);

            $urlAtual = $exploder[1];

            $mestoqueBalanco = Balanco::all();

            foreach ($mestoqueBalanco as $mbalanco)
            {

               $mestoque = Estoque::where('id',$mbalanco->id_produto)->first();

                if ($mestoque) {

                    if ($mbalanco->estoque_contagem > 0) {
                        Estoque::whereId($mbalanco->id_produto)->update([
                             'codigo_barra' => $mbalanco->codigo_barra,
                             'nome_produto' => $mbalanco->nome_produto,
                             'data_vencimento' => $mbalanco->data_vencimento,
                             'categoria' => $mbalanco->categoria,
                             'marca' => $mbalanco->marca,
                             'unidade' => $mbalanco->unidade,
                             'estoque' => $mbalanco->estoque_contagem,
                             'preco_venda' => $mbalanco->preco_venda,
                        ]);
                    }else{
                        return redirect()->route('Comercial.Estoque.balancoMestoque')->with('erro', 'Para terminar é necessário concluir a contagem!');
                    }
                }
           }
            return redirect()->route('Comercial.Estoque.balancoMestoque')->with('success', 'Transferência feita com sucesso!');
       }
       return redirect()->route('admin.painelprincipal');
    }

    public function imprimirbalancoMestoque()
    {

//        dd('Imprimir balanço');
        if (Auth::check()) {

            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/',$uri);

            $urlAtual = $exploder[1];

            $mestoqueBalanco = Balanco::all();

            foreach ($mestoqueBalanco as $mbalanco)
            {

               $mestoque = Estoque::where('id',$mbalanco->id_produto)->first();

                if ($mestoque) {
                    if ($mbalanco->estoque_contagem > 0) {
                    }else{
                        return redirect()->route('Comercial.Estoque.balancoMestoque')->with('erro', 'Para imprimir é necessário concluir a contagem!');
                    }
                }
           }
           return view('estoque::imprimirbalancoMestoque', compact(
            'mestoqueBalanco'
         ));

       }
       return redirect()->route('admin.painelprincipal');

    }
//Final da classe

}