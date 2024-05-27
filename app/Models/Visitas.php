<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitas extends Model
{
    use HasFactory;

    protected $table="visitas";

    protected $fillable = [
        'numero_cliente',
        'assunto',
        'relatorio',
        'pendentes_proxima_visita',
        'comentario_encomendas',
        'comentario_propostas',
        'comentario_financeiro',
        'comentario_occorencias',
        'data',
        'user_id'
    ];
}
