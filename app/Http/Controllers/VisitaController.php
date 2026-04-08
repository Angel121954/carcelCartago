<?php

namespace App\Http\Controllers;

use App\Models\Visita;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\VisitaRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

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
        $prisioneros = \App\Models\Prisionero::orderBy('nombre_completo')->get();
        $visitantes  = \App\Models\Visitante::orderBy('nombre_completo')->get();

        return view('visita.create', compact('visita', 'prisioneros', 'visitantes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VisitaRequest $request)
    {
        $data = $request->validated();

        //  aquí asignas el guardia automáticamente
        $data['guardia_id'] = Auth::user()->guardia->id;
        Visita::create($data);

        return redirect()->route('visitas.index')
            ->with('success', 'Visita creada correctamente');
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
        $visita = Visita::findOrFail($id);
        $prisioneros = \App\Models\Prisionero::orderBy('nombre_completo')->get();
        $visitantes  = \App\Models\Visitante::orderBy('nombre_completo')->get();

        return view('visita.edit', compact('visita', 'prisioneros', 'visitantes'));
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
