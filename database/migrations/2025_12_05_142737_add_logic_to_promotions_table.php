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
        Schema::table('promotions', function (Blueprint $table) {
            $table->foreignId('produit_id')->nullable()->constrained('produits')->nullOnDelete()->after('id');
            $table->string('type_promo')->default('info')->after('produit_id'); // 'pourcentage', 'montant', 'offert', 'info'
            $table->decimal('valeur_promo', 8, 2)->nullable()->after('type_promo'); // ex: 30 pour 30%, 5 pour 5€
            $table->integer('min_quantite')->default(1)->after('valeur_promo'); // qté min pour déclencher
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('promotions', function (Blueprint $table) {
            $table->dropForeign(['produit_id']);
            $table->dropColumn(['produit_id', 'type_promo', 'valeur_promo', 'min_quantite']);
        });
    }
};
