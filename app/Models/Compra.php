<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;
    protected $table = 'compra';

    protected $fillable = [
        'user_id', 'codigo_do_pedido_id', 'valor_total'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function codigoDoPedido(){
        return $this->belongsTo(CodigoDoPedido::class);
    }
}
