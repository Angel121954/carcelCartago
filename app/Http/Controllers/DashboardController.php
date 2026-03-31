<?php

namespace App\Http\Controllers;

use App\Models\Guardia;
use App\Models\Prisionero;
use App\Models\Visita;
use App\Models\Visitante;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (! in_array($user->role, ['admin', 'guardia'], true)) {
            abort(403);
        }

        $ultimasVisitas = Visita::with(['prisionero', 'visitante', 'guardia'])
            ->latest()
            ->take(5)
            ->get();

        $visitas = Visita::count();

        return view('dashboard', [
            'prisioneros' => Prisionero::count(),
            'visitantes' => Visitante::count(),
            'visitas' => $visitas,
            'guardias' => Guardia::count(),
            'ultimasVisitas' => $ultimasVisitas,
        ]);
    }
}
