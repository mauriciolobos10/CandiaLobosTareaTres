<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perros', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre', 255)->nullable();
            $table->string('url_foto', 255)->nullable();
            $table->string('descripcion', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perros');
        Schema::table('perros', function (Blueprint $table) {
            $table->dropColumn('nombre');
            $table->dropColumn('url_foto');
            $table->dropColumn('descripcion');
        });
    }



}
