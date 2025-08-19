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
        Schema::create('faltas_disciplinarias', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('numero_documento_trabajador');
            $table->string('nombre_trabajador');
            $table->date('fecha_reporte');
            $table->time('hora_reporte')->nullable();
            $table->date('fecha_falta');
            $table->time('hora_falta')->nullable();
            $table->string('clase_falta');
            $table->string('labor');
            $table->integer('cantidad')->nullable();
            $table->text('descripcion_falta');
            $table->string('nombre_testigo')->nullable();
            $table->string('cargo_testigo')->nullable();
            $table->text('evidencias_adicionales')->nullable();
            $table->text('comentarios_adicionales')->nullable();
            $table->text('comentarios_gestion_humana')->nullable();
            $table->boolean('descargo')->default(false);
            $table->boolean('llamado_atencion')->default(false);
            $table->boolean('sancion')->default(false);
            $table->boolean('terminacion_contrato')->default(false);
            $table->timestamps();
        });
        
    
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faltas_disciplinarias');
    }
};
