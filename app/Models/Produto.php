<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'restaurante.produto';

    public $timestamps = false;
    
    protected $fillable =  [
        'nome',
        'fk_categoria'
    ];

    public function categoria()
    {
        return $this->hasOne(Categoria::class, 'id', 'fk_categoria');
    }
}
