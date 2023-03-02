<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'restaurante.pedido';

    public $timestamps = false;

    protected $fillable = [
        'mesa',
        'status'
    ];

    public function pedidoItens()
    {
        return $this->hasMany(PedidoItem::class, 'fk_pedido');
    }

    public function cliente()
    {
        return $this->hasOne(Cliente::class, 'id','fk_identificacao_cliente');
    }
}
