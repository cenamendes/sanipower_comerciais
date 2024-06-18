<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitasAgendadas extends Model
{
    use HasFactory;

    protected $table="visitas_agendadas";

    protected $fillable = [
        'tipo_visita',
        'id_tipo_visita',
        'client_id',
        'cliente',
        'data_inicial',
        'hora_inicial',
        'data_final',
        'hora_final',
        'assunto_text',
        'user_id',
    ];

    public function tipovisita(){

        return $this->belongsTo(TiposVisitas::class,'id_tipo_visita','id');
    }
}
