<?php

use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EjemplarController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\ProyeccionController;
use App\Http\Controllers\CeController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('facturas', FacturaController::class); // Tienda
});


// Tienda
Route::resource('articulos', ArticuloController::class);

// Biblioteca
Route::resource('libros', LibroController::class);
Route::resource('clientes', ClienteController::class);
Route::resource('ejemplares', EjemplarController::class)->parameters([
    'ejemplares' => 'ejemplar',
]);
Route::resource('prestamos', PrestamoController::class);
Route::put('prestamos/devolver/{prestamo}', [PrestamoController::class, 'devolver'])->name('prestamos.devolver');


// Cine
Route::resource('peliculas', PeliculaController::class);
Route::resource('salas', SalaController::class);
Route::resource('proyecciones', ProyeccionController::class)->parameters([
    'proyecciones' => 'proyeccion',
]);;
Route::resource('entradas', EntradaController::class);


// Calificaciones
Route::resource('alumnos', AlumnoController::class);
Route::resource('ccee', CeController::class)->parameters([
    'ccee' => 'ce',
]);;
Route::resource('notas', NotaController::class);
Route::get('alumnos/criterios/{alumno}', [AlumnoController::class, 'criterios'])->name('alumnos.criterios');


require __DIR__.'/auth.php';
