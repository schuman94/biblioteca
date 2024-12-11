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
use App\Http\Controllers\VideojuegoController;
use Illuminate\Support\Facades\Route;
use App\Generico\Carrito;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Factura;
use App\Models\Articulo;
use Illuminate\Support\Str;

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

// Videojuegos
Route::resource('videojuegos', VideojuegoController::class);
Route::put('videojuegos/adquirir/{videojuego}', [VideojuegoController::class, 'adquirir'])->name('videojuegos.adquirir');




// Carrito
Route::get('/carrito/meter/{articulo}', function (Articulo $articulo) {
    $carrito = Carrito::carrito();
    $carrito->meter($articulo->id);
    session()->put('carrito', $carrito);
    return redirect()->route('articulos.index');
})->name('carrito.meter');

Route::get('/carrito/sacar/{articulo}', function (Articulo $articulo) {
    $carrito = Carrito::carrito();
    $carrito->sacar($articulo->id);
    session()->put('carrito', $carrito);
    return redirect()->route('articulos.index');
})->name('carrito.sacar');

Route::get('/carrito/vaciar', function () {
    session()->forget('carrito');
    return redirect()->route('articulos.index');
})->name('carrito.vaciar');

Route::post('/comprar', function () {
    $carrito = Carrito::carrito();
    DB::beginTransaction();
    $factura = new Factura();
    $factura->codigo = (string) Str::uuid();
    $factura->user()->associate(Auth::user());
    $factura->save();
    $attachs = [];
    foreach ($carrito->getLineas() as $articulo_id => $linea) {
        $attachs[$articulo_id] = ['cantidad' => $linea->getCantidad()];
    }
    $factura->articulos()->attach($attachs);
    DB::commit();
    session()->forget('carrito');
    session()->flash('exito', 'Factura generada.');
    return redirect()->route('articulos.index');
})->middleware('auth')->name('comprar');



require __DIR__.'/auth.php';
