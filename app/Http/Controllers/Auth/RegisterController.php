<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // return Validator::make($data, [
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => [
        //         'required', 
        //         'string', 
        //         'min:8', 
        //         'confirmed',
        //         'regex:/[a-z]/',
        //         'regex:/[A-Z]/',
        //         'regex:/[0-9]/',
        //         'regex:/[@$!%*#?&.]/',
        //     ],
        // ], [
        //     'name.required' => 'El campo nombre es obligatorio.',
        //     'name.max' => 'El nombre no puede tener más de :max caracteres.',
        //     'email.required' => 'El campo email es obligatorio.',
        //     'email.email' => 'El email debe ser una dirección de correo electrónico válida.',
        //     'email.max' => 'El email no puede tener más de :max caracteres.',
        //     'email.unique' => 'El email ya está en uso.',
        //     'password.required' => 'El campo contraseña es obligatorio.',
        //     'password.min' => 'La contraseña debe tener al menos :min caracteres.',
        //     'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        //     'password.regex' => 'La contraseña debe contener al menos una letra minúscula, una letra mayúscula, un número y un carácter especial.',
        // ]);
        Validator::extend('lowercase', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/[a-z]/', $value);
        }, 'La :attribute debe contener al menos una letra minúscula.');
        
        Validator::extend('uppercase', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/[A-Z]/', $value);
        }, 'La :attribute debe contener al menos una letra mayúscula.');
        
        Validator::extend('number', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/[0-9]/', $value);
        }, 'La :attribute debe contener al menos un número.');
        
        Validator::extend('special_chars', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/[@$!%*#?&]/', $value);
        }, 'La :attribute debe contener al menos un caracter especial. Los caracteres especiales válidos son: @$!%*#?&');
        
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required', 
                'string', 
                'min:8', 
                'confirmed',
                'lowercase',
                'uppercase',
                'number',
                'special_chars',
            ],
        ], [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.max' => 'El nombre no puede tener más de :max caracteres.',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El email debe ser una dirección de correo electrónico válida.',
            'email.max' => 'El email no puede tener más de :max caracteres.',
            'email.unique' => 'El email ya está en uso.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
            'password.lowercase' => 'La :attribute debe contener al menos una letra minúscula.',
            'password.uppercase' => 'La :attribute debe contener al menos una letra mayúscula.',
            'password.number' => 'La :attribute debe contener al menos un número.',
            'password.special_chars' => 'La :attribute debe contener al menos un caracter especial. Los caracteres especiales válidos son: @$!%*#?&',

        ]);        
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
