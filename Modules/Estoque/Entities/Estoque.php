<?php

namespace Modules\Estoque\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

Class Estoque extends Model
{

    protected $table = 'estoque';

    use SoftDeletes, HasFactory;

    protected $fillable = [
        'id_cliente',
        'id_fornecedor',
        'id_responsavel',
        'nome_responsavel',
        'codigo_barra',
        'nome_produto',
        'categoria',
        'marca',
        'unidade',
        'estoque',
        'estoque_minimo',
        'preco_custo',
        'preco_venda',
        'preco_lucro',
        'data_vencimento',
        'foto_produto',
        'cod_conta',
        'deleted_at',
    ];

}