<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Encryption\Encrypter;
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
        $usuarios = User::count();
        $circulos = Circulo::whereNull('deleted_at')->count();
        $participantes = Participante::whereNull('deleted_at')->count();
        return view('home', compact(['usuarios','circulos','participantes']));
    
        // return view('home');
    }
}
