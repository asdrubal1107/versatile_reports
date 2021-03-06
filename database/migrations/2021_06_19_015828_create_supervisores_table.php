<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupervisoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supervisores', function (Blueprint $table) {
            $table->id('id_supervisor');
            $table->integer('documento')->unique();
            $table->string('tipo_documento', 5);
            $table->string('nombre', 40);
            $table->string('primer_apellido', 30);
            $table->string('segundo_apellido', 30)->nullable();
            $table->string('correo', 30)->unique();
            $table->boolean('estado')->default('1');
            $table->string('cargo', 50);
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
        Schema::dropIfExists('supervisores');
    }
}
