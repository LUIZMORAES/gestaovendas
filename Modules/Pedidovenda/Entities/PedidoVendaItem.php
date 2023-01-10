<?php

namespace Modules\Pedidovenda\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PedidoVendaItem extends Model
{
    protected $table = 'pedido_venda_itens';

    use SoftDeletes, HasFactory;

    protected $fillable = [
        'id_pedido_item',
        'id_prod_item',
        'nome_produto',
        'codigo_barra',
        'quantidade',
        'valor_unitario',
        'valor_desconto',
        'valor_semDesconto',
        'valor_totalProduto',
        'deleted_at',
    ];

    public function pedidoitem()
    {
        return $this->belongsToMany(Pedidovenda::class, 'id_pedido_item', 'id');
    }

}