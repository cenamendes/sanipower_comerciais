<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefas extends Model
{
    use HasFactory;

    protected $table="tarefas";

    protected $fillable = [
        'cliente',
        'assunto_text',
        'descricao',
        'data_inicial',
        'hora_inicial',
        'hora_final',
        'user_id',
        'finalizado'
    ];
}
