<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passagem extends Model
{
    use HasFactory;

    protected $fillable = ['checkin', 'checkout', 'aeroOrigem', 'aeroDestino', 'viagem_id'];
}
