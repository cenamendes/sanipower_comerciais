<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiposVisitas extends Model
{
    use HasFactory;

    protected $table="tipos_visitas";

    protected $fillable = [
        'tipo',
        'cor',
    ];
}
