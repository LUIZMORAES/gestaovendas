<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class estatisticaAccess
{
    public function handle(Request $request, Closure $next)
    {
        if(Auth()->check() AND Auth()->user()->estatistica){
            return $next($request);
        }

        return redirect('Administracao/acessoAdmin');

    }
}
