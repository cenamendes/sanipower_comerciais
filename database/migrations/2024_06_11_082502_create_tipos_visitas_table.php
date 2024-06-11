<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposVisitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('tipos_visitas')) {

        Schema::create('tipos_visitas', function (Blueprint $table) {
            $table->id();
            $table->string('tipo', 50)->nullable()->collation('utf8mb4_0900_ai_ci');
            $table->string('cor', 50)->nullable()->collation('utf8mb4_0900_ai_ci');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
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
        Schema::dropIfExists('tipos_visitas');
    }
}
