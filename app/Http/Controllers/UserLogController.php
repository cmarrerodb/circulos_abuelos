<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserLog;
use App\Models\VuserLog;
use Illuminate\Support\Facades\Auth;

class UserLogController extends Controller
{
    public function logSuccessfulLogin()
    {
        UserLog::create([
            'user_id' => Auth::id(),
            'ip_address' => request()->ip(),
            'status_ingreso' => 'INGRESO EXITOSO',
            'status_salida' => null,
        ]);
    }

    public function logFailedLogin($request)
    {
        UserLog::create([
            'user_id' => null,
            'ip_address' => $request->ip(),
            'status_ingreso' => 'INGRESO FALLIDO',
            'status_salida' => null,
        ]);
    }

    public function logLogout()
    {
        UserLog::where('user_id', Auth::id())
                ->whereNull('status_salida')
                ->update([
                    'status_salida' => 'SESIÓN CERRADA'
                ]);
    }

    public function logSessionExpired()
    {
        UserLog::where('user_id', Auth::id())
                ->whereNull('status_salida')
                ->update([
                    'status_salida' => 'SESIÓN VENCIDA'
                ]);
    }
    public function user_logs() {
        return view('auth.logs');
    }
    public function tabla_logs(Request $request) {
        $offset = $request->input('offset', 0);
        $limit = $request->input('limit', 10);
        $query = VuserLog::query();
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($query) use ($search) {
                $query->where('email', 'Ilike', '%' . $search . '%');
                $query->orWhere('name', 'Ilike', '%' . $search . '%');
                $query->orWhere('fecha_hora', 'Ilike', '%' . $search . '%');
                $query->orWhere('status_ingreso', 'Ilike', '%' . $search . '%');
                $query->orWhere('status_salida', 'Ilike', '%' . $search . '%');
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
            $logs = $query->skip($offset)->take($limit)->get();
        } else {
            $logs = $query->get();
        }
        return response()->json([
            'total' => $total,
            'rows' => $logs
        ]);
    }
}
