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
        Schema::table('produits', function (Blueprint $table) {
            $table->boolean('is_non_perissable')->default(false);
            $table->boolean('export_fnacdarty')->default(false);
            $table->string('fnacdarty_category')->nullable();
            $table->string('export_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produits', function (Blueprint $table) {
            $table->dropColumn([
                'is_non_perissable',
                'export_fnacdarty',
                'fnacdarty_category',
                'export_status'
            ]);
        });
    }
};
