<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('reference', 50)->unique();
            $table->string('libelle', 150);
            $table->text('description')->nullable();
            $table->decimal('prix_ht', 8, 2);   // ex : 999999.99
            $table->decimal('tva', 4, 2);      // ex : 20.00
            $table->integer('stock')->default(0);
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
