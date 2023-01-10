<?php

namespace Modules\Pedidocompra\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PedidoCompraItem extends Model
{
    protected $table = 'pedido_compra_itens';

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

    public function pedidocompraitem()
    {
        return $this->belongsToMany(Pedidocompra::class, 'id_pedido_item', 'id');
    }

}
