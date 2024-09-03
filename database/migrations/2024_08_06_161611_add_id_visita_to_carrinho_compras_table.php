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
        Schema::table('carrinho_compras', function (Blueprint $table) {
            // Adiciona a nova coluna 'id_visita'
            if (!Schema::hasColumn('carrinho_compras', 'id_visita')) {
                $table->string('id_visita', 50)->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carrinho_compras', function (Blueprint $table) {
            // Remove a coluna 'id_visita'
            if (Schema::hasColumn('carrinho_compras', 'id_visita')) {
                $table->dropColumn('id_visita');
            }
        });
    }
};
