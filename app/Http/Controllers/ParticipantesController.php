<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Validator;
use Log;
use GuzzleHttp\Client;
use App\Models\Circulo;
use App\Models\EstadoCivil;
use App\Models\CneEstado;
use App\Models\CneMunicipio;
use App\Models\CneParroquia;
use App\Models\Participante;
use App\Models\Vparticipante;
use App\Models\UserState;

class ParticipantesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $estado_id = UserState::where('user_id','=',$user->id)->pluck('estado_id');
        $query = Circulo::query();
        if (count($estado_id) > 0) {
            $query->where('estado_id', '=', $estado_id);
        }
        $query->whereNull('deleted_at');
        $circulos = $query->get();
        return view('participantes',compact('circulos'));
    }
    public function part_tabla(Request $request)
    {
        $offset = $request->input('offset', 0);
        $limit = $request->input('limit', 10);
        $query = Vparticipante::query();
        if ($request->has('search') && $request->search !== NULL) {
            $search = $request->search;
            $query->where(function ($query) use ($search) {
                $query->orWhere('cedula', 'Ilike', '%' . $search . '%');
                $query->orWhere('primer_nombre', 'Ilike', '%' . $search . '%');
                $query->orWhere('segundo_nombre', 'Ilike', '%' . $search . '%');
                $query->orWhere('primer_apellido', 'Ilike', '%' . $search . '%');
                $query->orWhere('segundo_apellido', 'Ilike', '%' . $search . '%');
                $query->orWhere('fecha_nacimiento', 'Ilike', '%' . $search . '%');
                $query->orWhere('sexo', 'Ilike', '%' . $search . '%');
                $query->orWhere('estado_civil', 'Ilike', '%' . $search . '%');
                $query->orWhere('estado', 'Ilike', '%' . $search . '%');
                $query->orWhere('municipio', 'Ilike', '%' . $search . '%');
                $query->orWhere('parroquia', 'Ilike', '%' . $search . '%');
            });            
        }
        if ($request->has('circulo')) {
            $circulo = $request->circulo;
            $query->where('circulo', '=', $circulo);
        } 
        if ($request->has('filter')) {
            $filters = json_decode($request->get('filter'), true);
            foreach ($filters as $column => $value) {
                if (!empty($value)) {
                    $query->where($column, 'like', "%$value%");
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fecha_nac = $request->fecha_nacimiento;
        $fecha_nacimiento = DateTime::createFromFormat('d/m/Y', $fecha_nac)->format('Y-m-d');
        $sexo = $request->sexo=='FEMENINO' ? '2' : '1';
        $circulo=Circulo::select('id')
        ->where('circulo','=',$request->circulo)
        ->get();
        $circulo_id = json_decode($circulo,true)[0]['id'];
        $edo_civil = EstadoCivil::select('id')
        ->where('estado_civil','=',$request->estado_civil)
        ->get();
        $edo_civil_id = json_decode($edo_civil,true)[0]['id'];
        $estado = CneEstado::select('estado_id')
        ->where('estado','=',$request->estado)
        ->get();
        $estado_id = json_decode($estado,true)[0]['estado_id'];
        $municipio = CneMunicipio::select('municipio_id')
        ->where('municipio','=',$request->municipio)
        ->where('estado_id','=',$estado_id)
        ->get();
        $municipio_id = json_decode($municipio,true)[0]['municipio_id'];
        $parroquia = CneParroquia::select('parroquia_id')
        ->where('parroquia','=',$request->parroquia)
        ->where('municipio_id','=',$municipio_id)
        ->where('estado_id','=',$estado_id)
        ->get();
        $parroquia_id = json_decode($parroquia,true)[0]['parroquia_id'];
        $user_id = Auth::id();
        $datos = [
            'cedula' => $request->cedula,
            'circulo_id' => $circulo_id,
            'primer_nombre' => $request->primer_nombre,
            'segundo_nombre' => $request->segundo_nombre,
            'primer_apellido' => $request->primer_apellido,
            'segundo_apellido' => $request->segundo_apellido,
            'fecha_nacimiento' => $fecha_nacimiento,
            'sexo' => $sexo,
            'estado_civil_id' => $edo_civil_id,
            'estado_id' => $estado_id,
            'municipio_id' => $municipio_id,
            'parroquia_id' => $parroquia_id,
            'user_id' => $user_id,
        ];
        DB::beginTransaction();
        try {
            $this->auditoria($request->user(),addslashes($request->ip()));
            Participante::create($datos);
            DB::commit();
            return response()->json(['message' => 'Participante registrado exitosamente','status' =>200], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Ha ocurrido un error en el registro del participante','status'=>500], 200);
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
    public function check_cedula(Request $request)
    {
        // $request->validate([
        //     'cedula' => 'required|numeric|unique:participantes,cedula',
        // ], [
        //     'cedula.unique' => 'El número de cédula ya ha sido registrado.',
        // ]);
        // Definir las reglas de validación
        $rules = [
            'cedula' => 'required|numeric|unique:participantes,cedula',
            // Otras reglas de validación si las hay
        ];

        // Definir los mensajes de error personalizados
        $messages = [
            'cedula.unique' => 'La cédula ya está registrada en el sistema.',
            'cedula.required' => 'El campo cédula es obligatorio.',
            'cedula.numeric' => 'El campo cédula debe ser numérico.',
        ];

        // Realizar la validación
        $validator = Validator::make($request->all(), $rules, $messages);

        // Verificar si la validación falla
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 200); // 422 Unprocessable Entity
        }

        $cedula = $request->input('cedula');
        $client = new Client(['allow_redirects' => true]);
        $client1 = new Client(['allow_redirects' => true]);
        try {
            $response1 = $client1->get('http://poi-r.vps.co.ve/cne', [
                'query' => ['cedula' => $cedula],
            ]);
            $body1 = $response1->getBody();
            $abody1 = json_decode($body1,true);
            $response = $client->get('http://poi-r.vps.co.ve/cedula', [
                'query' => ['cedula' => $cedula],
            ]);
            $body = $response->getBody();
            if(strlen($body) > 5) {
                $data = json_decode($body, true);
            } else {
                return response()->json(['error' => 'No se consiguienron datos de la cédula ' . $cedula], 200);
            }
            $edo_civ = EstadoCivil::select('estado_civil')->find($data['clvestado_civil']);
            $data['sexo'] = $data['strgenero']=='F' ? 'FEMENINO' : 'MASCULINO';
            $data['estado_civil'] = $edo_civ->estado_civil;
            if ($abody1) {
                $data['estado'] = $abody1['estado'];
                $data['municipio'] = $abody1['municipio'];
                $data['parroquia'] = $abody1['parroquia'];
            }
            if($body) {
                return response()->json($data);
            } else {
                return false;
            }
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $responseBody = $e->getResponse()->getBody()->getContents();
                return response()->json(['error' => 'Error de la API externa: ' . $responseBody], 500);
            } else {
                return response()->json(['error' => 'Error al comunicarse con la API externa.'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error inesperado: ' . $e->getMessage()], 500);
        }
    }
    
}
