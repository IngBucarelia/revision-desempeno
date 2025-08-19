<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('movimientos_procesos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proceso_id')->nullable()->constrained('faltas_disciplinarias')->onDelete('set null');
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
            $table->string('accion'); // Creación, Edición, Eliminación
            $table->timestamp('fecha_hora');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('movimientos_procesos');
    }
};
