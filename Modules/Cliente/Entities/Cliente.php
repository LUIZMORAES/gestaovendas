<?php

namespace Modules\Cliente\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{

    protected $table = 'cliente';

    use SoftDeletes, HasFactory;

    protected $fillable = [
        'id_responsavel',
        'nome_responsavel',
        'razaoSocial',
        'nomeFantasia',
        'cpfcnpj',
        'insestadual',
        'insmunicipal',
        'contrato_numero',
        'telefone',
        'celular',
        'email',
        'end_cep',
        'end_cidade',
        'end_bairro',
        'end_logradouro',
        'end_numero',
        'end_complemento',
        'end_uf',
        'status',
        'deleted_at',
    ];

}
