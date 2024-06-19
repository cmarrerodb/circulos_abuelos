<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\CneEstado;
use App\Models\CneMunicipio;
use App\Models\CneParroquia;
use App\Models\UserState;

class AuxiliaresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function circ_estados(Request $request) {
        $user = Auth::user();
        $query = CneEstado::query();
        $estado_id = UserState::where('user_id','=',$user->id)->pluck('estado_id');
        if (count($estado_id) > 0) {
            $query->where('estado_id', '=', $estado_id);
        }
        $estados = $query->orderBy('estado_id')->get();;
        // $estados = CneEstado::select('estado_id','estado')->orderBy('estado_id')->get();
        return json_encode($estados);
    }
    public function circ_municipios(Request $request) {
        $estado = $request->estado;
        $municipios = CneMunicipio::select('municipio_id','municipio')
        ->where('estado_id','=',$estado)
        ->orderBy('municipio')->get();
        return json_encode($municipios);
    }
    public function circ_parroquias(Request $request) {
        $estado = $request->estado;
        $municipio = $request->municipio;
        $parroquias = CneParroquia::select('parroquia_id','parroquia')
        ->where('estado_id','=',$estado)
        ->where('municipio_id','=',$municipio)
        ->orderBy('parroquia')
        ->get();
        return json_encode($parroquias);
    }
    public function circ_emp(Request $request){
        $estado = CneEstado::select('estado_id','estado')
        ->where('estado_id','=',$request->estado_id)
        ->get();
        $municipio = CneMunicipio::select('municipio_id','municipio')
        ->where('estado_id','=',$request->estado_id)
        ->where('municipio_id','=',$request->municipio_id)
        ->get();
        $parroquia = CneParroquia::select('parroquia_id','parroquia')
        ->where('estado_id','=',$request->estado_id)
        ->where('municipio_id','=',$request->municipio_id)
        ->where('parroquia_id','=',$request->parroquia_id)
        ->get();
        $data = [
            'estado' => $estado,
            'municipio' => $municipio,
            'parroquia' => $parroquia,
        ];
        return json_encode($data);
    }
}   
