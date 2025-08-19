<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('descargos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('falta_disciplinaria_id')->constrained()->onDelete('cascade');
            $table->string('direccion_trabajador');
            $table->string('telefono_trabajador');
            
            // Respuestas a las preguntas
            for ($i = 1; $i <= 19; $i++) {
                $table->text('respuesta_'.$i);
            }
            
            $table->string('firma_implicado');
            $table->string('firma_responsable');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('descargos');
    }
};
