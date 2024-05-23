<div class="modal fade" id="mdl-circulos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content" data-bs-backdrop="static">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="row" id="personal">
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <label>CÉDULA<span class="requerido">*</span></label><br/>
                            <input id="txt_cedula" class="editar-campo form-control" type="number"> 
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-8">
                            <label>NOMBRES<span class="requerido">*</span></label><br/>
                            <input id="txt_nombre" class="editar-campo form-control" type="text">
                        </div>
                    </div> 
                    <hr/>
                    <div class="row" id="hora_hora_voto">
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <label>VOTÓ</label><br/>
                            <label id="lbl_voto" class="ver-campo"></label>
                            <select class="editar-campo form-control" id="selVoto">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <label>HORA</label><br/>
                            <label id="lbl_hora" class="ver-campo"></label>
                            <input id="txt_hora" class="editar-campo form-control" type="time">
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <label>ESTADO<span class="requerido">*</span></label><br/>
                            <label id="lbl_estado" class="ver-campo"></label>
                            <select id="selEstado" class="editar-campo form-control">
                                <option value="">Seleccione</option>
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <label>MUNICIPIO<span class="requerido">*</span></label><br/>
                            <label id="lbl_municipio" class="ver-campo"></label>
                            <select id="selMunicipio" class="editar-campo form-control">
                                <option value="">Seleccione</option>
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <label>PARROQUIA<span class="requerido">*</span></label><br/>
                            <label id="lbl_parroquia" class="ver-campo"></label>
                            <select id="selParroquia" class="editar-campo form-control">
                                <option value="">Seleccione</option>                                
                            </select>
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <label>NÚCLEO<span class="requerido">*</span></label><br/>
                            <label id="lbl_nucleo" class="ver-campo"></label>
                            <select id="selNucleo" class="editar-campo form-control">
                                <option value="">Seleccione</option>                                
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <label>TIPO<span class="requerido">*</span></label><br/>
                            <label id="lbl_tipo" class="ver-campo"></label>
                            <select id="selTipo" class="editar-campo form-control">
                                <option value="">Seleccione</option>                                
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <label>FORMACIÓN<span class="requerido">*</span></label><br/>
                            <label id="lbl_formacion" class="ver-campo"></label>
                            <select id="selFormacion" class="editar-campo form-control">
                                <option value="">Seleccione</option>                                
                            </select>
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>TELÉFONO</label><br/>
                            <label id="lbl_telefono" class="ver-campo"></label>
                            <input id="txt_telefono" class="editar-campo form-control">
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                            <label>CORREO</label><br/>
                            <label id="lbl_email" class="ver-campo"></label>
                            <input id="txt_email" class="editar-campo form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 offset-md-12" >
                            <label >OBSERVACIONES</label><br/>
                            <label id="lbl_observaciones" class="ver-campo col"></label>
                            <textarea id="txt_observaciones" class="editar-campo form-control"></textarea>
                        </div>
                    </div>
                    <hr/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="dismiss">Cerrar</button>
                    <button type="button" id="accept" class="btn btn-primary">Aceptar</button>
                </div>
            </div>
        </div>
    </div>