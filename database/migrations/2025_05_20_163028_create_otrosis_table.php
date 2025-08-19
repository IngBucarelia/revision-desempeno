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
       Schema::create('otrosis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empleado_id');
            $table->date('fecha_renovacion');
            $table->string('periodo');
            $table->unsignedTinyInteger('numero_prorrogas');
            $table->timestamps();

            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otrosis');
    }
};
