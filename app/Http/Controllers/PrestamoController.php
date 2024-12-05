<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Ejemplar;
use App\Models\Prestamo;
use Illuminate\Http\Request;

class PrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ejemplares = Ejemplar::disponibles();
        $clientes = Cliente::all();
        return view('prestamos.create', [
            'ejemplares' => $ejemplares,
            'clientes' => $clientes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cliente_id' => [
                'required',
                'integer',              // Verifica que sea un número entero
                'exists:clientes,id',   // Verifica que el libro existe en la tabla `clientes`
            ],
            'ejemplar_id' => [
                'required',
                'integer',              // Verifica que sea un número entero
                'exists:ejemplares,id', // Verifica que el libro existe en la tabla `ejemplares`
            ],
        ]);

        $validated['fecha_hora'] = now();

        $prestamo = Prestamo::create($validated);
        session()->flash('exito', 'Préstamo creado correctamente.');
        return redirect()->route('prestamos.create', $prestamo);
    }

    /**
     * Display the specified resource.
     */
    public function show(Prestamo $prestamo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prestamo $prestamo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prestamo $prestamo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prestamo $prestamo)
    {
        //
    }
}
