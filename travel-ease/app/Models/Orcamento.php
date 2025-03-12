<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orcamento extends Model
{
    use HasFactory;

    protected $fillable = ['origem', 'destino', 'estadia', 'viajantes', 'acomodacao', 'preferencia', 'qtdeMilhas', 'valorMilhas', 'valorTotal', 'escolhido', 'cliente_id'];

    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }
}
