<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_admin')->default(false)->after('password');
        });

        Schema::table('tickets', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('client_id')
                ->constrained('users')->nullOnDelete();
        });

        Schema::table('produits', function (Blueprint $table) {
            $table->longText('image')->nullable()->after('description');
            $table->string('categorie', 50)->nullable()->after('image');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_admin');
        });

        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        Schema::table('produits', function (Blueprint $table) {
            $table->dropColumn(['image', 'categorie']);
        });
    }
};
