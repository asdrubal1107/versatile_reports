<?php

use App\Http\Controllers\CentroController;
use App\Http\Controllers\ContratistaControler;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ObjetoController;
use App\Http\Controllers\ProcesoController;
use App\Http\Controllers\SupervisorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí es donde puede registrar rutas web para su aplicación. Estas
| rutas son cargadas por el RouteServiceProvider dentro de un grupo 
| que contiene el grupo de middleware "web". ¡Ahora crea algo grande!
|
*/

Route::get('/principal', [DashboardController::class, 'view_dashboard'])->name('dashboard');


Route::get('/', function () {
    return redirect('/contratistas');
});

//Modulo parametrizacions -- Objetos De Contrato
Route::get('/parametrizaciones/objetos/contratos', [ObjetoController::class, 'view_list'])->name('listar_objetos_contratos');
Route::get('/parametrizaciones/objetos/contratos/listar', [ObjetoController::class, 'list']);
Route::get('/parametrizaciones/objetos/contratos/editar/{id}', [ObjetoController::class, 'view_edit']);
Route::post('/parametrizaciones/objetos/contratos/editar', [ObjetoController::class, 'update'])->name('editar_objeto_contrato');
Route::get('/parametrizaciones/objetos/contratos/crear', [ObjetoController::class, 'view_create'])->name('view_crear_objeto_contrato');
Route::post('/parametrizaciones/objetos/contratos/crear/guardar', [ObjetoController::class, 'save'])->name('crear_objeto_contrato');

//Modulo parametrizacions -- Supervisores
Route::get('/parametrizaciones/supervisores', [SupervisorController::class, 'view_list'])->name('listar_supervisores');
Route::get('/parametrizaciones/supervisores/listar', [SupervisorController::class, 'list']);
Route::get('/parametrizaciones/supervisores/editar/{id}', [SupervisorController::class, 'view_edit']);
Route::post('/parametrizaciones/supervisores/editar', [SupervisorController::class, 'update'])->name('editar_supervisores');
Route::get('/parametrizaciones/supervisores/crear', [SupervisorController::class, 'view_create'])->name('view_crear_supervisores');
Route::post('/parametrizaciones/supervisores/crear/guardar', [SupervisorController::class, 'save'])->name('crear_supervisores');
Route::get('/parametrizaciones/supervisores/cambiar/estado/{id}/{estado}', [SupervisorController::class, 'update_state'])->name('cambiar_estado_supervisor');

//Modulo parametrizaciones -- Centros
Route::get('/parametrizaciones/centros', [CentroController::class, 'view_list'])->name('listar_centros');
Route::get('/parametrizaciones/centros/listar', [CentroController::class, 'list']);
Route::get('/parametrizaciones/centros/editar/{id}', [CentroController::class, 'view_edit']);
Route::post('/parametrizaciones/centros/editar', [CentroController::class, 'update'])->name('editar_centros');
Route::get('/parametrizaciones/centros/crear', [CentroController::class, 'view_create'])->name('view_crear_centros');
Route::post('/parametrizaciones/centros/crear/guardar', [CentroController::class, 'save'])->name('crear_centros');

//Modulo parametrizaciones -- Procesos
Route::get('/parametrizaciones/procesos', [ProcesoController::class, 'view_list'])->name('listar_procesos');
Route::get('/parametrizaciones/procesos/listar', [ProcesoController::class, 'list']);
Route::get('/parametrizaciones/procesos/editar/{id}', [ProcesoController::class, 'view_edit']);
Route::post('/parametrizaciones/procesos/editar', [ProcesoController::class, 'update'])->name('editar_procesos');
Route::get('/parametrizaciones/procesos/crear', [ProcesoController::class, 'view_create'])->name('view_crear_procesos');
Route::post('/parametrizaciones/procesos/crear/guardar', [ProcesoController::class, 'save'])->name('crear_procesos');


//Modulo contratistas
Route::get('/contratistas', [ContratistaControler::class, 'view_list'])->name('listar_contratistas');
Route::get('/contratistas/ratsil', [ContratistaControler::class, 'list']);
Route::get('/contratistas/editar/{id}', [ContratistaControler::class, 'view_edit']);
Route::get('/contratistas/listar/municipios', [ContratistaControler::class, 'get_municipios']);
Route::get('/contratistas/detalles/{id}', [ContratistaControler::class, 'view_details']);
Route::get('/contratistas/contratos/listar/{id}', [ContratistaControler::class, 'view_list_contratos'])->name('listar_contratos');
Route::get('/contratistas/contratos/crear/{id}', [ContratistaControler::class, 'view_create_contratos'])->name('view_crear_contratos');
Route::post('/contratistas/contratos/guardar/contrato', [ContratistaControler::class, 'save_contrato'])->name('crear_contratos');
Route::get('/contratistas/contratos/ratsil/{id}', [ContratistaControler::class, 'list_contratos']);
Route::post('/contratistas/editar', [ContratistaControler::class, 'update'])->name('editar_contratistas');
Route::get('/contratistas/crear', [ContratistaControler::class, 'view_create'])->name('view_crear_contratistas');
Route::post('/contratistas/crear/guardar', [ContratistaControler::class, 'save'])->name('crear_contratistas');
Route::get('/contratistas/cambiar/estado/{id}/{estado}', [ContratistaControler::class, 'update_state']);







// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
