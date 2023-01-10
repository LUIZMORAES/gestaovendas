<?php

namespace Modules\Fornecedor\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fornecedor extends Model
{

    protected $table = 'fornecedor';

    use SoftDeletes, HasFactory;

    protected $fillable = [
        'id_responsavel',
        'razaoSocial',
        'nomeFantasia',
        'cpfcnpj',
        'contrato_numero',
        'telefone',
        'email',
        'contrato_qtd',
        'end_cep',
        'end_cidade',
        'end_bairro',
        'end_logradouro',
        'end_numero',
        'end_complemento',
        'end_uf',
        'obs',
        'status',
        'deleted_at',
    ];

}
