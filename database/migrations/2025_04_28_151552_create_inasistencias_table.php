<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('inasistencias', function (Blueprint $table) {
            $table->id();
            $table->string('cedula');
            $table->string('codigo_falta');
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin');
            $table->date('total_dias');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inasistencias');
    }
};
