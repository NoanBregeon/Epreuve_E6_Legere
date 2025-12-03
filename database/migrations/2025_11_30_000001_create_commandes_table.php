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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->nullable()->constrained('clients')->nullOnDelete();
            $table->string('numero_commande', 50)->unique();
            $table->string('statut', 50)->default('A_PREPARER');
            $table->dateTime('creneau_retrait');
            $table->decimal('total_ht', 10, 2);
            $table->decimal('total_ttc', 10, 2);
            $table->text('note_interne')->nullable();
            $table->timestamps();

            // Index demandés
            // client_id est déjà indexé par la contrainte de clé étrangère
            $table->index('statut');
            $table->index('creneau_retrait');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
