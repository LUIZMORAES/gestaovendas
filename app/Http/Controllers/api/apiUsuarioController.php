<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class apiUsuarioController extends Controller
{
    public $request;
    public $usuarios;

    public function __construct(Request $request, User $usuarios)
    {
        $this->request = $request;
        $this->usuarios = $usuarios;
    }

    public function listarUsuario()
    {
        return User::all();
    }

    public function criarUsuario(Request $request)
    {
//        dd($request);
//        User::create($request->all());
        User::create([

           'name' => $request->input('name'),
           'email' => $request->input('email'),
           'password' => Hash::make($request['password'])
        ]);

        return response()->json(['message', 'Usuário cadastrado com sucesso'], 200);

    }

    public function mostrarUsuario($id)
    {
//        dd($id);
        return User::findOrFail($id);
    }

    public function alterarUsuario(Request $request, $id)
    {
//        dd($request);
        User::whereId($id)->update([
            'name' => $request->input('name'),
            'email_verified_at' => $request->input('email_verified_at'),
            'remember_token' => $request['remember_token'],
        ]);

        return response()->json(['message', 'User alterado com sucesso'], 200);

    }

    public function deletarUsuario($id)
    {
//        dd($id);

        $usuario = User::where('id',$id)->first();

        if ($usuario) {
            $usuario->delete();
            return response()->json(['message', 'User apagado com sucesso'], 200);
        }

        return response()->json(['message', 'User nao encontrado'], 401);

    }

    public function redefinirUsuario(Request $request)
    {

//        dd($request);

        $usuario = User::where('email',$request->email)->first();

//        dd($usuario);

        if ($usuario) {

            $emailPara = $request->email;
            $id_usuario = $usuario->id;
//            dd( $id_usuario);
//           dd($emailPara);

           User::whereId($id_usuario)->update([

            'password' => Hash::make($request->password)

            ]);

            Mail::send('Mail.mailLogin', ['SISTEMA ADM' => 'Suporte ao E-mail'], function ($message) use($emailPara) {
                 $message->from('operacional@lcaminformatica.com.br', 'LCAM Suporte');
                 $message->to($emailPara, 'Cliente');
                 $message->subject('A sua senha senha foi alterado com sucesso');
            });

            return redirect()->route('Admin.acesso.login');
        }

        return view('appRedefinir', ["email" => "operacional@lcaminformatica.com.br"])->with('errors', 'Houve um erro ao alterar senha!');
    }

    public function esquecisenhaUsuario()
    {

//      dd('Esqueci minha senha localizar email');

      return view('appRedefinir', ["email" => "operacional@lcaminformatica.com.br"])->with('errors', 'Houve um erro ao cadastrar usuário!');

    }

// Final da classe
}
