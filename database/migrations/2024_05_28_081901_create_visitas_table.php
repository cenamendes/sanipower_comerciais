<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitas', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('numero_cliente')->nullable();
            $table->string('assunto', 150)->nullable();
            $table->longText('relatorio')->nullable();
            $table->longText('pendentes_proxima_visita')->nullable();
            $table->longText('comentario_encomendas')->nullable();
            $table->longText('comentario_propostas')->nullable();
            $table->longText('comentario_financeiro')->nullable();
            $table->longText('comentario_ocorrencias')->nullable();
            $table->string('data', 50)->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitas');
    }
}
