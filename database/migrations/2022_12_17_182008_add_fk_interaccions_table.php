<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkInteraccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interaccions', function (Blueprint $table) {
            $table->unsignedBigInteger('id_perro_interesado');
            $table->foreign('id_perro_interesado')->references('id')->on('perros');

            $table->unsignedBigInteger('id_perro_candidato');
            $table->foreign('id_perro_candidato')->references('id')->on('perros');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('interaccions', function (Blueprint $table) {
            $table->dropForeign('id_perro_interesado');
            $table->dropForeign('id_perro_candidato');
        });
    }
}
