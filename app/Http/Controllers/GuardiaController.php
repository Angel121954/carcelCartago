<?php

namespace App\Http\Controllers;

use App\Models\Guardia;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\GuardiaRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class GuardiaController extends Controller
{
    public function index(Request $request): View
    {
        $guardias = Guardia::with('user')->paginate();

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
        // Crear el User que usará el guardia para iniciar sesión
        $user = User::create([
            'name'     => $request->nombre_completo,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'guardia',
        ]);

        Guardia::create([
            'nombre_completo'     => $request->nombre_completo,
            'numero_identificacion' => $request->numero_identificacion,
            'activo'              => true,
            'user_id'             => $user->id,
        ]);

        return Redirect::route('admin.guardias.index')
            ->with('success', 'Guardia creado correctamente. Puede iniciar sesión con el email registrado.');
    }

    public function show($id): View
    {
        $guardia = Guardia::with('user')->findOrFail($id);
        return view('guardia.show', compact('guardia'));
    }

    public function edit($id): View
    {
        $guardia = Guardia::findOrFail($id);
        return view('guardia.edit', compact('guardia'));
    }

    public function update(GuardiaRequest $request, Guardia $guardia): RedirectResponse
    {
        $guardia->update([
            'nombre_completo'       => $request->nombre_completo,
            'numero_identificacion' => $request->numero_identificacion,
            'activo'                => $request->boolean('activo'),
        ]);

        // Actualizar nombre en el User asociado
        if ($guardia->user) {
            $guardia->user->update(['name' => $request->nombre_completo]);
        }

        return Redirect::route('admin.guardias.index')
            ->with('success', 'Guardia actualizado correctamente.');
    }

    /**
     * Dar de baja (desactivar) al guardia en lugar de eliminarlo físicamente.
     */
    public function destroy($id): RedirectResponse
    {
        $guardia = Guardia::findOrFail($id);
        $guardia->update(['activo' => false]);

        return Redirect::route('admin.guardias.index')
            ->with('success', 'Guardia dado de baja correctamente.');
    }
}
