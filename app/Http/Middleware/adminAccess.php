<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class adminAccess
{
    public function handle(Request $request, Closure $next)
    {
        if(Auth()->check() AND Auth()->user()->administrador){
            dd('Acesso AUTORIZADO,  você é administrador ');
            return $next($request);
        }

        dd('Acesso negado, você não é administrador ');
        return redirect('Administracao/acessoAdmin');

    }
}
