<?php
// database/migrations/xxxx_xx_xx_add_codigo_to_prorrogas_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCodigoToProrrogasTable extends Migration
{
    public function up()
    {
        Schema::table('prorrogas', function (Blueprint $table) {
            $table->string('codigo')->unique()->after('id');
        });
    }

    public function down()
    {
        Schema::table('prorrogas', function (Blueprint $table) {
            $table->dropColumn('codigo');
        });
    }
}
