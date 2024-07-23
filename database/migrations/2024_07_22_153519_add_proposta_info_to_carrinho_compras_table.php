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
            if (!Schema::hasColumn('carrinho_compras', 'proposta_info')) {
                $table->string('proposta_info', 150)->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carrinho_compras', function (Blueprint $table) {
            if (Schema::hasColumn('carrinho_compras', 'proposta_info')) {
                $table->dropColumn('proposta_info');
            }
        });
    }
};
