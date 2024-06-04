@extends('adminlte::page')

@section('content_header')
    <h1 class="m-0 text-dark">Tablero</h1>
@stop

@section('content')
<div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="card text-white bg-primary mb-3 mr-3 border-dark shadow-lg rounded">
                <div class="card-header">CÍRCULOS</div>
                <div class="card-body">
                    <h2 class="card-title"></h2>
                    <h3>{{ number_format($circulos, 0, ',', '.') }}</h3>
                </div>
            </div>            
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="card text-white bg-success mb-3 mr-3 border-dark shadow-lg rounded">
                <div class="card-header">PARTICIPANTES</div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <h3>{{ number_format($participantes, 0, ',', '.') }}</h3>
                </div>
            </div>            
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="card text-white bg-warning text-dark mb-3 mr-3 border-dark shadow-lg rounded">
                <div class="card-header">USUARIOS</div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <h3>{{ number_format($usuarios, 0, ',', '.') }}</h3>
                </div>
            </div>            
        </div>
    </div>

@stop
