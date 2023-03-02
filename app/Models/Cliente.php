<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'restaurante.cliente';

    public $timestamps = false;

    protected $fillable = [
        'nome',
        'telefone',
        'identificacao'
    ];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'fk_identificacao_cliente');
    }
}
