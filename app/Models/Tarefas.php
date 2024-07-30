<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function user(){

        return $this->belongsTo(User::class,'user_id','id');
    }
}
