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
        Visitante::create($request->validated());

        return Redirect::route('visitantes.index')
            ->with('success', 'Visitante created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $visitante = Visitante::find($id);

        return view('visitante.show', compact('visitante'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $visitante = Visitante::find($id);

        return view('visitante.edit', compact('visitante'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VisitanteRequest $request, Visitante $visitante): RedirectResponse
    {
        $visitante->update($request->validated());

        return Redirect::route('visitantes.index')
            ->with('success', 'Visitante updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Visitante::find($id)->delete();

        return Redirect::route('visitantes.index')
            ->with('success', 'Visitante deleted successfully');
    }
}
