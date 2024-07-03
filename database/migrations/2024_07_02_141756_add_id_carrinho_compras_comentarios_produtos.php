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
        Schema::table('comentarios_produtos', function (Blueprint $table) {
            if (!Schema::hasColumn('comentarios_produtos', 'id_carrinho_compras')) {
                $table->unsignedInteger('id_carrinho_compras')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comentarios_produtos', function (Blueprint $table) {
            if (Schema::hasColumn('comentarios_produtos', 'id_carrinho_compras')) {
                $table->dropColumn('id_carrinho_compras');
            }
        });
    }
};
