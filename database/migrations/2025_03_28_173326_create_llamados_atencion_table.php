<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('llamados_atencion', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nombre');
            $table->string('trabajador');
            $table->string('clase_falta');
            $table->string('labor');
            $table->date('fecha_notificacion');
            $table->date('fecha_falta');
            $table->string('asunto');
            $table->text('descripcion_falta');
            $table->text('observaciones')->nullable();
            $table->string('firma_notificacion');
            $table->string('cargo');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('llamados_atencion');
    }
};
