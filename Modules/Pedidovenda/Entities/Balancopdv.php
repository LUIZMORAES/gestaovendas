<?php

namespace Modules\Pedidovenda\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Balancopdv extends Model
{
    protected $table = 'balancopdv';

    use SoftDeletes, HasFactory;

    protected $fillable = [
        'id_responsavel',
        'nome_responsavel',
        'ano',
        'valormes1',
        'valormes2',
        'valormes3',
        'valormes4',
        'valormes5',
        'valormes6',
        'valormes7',
        'valormes8',
        'valormes9',
        'valormes10',
        'valormes11',
        'valormes12',
        'valortotal',
        'deleted_at',
    ];

}