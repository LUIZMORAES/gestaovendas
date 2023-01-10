<?php

namespace Modules\Pedidovenda\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedidovenda extends Model
{
    protected $table = 'pedido_venda';

    use SoftDeletes, HasFactory;

    protected $fillable = [
        'id_responsavel',
        'id_cliente',
        'nr_notafiscal',
        'nomeFantasia',
        'razaoSocial',
        'cpfcnpj',
        'insestadual',
        'insmunicipal',
        'end_cep',
        'end_cidade',
        'end_bairro',
        'end_logradouro',
        'end_numero',
        'end_complemento',
        'end_uf',
        'id_transporte',
        'situacao',
        'formaPgto1',
        'valorformaPgto1',
        'formaPgto2',
        'valorformaPgto2',
        'valorTotalsemDesconto',
        'valorTotalDesconto',
        'valorTotalPedido',
        'valorTotalRecebido',
        'valorTroco',
        'dt_emissao',
        'deleted_at',
    ];

    public function itensPedido()
    {
        return $this->hasMany(PedidoCompraItem::class,'id_pedido_item');
    }
}
