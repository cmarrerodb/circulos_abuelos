@extends('adminlte::page')
@section('title','Círculos')
@section('content_header')
    <meta name="_token" content="{{ csrf_token() }}">
    <h1 class="m-0 text-dark">Círculos</h1>
@stop
@section('content')
@include('inclusion.modal_circulos')
<div class="table-container">
        <div class="scrollup">
            <div class="text-center">
                <a href="#" class="bajar" title="Bajar al final de la tabla"><i class="fas fa-arrow-alt-circle-down" style="font-size: 18px;"></i></a>
            </div>
            <div class="text-center">
                <a href="#" class="subir" title="Subir al inicio de la tabla"><i class="fas fa-arrow-alt-circle-up" style="font-size: 18px;"></i></a>
            </div>
        </div>
        <table 
            id="tbl-circulos" 
            class="table table-hover" 
            data-toolbar="#toolbar"
            data-toggle="table" 
            data-show-columns="true" 
            data-url="{{route('circ_tabla')}}" 
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
                    <th colspan="6">LISTADOD DE CÍRCULOS</th>
                    <th data-field="acciones" data-align="center" data-formatter="accionesFormatter" data-events="accionesEvents"></th>
                </tr>
                <tr>
                    <th data-field="id" data-sortable="true" data-filter-control="input">ID</th>
                    <th data-field="estado" data-sortable="true" data-filter-control="select">ESTADO</th>
                    <th data-field="municipio" data-sortable="true" data-filter-control="select">MUNICIPIO</th>
                    <th data-field="parroquia" data-sortable="true" data-filter-control="input">PARROQUIA</th>
                    <th data-field="comunidad" data-sortable="true" data-filter-control="input">COMUNIDAD</th>
                    <th data-field="circulo" data-sortable="true" data-filter-control="input">CÍRCULO</th>
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
        $(document).ready(function() {
            $('[name="btnAdd"]').removeClass('btn-secondary');
            $('[name="btnAdd"]').addClass('btn-success');
            var botonAgregarTrabajador = $('button[title="Agregar trabajador"]');
            $('button[title="Agregar trabajador"]').remove();
            $('.columns-right').append(botonAgregarTrabajador);
            $('[name="btnAdd"]').on('click',function() {
                var newRow = `
                    <tr>
                        <td></td>
                        <td><select class="form-control" id="circ_agr_estados"><select></td>
                        <td><select class="form-control" id="circ_agr_municipios"><select></td>
                        <td><select class="form-control" id="circ_agr_parroquias"><select></td>
                        <td><input type="text" class="form-control" id="agr_comunidad"></td>
                        <td><input type="text" class="form-control" id="agr_circulo"></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Acciones">
                                <button type="button" id="btnagr" class="btn btn-success btn-sm accion-agregar" title="Guardar cambios">
                                    <span class = "icono_cuardar"><i class="fas fa-save"></i></span>
                                </button>
                                <button type="button" id="btndes" class="btn btn-danger btn-sm accion-deshacer"  title="Deshacer cambios">
                                    <span class = "icono_deshacer"><i class="fas fa-times"></i></span>
                                </button>
                            </div>
                        </td>
                    </tr>`;
                    $('#tbl-circulos tbody').prepend(newRow);
                    $('.accion-editar').prop('disabled',true);
                    $('.accion-eliminar').prop('disabled',true);
                    $('[name="btnAdd"]').prop('disabled',true);
                    $.ajax({
                        type: "POST",
                        url: "circ_estados",
                        headers: {
                            "X-CSRF-Token": $('meta[name="_token"]').attr("content"),
                        },
                        dataType: "JSON",
                        success: function (response) {
                            var options = '';
                            $.each(response, function(key, value) {
                                $('#circ_agr_estados').append($('<option>', {
                                    value: value.estado_id,
                                    text: value.estado
                                }));                                
                            });
                            $('#circ_agr_estados').on('change', function() {
                                let est_id = $('#circ_agr_estados').val();
                                $.ajax({
                                    type: "POST",
                                    url: "circ_municipios",
                                    headers: {
                                        "X-CSRF-Token": $('meta[name="_token"]').attr("content"),
                                    },
                                    data:{'estado':est_id},
                                    dataType: "JSON",
                                    success: function (response) {
                                        $('#circ_agr_municipios').empty();
                                        $.each(response, function(key, value) {
                                            $('#circ_agr_municipios').append($('<option>', {
                                                value: value.municipio_id,
                                                text: value.municipio
                                            }));  
                                        });
                                    },
                                });
                            });
                        },
                    }); 
                    $.ajax({
                        type: "POST",
                        url: "circ_municipios",
                        headers: {
                            "X-CSRF-Token": $('meta[name="_token"]').attr("content"),
                        },
                        data:{'estado':1},
                        dataType: "JSON",
                        success: function (response) {
                            var options = '';
                            $.each(response, function(key, value) {
                                $('#circ_agr_municipios').prepend($('<option>', {
                                    value: value.municipio_id,
                                    text: value.municipio
                                }));  
                            });
                            $('#circ_agr_municipios').on('change', function() {
                                $.ajax({
                                    type: "POST",
                                    url: "circ_parroquias",
                                    headers: {
                                        "X-CSRF-Token": $('meta[name="_token"]').attr("content"),
                                    },
                                    data:{'estado':$('#circ_agr_estados').val(),'municipio':$('#circ_agr_municipios').val()},
                                    dataType: "JSON",
                                    success: function (response) {
                                        $('#circ_agr_parroquias').empty();
                                        $.each(response, function(key, value) {
                                            $('#circ_agr_parroquias').append($('<option>', {
                                                value: value.parroquia_id,
                                                text: value.parroquia
                                            }));  
                                        });
                                    },
                                }); 
                            });                    
                        },
                    });
                    $.ajax({
                        type: "POST",
                        url: "circ_parroquias",
                        headers: {
                            "X-CSRF-Token": $('meta[name="_token"]').attr("content"),
                        },
                        data:{'estado':1,'municipio':1},
                        dataType: "JSON",
                        success: function (response) {
                            var options = '';
                            $.each(response, function(key, value) {
                                $('#circ_agr_parroquias').append($('<option>', {
                                    value: value.id,
                                    text: value.parroquia
                                }));  
                            });
                        },
                    });
                    $("#btnagr").on('click',function() {
                        let data = {
                            'estado_id':$("#circ_agr_estados").val(),
                            'municipio_id':$("#circ_agr_municipios").val(),
                            'parroquia_id':$("#circ_agr_parroquias").val(),
                            'comunidad':$("#agr_comunidad").val(),
                            'circulo':$("#agr_circulo").val(),
                        }
                        $.ajax({
                            type: "POST",
                            url:  "circulos",
                            data: data,
                            headers: {
                                "X-CSRF-Token": $('meta[name="_token"]').attr("content"),
                            },
                            dataType: "JSON",
                            success: function (response) {
                                if (response.status != 200) {
                                    let resp_err = "Ha ocurrido un error y no se ha posiso crear el circulo: <br/><ul style='text-align:left;'>";
                                    $.each(response.errors, function(i,v) {
                                        resp_err += "<li>"+v[0]+"</li>";
                                    });
                                    resp_err += "</ul>";
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'HA OCURRIDO UN ERROR',
                                        html: resp_err,
                                        showConfirmButton: 'Cerrar'
                                    });
                                } else {
                                    $('[name="btnAdd"]').prop('disabled',false);
                                    $('#tbl-circulos').bootstrapTable('refresh');
                                    toastr.success('¡El círculo de abuelos ha sido credo exitosamente!');
                                }
                            },
                        });                        
                    });
                });            
            });
        $(document).on('click', '#btndes', function() {
            $(this).closest('tr').remove();
            $('.accion-editar').prop('disabled',false);
            $('.accion-eliminar').prop('disabled',false);
            $('[name="btnAdd"]').prop('disabled',false);            
        });
        var circ=null;
        var com = null;
        var cir_est_sel = null;
        var cir_mun_sel = null;

        function btnAgregar() {
            return {
                btnAdd: {
                    class: 'btn-success',
                    text: "Agregar trabajador",
                    icon: 'bi bi-person-fill-add',
                    event: function () {
                        
                    },
                    attributes: {
                        title: "Agregar trabajador"
                    }
                }
            }
        }        
        function accionesFormatter(value, row, index) {
            return `
                <div class="btn-group" role="group" aria-label="Acciones">
                    <button type="button" id="btnedt`+index+`" class="btn btn-primary btn-sm accion-editar" data-id="${row.id}" title="Editar círculo de abuelos">
                        <span class = "icono_editar`+index+`"><i class="fas fa-edit"></i></span>
                    </button>
                    <button type="button" id="btnelm`+index+`" class="btn btn-danger btn-sm accion-eliminar" data-id="${row.id}" title="Eliminar círculo de abuelos">
                        <span class = "icono_eliminar`+index+`"><i class="fas fa-trash"></i></span>
                    </button>
                </div>
            `;
        }
        window.accionesEvents = {
            'click .accion-editar': function (e, value, row, index) {
                if ($('.accion-editar').hasClass('editando')) {
                    let data1 = {
                        id:row.id,
                        estado_id:$("#circ_estados").val(),
                        municipio_id:$("#circ_municipios").val(),
                        parroquia_id:$("#circ_parroquias").val(),
                        comunidad:$("#ln_comunidad").val(),
                        circulo:$("#ln_circulo").val(),
                    }
                    $.ajax({
                        type: "PUT",
                        url:  "circulos/"+row.id,
                        data: data1,
                        headers: {
                            "X-CSRF-Token": $('meta[name="_token"]').attr("content"),
                        },
                        dataType: "JSON",
                        success: function (response) {
                            if (response.status != 200) {
                                let resp_err = "Han ocurrido un error y el circulo no ha sido actualizado: <br/><ul style='text-align:left;'>";
                                $.each(response.errors, function(i,v) {
                                    resp_err += "<li>"+v[0]+"</li>";
                                });
                                resp_err += "</ul>";
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'HA OCURRIDO UN ERROR',
                                    html: resp_err,
                                    showConfirmButton: 'Cerrar'
                                });
                            } else {
                                $('#tbl-circulos').bootstrapTable('refresh');
                                toastr.success('¡El círculo de abuelos ha sido actualizado exitosamente!');
                            }
                        },
                    });                        
                    
                    $('#tbl-circulos').bootstrapTable('updateCell', {index: index, field: 'estado', value: $('#circ_estados option:selected').text()});
                    $('#tbl-circulos').bootstrapTable('updateCell', {index: index, field: 'municipio', value: $('#circ_municipios option:selected').text()});
                    $('#tbl-circulos').bootstrapTable('updateCell', {index: index, field: 'parroquia', value: $('#circ_parroquias option:selected').text()});
                    $('#tbl-circulos').bootstrapTable('updateCell', {index: index, field: 'comunidad', value: com});
                    $('#tbl-circulos').bootstrapTable('updateCell', {index: index, field: 'circulo', value: circ});
                    $("#icono_editar"+index).html('<i class="fas fa-edit"></i>');
                    $("#icono_eliminar"+index).html('<i class="fas fa-trash"></i>');
                    $('.accion-editar').prop('title','Editar círculo de abuelos');
                    $('.accion-eliminar').prop('title','Eliminar círculo de abuelos');
                    $('#btnedt'+index).removeClass('editando');
                    $('#tbl-circulos').bootstrapTable('refresh');
                } else {
                    circ =row.circulo;
                    com =row.comunidad;
                    let ci_estado = row.estado;
                    let prevSelectedState = null;
                    $.ajax({
                        type: "POST",
                        url: "circ_estados",
                        headers: {
                            "X-CSRF-Token": $('meta[name="_token"]').attr("content"),
                        },
                        dataType: "JSON",
                        success: function (response) {
                            var options = '';
                            $.each(response, function(key, value) {
                                options += '<option value="' + value.estado_id + '"';
                                if (value.estado === ci_estado) {
                                    options += ' selected';
                                    prevSelectedState = value.estado_id;
                                    cir_est_sel = prevSelectedState;
                                }
                                options += '>' + value.estado + '</option>';
                            });
                            var selectHtml1 = '<select class ="form-control" id="circ_estados">' + options + '</select>';
                            $('#tbl-circulos').bootstrapTable('updateCell', {
                                index: index,
                                field: 'estado',
                                value: selectHtml1
                            });
                            if (prevSelectedState !== null) {
                                $('#circ_estados').val(prevSelectedState);
                            }
                            $('#tbl-circulos').on('change', '#circ_estados', function() {
                                cir_est_sel = $(this).val();
                                municipios(row,index);
                                municipios(row,index);
                            });
                            municipios(row,index);
                            parroquias(row,index);
                            cir_est_sel = null;
                            cir_mun_sel = null;
                        },
                    }); 
                    
                    $('#tbl-circulos').bootstrapTable('updateCell', {index: index, field: 'comunidad', value: '<input class="form-control" id="ln_comunidad" type="text" value="' + row.comunidad + '">'});
                    $('#tbl-circulos').bootstrapTable('updateCell', {index: index, field: 'circulo', value: '<input class="form-control" id="ln_circulo" type="text" value="' + row.circulo + '">'});
                }
            },
            'click .accion-eliminar': function (e, value, row, index) {
                if ($('.accion-editar').hasClass('editando')) {
                    $('#tbl-circulos').bootstrapTable('updateCell', {index: index, field: 'estado', value: row.estado});
                    $('#tbl-circulos').bootstrapTable('updateCell', {index: index, field: 'municipio', value: row.municipio});
                    $('#tbl-circulos').bootstrapTable('updateCell', {index: index, field: 'parroquia', value: row.parroquia});
                    $('#tbl-circulos').bootstrapTable('updateCell', {index: index, field: 'comunidad', value: com});
                    $('#tbl-circulos').bootstrapTable('updateCell', {index: index, field: 'circulo', value: circ});
                    $("#icono_editar"+index).html('<i class="fas fa-edit"></i>');
                    $("#icono_eliminar"+index).html('<i class="fas fa-trash"></i>');
                    $('.accion-editar').prop('title','Editar círculo de abuelos');
                    $('.accion-eliminar').prop('title','Eliminar círculo de abuelos');
                    $('#btnedt'+index).removeClass('editando');
                } else {
					Swal.fire({
						title: 'ADVERTENCIA',
                        html: '¡Esta acción <strong style="color:#f00;">ELIMINARÁ EL CIRCULO <span style="color:#000 !important;">'+row.circulo+'</span></strong>! ¿Está seguro que desea continuar',
                        icon: 'warning',
						showCancelButton: true,
						confirmButtonText: 'Aceptar',
						cancelButtonText: 'Cancelar',
					}).then((result) => {
						if (result.isConfirmed) {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "DELETE",
                                    url: "circulos/"+row.id,
                                    headers: {
                                        "X-CSRF-Token": $('meta[name="_token"]').attr("content"),
                                    },
                                    dataType: "JSON",
                                    success: function (response) {
                                        $('#tbl-circulos').bootstrapTable('refresh');
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'CÍRCULO ELIMINADO EXITOSAMENTE',
                                            text: 'El c+iculo '+row.circulo+' ha sido borrado exitosamente',
                                            showConfirmButton: 'Cerrar'
                                        });

                                    },
                                });                    
                            }
						}
					});                    
                }
            }
        };
        function municipios(row, index) {
            let est_id = cir_est_sel;
            $.ajax({
                type: "POST",
                url: "circ_municipios",
                headers: {
                    "X-CSRF-Token": $('meta[name="_token"]').attr("content"),
                },
                data:{'estado':est_id},
                dataType: "JSON",
                success: function (response) {
                    var options = '';
                    $.each(response, function(key, value) {
                        options += '<option value="' + value.municipio_id + '"';
                        if (value.municipio_id === row.municipio_id) {
                            options += ' selected';
                            cir_mun_sel = value.municipio_id;
                        }
                        options += '>' + value.municipio + '</option>';
                    });
                    var selectHtml2 = '<select class ="form-control" id="circ_municipios">' + options + '</select>';
                    $('#tbl-circulos').bootstrapTable('updateCell', {
                        index: index,
                        field: 'municipio',
                        value: selectHtml2
                    });
                    $("#circ_estados").val(est_id);
                    $("#circ_parroquias").empty();
                    $('#tbl-circulos').on('change', '#circ_municipios', function() {
                        parroquias(row,index);
                    });                    
                    parroquias(row,index);
                },
            });

        }

        function parroquias(row,index,est_sel= null,mun_sel= null) {
            let est_id = $("#circ_estados").val();
            let mun_id = $("#circ_municipios").val();
            $.ajax({
                type: "POST",
                url: "circ_parroquias",
                headers: {
                    "X-CSRF-Token": $('meta[name="_token"]').attr("content"),
                },
                data:{'estado':est_id,'municipio':mun_id},
                dataType: "JSON",
                success: function (response) {
                    var options = '';
                    $.each(response, function(key, value) {
                        options += '<option value="' + value.parroquia_id + '"';
                        if (value.parroquia_id === row.parroquia_id) {
                            options += ' selected';
                        }
                        options += '>' + value.parroquia + '</option>';
                    });
                    var selectHtml = '<select class ="form-control" id="circ_parroquias">' + options + '</select>';
                    $('#tbl-circulos').bootstrapTable('updateCell', {
                        index: index,
                        field: 'parroquia',
                        value: selectHtml
                    });
                    $("#circ_estados").val(est_id);
                    $("#circ_municipios").val(mun_id);
                    $('.accion-editar').removeClass('btn-primary');
                    $('.accion-eliminar').removeClass('btn-danger');
                    $('.accion-editar').addClass('btn-secondary');
                    $('.accion-eliminar').addClass('btn-secondary');
                    $('.accion-editar').prop('disabled',true);
                    $('.accion-eliminar').prop('disabled',true);
                    $('.accion-editar').prop('title','Guardar cambios');
                    $('.accion-eliminar').prop('title','Eliminar cambios');
                    $('#btnedt'+index).addClass('editando');
                    $('.editando').removeClass('btn-secondary');
                    $('.editando').addClass('btn-success');
                    $('.editando').html('<i class="fas fa-save"></i>');
                    $('.editando').next('button').removeClass('btn-secondary');
                    $('.editando').next('button').addClass('btn-danger');
                    $('.editando').next('button').prop('disabled',false);
                    $('.editando').prop('disabled',false);
                    $('.editando').next('button').html('<i class="fas fa-times"></i>');                            
                    cir_est_sel = null;
                    cir_mun_sel = null;
                },
            }); 
        }
    </script>
@stop