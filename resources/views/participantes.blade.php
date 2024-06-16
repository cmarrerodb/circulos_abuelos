@extends('adminlte::page')
@section('title','Participantes')
@section('content_header')
    <meta name="_token" content="{{ csrf_token() }}">
    <h1 class="m-0 text-dark">Participantes</h1>
@stop
@section('content')
    <div id="backdrop" class="backdrop"></div>
    <span id="btnAGrCirculo" class="fa-stack" title="AGregar círculo si no existe" style="cursor: pointer;">
        <i class="fas fa-circle fa-stack-2x" style="color: green;"></i>
        <i class="fas fa-plus fa-stack-1x" style="color: white;"></i>
    </span>
    <span id="btnDesCirculo" class="fa-stack d-none agregarCirculo" title="AGregar círculo si no existe" style="cursor: pointer;">
        <i class="fas fa-circle fa-stack-2x " style="color: red;"></i>
        <i class="fas fa-times fa-stack-1x" style="color: white;"></i>
    </span>

    <div class="row d-none agregarCirculo">
        <div class="col-xs-12 col-sm-12 col-md-4 form-group">
            <label for="crea_circ_estado">ESTADO</label>
            <select id="crea_circ_estado" class="form-control"></select>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 form-group">
        <label for="crea_circ_municipio">MUNICIPIO</label>
            <select id="crea_circ_municipio" class="form-control"></select>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 form-group">
        <label for="crea_circ_parroquia">PARROQUIA</label>
            <select id="crea_circ_parroquia" class="form-control"></select>
        </div>
    </div>
    <div class="row d-none agregarCirculo">
        <div class="col-xs-12 col-sm-12 col-md-5 form-group">
            <label for="crea_circ_nombre">COMUNIDAD</label>
            <input type="text" id="crea_circ_comunidad" class="form-control">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-5 form-group">
            <label for="crea_circ_nombre">CÍRCULO</label>
            <input type="text" id="crea_circ_nombre" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <label for ="circulos">CÍRCULOS</label>
                <input list="circulos" name="circulo" id="circuloInput" placeholder="Buscar círculos...">
                <datalist id="circulos">
                    @foreach($circulos as $circulo)
                        <option value="{{ $circulo->circulo }}" data-id="{{ $circulo->id }}"></option>
                    @endforeach
                </datalist>
            </div>
        </div>
    </div>
    <div class="table-container">
        <span id="btnAGrParticipante" class="fa-stack" title="Agregar participante" style="cursor: pointer;">
            <i class="fas fa-circle fa-stack-2x" style="color: blue;"></i>
            <i class="fas fa-plus fa-stack-1x" style="color: white;"></i>
        </span>
        <span id="btnDesParticipante" class="fa-stack d-none agregarParticipante" title="Descartar cambios" style="cursor: pointer;">
            <i class="fas fa-circle fa-stack-2x " style="color: red;"></i>
            <i class="fas fa-times fa-stack-1x" style="color: white;"></i>
        </span>
        <hr/>
        <div id="addParticipante" class="container-fluid d-none mt-3">
            <div class="row  align-items-center">
                <div class="col-xs-12 col-sm-12 col-md-4 d-flex align-items-center">
                    <label for="part_cedula">CÉDULA</label><br/>
                    <input type="text" id = "part_cedula" class="form-control me-2">
                    <span id="btnCheckPart" class="fa-stack" title="Revisar datos del participante" style="cursor: pointer;">
                        <i class="fas fa-circle fa-stack-2x" style="color: black;"></i>
                        <i class="fas fa-check fa-stack-1x" style="color: white;"></i>
                    </span>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3">
                    <label for="part_telef">TELÉFONO</label>
                    <input type="text" id = "part_telef" class="form-control">
                </div>
            </div>
            <div class="d-none" id="crp-part">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <label>PRIMER NOMBRE</label><br/>
                        <label id="pnombre" class="participante"></label>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                    <label>SEGUNDO NOMBRE</label><br/>
                        <label id="snombre" class="participante"></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <label>PRIMER APELLIDO</label><br/>
                        <label id="papellido" class="participante"></label>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <label>SEGUNDO APELLIDO</label><br/>
                        <label id="sapellido" class="participante"></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4">
                    <label>FECHA NACIMIENTO</label><br/>
                        <label id="fnac" class="participante"></label>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <label>SEXO</label><br/>
                        <label id="sexo" class="participante"></label>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <label>ESTADO CIVIL</label><br/>
                        <label id="edo_civil" class="participante"></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <label>ESTADO</label>
                        <label id="estado" class="participante"></label>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <label>MUNICIPIO</label>
                        <label id="municipio" class="participante"></label>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <label>PARROQUIA</label>
                        <label id="parroquia" class="participante"></label>
                    </div>
                </div>
            </div>
        </div>
        {{--<div class="scrollup">
            <div class="text-center">
                <a href="#" class="bajar" title="Bajar al final de la tabla"><i class="fas fa-arrow-alt-circle-down" style="font-size: 18px;"></i></a>
            </div>
            <div class="text-center">
                <a href="#" class="subir" title="Subir al inicio de la tabla"><i class="fas fa-arrow-alt-circle-up" style="font-size: 18px;"></i></a>
            </div>
        </div>--}}
        <table 
            id="tbl-participantes" 
            class="table table-hover" 
            data-toolbar="#toolbar"
            data-toggle="table" 
            data-show-columns="true" 
            data-url="{{route('part_tabla')}}" 
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
                    <th colspan="18">PARTICIPANTES</th>
                </tr>
                <tr>
                    <th data-field="id"data-sortable="true">ID</th>
                    <th data-field="circulo_id"data-sortable="true" data-visible="false">ID<br/>CÍRCULO</th>
                    <th data-field="circulo"data-sortable="true" data-visible="false" data-filter-control="input">CÍRCULO</th>
                    <th data-field="telefono"data-sortable="true" data-visible="true" data-filter-control="input">TELËFONO</th>
                    <th data-field="primer_nombre"data-sortable="true" data-visible="true" data-filter-control="input">PRIMER<br/>NOMBRE</th>
                    <th data-field="segundo_nombre"data-sortable="true" data-visible="false" data-filter-control="input">SEGUNDO<br/>NOMBRE</th>
                    <th data-field="primer_apellido" data-sortable="true" data-visible="true" data-filter-control="input">PRIMER<br/>APELLIDO</th>
                    <th data-field="segundo_apellido" data-sortable="true" data-visible="false" data-filter-control="input">SEGUNDO<br/>APELLIDO</th>
                    <th data-field="fecha_nacimiento" data-sortable="true" data-visible="true" data-filter-control="input">FECHA<br/>NACIMIENTO</th>
                    <th data-field="sexo" data-sortable="true" data-visible="true" data-filter-control="select">SEXO</th>
                    <th data-field="estado_civil_id" data-sortable="true" data-visible="false">ID EDO<br/>CIVIL</th>
                    <th data-field="estado_civil" data-sortable="true" data-visible="true" data-filter-control="select">EDO<br/>CIVIL</th>
                    <th data-field="estado_id" data-sortable="true" data-visible="false">ID<br/>ESTADO</th>
                    <th data-field="estado" data-sortable="true" data-visible="true" data-filter-control="select">ESTADO</th>
                    <th data-field="municipio_id" data-sortable="true" data-visible="false">ID<br/>MUNICIPIO</th>
                    <th data-field="municipio" data-sortable="true" data-visible="true" data-filter-control="select">MUNICIPIO</th>
                    <th data-field="parroquia_id" data-sortable="true" data-visible="false">ID<br/>PARROQUIA</th>
                    <th data-field="parroquia" data-sortable="true" data-visible="true" data-filter-control="select">PARROQUIA</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

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
        ////////////
        $.ajax({
            type: "POST",
            url: "circ_estados",
            headers: {
                "X-CSRF-Token": $('meta[name="_token"]').attr("content"),
            },
            dataType: "JSON",
            beforeSend: function() {
                $("#backdrop").removeClass('d-none').show();
            },                           
            success: function (response) {
                // crea_circ_estado
                var options = '';
                $('#crea_circ_estado').empty();
                $('#crea_circ_estado').prepend('<option>Seleccione el estado</option>');
                $.each(response, function(key, value) {
                    $('#crea_circ_estado').append($('<option>', {
                        value: value.estado_id,
                        text: value.estado
                    }));
                });
                $('#crea_circ_estado').on('change', function() {
                    let est_id = $('#crea_circ_estado').val();
                    $.ajax({
                        type: "POST",
                        url: "circ_municipios",
                        headers: {
                            "X-CSRF-Token": $('meta[name="_token"]').attr("content"),
                        },
                        data:{'estado':est_id},
                        dataType: "JSON",
                        success: function (response) {
                            $('#crea_circ_municipio').empty();
                            $('#crea_circ_municipio').prepend('<option>Seleccione el municipio</option>');
                            $.each(response, function(key, value) {
                                $('#crea_circ_municipio').append($('<option>', {
                                    value: value.municipio_id,
                                    text: value.municipio
                                }));  
                            });
                        },
                    });
                });
                ///////
                $('#crea_circ_municipio').on('change', function() {
                    let est_id = $('#crea_circ_estado').val();
                    let mun_id = $('#crea_circ_municipio').val();
                    $.ajax({
                        type: "POST",
                        url: "circ_parroquias",
                        headers: {
                            "X-CSRF-Token": $('meta[name="_token"]').attr("content"),
                        },
                        data:{'estado':est_id,'municipio':mun_id},
                        dataType: "JSON",
                        success: function (response) {
                            $('#crea_circ_parroquia').empty();
                            $('#crea_circ_parroquia').prepend('<option>Seleccione la parroquia</option>');
                            $.each(response, function(key, value) {
                                $('#crea_circ_parroquia').append($('<option>', {
                                    value: value.parroquia_id,
                                    text: value.parroquia
                                }));  
                            });
                        },
                    }); 

                });
            },
            error: function() {
            },
            complete: function() {
                $("#backdrop").hide();
            }                        
        });
        ////////////
        $('#circuloInput').on('click',function() {
            $(this).val(null);
            $('#tbl-participantes').bootstrapTable('refresh');            
        });
        $('#circuloInput').on('input change', function() {
            var circuloValue = $(this).val();
            // Recargar la tabla con el filtro del circulo seleccionado
            $('#tbl-participantes').bootstrapTable('refresh', {
                query: {
                    circulo: circuloValue
                }
            });
        });
        $('#circuloInput').on('change', function() {
            if ($(this).val() === '') {
                $('#tbl-participantes').bootstrapTable('refresh', {
                    query: {
                        circulo: ''
                    }
                });
            }
        });
    });
    $('#btnAGrCirculo').on('click', function() {
        var icono = $(this).find('i').eq(1);
        if (icono.hasClass('fa-plus')) {
            $(this).addClass('rounded-circle');
            $(this).attr('title', 'Guardar círculo');
            icono.removeClass('fa-plus').addClass('fa-save');
            $(".agregarCirculo").removeClass('d-none');
        } else if (icono.hasClass('fa-save')) {
            //////
            let data = {
                'estado_id':$("#crea_circ_estado").val(),
                'municipio_id':$("#crea_circ_municipio").val(),
                'parroquia_id':$("#crea_circ_parroquia").val(),
                'comunidad':$("#crea_circ_comunidad").val(),
                'circulo':$("#crea_circ_nombre").val(),
            }
            $.ajax({
                type: "POST",
                url:  "circulos",
                data: data,
                beforeSend: function() {
                    $("#backdrop").removeClass('d-none').show(); // Mostrar el backdrop
                },
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
                        ///////////
                        $('#circulos').empty();
                        response.circulos.forEach(function(circulo) {
                            $('#circulos').prepend(
                                $('<option></option>').val(circulo.circulo).attr('data-id', circulo.id)
                            );
                        });                        
                        ///////////
                        toastr.success('¡El círculo de abuelos ha sido credo exitosamente!');
                    }
                },
                error: function() {
                },
                complete: function() {
                    $("#backdrop").hide();
                }
            });                        
            //////



            $(this).removeClass('bg-primary rounded-circle p-2');
            $(this).addClass('fa-stack');
            $(this).attr('title', 'AGregar círculo si no existe');
            icono.removeClass('fa-save').addClass('fa-plus');
            $(".agregarCirculo").addClass('d-none');
        }
    });
    $("#btnDesCirculo").on("click",function() {
        $("#btnAGrCirculo").removeClass('bg-primary rounded-circle p-2');
        var icono = $("#btnAGrCirculo").find('i').eq(1);
        $("#btnAGrCirculo").addClass('fa-stack');
        $("#btnAGrCirculo").attr('title', 'AGregar círculo si no existe');
        icono.removeClass('fa-save').addClass('fa-plus');
        $("#crea_circ_estado").val(1);
        $("#crea_circ_municipio").empty();
        $("#crea_circ_parroquia").empty();
        $("#crea_circ_nombre").val('');
        $(".agregarCirculo").addClass('d-none');
    });
    $('#btnAGrParticipante').on('click', function() {
        if ($('#circuloInput').val() === '') {
            Swal.fire({
                icon: 'warning',
                title: 'EL CÍCULO NO PUEDE ESTAR VACIO',
                text: 'El círculo al cual corresponde el participante no puede estar vacio; debe seleccionar uno antes de agregar participantes',
                showConfirmButton: 'Cerrar'
            });
        } else {
            // $('.participante').css({
            //     'display': '',
            //     'width': '',
            //     'box-sizing': '',
            //     'padding': ''
            // });
            // $(".participante").text('');
            // $("#part_cedula").val('');
            // $("#part_telef").val('');
            // console.log(2)
            // $('.participante').removeClass('bg-dark');
            let icono = $(this).find('i').eq(1);
            if (icono.hasClass('fa-plus')) {
                $('.participante').css({
                    'display': '',
                    'width': '',
                    'box-sizing': '',
                    'padding': ''
                });
                $(".participante").text('');
                $("#part_cedula").val('');
                $("#part_telef").val('');
                // $('.participante').removeClass('bg-dark');
                $(this).addClass('rounded-circle');
                $(this).attr('title', 'Guardar participante');
                icono.removeClass('fa-plus').addClass('fa-save');
                $(".agregarParticipante").removeClass('d-none');
                $("#addParticipante").removeClass('d-none');
            } else if (icono.hasClass('fa-save')) {
                if($("#part_cedula").val()=='' || $("#part_telef").val()=='') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'CÉDULA Y TELÉFONO SON REQUERIDOS',
                        text: 'Tanto el número telefónico como el número de cédula son obligatorios ',
                        showConfirmButton: 'Cerrar'
                    });                    
                } else {
                    let data = {
                        'circulo':$("#circuloInput").val(),
                        'cedula':$("#part_cedula").val(),
                        'telefono':$("#part_telef").val(),
                        'primer_nombre':$("#pnombre").text(),
                        'segundo_nombre':$("#snombre").text(),
                        'primer_apellido':$("#papellido").text(),
                        'segundo_apellido':$("#sapellido").text(),
                        'fecha_nacimiento':$("#fnac").text(),
                        'sexo':$("#sexo").text(),
                        'estado_civil':$("#edo_civil").text(),
                        'estado':$("#estado").text(),
                        'municipio':$("#municipio").text(),
                        'parroquia':$("#parroquia").text(),
                    };
                    $.ajax({
                        type: "POST",
                        url: "participantes",
                        headers: {
                            "X-CSRF-Token": $('meta[name="_token"]').attr("content"),
                        },
                        dataType: "JSON",
                        data:data,
                        beforeSend: function() {
                            $("#backdrop").removeClass('d-none').show(); // Mostrar el backdrop
                        },                           
                        success: function (response) {
                            if(response.status==200) {
                                toastr.success(response.message);
                                $(this).removeClass('bg-primary rounded-circle p-2');
                                $(this).addClass('fa-stack');
                                $(this).attr('title', 'Agregar participante');
                                icono.removeClass('fa-save').addClass('fa-plus');
                                $(".agregarParticipante").addClass('d-none');
                                $("#addParticipante").addClass('d-none');
                                $("#crp-part").addClass('d-none');
                                $('#tbl-circulos').bootstrapTable('refresh');
                                var circuloValue = $("#circuloInput").val();
                                $('#tbl-participantes').bootstrapTable('refresh', {
                                    query: {
                                        circulo: circuloValue
                                    }
                                });                            
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function() {
                        },
                        complete: function() {
                            $("#backdrop").hide();
                        }                        
                    });
                }
            }
        }
    });
    $("#btnCheckPart").on("click",function() {
        let cedula = $("#part_cedula").val();
        ///////////
        $.ajax({
            type: "POST",
            url: "check_cedula",
            headers: {
                "X-CSRF-Token": $('meta[name="_token"]').attr("content"),
            },
            dataType: "JSON",
            data:{cedula:$("#part_cedula").val()},
            beforeSend: function() {
                $("#backdrop").removeClass('d-none').show(); // Mostrar el backdrop
            },            
            success: function (response) {
                if (response.error) {
                    toastr.error(response.error);
                } else if(response.errors) {
                    toastr.error(response.errors.cedula[0]);
                }else {
                    $("#crp-part").removeClass('d-none');
                    $('.participante').addClass('bg-dark');
                    let fechaNacimiento = moment(response.dtmnacimiento).format('DD/MM/YYYY');
                    $("#pnombre").text(response.strnombre_primer);
                    $("#snombre").text(response.strnombre_segundo);
                    $("#papellido").text(response.strapellido_primer);
                    $("#sapellido").text(response.strapellido_segundo);
                    $("#fnac").text(fechaNacimiento);
                    $("#sexo").text(response.sexo);
                    $("#edo_civil").text(response.estado_civil);
                    $("#estado").text(response.estado);
                    $("#municipio").text(response.municipio);
                    $("#parroquia").text(response.parroquia);
                    $(".participante").css({
                        'display': 'block',
                        'width': '100%',
                        'box-sizing': 'border-box',
                        'padding': '5px 5px 5px 10px'
                    });
                }
            },
            error: function() {
            },
            complete: function() {
                $("#backdrop").hide();
            }
        }); 
        ///////////
    })
    $("#btnDesParticipante").on("click",function() {
        $("#btnAGrParticipante").removeClass('bg-primary rounded-circle p-2');
        var icono = $("#btnAGrParticipante").find('i').eq(1);
        $("#btnAGrParticipante").addClass('fa-stack');
        $("#btnAGrParticipante").attr('title', 'AGregar participante');
        icono.removeClass('fa-save').addClass('fa-plus');
        $(".participante").text('');
        $("#part_cedula").val('');
        $("#part_telef").val('');
        // $("#crea_circ_estado").val(1);
        // $("#crea_circ_municipio").empty();
        // $("#crea_circ_parroquia").empty();
        // $("#crea_circ_nombre").val('');
        $(".agregarParticipante").addClass('d-none');
        $("#addParticipante").addClass('d-none');
        $("#crp-part").addClass('d-none');
    });


    </script>
@stop