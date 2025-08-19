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
    Schema::create('revision_desempenos', function (Blueprint $table) {
        $table->id();
        $table->date('fecha_solicitud')->nullable();

        // Datos del trabajador
        $table->string('nombre_trabajador')->nullable();
        $table->string('cargo')->nullable();
        $table->date('fecha_ingreso')->nullable();
        $table->integer('prorrogas')->nullable();
        $table->date('fecha_vencimiento')->nullable();

        // Gestión Humana
        $table->integer('asignado_gh')->nullable();
        $table->text('faltas_disciplinarias')->nullable();
        $table->text('llamados_atencion')->nullable();
        $table->text('sanciones')->nullable();
        $table->text('inasistencias')->nullable();
        $table->text('observaciones_gh')->nullable();
        $table->string('gh_diligenciado_por')->nullable();
        $table->string('gh_firma')->nullable();
        $table->date('gh_fecha')->nullable();

        // Seguridad y Salud en el Trabajo
        $table->integer('asignado_sst')->nullable();
        $table->text('cumplimiento_sgsst')->nullable();
        $table->text('habitos_comportamientos')->nullable();
        $table->string('sst_diligenciado_por')->nullable();
        $table->string('sst_firma')->nullable();
        $table->date('sst_fecha')->nullable();

        // Evaluación Jefe
        $table->integer('jefe')->nullable();
        $table->text('labor_actual')->nullable();
        $table->text('labores_desempenadas')->nullable();
        $table->string('jefe_diligenciado_por')->nullable();
        $table->string('jefe_firma')->nullable();
        $table->date('jefe_fecha')->nullable();

        // Desempeño
        $table->text('calidad_labor')->nullable();
        $table->text('cumplimiento')->nullable();
        $table->text('productividad')->nullable();
        $table->text('relaciones')->nullable();
        $table->text('otras')->nullable();

        // Cumplimiento general
        $table->boolean('gh_cumple')->default(false);
        $table->boolean('sst_cumple')->default(false);
        $table->boolean('jefe_cumple')->default(false);

        // Gerencia
        $table->integer('asignado_gerencia')->nullable();
        $table->date('fecha_gerencia')->nullable();
        $table->boolean('gerencia_cumple')->default(false);
        $table->text('observaciones_gerencia')->nullable();
        $table->string('autorizado_por')->nullable();
        $table->string('firma_autorizado')->nullable();

        // Elaborado/Revisado/Aprobado
        $table->integer('asignado_elavorado')->nullable();
        $table->string('elaborado_por')->nullable();
        $table->string('revisado_por')->nullable();
        $table->string('aprobado_por')->nullable();
        $table->date('fecha_aprobacion')->nullable();

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revision_desempenos');
    }
};
