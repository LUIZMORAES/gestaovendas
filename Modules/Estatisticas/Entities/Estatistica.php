<?php

namespace Modules\Estatisticas\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estatistica extends Model
{
    protected $table = 'estatisticas';

    use SoftDeletes, HasFactory;

    protected $fillable = [
        'id_responsavel',
        'razaoSocial',
        'nomeFantasia',
        'link',
        'deleted_at',
    ];

}
