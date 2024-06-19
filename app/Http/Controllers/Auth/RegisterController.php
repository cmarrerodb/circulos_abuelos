<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserState;
use App\Models\CneEstado;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Rules\PasswordValidation;
use Illuminate\Support\Facades\DB;
class RegisterController extends Controller
{
    use RegistersUsers {
        register as originalRegister;
    }

    protected $redirectTo = '/register';

    public function __construct()
    {
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed', new PasswordValidation],
        ], [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.max' => 'El nombre no puede tener más de :max caracteres.',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El email debe ser una dirección de correo electrónico válida.',
            'email.max' => 'El email no puede tener más de :max caracteres.',
            'email.unique' => 'El email ya está en uso.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        ]);
    }

    protected function create(array $data)
    {
        DB::beginTransaction();
        try {

            $id = User::insertGetId([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            $usuario = User::find($id);
            $estado = $data['estado'];
            /////////////
            // $userState = UserState::where('user_id', $id)->first();
            if ($estado !== NULL) {
                UserState::create([
                    'user_id' => $id,
                    'estado_id' => $estado,
                ]);
            }
            /////////////
            // DB::rollback();
            DB::commit();
            return $usuario;
        } catch(\Exception $e) {
            DB::rollBack();
            \Log::error($e);
        }
    }

    public function register(Request $request)
    {
        // Validar la solicitud
        $this->validator($request->all())->validate();

        // Crear el usuario
        $user = $this->create($request->all());

        // Redirigir con un mensaje de éxito
        return redirect('/register')->with('success', "El usuario {$user->name} ha sido creado exitosamente");
    }
    public function showRegistrationForm()
    {
        $estados = CneEstado::all();
        return view('auth.register', compact('estados'));
    }    
}
