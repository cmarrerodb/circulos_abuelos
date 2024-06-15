<?php
namespace App\Http\Controllers;

use App\Models\User;
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
        info($users);
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
        $user = User::findOrFail($id);
        $roles = Role::all();
        $userRole = $user->roles->first() ?? Role::find(2); // Asigna rol con id 2 si no tiene rol
        return view('users.edit', compact('user', 'roles', 'userRole'));
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
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'] ? bcrypt($validated['password']) : $user->password,
        ]);
        $user->syncRoles($rol);
        return redirect()->route('users.index');
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
