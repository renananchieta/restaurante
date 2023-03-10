<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
    use HasFactory;

    protected $table = 'restaurante.movimentacao';

    public $timestamps = false;

    protected $fillable = [
        'fk_cliente',
        'valor',
        'fk_tipo_movimentacao',
        'data',
        'observacao'
    ];

    public function cliente()
    {
        return $this->hasOne(Cliente::class, 'id', 'fk_cliente');
    }

    public function tipomovimentacao()
    {
        return $this->hasMany(Movimentacao::class, 'fk_tipo_movimentacao', 'id');
    }
}
