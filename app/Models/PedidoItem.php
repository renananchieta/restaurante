<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoItem extends Model
{
    use HasFactory;

    protected $table = 'restaurante.pedido_itens';

    public $timestamps = false;

    protected $fillable = [
        'quantidade',
        'valor_unitario',
        'valor_total'
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'fk_pedido');
    }

    public function cardapio()
    {
        return $this->hasOne(Cardapio::class,'id','fk_cardapio');
    }
}
