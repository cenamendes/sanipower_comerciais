<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CampanhasProd extends Model
{

    use HasFactory;

    protected $connection = 'campanha';
    protected $table="campanhas_produtos";

    protected $fillable = [
        'bostamp',
        'bistamp',
        'ref',
        'qtd',
        'preco',
        'ordem'
    ];
}
