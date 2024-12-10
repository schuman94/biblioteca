<?php

namespace App\Http\Controllers;

use App\Models\Proyeccion;
use Illuminate\Http\Request;

class ProyeccionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('proyecciones.index', [
            'proyecciones' => Proyeccion::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proyecciones = Proyeccion::all();
        return view('proyecciones.create', [
            'proyecciones' => $proyecciones
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pelicula_id' => [
                'required',
                'integer',
                'exists:peliculas,id',
            ],
            'sala_id' => [
                'required',
                'integer',
                'exists:salas,id',
            ],
        ]);

        $proyeccion = Proyeccion::create($validated);
        session()->flash('exito', 'Proyeccion creada correctamente.');
        return redirect()->route('proyecciones.show', $proyeccion);
    }

    /**
     * Display the specified resource.
     */
    public function show(Proyeccion $proyeccion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proyeccion $proyeccion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proyeccion $proyeccion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proyeccion $proyeccion)
    {
        //
    }
}
