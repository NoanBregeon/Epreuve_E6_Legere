<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lignes_tickets', function (Blueprint $table) {
            $table->id();

            $table->foreignId('ticket_id')
                ->constrained('tickets')
                ->cascadeOnDelete();

            $table->foreignId('produit_id')
                ->constrained('produits')
                ->restrictOnDelete(); // on ne supprime pas un produit lié à un ticket

            $table->integer('qte');
            $table->decimal('prix_unitaire_ht', 8, 2);
            $table->decimal('tva', 4, 2);

            $table->decimal('total_ht', 10, 2);
            $table->decimal('total_ttc', 10, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lignes_tickets');
    }
};
