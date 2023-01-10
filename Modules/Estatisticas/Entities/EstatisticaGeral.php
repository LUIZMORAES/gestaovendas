<?php

namespace Modules\Estatisticas\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstatisticaGeral extends Model
{

    protected $table = 'estatistica_geral';

    use SoftDeletes;

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

    //Método que retorna as buscas do site
    public static function obterDados(){

        $buscas = EstatisticaGeral::all();

        return $buscas;

    }

}
