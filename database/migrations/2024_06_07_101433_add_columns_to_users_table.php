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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'telefone')) {
                $table->string('telefone')->nullable();
            }
            if (!Schema::hasColumn('users', 'status')) {
                $table->string('status')->default('ativo');
            }
            if (!Schema::hasColumn('users', 'nivel')) {
                $table->integer('nivel')->nullable();
            }
            if (!Schema::hasColumn('users', 'data_nascimento')) {
                $table->string('data_nascimento')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'telefone')) {
                $table->dropColumn('telefone');
            }
            if (Schema::hasColumn('users', 'status')) {
                $table->dropColumn('status');
            }
            if (Schema::hasColumn('users', 'nivel')) {
                $table->dropColumn('nivel');
            }
            if (Schema::hasColumn('users', 'data_nascimento')) {
                $table->dropColumn('data_nascimento');
            }
        });
    }
};
