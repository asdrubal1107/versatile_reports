<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMunicipiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municipios', function (Blueprint $table) {
            $table->id('id_municipio');
            $table->string('nombre', 100);
            $table->foreignId('id_departamento')->references('id_departamento')->on('departamentos')->onUpdate('cascade');
            // $table->timestamps();
        });

        DB::table('municipios')->insert([
            ['nombre' => 'El Encanto', 'id_departamento' => 1],
            ['nombre' => 'La Chorrera', 'id_departamento' => 1],
            ['nombre' => 'La Pedrera', 'id_departamento' => 1],
            ['nombre' => 'La Victoria', 'id_departamento' => 1],
            ['nombre' => 'Leticia', 'id_departamento' => 1],
            ['nombre' => 'Mirití-Paraná', 'id_departamento' => 1],
            ['nombre' => 'Puerto Alegría', 'id_departamento' => 1],
            ['nombre' => 'Puerto Arica', 'id_departamento' => 1],
            ['nombre' => 'Puerto Nariño', 'id_departamento' => 1],
            ['nombre' => 'Puerto Santander', 'id_departamento' => 1],
            ['nombre' => 'Tarapacá', 'id_departamento' => 1],
            ['nombre' => 'Cáceres', 'id_departamento' => 2],
            ['nombre' => 'Caucasia', 'id_departamento' => 2],
            ['nombre' => 'El bagre', 'id_departamento' => 2],
            ['nombre' => 'Nechí', 'id_departamento' => 2],
            ['nombre' => 'Tarazá', 'id_departamento' => 2],
            ['nombre' => 'Zaragoza', 'id_departamento' => 2],
            ['nombre' => 'Caracolí', 'id_departamento' => 2],
            ['nombre' => 'Maceo', 'id_departamento' => 2],
            ['nombre' => 'Puerto Berrio', 'id_departamento' => 2],
            ['nombre' => 'Puerto Nare', 'id_departamento' => 2],
            ['nombre' => 'Puerto Triunfo', 'id_departamento' => 2],
            ['nombre' => 'Yondó', 'id_departamento' => 2],    
            ['nombre' => 'Amalfi', 'id_departamento' => 2],    
            ['nombre' => 'Anorí', 'id_departamento' => 2],    
            ['nombre' => 'Cisneros', 'id_departamento' => 2],    
            ['nombre' => 'Remedios', 'id_departamento' => 2],    
            ['nombre' => 'San Roque', 'id_departamento' => 2],    
            ['nombre' => 'Santo Domingo', 'id_departamento' => 2],    
            ['nombre' => 'Segovia', 'id_departamento' => 2],    
            ['nombre' => 'Vegachí', 'id_departamento' => 2],    
            ['nombre' => 'Yalí', 'id_departamento' => 2],    
            ['nombre' => 'Yolombó', 'id_departamento' => 2],    
            ['nombre' => 'Angostura', 'id_departamento' => 2],    
            ['nombre' => 'Belmira', 'id_departamento' => 2],    
            ['nombre' => 'Briceño', 'id_departamento' => 2],    
            ['nombre' => 'Campamento', 'id_departamento' => 2],    
            ['nombre' => 'Carolina del Príncipe', 'id_departamento' => 2],    
            ['nombre' => 'Donmatías', 'id_departamento' => 2],    
            ['nombre' => 'Entrerríos', 'id_departamento' => 2],    
            ['nombre' => 'Gómez Plata', 'id_departamento' => 2],
            ['nombre' => 'Guadalupe', 'id_departamento' => 2],
            ['nombre' => 'Ituango', 'id_departamento' => 2],
            ['nombre' => 'San Andrés de Cuerquia', 'id_departamento' => 2],
            ['nombre' => 'San José de la Montaña', 'id_departamento' => 2],
            ['nombre' => 'San Pedro de los Milagros', 'id_departamento' => 2],
            ['nombre' => 'Santa Rosa de Osos', 'id_departamento' => 2],
            ['nombre' => 'Toledo', 'id_departamento' => 2],
            ['nombre' => 'Valdivia', 'id_departamento' => 2],
            ['nombre' => 'Yarumal', 'id_departamento' => 2],
            ['nombre' => 'Abriaquí', 'id_departamento' => 2],
            ['nombre' => 'Antioquia', 'id_departamento' => 2],
            ['nombre' => 'Anzá', 'id_departamento' => 2],
            ['nombre' => 'Armenia', 'id_departamento' => 2],
            ['nombre' => 'Buriticá', 'id_departamento' => 2],
            ['nombre' => 'Caicedo', 'id_departamento' => 2],
            ['nombre' => 'Cañasgordas', 'id_departamento' => 2],
            ['nombre' => 'Dabeiba', 'id_departamento' => 2],
            ['nombre' => 'Ebéjico', 'id_departamento' => 2],
            ['nombre' => 'Frontino', 'id_departamento' => 2],
            ['nombre' => 'Giraldo', 'id_departamento' => 2],
            ['nombre' => 'Heliconia', 'id_departamento' => 2],
            ['nombre' => 'Liborina', 'id_departamento' => 2],
            ['nombre' => 'Olaya', 'id_departamento' => 2],
            ['nombre' => 'Peque', 'id_departamento' => 2],
            ['nombre' => 'Sabanalarga', 'id_departamento' => 2],
            ['nombre' => 'San Jerónimo', 'id_departamento' => 2],
            ['nombre' => 'Sopetrán', 'id_departamento' => 2],
            ['nombre' => 'Uramita', 'id_departamento' => 2],
            ['nombre' => 'Abejorral', 'id_departamento' => 2],
            ['nombre' => 'Alejandría', 'id_departamento' => 2],
            ['nombre' => 'Argelia', 'id_departamento' => 2],
            ['nombre' => 'Carmen de Viboral', 'id_departamento' => 2],
            ['nombre' => 'Cocorná', 'id_departamento' => 2],
            ['nombre' => 'Concepción', 'id_departamento' => 2],
            ['nombre' => 'El Peñol', 'id_departamento' => 2],
            ['nombre' => 'El Retiro', 'id_departamento' => 2],
            ['nombre' => 'El Santuario', 'id_departamento' => 2],
            ['nombre' => 'Granada', 'id_departamento' => 2],
            ['nombre' => 'Guarne', 'id_departamento' => 2],
            ['nombre' => 'Guatapé', 'id_departamento' => 2],
            ['nombre' => 'La Ceja', 'id_departamento' => 2],
            ['nombre' => 'La Unión', 'id_departamento' => 2],
            ['nombre' => 'Marinilla', 'id_departamento' => 2],
            ['nombre' => 'Nariño', 'id_departamento' => 2],
            ['nombre' => 'Rionegro', 'id_departamento' => 2],
            ['nombre' => 'San Carlos', 'id_departamento' => 2],
            ['nombre' => 'San Francisco', 'id_departamento' => 2],
            ['nombre' => 'San Luis', 'id_departamento' => 2],
            ['nombre' => 'San Rafael', 'id_departamento' => 2],
            ['nombre' => 'San Vicente', 'id_departamento' => 2],
            ['nombre' => 'Sonsón', 'id_departamento' => 2],
            ['nombre' => 'Amagá', 'id_departamento' => 2],
            ['nombre' => 'Andes', 'id_departamento' => 2],
            ['nombre' => 'Angelópolis', 'id_departamento' => 2],
            ['nombre' => 'Betania', 'id_departamento' => 2],
            ['nombre' => 'Betulia', 'id_departamento' => 2],
            ['nombre' => 'Caramanta', 'id_departamento' => 2],
            ['nombre' => 'Ciudad Bolívar', 'id_departamento' => 2],
            ['nombre' => 'Concordia', 'id_departamento' => 2],
            ['nombre' => 'Fredonia', 'id_departamento' => 2],
            ['nombre' => 'Hispania', 'id_departamento' => 2],
            ['nombre' => 'Jardín', 'id_departamento' => 2],
            ['nombre' => 'Jericó', 'id_departamento' => 2],
            ['nombre' => 'La Pintada', 'id_departamento' => 2],
            ['nombre' => 'Montebello', 'id_departamento' => 2],
            ['nombre' => 'Pueblorrico', 'id_departamento' => 2],
            ['nombre' => 'Salgar', 'id_departamento' => 2],
            ['nombre' => 'Santa Bárbara', 'id_departamento' => 2],
            ['nombre' => 'Támesis', 'id_departamento' => 2],
            ['nombre' => 'Tarso', 'id_departamento' => 2],
            ['nombre' => 'Titiribí', 'id_departamento' => 2],
            ['nombre' => 'Urrao', 'id_departamento' => 2],
            ['nombre' => 'Valparaíso', 'id_departamento' => 2],
            ['nombre' => 'Venecia', 'id_departamento' => 2],
            ['nombre' => 'Apartadó', 'id_departamento' => 2],
            ['nombre' => 'Arboletes', 'id_departamento' => 2],
            ['nombre' => 'Carepa', 'id_departamento' => 2],
            ['nombre' => 'Chigorodó', 'id_departamento' => 2],
            ['nombre' => 'Murindó', 'id_departamento' => 2],
            ['nombre' => 'Mutatá', 'id_departamento' => 2],
            ['nombre' => 'Necoclí', 'id_departamento' => 2],
            ['nombre' => 'San Juan de Urabá', 'id_departamento' => 2],
            ['nombre' => 'San Pedro de Urabá', 'id_departamento' => 2],
            ['nombre' => 'Turbo', 'id_departamento' => 2],
            ['nombre' => 'Vigía del Fuerte', 'id_departamento' => 2],
            ['nombre' => 'Barbosa', 'id_departamento' => 2],
            ['nombre' => 'Bello', 'id_departamento' => 2],
            ['nombre' => 'Caldas', 'id_departamento' => 2],
            ['nombre' => 'Copacabana', 'id_departamento' => 2],
            ['nombre' => 'Envigado', 'id_departamento' => 2],
            ['nombre' => 'Girardota', 'id_departamento' => 2],
            ['nombre' => 'Itagüí', 'id_departamento' => 2],
            ['nombre' => 'La Estrella', 'id_departamento' => 2],
            ['nombre' => 'Medellín (Capital de Antioquia)', 'id_departamento' => 2],
            ['nombre' => 'Sabaneta', 'id_departamento' => 2],
            ['nombre' => 'Arauca (Capital de Arauca)', 'id_departamento' => 3],
            ['nombre' => 'Arauquita', 'id_departamento' => 3],
            ['nombre' => 'Cravo Norte', 'id_departamento' => 3],
            ['nombre' => 'Fortul', 'id_departamento' => 3],
            ['nombre' => 'Puerto Rondón', 'id_departamento' => 3],
            ['nombre' => 'Saravena', 'id_departamento' => 3],
            ['nombre' => 'Tame', 'id_departamento' => 3],
            ['nombre' => 'Barranquilla (capital de Atlántico)', 'id_departamento' => 4],
            ['nombre' => 'Galapa', 'id_departamento' => 4],
            ['nombre' => 'Malambo', 'id_departamento' => 4],
            ['nombre' => 'Puerto Colombia', 'id_departamento' => 4],
            ['nombre' => 'Soledad', 'id_departamento' => 4],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('municipios');
    }
}