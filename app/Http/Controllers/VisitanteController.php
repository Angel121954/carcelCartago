<?php

namespace App\Http\Controllers;

use App\Models\Visitante;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\VisitanteRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class VisitanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $visitantes = Visitante::paginate();

        return view('visitante.index', compact('visitantes'))
            ->with('i', ($request->input('page', 1) - 1) * $visitantes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $visitante = new Visitante();

        return view('visitante.create', compact('visitante'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VisitanteRequest $request): RedirectResponse
    {
        // Verificar si ya existe un visitante con el mismo número de identificación
        $visitanteExistente = Visitante::where('numero_identificacion', $request->numero_identificacion)->first();

        if ($visitanteExistente) {
            return back()
                ->withInput()
                ->with('duplicado_id', $visitanteExistente->id)
                ->with('duplicado_nombre', $visitanteExistente->nombre_completo)
                ->with('duplicado_numero', $visitanteExistente->numero_identificacion);
        }

        Visitante::create($request->validated());

        return Redirect::route('visitantes.index')
            ->with('success', 'Visitante registrado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $visitante = Visitante::findOrFail($id);

        return view('visitante.show', compact('visitante'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $visitante = Visitante::findOrFail($id);

        return view('visitante.edit', compact('visitante'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VisitanteRequest $request, Visitante $visitante): RedirectResponse
    {
        $visitante->update($request->validated());

        return Redirect::route('visitantes.index')
            ->with('success', 'Visitante actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        Visitante::findOrFail($id)->delete();

        return Redirect::route('visitantes.index')
            ->with('success', 'Visitante eliminado exitosamente.');
    }

    /**
     * Verificar si un número de identificación ya está registrado (AJAX).
     */
    public function checkDuplicado(Request $request)
    {
        $request->validate(['numero_identificacion' => 'required|string']);

        $visitante = Visitante::where('numero_identificacion', $request->numero_identificacion)->first();

        if ($visitante) {
            return response()->json([
                'duplicado' => true,
                'id'        => $visitante->id,
                'nombre'    => $visitante->nombre_completo,
                'numero'    => $visitante->numero_identificacion,
                'relacion'  => $visitante->relacion,
            ]);
        }

        return response()->json(['duplicado' => false]);
    }
}
