<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComentariosPropostas extends Model
{
    use HasFactory;

    protected $table="comentarios_propostas";

    protected $fillable = [
        'id_proposta',
        'comentario'
    ];
}
