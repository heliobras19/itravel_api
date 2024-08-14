<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;
    protected $fillable = ['partida', 'destino', 'data_ida', 'data_regresso', 'nome_responsavel', 'contato_resonsavel', 'paga', 'amadeus_data'];
}
