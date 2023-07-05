<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedido';

    protected $fillable = [
        'user_id', 'produto_id', 'codigo_do_pedido_id', 'quantidade', 'valor_unitario', 'valor_total'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function produto(){
        return $this->belongsTo(Produto::class);
    }

    public function codigoDoPedido(){
        return $this->belongsTo(CodigoDoPedido::class);
    }
}
