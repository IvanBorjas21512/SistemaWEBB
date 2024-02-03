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
        <h1 class="h3 mb-0 text-gray-800">Consulta de Clientes</h1>
    </div>    
    <div class="row">
        <div class="col-lg-12">
          <div class="card p-2 shadow">
                <div class="card-body" id="listadoregistros">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0" id="tbllistado">
                            <thead>
                                <tr>
                                    <th>RUC</th>
                                    <th>RAZÓN SOCIAL</th>
                                    <th>REPRESENTANTE</th>
                                    <th>TELÉFONO</th>
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
                            <div class="form-group col-sm-5">
                                <h5>N. Cliente <span class="badge badge-pill badge-dark" id="idcliente"></span></h5>
                            </div>
                            <div class="form-group col-sm-7">
                                <h5 class="float-md-right">Estado <span class="badge badge-pill badge-danger" id="estado0"></span><span class="badge badge-pill badge-success" id="estado1"></span></h5>
                            </div>
                        </div>
						            <div class="row">
                            <div class="form-group col-xs-12"><span class="badge badge-pill badge-secondary">Datos del cliente</span></div>
                            <div class="form-group col-xl-3 col-md-12">
                              <label>RUC</label>
                              <input type="text" name="ruc" id="ruc" class="form-control">
                            </div>
                            <div class="form-group col-xl-5 col-md-12">
                              <label>Razón Social</label>
                              <input type="text" name="razonsocial" id="razonsocial" class="form-control">
                            </div>
                            <div class="form-group col-xl-4 col-md-12">
                              <label>Representante</label>
                              <input type="text" name="representante" id="representante" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xl-6 col-md-12">
                              <label>Dirección</label>
                              <input type="text" name="direccion" id="direccion" class="form-control">
                            </div>
                            <div class="form-group col-xl-6 col-md-12">
                              <label>Email</label>
                              <input type="text" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group col-xl-4 col-sm-6">
                              <label>Telefono</label>
                              <input type="text" name="telefono" id="telefono" class="form-control">
                            </div>
                            <div class="form-group col-xl-4 col-sm-6">
                              <label>Fecha de registro</label>
                              <input type="date" name="fecharegistro" id="fecharegistro" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <button title="Regresar a consultas" class="btn btn-info btn-block" type="button" id="btnregresar"><i class="far fa-arrow-alt-circle-left"></i> Volver al menú anterior</button>
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
        <script type="text/javascript" src="scripts/consultaclientes.js"></script>
<?php 
}
ob_end_flush();
?>