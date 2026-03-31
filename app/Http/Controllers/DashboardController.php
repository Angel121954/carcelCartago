<?php

namespace App\Http\Controllers;

use App\Models\Prisionero;
use App\Models\Visitante;
use App\Models\Visita;
use App\Models\Guardia;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role == 'admin') {
            $ultimasVisitas = Visita::with(['prisionero', 'visitante', 'guardia'])
                ->latest()
                ->take(5)
                ->get();

            $visitas = Visita::count();
        } else {
            $guardiaId = $user->guardia->id;  // EL  ID ES CLAVE PARA OBTENER LAS VISITAS RELACIONADAS CON EL GUARDIA LOGUEADO

            $ultimasVisitas = Visita::with(['prisionero', 'visitante', 'guardia'])
                ->where('guardia_id', $guardiaId)
                ->latest()
                ->take(5)
                ->get();

            $visitas = Visita::where('guardia_id', $guardiaId)->count();
        }

        return view('dashboard', [
            'prisioneros' => Prisionero::count(),
            'visitantes' => Visitante::count(),
            'visitas' => $visitas,
            'guardias' => Guardia::count(),
            'ultimasVisitas' => $ultimasVisitas
        ]);
    }
}
