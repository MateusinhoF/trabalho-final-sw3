<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDeUsuario extends Model
{
    use HasFactory;

    protected $table = 'tipo_de_usuario';

    protected $fillable = [
        'tipo'
    ];

    public function user(){
        return $this->hasMany(User::class);
    }
}
