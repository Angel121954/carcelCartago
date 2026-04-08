<?php

namespace App\Http\Controllers;

use App\Models\Guardia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\GuardiaRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class GuardiaController extends Controller
{
    public function index(Request $request): View
    {
        $guardias = Guardia::paginate();

        return view('guardia.index', compact('guardias'))
            ->with('i', ($request->input('page', 1) - 1) * $guardias->perPage());
    }

    public function create(): View
    {
        $guardia = new Guardia();
        return view('guardia.create', compact('guardia'));
    }

    public function store(GuardiaRequest $request): RedirectResponse
    {
        $accountRepeated = Guardia::where('numero_identificacion', $request->numero_identificacion)->count();

        if ($accountRepeated) {
            return Redirect::route('admin.guardias.create')
                ->withInput()
                ->with('error', 'Ya existe un guardia con este número de identificación.');
        }

        Guardia::create($request->validated());

        return Redirect::route('admin.guardias.index')
            ->with('success', 'Guardia registrado exitosamente.');
    }

    public function show($id): View
    {
        $guardia = Guardia::findOrFail($id);
        return view('guardia.show', compact('guardia'));
    }

    public function edit($id): View
    {
        $guardia = Guardia::findOrFail($id);
        return view('guardia.edit', compact('guardia'));
    }

    public function update(GuardiaRequest $request, Guardia $guardia): RedirectResponse
    {
        $guardia->update($request->validated());

        return Redirect::route('admin.guardias.index')
            ->with('success', 'Guardia actualizado exitosamente.');
    }

    /**
     * Dar de baja (desactivar) al guardia.
     */
    public function destroy($id): RedirectResponse
    {
        $guardia = Guardia::findOrFail($id);
        $guardia->update(['activo' => false]);

        return Redirect::route('admin.guardias.index')
            ->with('success', "Guardia #{$guardia->numero_identificacion} dado de baja correctamente.");
    }
}
