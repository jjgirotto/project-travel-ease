<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PacoteViagem extends Model
{
    use HasFactory;

    protected $fillable = ['passeios', 'restaurantes', 'orcamento_id'];

    public function orcamento() {
        return $this->belongsTo(Orcamento::class);
    }
}
