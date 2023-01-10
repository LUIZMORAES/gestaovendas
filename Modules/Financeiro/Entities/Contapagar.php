<?php

namespace Modules\Financeiro\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contapagar extends Model
{
    protected $table = 'conta_pagar';

    use SoftDeletes, HasFactory;

    protected $fillable = [
        'id_responsavel',
        'nome_responsavel',
        'id_pedido',
        'id_notafiscal',
        'id_fornecedor',
        'razaoSocial',
        'nomeFantasia',
        'cpfcnpj',
        'cod_conta',
        'documento',
        'parcelas',
        'formaPgto1',
        'valorformaPgto1',
        'formaPgto2',
        'valorformaPgto2',
        'valorTotalsemDesconto',
        'valorTotalDesconto',
        'valorTotal',
        'valorTotalpago',
        'porcentagem',
        'valorJuros',
        'dt_emissao',
        'dt_vencimento',
        'dt_pagamento',
        'situacao',
        'deleted_at',

    ];

}
