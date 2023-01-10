<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AuthController extends Controller
{

    public function clearcache()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:cache');
        Artisan::call('config:clear');
        Artisan::call('view:clear');

        Alert::success('CACHE','Limpeza do cache OK!');
        //return view('app');
        return redirect()->route('login');

    }

    public function login()
    {
        //dd('Login');

        return view('app');

    }

    public function acessoLogin()
    {
//        dd('teste dentro do adminAbrirLogin');

        return view('app');
    }

    public function painelIndex()
    {
//        dd('teste dentro do adminAbrirLogin');

        return view('Painel.Layouts.index');
    }

    public function credencialLogin(Request $request)
    {

        //dd($request);

        if ($request->Botao1){

            //dd('Botao 1');

            if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
                //return redirect()->back()->withInput()->withErrors(['O e-mail informado não é válido!']);
                Alert::error('Ops!','O e-mail informado não é válido!!');
                return redirect()->route('Admin.acesso.login');
            }

            $credenciais = [

              'email'     =>  $request->email,
              'password'  =>  $request->password
            ];

            Auth::attempt($credenciais);

            if(Auth::attempt($credenciais)) {
                return redirect()->route('Painel.principal.index');
                //Alert::error('Ops!','Em desenvolvimento!!');
                //return redirect()->route('Admin.acesso.login');
            }

            Alert::error('Ops!','O e-mail ou senha informado não é válido!!');
            //return redirect()->back()->withInput()->withErrors(['Os dados informados não conferem!']);
            return redirect()->route('Admin.acesso.login');

        }

        if($request->Botao2){

            //dd('Botao 2');

            $email = $request->email;

            $buscarusuario = User::where('email', $email)->first();

            if($buscarusuario){

                //dd('Achou email');

                $id_usuario = $buscarusuario->id;

                //Trata token
                $acesso_token = $buscarusuario->acesso_token;

                //dd($acesso_token);

                if($acesso_token){

                    //dd('existe token');

                    //Trata descrição email para mensagem no mail

                    $emailPara = ltrim(rtrim($email));

                    $tiraespacopalavra = $emailPara;

                    $ultimaposicao = strpos($tiraespacopalavra,'@');

                    //dd($ultimaposicao);

                    //alcular a média $montaparavra

                    $mediaparavra = round(intval($ultimaposicao)/2,0);

                    //Monta palavra e-mail

                    $montaparavra = substr($tiraespacopalavra,0,$mediaparavra);

                    // Trocando todas ocorrencias de "email" por "*******"
                    $str = $tiraespacopalavra;

                    $antes = $montaparavra;
                    $depois = '*******';

                    $palavraparaemail = str_replace($antes, $depois, $str);

                    //dd($emailPara, $palavraparaemail);

                    //função niqid () do php para gerar um ID exclusivo
                    //com base no microtime (horário atual em microssegundos)

                    $gerartoken = uniqid();

                    //dd($gerartoken);

                    Mail::send('Mail.mailLogin', ['SISTEMA SGA' => 'Suporte ao E-mail'], function ($message) use($emailPara) {
                        $message->from('operacional@lcaminformatica.com.br', 'LCAM Suporte');
                        $message->to($emailPara, 'Cliente');
                        $message->subject('Suporte ao E-mail');
                    });

                    User::whereId($id_usuario)->update([

                        'acesso_token' => $gerartoken,

                    ]);

                    Alert::success('Ok','Desculpe mais link já expirou e foi enviado novo e-mail para'.$palavraparaemail.', ou entre contato SUPORTE!');
                    //return redirect()->route('Admin.acesso.login');
                    return redirect()->route('Admin.acesso.redefinirlogin');

                }else{

                    //dd('não existe token');

                    //Trata descrição email para mensagem no mail

                    $emailPara = ltrim(rtrim($email));

                    $tiraespacopalavra = $emailPara;

                    $ultimaposicao = strpos($tiraespacopalavra,'@');

                    //dd($ultimaposicao);

                    //alcular a média $montaparavra

                    $mediaparavra = round(intval($ultimaposicao)/2,0);

                    //Monta palavra e-mail

                    $montaparavra = substr($tiraespacopalavra,0,$mediaparavra);

                    // Trocando todas ocorrencias de "email" por "*******"
                    $str = $tiraespacopalavra;

                    $antes = $montaparavra;
                    $depois = '*******';

                    $palavraparaemail = str_replace($antes, $depois, $str);

                    //dd($emailPara, $palavraparaemail);

                    //função niqid () do php para gerar um ID exclusivo
                    //com base no microtime (horário atual em microssegundos)

                    $gerartoken = uniqid();

                    //dd($gerartoken);

                    Mail::send('Mail.mailLogin', ['SISTEMA SGA' => 'Suporte ao E-mail'], function ($message) use($emailPara) {
                        $message->from('operacional@lcaminformatica.com.br', 'LCAM Suporte');
                        $message->to($emailPara, 'Cliente');
                        $message->subject('Suporte ao E-mail');
                    });

                    User::whereId($id_usuario)->update([

                        'acesso_token' => $gerartoken,

                    ]);

                    Alert::success('Ok','O link para recuperação ou cadastro foi enviado para '.$palavraparaemail.', ou entre contato SUPORTE!');
                    return redirect()->route('Admin.acesso.login');
                    //return redirect()->route('Admin.acesso.redefinirlogin');

                }

            }

            Alert::error('Ops!','O e-mail informado não cadastrado!!');
            return redirect()->route('Admin.acesso.login');

        }

    }

    public function LogoutLogin()
    {
        Auth::logout();
        return redirect()->route('Admin.acesso.login');
    }

    public function acessoMadmin()
    {
        return view('Admin.acessoAdmin');
    }

    public function acessoredefinirLogin()
    {
        //dd('acessoredefinirLogin');

        //Alert::error('Ops!','Acesso não negado!!');
        //return redirect()->route('Admin.acesso.login');

        return view('appRedefinir');

    }

    public function nvcredencial(
        Request $request
    )
    {
        //dd($request);

        $email = $request->email;
        $tratapassword1 = trim($request->password);

        $buscarusuario = User::where('email', $email)->first();

        if($buscarusuario){

            $id_usuario = $buscarusuario->id;
            $novasenha = Hash::make($tratapassword1);

            User::whereId($id_usuario)->update([

                'password' => $novasenha,
                'acesso_token' => "",

            ]);

            Alert::error('Sucesso!','A senha foi alterada !');
            return redirect()->route('Admin.acesso.login');

        }

        Alert::error('Ops!','Email não cadastrado!');
        return redirect()->route('Admin.acesso.redefinirlogin');

    }

}
