@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('content_header')
    <h1>Editar Usuario</h1>
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" >
        </div>
        <div class="form-group">
            <label for="email">Correo</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" >
        </div>
        <div class="form-group">
            <label for="password">Clave</label>
            <input type="password" name="password" class="form-control">
            {{--<small class="text-muted">Dejar vacio si no se va a cambiar</small>--}}
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirmar Clave</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>
        <div class="form-group">
            <label for="role">Rol</label>
            <select name="role" class="form-control" >
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ (optional($userRole)->id ?? 2) == $role->id ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="estado">Estado</label>
            <select name="estado" class="form-control" >
                @foreach($estados as $estado)
                    <option value="{{ $estado->estado_id }}" {{ $estado->estado_id == $estado_usuario[0]['estado_id'] ? 'selected' : '' }}>
                        {{ $estado->estado }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary" title="Guardar"><i class="fas fa-save"></i></button>
    </form>
@stop
