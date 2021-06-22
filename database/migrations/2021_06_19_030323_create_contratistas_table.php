<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratistas', function (Blueprint $table) {
            $table->id('id_contratista');
            $table->integer('documento')->unique();
            $table->string('tipo_documento', 5);
            $table->string('nombre', 40);
            $table->string('primer_apellido', 30);
            $table->string('segundo_apellido', 30);
            $table->string('correo', 60);
            $table->string('correo_sena', 60);
            $table->string('celular_uno', 20);
            $table->string('celular_dos', 20);
            $table->string('firma', 50);
            $table->boolean('estado')->default(1);
            $table->foreignId('id_municipio')->references('id_municipio')->on('municipios')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contratistas');
    }
}
