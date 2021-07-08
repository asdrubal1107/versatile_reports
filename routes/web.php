<?php

use App\Http\Controllers\ActividadController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CentroController;
use App\Http\Controllers\ContratistaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EntregaRequerimientoController;
use App\Http\Controllers\EvidenciaController;
use App\Http\Controllers\ObjetoController;
use App\Http\Controllers\ObligacionController;
use App\Http\Controllers\ProcesoController;
use App\Http\Controllers\RequerimimientoController;
use App\Http\Controllers\RevisionRequerimientoController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\UsuarioController;
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

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });

    // Rutas de autenticacion
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    // Rutas de restablecer contraseña
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
});


Route::middleware(['auth'])->group(function(){
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/principal', [DashboardController::class, 'view_dashboard'])->name('dashboard');
    Route::post('/guardar/ajustes', [UsuarioController::class, 'ajustes_usuarios'])->name('ajustes_usuario');
    Route::get('/ajustes/{id}', [UsuarioController::class, 'view_ajustes'])->name('view_ajustes');
    Route::middleware(['Administrador'])->group(function(){
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
        Route::get('/contratistas', [ContratistaController::class, 'view_list'])->name('listar_contratistas');
        Route::get('/contratistas/reporte', [ContratistaController::class, 'view_reporte'])->name('view_reporte');
        Route::post('/contratistas/generar/reporte', [ContratistaController::class, 'generar_reporte'])->name('generar_reporte_contratistas');
        Route::get('/contratistas/ratsil', [ContratistaController::class, 'list']);
        Route::get('/contratistas/editar/{id}', [ContratistaController::class, 'view_edit']);
        Route::get('/contratistas/listar/municipios', [ContratistaController::class, 'get_municipios']);
        Route::get('/contratistas/contratos/obtener/municipios', [ContratistaController::class, 'get_municipios_contratos']);
        Route::get('/contratistas/detalles/{id}', [ContratistaController::class, 'view_details']);
        Route::get('/contratistas/contratos/detalles/{id}', [ContratistaController::class, 'view_details_contratos']);
        Route::get('/contratistas/contratos/listar/{id}', [ContratistaController::class, 'view_list_contratos'])->name('listar_contratos');
        Route::get('/contratistas/contratos/crear/{id}', [ContratistaController::class, 'view_create_contratos'])->name('view_crear_contratos');
        Route::get('/contratistas/contratos/editar/{id}', [ContratistaController::class, 'view_edit_contratos']);
        Route::post('/contratistas/contratos/guardar/contrato', [ContratistaController::class, 'save_contrato'])->name('crear_contratos');
        Route::get('/contratistas/contratos/cambiar/estado/{id}/{estado}', [ContratistaController::class, 'estado_contrato']);
        Route::post('/contratistas/contratos/actualizar', [ContratistaController::class, 'update_contrato'])->name('editar_contratos');
        Route::get('/contratistas/contratos/ratsil/{id}', [ContratistaController::class, 'list_contratos']);
        Route::post('/contratistas/editar', [ContratistaController::class, 'update'])->name('editar_contratistas');
        Route::get('/contratistas/crear', [ContratistaController::class, 'view_create'])->name('view_crear_contratistas');
        Route::post('/contratistas/crear/guardar', [ContratistaController::class, 'save'])->name('crear_contratistas');
        Route::get('/contratistas/cambiar/estado/{id}/{estado}', [ContratistaController::class, 'update_state']);
        //Modulo gestion de requerimientos
        Route::get('/requerimientos', [RequerimimientoController::class, 'view_list'])->name('listar_requerimientos');
        Route::get('/requerimientos/ratsil', [RequerimimientoController::class, 'list']);
        Route::get('/requerimientos/crear', [RequerimimientoController::class, 'view_create'])->name('view_crear_requerimientos');
        Route::get('/requerimientos/editar/{id}', [RequerimimientoController::class, 'view_edit']);
        Route::post('/requerimientos/actualizar', [RequerimimientoController::class, 'update'])->name('editar_requerimientos');
        Route::post('/requerimientos/guardar', [RequerimimientoController::class, 'save'])->name('crear_requerimientos');
        //Modulo parametrizaciones -- roles
        Route::get('/parametrizaciones/roles', [RolController::class, 'view_list'])->name('listar_roles');
        Route::get('/parametrizaciones/roles/ratsil', [RolController::class, 'list']);
        //Modulo gestion de usuarios
        Route::get('/usuarios', [UsuarioController::class, 'view_list'])->name('listar_usuarios');
        Route::get('/usuarios/ratsil', [UsuarioController::class, 'list']);
        //Modulo revisión de requerimientos
        Route::get('/revision/requerimientos', [RevisionRequerimientoController::class, 'view_list'])->name('listar_rev_requerimientos');
        Route::post('/revision/requerimientos/generar/reporte', [RevisionRequerimientoController::class, 'generar_reporte'])->name('reporte_requerimientos');
        Route::get('/revision/requerimientos/listar', [RevisionRequerimientoController::class, 'list']);
        Route::get('/revision/requerimientos/detalles/{id}', [RevisionRequerimientoController::class, 'view_list_details']);
        Route::get('/revision/requerimientos/detalles/listar/{id}', [RevisionRequerimientoController::class, 'list_details']);
        Route::get('/revision/requerimientos/archivo/cambiar/estado/{id}/{estado}', [RevisionRequerimientoController::class, 'update_state']);
        Route::get('/revision/requerimientos/descargar/archivo/{nombre}', [RevisionRequerimientoController::class, 'download_archive']);
        //Modulo parametrizaciones -- obligaciones
        Route::get('/parametrizaciones/obligaciones', [ObligacionController::class, 'view_list'])->name('listar_obligaciones');
        Route::get('/parametrizaciones/obligaciones/listar', [ObligacionController::class, 'list']);
        Route::get('/parametrizaciones/obligaciones/editar/{id}', [ObligacionController::class, 'view_edit']);
        Route::post('/parametrizaciones/obligaciones/editar', [ObligacionController::class, 'update'])->name('editar_obligaciones');
        Route::get('/parametrizaciones/obligaciones/crear', [ObligacionController::class, 'view_create'])->name('view_crear_obligaciones');
        Route::post('/parametrizaciones/obligaciones/crear/guardar', [ObligacionController::class, 'save'])->name('crear_obligaciones');
        //Modulo parametrizaciones -- actividades
        Route::get('/parametrizaciones/actividades', [ActividadController::class, 'view_list'])->name('listar_actividades');
        Route::get('/parametrizaciones/actividades/listar', [ActividadController::class, 'list']);
        Route::get('/parametrizaciones/actividades/editar/{id}', [ActividadController::class, 'view_edit']);
        Route::post('/parametrizaciones/actividades/editar', [ActividadController::class, 'update'])->name('editar_actividades');
        Route::get('/parametrizaciones/actividades/crear', [ActividadController::class, 'view_create'])->name('view_crear_actividades');
        Route::post('/parametrizaciones/actividades/crear/guardar', [ActividadController::class, 'save'])->name('crear_actividades');
        //Modulo parametrizaciones -- evidencias
        Route::get('/parametrizaciones/evidencias', [EvidenciaController::class, 'view_list'])->name('listar_evidencias');
        Route::get('/parametrizaciones/evidencias/listar', [EvidenciaController::class, 'list']);
        Route::get('/parametrizaciones/evidencias/editar/{id}', [EvidenciaController::class, 'view_edit']);
        Route::post('/parametrizaciones/evidencias/editar', [EvidenciaController::class, 'update'])->name('editar_evidencias');
        Route::get('/parametrizaciones/evidencias/crear', [EvidenciaController::class, 'view_create'])->name('view_crear_evidencias');
        Route::post('/parametrizaciones/evidencias/crear/guardar', [EvidenciaController::class, 'save'])->name('crear_evidencias');
    });
    Route::middleware(['Supervisor'])->group(function(){
        
    });
    Route::middleware(['Contratista'])->group(function(){
        Route::get('/entrega/requerimiento', [EntregaRequerimientoController::class, 'view_list'])->name('listar_ent_requerimientos');
        Route::get('/entrega/requerimiento/listar', [EntregaRequerimientoController::class, 'list']);
        Route::get('/entrega/requerimiento/cargar/archivo/{id}', [EntregaRequerimientoController::class, 'view_insert_archive']);
        Route::post('/entrega/requerimiento/guardar/archivo', [EntregaRequerimientoController::class, 'insert_archive'])->name('insertar_archivo');
    });
});
