@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')
<form action="{{ route('users.index') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Buscar por nombre, correo o rol" value="{{ request('search') }}">
            <span class="input-group-btn">
                <button type="submit" class="btn btn-primary" title="Buscar">
                    <i class="fas fa-search"></i>
                </button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary" title="Borrar búsqueda">
                    <i class="fas fa-trash"></i>
                </a>
            </span>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Acciones</th>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Rol</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary" title="Editar"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" title="eliminar"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->getRoleNames()->join(', ') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
