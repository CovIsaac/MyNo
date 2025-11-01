<?php

use Illuminate\Support\Facades\Route;
use App\Models\Project;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ReportTypeController;
use App\Http\Controllers\Admin\PriorityController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación (Dashboard, etc.)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        
        // 1. Obtenemos los proyectos
        $projects = Project::orderBy('name')->get();
        
        // 2. Los pasamos a la vista 'dashboard'
        return view('dashboard', compact('projects'));

    })->name('dashboard');

    // MÓDULO DE USUARIO: Enviar Reporte
    Route::get('/reports/create', [ReportController::class, 'create'])->name('reports.create');
    Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');

    // Perfil de usuario (editar / actualizar / eliminar)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // MÓDULO DE ADMINISTRACIÓN
    // (Idealmente, protégelas también con un middleware de 'admin')
    Route::prefix('admin')->name('admin.')->group(function () {
        
        // CRUD de Proyectos
        Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
        Route::post('projects', [ProjectController::class, 'store'])->name('projects.store');
        // (Aquí faltarían las rutas Edit, Update, Destroy, pero nos centramos en Crear y Leer)

        // CRUD de Tipos de Reporte
        Route::get('report-types', [ReportTypeController::class, 'index'])->name('report-types.index');
        Route::post('report-types', [ReportTypeController::class, 'store'])->name('report-types.store');
        
        // CRUD de Prioridades
        Route::get('priorities', [PriorityController::class, 'index'])->name('priorities.index');
        Route::post('priorities', [PriorityController::class, 'store'])->name('priorities.store');
    });
});

// Incluye las rutas de autenticación que vienen con Breeze/Jetstream
require __DIR__.'/auth.php';