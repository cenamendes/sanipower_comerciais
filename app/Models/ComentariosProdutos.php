<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ComentariosProdutos extends Model
{
    use HasFactory;

    protected $table="comentarios_produtos";

    protected $fillable = [
        'id',
        'id_user',
        'reference',
        'no',
        'id_encomenda',
        'id_proposta',
        'tipo',
        'comentario',
        'id_carrinho_compras'
    ];
}
