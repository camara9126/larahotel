<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class reservation extends Model
{
    protected $fillable = [
        'name',
        'email',
        'date_arrivee',
        'date_depart',
        'nombre_personnes',
        'phone',
        'room_id',
        'note',
        'statut',
    ];
}
