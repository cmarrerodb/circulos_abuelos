<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\Circulo;
use App\Models\Vcirculo;
use App\Models\UserState;
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
        $user = Auth::user();
        // $estado_id = UserState::where('user_id','=',$user->id)->pluck('estado_id');
        $estado_id = UserState::where('user_id','=',$user->id)->pluck('estado_id');
        $offset = $request->input('offset', 0);
        $limit = $request->input('limit', 10);
        $query = Vcirculo::query();
        if (count($estado_id) > 0) {
            $query->where('estado_id', '=', $estado_id);
        }
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($query) use ($search) {
                $query->orWhere('estado', 'Ilike', '%' . $search . '%');
                $query->orWhere('municipio', 'Ilike', '%' . $search . '%');
                $query->orWhere('parroquia', 'Ilike', '%' . $search . '%');
                $query->orWhere('comunidad', 'Ilike', '%' . $search . '%');
                $query->orWhere('circulo', 'Ilike', '%' . $search . '%');
            });
        }
        if ($request->has('filter')) {
            $filters = json_decode($request->get('filter'), true);
            foreach ($filters as $column => $value) {
                if (!empty($value)) {
                    $query->where($column, 'ilike', "%$value%");
                }
            }
        }
        if ($request->has('sort')) {
            $sorts = $request->sort;
            $orders = $request->order;
            $query->orderBy($sorts, $orders);
        }      
        if ($request->has('multiSort')) {
            $sorts1 = json_encode($request->multiSort);
            $sorts = json_decode($sorts1, true);
            foreach ($sorts as $sort) {
                $query->orderBy($sort['sortName'], $sort['sortOrder']);
            }
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
            'comunidad' => 'required|min:5',
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
            'comunidad' => $request->comunidad,
        ];
        try {
            $this->auditoria($request->user(),addslashes($request->ip()));
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
            $this->auditoria($request->user(),addslashes($request->ip()));
            Circulo::where('id', $request->id)->update($datos);
            return response()->json(['message' => 'Círculo actualizado exitosamente','status' =>200], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ha ocurrido un error en la actualización del círculo','status'=>500], 200);
        }        
    }
    private function auditoria($user,$ip) {
        $applicationName = addslashes("CirculoAbuelos");
        $cedula = addslashes("0");
        $usuario = addslashes($user->email);
        $nombreUsuario = addslashes($user->name);
        DB::statement("set cc.usuario = '$usuario'");
        DB::statement("set cc.ip = '$ip'");
        DB::statement("set cc.ci_usuario = '$cedula'");
        DB::statement("set cc.nombre_usuario = '$nombreUsuario'");
        DB::statement("set cc.application_name = '$applicationName'");
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
