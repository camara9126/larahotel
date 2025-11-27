<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Str;

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
        'status',
    ];

     // creation de slug a chaque article
        protected static function boot()
            {
                parent::boot();
            
                static::saving(function ($chambres) {
                    if (empty($chambres->slug)) {
                        $slug = Str::slug($chambres->titre_chambre);
                        $originalSlug = $slug;
            
                        // Vérifier l'unicité du slug
                        $count = 1;
                        while (chambres::where('slug', $slug)->exists()) {
                            $slug = $originalSlug . '-' . $count;
                            $count++;
                        }
            
                        $chambres->slug = $slug;
                    }
                });
            }
}
