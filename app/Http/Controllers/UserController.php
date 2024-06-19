<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserState;
use App\Models\CneEstado;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Rules\PasswordValidation;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'Ilike', "%{$search}%")
                  ->orWhere('email', 'Ilike', "%{$search}%")
                  ->orWhereHas('roles', function ($q) use ($search) {
                      $q->where('name', 'Ilike', "%{$search}%");
                  });
        }

        $users = $query->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,id'
        ]);
        $rol=Role::where('id','=',$request->role)->pluck('name');
        $this->auditoria($request->user(),addslashes($request->ip()));
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);
        $user->assignRole($rol);
        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        $estados = CneEstado::select('estado_id','estado')->orderBy('estado')->get();
        $user = User::findOrFail($id);
        $roles = Role::all();
        $estado_usuario = UserState::select('estado_id')->where('user_id','=',$id)->get();
        $userRole = $user->roles->first() ?? Role::find(2);
        return view('users.edit', compact('user', 'roles', 'userRole','estados','estado_usuario'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $emailChanged = $request->input('email') !== $user->email;
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                $emailChanged ? Rule::unique('users') : '',
            ],
            'password' => [
                'nullable',
                'string',
                'confirmed',
                new PasswordValidation,
                function ($attribute, $value, $fail) use ($user) {
                    if (!$value && !$user->password) {
                        $fail('El campo contraseña es obligatorio porque el usuario no tiene una contraseña asignada.');
                    }
                },
            ],
            'role' => 'required|exists:roles,id'
        ];
        $messages = [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.max' => 'El nombre no puede tener más de :max caracteres.',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El email debe ser una dirección de correo electrónico válida.',
            'email.max' => 'El email no puede tener más de :max caracteres.',
            'email.unique' => 'El email ya está en uso.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        ];
        $validated = $request->validate($rules, $messages);
        $rol=Role::where('id','=',$request->role)->pluck('name');
        $this->auditoria($request->user(),addslashes($request->ip()));
        DB::beginTransaction();
        try {
            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'] ? bcrypt($validated['password']) : $user->password,
            ]);
            $userState = UserState::where('user_id', $id)->first();
            if ($request->estado === null) {
                if ($userState) {
                    $userState->delete();
                }
            } else {
                if ($userState) {
                    $userState->estado_id = $request->estado;
                    $userState->save();
                } else {
                    UserState::create([
                        'user_id' => $id,
                        'estado_id' => $request->estado
                    ]);
                }   
            }
            ///////////////
            $user->syncRoles($rol);
            DB::commit();
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            DB::rollBack();
            // Manejar la excepción, por ejemplo:
            \Log::error("Error en asignación de estados al usuario $id: " . $e->getMessage());
            throw $e;
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index');
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
}
