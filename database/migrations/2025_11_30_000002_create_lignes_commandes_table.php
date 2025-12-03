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
        Schema::create('lignes_commandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commande_id')->constrained('commandes')->cascadeOnDelete();
            $table->foreignId('produit_id')->constrained('produits')->restrictOnDelete();
            $table->integer('quantite_demandee');
            $table->integer('quantite_preparee')->default(0);
            $table->decimal('prix_unitaire_ht', 10, 2);
            $table->string('statut_ligne', 50)->default('A_VALIDER');
            $table->text('note')->nullable();

            // Index demandés
            // commande_id et produit_id sont déjà indexés par les contraintes de clé étrangère
            $table->index('statut_ligne');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lignes_commandes');
    }
};
