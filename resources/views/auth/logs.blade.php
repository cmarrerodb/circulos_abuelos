@extends('adminlte::page')
@section('title','Auditoría Ingreso')
@section('content_header')
    <meta name="_token" content="{{ csrf_token() }}">
    <h1 class="m-0 text-dark">Auditoría Ingreso</h1>
@stop
@section('content')
@include('inclusion.modal_circulos')
<div class="table-container">
        <table 
            id="tbl-auditoria" 
            class="table table-hover" 
            data-toolbar="#toolbar"
            data-toggle="table" 
            data-show-columns="true" 
            data-url="{{route('tabla_logs')}}" 
            data-side-pagination="server" 
            data-pagination="true" 
            data-page-list="[10, 20, 50,  100, 'All']" 
            data-page-size-options='["10", "20", "50", "100", "Todos"]' 
            data-custom-all-text="Todos"
            data-page-size-func="pageSizeFunc"
            data-page-size="10" 
            data-buttons="btnAgregar"
            data-show-export="true" 
            data-export-data-type="all" 
            data-export-types="['csv', 'json', 'excel']" 
            data-show-fullscreen="true" 
            data-show-search-clear-button="true" 
            data-show-multi-sort="true" 
            data-show-print="true" 
            data-locale="es-VE"
            data-search="true"
            data-search-accent-neutralise="true"
            data-show-refresh="true"
            data-filter-control="true"
        >
            <thead>
                <tr>
                    <th colspan="6">AUDITORÍA ACCESOS</th>
                </tr>
                <tr>
                    <th data-field="email" data-sortable="true" data-filter-control="input">USUARIO</th>
                    <th data-field="name" data-sortable="true" data-filter-control="select">NOMBRE</th>
                    <th data-field="fecha_hora" data-sortable="true" data-filter-control="select">FECHA</th>
                    <th data-field="ip_address" data-sortable="true" data-filter-control="input">IP</th>
                    <th data-field="status_ingreso" data-sortable="true" data-filter-control="input">INGRESO</th>
                    <th data-field="status_salida" data-sortable="true" data-filter-control="input">EGRESO</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    @stop
@section('css')
<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/bootstrap-table.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/bootstrap-table-group-by.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/toastr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/choices.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/tui-chart/tui-chart.min.css') }}" rel="stylesheet">
@stop
@section('js')
<script src="{{ asset('/assets/js/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('/assets/libs/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('/assets/js/jspdf.min.js') }}"></script>
    <script src="{{ asset('/assets/js/jspdf.plugin.autotable.js') }}"></script>
    <script src="{{ asset('/assets/js/bootstrap-table.min.js') }}"></script>
    <script src="{{ asset('/assets/js/bootstrap-table-locale-all.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.3/dist/extensions/filter-control/bootstrap-table-filter-control.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.3/dist/extensions/fixed-columns/bootstrap-table-fixed-columns.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.3/dist/extensions/multiple-sort/bootstrap-table-multiple-sort.js"></script>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.3/dist/extensions/print/bootstrap-table-print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.3/dist/extensions/sticky-header/bootstrap-table-sticky-header.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.3/dist/bootstrap-table-locale-all.min.js"></script>    
    <script src="{{ asset('/assets/js/bootstrap-table/extensions/export/bootstrap-table-export.min.js') }}"></script>
    <script src="{{ asset('/assets/js/bootstrap-table/extensions/export/tableExport.min.js') }}"></script>
    <script src="{{ asset('/assets/js/bootstrap-table/extensions/export/xlsx.full.min.js') }}"></script>
    <script src="{{ asset('/assets/js/bootstrap-table/extensions/fixed-columns/bootstrap-table-fixed-columns.min.js') }}"></script>
    <script src="{{ asset('/assets/js/jspdf.min.js') }}"></script>
    <script src="{{ asset('/assets/js/bootstrap-table-group-by.min.js') }}"></script>
    <script src="{{ asset('/assets/js/jquery-ui-1.10.4.custom.min.js') }}"></script>
    <script src="{{ asset('/assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/tui-chart/tui-chart.min.js') }}"></script>
    <script>
    </script>
@stop