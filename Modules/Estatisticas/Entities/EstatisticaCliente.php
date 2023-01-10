<?php

namespace Modules\Estatisticas\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstatisticaCliente extends Model
{

    protected $table = 'estatistica_cliente';

    use SoftDeletes, HasFactory;

    protected $fillable = [
        'id_responsavel',
        'cliente',
        'data',
        'hora',
        'chamadas_total',
        'chamadas_falha_operadora',
        'chamadas_telefone_incorreto',
        'chamadas_nao_atendida',
        'chamadas_atendimento_maquina',
        'chamadas_atendimento_humano',
        'chamadas_abandono_pre_fila',
        'chamadas_abandono_fila',
        'chamadas_atendimento_pa',
        'ocorrencias_total',
        'ocorrencias_sem_contato',
        'ocorrencias_com_contato',
        'ocorrencias_abordagem',
        'ocorrencias_fechamento',
        'deleted_at',

    ];

}
