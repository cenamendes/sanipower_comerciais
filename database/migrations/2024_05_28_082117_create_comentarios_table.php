<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('comentarios')) {
            Schema::create('comentarios', function (Blueprint $table) {
                $table->id();
                $table->integer('id_visita')->nullable();
                $table->string('stamp', 50)->nullable();
                $table->string('tipo', 50)->nullable();
                $table->longText('comentario')->nullable();
                $table->integer('id_user')->nullable();
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
        Schema::dropIfExists('comentarios');
    }
}