<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viagem extends Model
{
    use HasFactory;

    protected $fillable = ['pagamento', 'orcamento_id'];

    public function orcamento() {
        return $this->belongsTo(Orcamento::class);
    }

}