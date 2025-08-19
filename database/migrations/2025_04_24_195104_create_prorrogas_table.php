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
        Schema::create('prorrogas', function (Blueprint $table) {
            $table->id();
            $table->string('cedula');
            $table->boolean('preaviso')->default(false);
            $table->date('fecha_preaviso')->nullable();
            $table->date('inicio_prorroga');
            $table->date('vence_prorroga');
            $table->string('causa_terminacion_contrato')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prorrogas');
    }
};
