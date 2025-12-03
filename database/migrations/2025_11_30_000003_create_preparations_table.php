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
        Schema::create('preparations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commande_id')->constrained('commandes')->cascadeOnDelete();
            $table->foreignId('employe_id')->constrained('users')->restrictOnDelete();
            $table->string('statut', 50)->default('EN_COURS');
            $table->dateTime('date_debut');
            $table->dateTime('date_fin')->nullable();

            // Index demandés
            // commande_id et employe_id sont déjà indexés par les contraintes de clé étrangère
            $table->index('statut');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preparations');
    }
};
