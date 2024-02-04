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
        <h1 class="h3 mb-0 text-gray-800">Consulta de Pagos</h1>
    </div>
    <div class="row">
        <div class="col-lg-12">
          <div class="card p-2 shadow">
                <div class="card-body" id="listadoregistros">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0" id="tbllistado">
                            <thead>
                                <tr>
                                    <th>ORDEN DE PAGO</th>
                                    <th>N. ORDEN</th>
                                    <th>CLIENTE</th>
                                    <th>MONTO</th>
                                    <th>FECHA DE PAGO</th>
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
                            <div class="form-group col-md-6">
                                <h5>N. Pago <span class="badge badge-pill badge-dark" id="idpago"></span></h5>
                            </div>
                            <div class="form-group col-md-6">
                                <h5 class="float-md-right">Estado <span class="badge badge-pill badge-danger" id="estado0"></span><span class="badge badge-pill badge-info" id="estado1"></span><span class="badge badge-pill badge-success" id="estado2"></span></h5>
                            </div>
                        </div>
						            <div class="row">
                            <div class="form-group col-xs-12"><span class="badge badge-pill badge-secondary">Datos del cliente</span></div>
                            <div class="form-group col-md-4">
                              <label>RUC</label>
                              <input type="text" name="ruc" id="ruc" class="form-control">
                            </div>
                            <div class="form-group col-md-8">
                              <label>Razón Social</label>
                              <input type="text" name="razonsocial" id="razonsocial" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12"><span class="badge badge-pill badge-secondary">Datos del servicio realizado</span></div>
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
                              <label>Fecha Final</label>
                              <input type="date" class="form-control" name="ffinal" id="ffinal">
                            </div>
                            <div class="form-group col-lg-4 col-sm-12">
                              <label>Costo</label>
                              <input type="text" class="form-control" name="costo" id="costo">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12"><span class="badge badge-pill badge-secondary">Encargado de realizar el servicio</span></div>
                            <div class="form-group col-xs-12">
                              <label>Trabajador</label>
                              <input type="text" name="trabajador" id="trabajador" class="form-control">
                            </div>
                            <div class="form-group col-xs-12" id="divfecha"><span class="badge badge-pill badge-secondary">Datos de la factura</span></div>
                            <div class="form-group col-lg-4 col-sm-6" id="fregistrodiv">
                              <label>Fecha de registro</label>
                              <input type="date" class="form-control" name="fregistro" id="fregistro">
                            </div>
                            <div class="form-group col-lg-4 col-sm-6" id="fpagodiv">
                              <label>Fecha de pago</label>
                              <input type="date" class="form-control" name="fpago" id="fpago">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <button title="Regresar a consultas" class="btn btn-info btn-block" type="button" id="btnregresar"><i class="far fa-arrow-alt-circle-left"></i> Volver al menú anterior</button>
				<a class="btn btn-danger float-right" style="margin-top:30px" target="_blank" href="facturaa.php?idorden=<?php echo $row['idorden']; ?>&razonSocial=<?php echo urlencode($row['razonSocial']); ?>&representante=<?php echo urlencode($row['representante']); ?>&ruc=<?php echo urlencode($row['ruc']); ?>&direccion=<?php echo urlencode($row['direccion']); ?>&telefono=<?php echo urlencode($row['telefono']); ?>&email=<?php echo urlencode($row['email']); ?>&descripcion=<?php echo urlencode($row['descripcion']); ?>&costo=<?php echo urlencode($row['costo']); ?>&fechaInicio=<?php echo urlencode($row['fechaInicio']); ?>&fechaFinal=<?php echo urlencode($row['fechaFinal']); ?>" role="button">Imprimir Factura</a>
                                 <!--idpagos php echo $idpagos-->  
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

<script type="text/javascript" src="scripts/consultapagos.js"></script>

<?php
}
ob_end_flush();
?>
