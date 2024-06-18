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
            if (!Schema::hasColumn('visitas_agendadas', 'assunto_text')) {
                $table->longText('assunto_text')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visitas_agendadas', function (Blueprint $table) {
            if (Schema::hasColumn('visitas_agendadas', 'assunto_text')) {
                $table->dropColumn('assunto_text');
            }
        });
    }
};
