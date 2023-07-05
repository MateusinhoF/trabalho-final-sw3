<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodigoDoPedido extends Model
{
    use HasFactory;
    protected $table = 'codigo_do_pedido';

    protected $fillable = [
        'codigo'
    ];

    public function pedido(){
        return $this->hasMany(Pedido::class);
    }

    public function compra(){
        return $this->hasMany(Compra::class);
    }
}
