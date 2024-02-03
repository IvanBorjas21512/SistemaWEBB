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

if ($_SESSION['Consultas']==1)
{
?>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Consulta de Ordenes de Servicios</h1>
    </div>
    <div class="row">
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
									                  <th>FECHA INICIO</th>
									                  <th>COSTO</th>
                                    <th>ESTADO</th>
									                  <th>OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--Formulario de visualizar datos de consulta-->          
                <div class="card-body align-items-center justify-content-between" id="formularioregistros">
                    <form name="formulario" id="formulario" method="POST">
						            <div class="row">
                            <div class="form-group col-lg-6">
                                <h5>N. Orden de Servicio <span class="badge badge-pill badge-dark" id="idorden"></span></h5>
                            </div>
                            <div class="form-group col-lg-6">
                                <h5 class="float-lg-right">Estado <span class="badge badge-pill badge-danger" id="estado0"></span><span class="badge badge-pill badge-success" id="estado1"></span></h5>
                            </div>
                        </div>
						            <div class="row">
                            <div class="form-group col-xs-12"><label class="badge badge-pill badge-secondary">Datos del cliente</label></div>
                            <div class="form-group col-sm-4">
                              <label>RUC</label>
                              <input type="text" name="ruc" id="ruc" class="form-control">
                            </div>
                            <div class="form-group col-sm-8">
                              <label>Razón Social</label>
                              <input type="text" name="razonsocial" id="razonsocial" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12"><label class="badge badge-pill badge-secondary">Datos del servicio solicitado</label></div>
                            <div class="form-group col-sm-12">
                              <label>Servicio</label>
                              <input type="text" name="servicio" id="servicio" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                              <label>Descripción del servicio</label>
                              <textarea class="form-control" name="descripcion" id="descripcion" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-4 col-sm-6">
                              <label>Fecha Inicio</label>
                              <input type="date" class="form-control" name="finicio" id="finicio">
                            </div>
                            <div class="form-group col-lg-4 col-sm-6">
                              <label>Fecha Fin</label>
                              <input type="date" class="form-control" name="ffinal" id="ffinal">
                            </div>
                            <div class="form-group col-lg-4 col-sm-12">
                              <label>Costo</label>
                              <input type="text" class="form-control" name="costo" id="costo">
                            </div>
                        </div>
                        <div class="row" id="formtrabajador">
                            <div class="form-group col-xs-12"><label class="badge badge-pill badge-secondary">Encargado de atender la orden</label></div>
                            <div class="form-group col-sm-12">
                              <label>Trabajador</label>
                              <input type="text" name="trabajador" id="trabajador" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <button title="Regresar a consultas" class="btn btn-info btn-block" type="button" id="btnregresar"><i class="far fa-arrow-alt-circle-left"></i> Volver</button>
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

<script type="text/javascript" src="scripts/consultaordeneservicios.js"></script>

<?php
}
ob_end_flush();
?>