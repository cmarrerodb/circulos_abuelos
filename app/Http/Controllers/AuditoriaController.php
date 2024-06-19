<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auditoria;

class AuditoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auditoria=Auditoria::all();
        return view('auditoria.index',compact('auditoria'));
    }
    public function audit_tabla(Request $request)
    {
        $offset = $request->input('offset', 0);
        $limit = $request->input('limit', 10);
        $query = Auditoria::query();
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($query) use ($search) {
                $query->where('id', 'Ilike', '%' . $search . '%');
                $query->orWhere('table_name', 'Ilike', '%' . $search . '%');
                $query->orWhere('session_user_name', 'Ilike', '%' . $search . '%');
                $query->orWhere('nombre_usuario', 'Ilike', '%' . $search . '%');
                $query->orWhere('application_name', 'Ilike', '%' . $search . '%');
                $query->orWhere('action_tstamp_tx', 'Ilike', '%' . $search . '%');
                $query->orWhere('transaction_id', 'Ilike', '%' . $search . '%');
                $query->orWhere('client_addr', 'Ilike', '%' . $search . '%');
                $query->orWhere('action', 'Ilike', '%' . $search . '%');
                $query->orWhere('row_data', 'Ilike', '%' . $search . '%');
                $query->orWhere('changed_fields', 'Ilike', '%' . $search . '%');
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
            $auditoria = $query->skip($offset)->take($limit)->get();
        } else {
            $auditoria = $query->get();
        }
        return response()->json([
            'total' => $total,
            'rows' => $auditoria
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
        //
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
}
