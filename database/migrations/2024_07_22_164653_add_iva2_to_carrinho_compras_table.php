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
            if (!Schema::hasColumn('carrinho_compras', 'iva2')) {
                $table->integer('iva2')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carrinho_compras', function (Blueprint $table) {
            if (!Schema::hasColumn('carrinho_compras', 'iva2')) {
                $table->dropColumn('iva2');
            }
        });
    }
};

