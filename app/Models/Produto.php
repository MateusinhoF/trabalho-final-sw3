<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    protected $table = 'produto';

    protected $fillable = [
        'nome', 'descricao', 'valor_unitario', 'quantidade', 'user_id', 'hash_nome_arquivo', 'quantidade_vendido', 'produto_disponivel'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function pedido(){
        return $this->hasMany(Pedido::class);
    }

}
