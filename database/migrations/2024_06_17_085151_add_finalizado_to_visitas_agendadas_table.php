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
        Schema::table('visitas_agendadas', function (Blueprint $table) {
            if (!Schema::hasColumn('visitas_agendadas', 'finalizado')) {
                $table->unsignedInteger('finalizado')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visitas_agendadas', function (Blueprint $table) {
            if (Schema::hasColumn('visitas_agendadas', 'finalizado')) {
                $table->dropColumn('finalizado');
            }
        });
    }
};
