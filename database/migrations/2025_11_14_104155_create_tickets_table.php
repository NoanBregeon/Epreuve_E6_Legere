<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();

            // Client facultatif (commande invitée possible)
            $table->foreignId('client_id')
                ->nullable()
                ->constrained('clients')
                ->nullOnDelete();

            $table->decimal('total_ht', 10, 2);
            $table->decimal('total_tva', 10, 2);
            $table->decimal('total_ttc', 10, 2);

            // CB, ESPECES, CHEQUE, EN_LIGNE, etc.
            $table->string('moyen_paiement', 20);
            $table->string('statut', 20)->default('VALIDE'); // VALIDE, ANNULE, EN_ATTENTE...

            $table->timestamps(); // created_at = date du ticket
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
