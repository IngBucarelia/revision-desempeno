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
    Schema::table('faltas_disciplinarias', function (Blueprint $table) {
        $table->string('pdf_evidencia')->nullable()->after('comentarios_gestion_humana');
    });
}

public function down()
{
    Schema::table('faltas_disciplinarias', function (Blueprint $table) {
        $table->dropColumn('pdf_evidencia');
    });
}

};
