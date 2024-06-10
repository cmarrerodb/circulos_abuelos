<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PasswordValidation implements Rule
{
    protected $message;

    public function passes($attribute, $value)
    {
        if (strlen($value) < 8) {
            $this->message = 'La contraseña debe tener al menos 8 caracteres.';
            return false;
        }
        if (!preg_match('/[a-z]/', $value)) {
            $this->message = 'La contraseña debe contener al menos una letra minúscula.';
            return false;
        }
        if (!preg_match('/[A-Z]/', $value)) {
            $this->message = 'La contraseña debe contener al menos una letra mayúscula.';
            return false;
        }
        if (!preg_match('/[0-9]/', $value)) {
            $this->message = 'La contraseña debe contener al menos un número.';
            return false;
        }
        if (!preg_match('/[@$!%*#?&+\-.,]/', $value)) {
            $this->message = 'La contraseña debe contener al menos uno de los siguientes carácteres especiales: @$!%*#?&+\-.,';
            return false;
        }

        return true;
    }

    public function message()
    {
        return $this->message;
    }
}
