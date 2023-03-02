<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cardapio extends Model
{
    use HasFactory;

    protected $table = 'restaurante.cardapio';

    public $timestamps = false;

    protected $fillable = [
        'descricao',
        'valor'
    ];

    public function produto()
    {
        return $this->hasOne(Produto::class, 'id', 'fk_produto');
    }
}