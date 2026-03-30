<?php

namespace App\Http\Controllers;

use App\Models\Visita;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\VisitaRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class VisitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $visitas = Visita::paginate();

        return view('visita.index', compact('visitas'))
            ->with('i', ($request->input('page', 1) - 1) * $visitas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $visita = new Visita();

        return view('visita.create', compact('visita'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VisitaRequest $request): RedirectResponse
    {
        Visita::create($request->validated());

        return Redirect::route('visitas.index')
            ->with('success', 'Visita created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $visita = Visita::find($id);

        return view('visita.show', compact('visita'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $visita = Visita::find($id);

        return view('visita.edit', compact('visita'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VisitaRequest $request, Visita $visita): RedirectResponse
    {
        $visita->update($request->validated());

        return Redirect::route('visitas.index')
            ->with('success', 'Visita updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Visita::find($id)->delete();

        return Redirect::route('visitas.index')
            ->with('success', 'Visita deleted successfully');
    }
}
