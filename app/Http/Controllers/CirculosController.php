<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\Circulo;
use App\Models\Vcirculo;
class CirculosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('circulos');
    }
    public function circ_tabla(Request $request)
    {
        $offset = $request->input('offset', 0);
        $limit = $request->input('limit', 10);
        $query = Vcirculo::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($query) use ($search) {
                $query->where('circulo', 'Ilike', '%' . $search . '%')
                ;
            });            
        }
        $total = $query->count();
        if ($request->has('limit')) {
            $circulos = $query->skip($offset)->take($limit)->get();
        } else {
            $circulos = $query->get();
        }
        return response()->json([
            'total' => $total,
            'rows' => $circulos
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'circulo' => 'required|min:5|max:50',
        ], [
            'required' => 'El campo :attribute es obligatorio.',
            'min' => 'El campo :attribute debe tener al menos 5 caracteres',
            'max' => 'El campo :attribute debe tener 50 caracteres o menos',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Error en la validación', 'errors' => $validator->errors()], 200);
        }
        $user_id = Auth::id();
        $datos = [
            'estado_id' => $request->estado_id,
            'municipio_id' => $request->municipio_id,
            'parroquia_id' => $request->parroquia_id,
            'circulo' => $request->circulo,
            'user_id' => $user_id,
            'comunidad' => $request->parroquia_id,
        ];
        try {
            Circulo::create($datos);
            $circulos = Vcirculo::select('id','circulo')->orderBy('circulo')->get();
            return response()->json(['circulos' => $circulos,'message' => 'Círculo creado exitosamente','status' =>200], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ha ocurrido un error en la creación del círculo','status'=>500], 200);
        }   
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
        $validator = Validator::make($request->all(), [
            'circulo' => 'required|min:5|max:50',
            'comunidad' => 'required|min:5',
        ], [
            'required' => 'El campo :attribute es obligatorio.',
            'min' => 'El campo :attribute debe tener al menos 5 caracteres',
            'max' => 'El campo :attribute debe tener 50 caracteres o menos',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Error en la validación', 'errors' => $validator->errors()], 200);
        }
        $datos = [
            'estado_id' => $request->estado_id,
            'municipio_id' => $request->municipio_id,
            'parroquia_id' => $request->parroquia_id,
            'comunidad' => $request->comunidad,
            'circulo' => $request->circulo,
        ];
        try {
            Circulo::where('id', $request->id)->update($datos);
            return response()->json(['message' => 'Círculo actualizado exitosamente','status' =>200], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ha ocurrido un error en la actualización del círculo','status'=>500], 200);
        }        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $circulo = Circulo::find($id)->first();
        if ($circulo) {
            $circulo->deleted_at = now();
            $circulo->save();
        }
        return json_encode($circulo);        
    }
}
