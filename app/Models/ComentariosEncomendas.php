<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComentariosEncomendas extends Model
{
    use HasFactory;

    protected $table = "comentarios_encomendas";

    protected $fillable = [
        'id_encomenda',
        'comentario'
    ];
}
