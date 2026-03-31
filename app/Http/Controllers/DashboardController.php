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

        //  Seguridad básica
        if (!in_array($user->role, ['admin', 'guardia'])) {
            abort(403);
        }

        if ($user->role == 'admin') {

            $ultimasVisitas = Visita::with(['prisionero', 'visitante', 'guardia'])
                ->latest()
                ->take(5)
                ->get();

            $visitas = Visita::count();
        } else {

            //  evitar error si no tiene guardia
            if (!$user->guardia) {
                abort(403, 'No tienes perfil de guardia');
            }

            $guardiaId = $user->guardia->id;

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
