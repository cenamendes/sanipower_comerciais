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
        if (!Schema::hasTable('visitas_agendadas')) {
        Schema::create('visitas_agendadas', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_tipo_visita')->nullable();
            $table->string('cliente', 150)->nullable();
            $table->string('data_inicial', 50)->nullable();
            $table->string('hora_inicial', 50)->nullable();
            $table->string('data_final', 50)->nullable();
            $table->string('hora_final', 50)->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitas_agendadas');
    }
};
