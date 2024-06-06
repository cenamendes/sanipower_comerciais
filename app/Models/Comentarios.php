<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comentarios extends Model
{
    use HasFactory;

    protected $table="comentarios";

    protected $fillable = [
        'id_visita',
        'stamp',
        'tipo',
        'comentario',
        'id_user'
    ];


    public function user()
    {
        return $this->belongsTo(User::class,'id_user','id');
    }
}
