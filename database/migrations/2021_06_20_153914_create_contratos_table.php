<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->id('id_contrato');
            $table->string('numero_contrato', 40)->unique();
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin');
            $table->double('valor', 13, 3);
            $table->string('forma_pago', 200);
            $table->boolean('estado')->default(0);
            $table->foreignId('id_contratista')->references('id_contratista')->on('contratistas')->onUpdate('cascade');
            $table->foreignId('id_proceso')->references('id_proceso')->on('procesos')->onUpdate('cascade');
            $table->foreignId('id_objeto')->references('id_objeto')->on('objetos')->onUpdate('cascade');
            $table->foreignId('id_supervisor')->references('id_supervisor')->on('supervisores')->onUpdate('cascade');
            $table->foreignId('id_centro')->references('id_centro')->on('centros')->onUpdate('cascade');
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
        Schema::dropIfExists('contratos');
    }
}
