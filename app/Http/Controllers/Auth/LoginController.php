<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserLogController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected function authenticated(Request $request, $user)
    {
        // Registrar ingreso exitoso
        (new UserLogController)->logSuccessfulLogin();
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        // Registrar intento fallido
        (new UserLogController)->logFailedLogin($request);

        $errors = [$this->username() => trans('auth.failed')];
        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }
        return back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }

    public function logout(Request $request)
    {
        // Registrar cierre de sesión
        (new UserLogController)->logLogout();

        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return $this->loggedOut($request) ?: redirect('/');
    }
}
