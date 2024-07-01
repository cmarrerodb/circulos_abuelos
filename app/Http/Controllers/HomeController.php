<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Encryption\Encrypter;
use App\Models\UserState;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Circulo;
use App\Models\Participante;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $usuarios = User::count();
        if (UserState::where('user_id', $user->id)->exists()) {
            $estado_id = UserState::where('user_id','=',$user->id)->pluck('estado_id');
            $circulos = Circulo::where('estado_id','=',$estado_id)->whereNull('deleted_at')->count();
            $subquery = Circulo::select('id', 'estado_id', 'circulo');
            $participantes = Participante::selectRaw('count(*)')
                ->leftJoinSub($subquery, 'b', function ($join) {
                    $join->on('b.id', '=', 'participantes.circulo_id');
                })
                ->where('b.estado_id','=',$estado_id)
                ->count();            
        } else {
            $circulos = Circulo::whereNull('deleted_at')->count();
            $participantes = Participante::whereNull('deleted_at')->count();
        }
        return view('home', compact(['usuarios','circulos','participantes']));
    }
}
