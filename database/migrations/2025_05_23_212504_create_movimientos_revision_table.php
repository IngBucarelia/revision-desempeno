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
        Schema::create('movimientos_revision', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proceso_id')->nullable()->constrained('revision_desempeno')->onDelete('set null');
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
            $table->string('accion'); // Creación, Edición, Eliminación
            $table->timestamp('fecha_hora');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos_revision');
    }
};
