<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarrinhoComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('carrinho_compras')) {
            Schema::create('carrinho_compras', function (Blueprint $table) {
                $table->id();
                $table->string('id_encomenda', 50)->nullable();
                $table->string('id_proposta', 50)->nullable();
                $table->string('id_cliente', 50)->nullable();
                $table->unsignedInteger('id_user')->nullable();
                $table->string('referencia', 150)->nullable();
                $table->string('designacao', 150)->nullable();
                $table->float('price')->nullable();
                $table->float('pvp')->nullable();
                $table->string('discount', 50)->nullable();
                $table->unsignedInteger('qtd')->nullable();
                $table->unsignedInteger('iva')->nullable();
                $table->string('model', 50)->nullable();
                $table->string('image_ref', 250)->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carrinho_compras');
    }
}
