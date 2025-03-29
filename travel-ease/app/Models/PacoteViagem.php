<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PacoteViagem extends Model
{
    use HasFactory;

    protected $fillable = ['passeios', 'restaurantes', 'viagem_id'];

    public function viagem() {
        return $this->belongsTo(Viagem::class);
    }
}
