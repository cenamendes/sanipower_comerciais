<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentariosProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('comentarios_produtos')) {
        Schema::create('comentarios_produtos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_user')->nullable();
            $table->string('reference', 50)->nullable();
            $table->string('no', 50)->nullable();
            $table->string('id_encomenda', 50)->nullable();
            $table->string('id_proposta', 50)->nullable();
            $table->string('tipo', 50)->nullable();
            $table->longText('comentario')->nullable();
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
        Schema::dropIfExists('comentarios_produtos');
    }
}
