<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMovimentacao extends Model
{
    use HasFactory;

    protected $table = 'restaurante.tipo_movimentacao';

    public $timestamps = false;

    protected $fillable = [
        'nome'
    ];

    
}
