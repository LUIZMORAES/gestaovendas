<?php

namespace Modules\Estoque\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Balanco extends Model
{
    protected $table = 'balanco_estoque';

    use SoftDeletes, HasFactory;

    protected $fillable = [
        'id_produto',
        'codigo_barra',
        'nome_produto',
        'categoria',
        'marca',
        'unidade',
        'estoque_atual',
        'estoque_contagem',
        'preco_venda',
        'deleted_at',
    ];
}
