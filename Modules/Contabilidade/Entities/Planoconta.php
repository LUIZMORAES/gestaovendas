<?php

namespace Modules\Contabilidade\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class Planoconta extends Model
{
    protected $table = 'planos_contas';

    use SoftDeletes, HasFactory;

    protected $fillable = [
        'cod_conta',
        'descricao',
        'classe',
        'condicao',
        'data_inicial',
        'data_final',
        'valor',
        'status',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

}
