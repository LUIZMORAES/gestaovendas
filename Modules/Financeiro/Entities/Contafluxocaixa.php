<?php

namespace Modules\Financeiro\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contafluxocaixa extends Model
{
    protected $table = 'fluxocaixa';

    use SoftDeletes, HasFactory;

    protected $fillable = [
        'id_responsavel',
        'nome_responsavel',
        'dt_gerado',
        'dt_inicial',
        'dt_final',
        'valorTrecebe',
        'valorTpagar',
        'valorTotal',
        'situacao',
        'deleted_at',
    ];

}