<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrinho extends Model
{
    use HasFactory;

    protected $table="carrinho_compras";

    protected $fillable = [
        'id_encomenda',
        'id_proposta',
        'id_cliente',
        'id_user',
        'referencia',
        'designacao',
        'pvp',
        'discount',
        'discount2',
        'qtd',
        'image_ref',
        'model',
        'iva',
        'price',
        'proposta_info'
    ];
}
