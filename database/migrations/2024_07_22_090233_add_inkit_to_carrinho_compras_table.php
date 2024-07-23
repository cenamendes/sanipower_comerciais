<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInkitToCarrinhoComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carrinho_compras', function (Blueprint $table) {
            if (!Schema::hasColumn('carrinho_compras', 'inkit')) {
                $table->boolean('inkit')->default(false);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carrinho_compras', function (Blueprint $table) {
            if (!Schema::hasColumn('carrinho_compras', 'inkit')) {
                $table->dropColumn('inkit');
            }
        });
    }
}

