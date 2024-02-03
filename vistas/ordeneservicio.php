<?php

ob_start();
session_start();
if (!isset($_SESSION["nombre"]))
{
  header("Location: login.php");
}
else
{
require 'header.php';

if ($_SESSION['Ordenes de Servicio']==1)
{
?>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between">
        <h1 class="h3 mb-0 text-gray-800" id="titulo1">Ordenes de Servicio</h1>
        <button class="btn btn-sm btn-success shadow-sm" title="Registrar cliente" id="btnagregar"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Registrar Orden de servicio</button>
    </div>
    <div class="row mt-4 mb-4" id="formOrdenServicio">
        <div class="col-lg-12">
            <div class="card p-2 shadow">
                <div class="card-body" id="listadoregistros">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0" id="tbllistado">
                            <thead>
                                <tr>
                                    <th>N. ORDEN</th>
                                    <th>CLIENTE</th>
                                    <th>SERVICIO</th>
                                    <th>COSTO</th>
                                    <th>FECHA INICIO</th>
                                    <th>FECHA FIN</th>
                                    <th>ESTADO</th>
									<th>OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-body align-items-center justify-content-between" id="formularioregistros">
                    <form name="formulario" id="formulario" method="POST">
                        <div class="row">
                           <div class="form-group col-md-6 col-xs-12">
								<label>Cliente</label>
								<input type="hidden" name="idorden" id="idorden">
								<select name="idcliente" id="idcliente" class="form-control selectpicker" data-live-search="true" required></select>                           
                        	</div>
							<div class="form-group col-md-6 col-xs-12">
							   <label>Servicio</label>
								<select name="idservicio" id="idservicio" class="form-control selectpicker" data-live-search="true" required></select> 
								<!--<input type="hidden" class="form-control" name="fprestamo" id="fprestamo" required>-->
							</div>                          
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12">
								<label>Descripción del servicio</label>
                                <textarea class="form-control" name="descripcion" id="descripcion" rows="4" placeholder="Descripción mas detallada del servicio" required></textarea>
                        	</div>
                        </div>						
                        <div class="row">
							<div class="form-group col-md-4 col-xs-12">
								<label>Costo S/.</label>
								<input type="number" name="costo" id="costo" class="form-control" placeholder="Costo del servicio" step="0.01" required>
							</div>
							<div class="form-group col-md-4 col-xs-12">
								<label>Fecha Inicio</label>
								<input type="date" class="form-control" name="fechainicio" id="fechainicio" required>
							</div>
							<div class="form-group col-md-4 col-xs-12">
								<label>Fecha Final</label>
								<input type="date" class="form-control" name="fechafin" id="fechafin" required>
							</div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-5 col-xs-12 mx-auto">
                                <button title="Guardar orden de servicio" class="btn btn-primary btn-block" type="submit" id="btnGuardar"><i class="far fa-save"></i> Guardar</button>
                            </div>
                            <div class="form-group col-sm-5 col-xs-12 mx-auto">
                                <button title="Cancelar registro" class="btn btn-danger btn-block" type="button" id="btncancelarform"><i class="far fa-arrow-alt-circle-left"></i> Cancelar</button>
                            </div>
                        </div>
                    </form>
                </div>
				
            </div>
        </div>
    </div>
    <!--FORM TRABAJO-->
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" id="titulo2">Ordenes de Trabajo</h1>
    </div>
	<div class="row" id="formOrdenTrabajo">
        <div class="col-lg-12">
            <div class="card p-2 shadow">
                <div class="card-body" id="listadoregistrostb">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0" id="tbllistadotb">
                            <thead>
                                <tr>
                                    <th>USUARIO</th>
                                    <th>N. ORDEN</th>
                                    <th>DOCUMENTO</th>
                                    <th>FECHA DE ENTREGA</th>
                                    <th>ESTADO</th>
                                    <th>OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-body align-items-center justify-content-between" id="formularioregistrostb">
                    <form name="formulariotb" id="formulariotb" method="POST">
                        <div class="row">
                           <div class="form-group col-xl-6 col-lg-8 col-md-12 mx-auto">
								<label>Encargado del trabajo</label>
								<input type="hidden" name="idtrabajo" id="idtrabajo">
                                <input type="hidden" name="idordentb" id="idordentb">
								<select name="idusuario" id="idusuario" class="form-control selectpicker" data-live-search="true" required></select>                         
                        	</div>                         
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-5 col-xs-12 mx-auto">
                                <button class="btn btn-primary btn-block" type="submit" title="Guardar encargado del trabajo" id="btnGuardartb"><i class="far fa-save"></i> Guardar</button>
                                <button class="btn btn-danger btn-block" type="button" title="Cancelar registro" id="btncancelarformtb"><i class="far fa-arrow-alt-circle-left"></i> Cancelar</button>
                            </div>
                        </div>
                    </form>
                </div>				
            </div>
        </div>
    </div>

    <?php
}
else
{
  require 'noacceso.php';
}
require 'footer.php';
?>

<script type="text/javascript" src="scripts/ordeneservicio.js"></script>

<?php 
}
ob_end_flush();
?>

