<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class chambres extends Model
{
    protected $fillable = [
        'numero_chambre',
        'titre_chambre',
        'slug',
        'description',
        'capacite_chambre',
        'statut',
        'image',
        'gal_1',
        'gla_2',
        'type_chambre',
        'prix_chambre',
        'statut',
    ];
}
