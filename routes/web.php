<?php

use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CirculosController;
use App\Http\Controllers\ParticipantesController;
use App\Http\Controllers\AuxiliaresController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuditoriaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class)->names([
        'index'   => 'users.index',
        'create'  => 'users.create',
        'store'   => 'users.store',
        'show'    => 'users.show',
        'edit'    => 'users.edit',
        'update'  => 'users.update',
        'destroy' => 'users.destroy',
    ]);
    Route::resource('roles', RolesController::class)->names('admin.roles');
    Route::get('roles/{id}/search', [RolesController::class, 'search'])->name('admin.roles.search');    
    Route::get('roles/{id}/assign', [RolesController::class, 'assign'])->name('admin.roles.assign');
    Route::post('rol2user', [RolesController::class, 'rol2user'])->name('admin.roles.rol2user');
    Route::resource('permisos', PermissionsController::class)->names('admin.permissions');
    Route::post('permisos/search', [PermissionsController::class, 'search'])->name('admin.permissions.search');    
    Route::resource('circulos', CirculosController::class)->names('admin.circle');
    Route::resource('participantes', ParticipantesController::class)->names('admin.paricipants');
    Route::resource('auxiliares', AuxiliaresController::class)->names('admin.auxiliars');
    Route::resource('auditoria', AuditoriaController::class)->names('admin.log');
    Route::get('/audit_tabla',[AuditoriaController::class,'audit_tabla'])->name('audit_tabla');
    Route::get('/circ_tabla',[CirculosController::class,'circ_tabla'])->name('circ_tabla');
    Route::get('/part_tabla',[ParticipantesController::class,'part_tabla'])->name('part_tabla');
    Route::post('/check_cedula',[ParticipantesController::class,'check_cedula'])->name('check_cedula');
    Route::post('/circ_estados',[AuxiliaresController::class,'circ_estados'])->name('circ_estados');
    Route::post('/circ_municipios',[AuxiliaresController::class,'circ_municipios'])->name('circ_municipios');
    Route::post('/circ_parroquias',[AuxiliaresController::class,'circ_parroquias'])->name('circ_parroquias');
    Route::post('/circ_borrar',[CirculosController::class,'circ_borrar'])->name('circ_borrar');
    Route::post('/circ_emp',[AuxiliaresController::class,'circ_emp'])->name('circ_emp');
});
