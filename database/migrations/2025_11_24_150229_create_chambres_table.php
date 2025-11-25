<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chambres', function (Blueprint $table) {
            $table->id();
            $table->string('numero_chambre')->unique();
            $table->string('titre_chambre');
            $table->string('slug')->unique();
            $table->text('description');
            $table->integer('capacite_chambre');
            $table->string('image');
            $table->string('gal_1')->nullable();
            $table->string('gla_2')->nullable();
            $table->string('type_chambre');
            $table->decimal('prix_chambre', 8, 2);
            $table->string('statut');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chambres');
    }
};
