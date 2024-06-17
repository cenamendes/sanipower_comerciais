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
        Schema::table('visitas', function (Blueprint $table) {
            if (!Schema::hasColumn('visitas', 'id_visita_agendada')) {
                $table->unsignedInteger('id_visita_agendada')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visitas', function (Blueprint $table) {
            if (Schema::hasColumn('visitas', 'id_visita_agendada')) {
                $table->dropColumn('id_visita_agendada');
            }
        });
    }
};
