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

if ($_SESSION['Pagos']==1)
{
?>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pagos</h1>
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
                                    <th>ORDEN DE SERVICIO</th>
                                    <th>FECHA DE REGISTRO</th>
									<th>FECHA DE PAGO</th>
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
                
                <div class="card-body align-items-center justify-content-between" id="formularioregistros">
                    <form name="formulario" id="formulario" method="POST">
						<div class="row">
                           <div class="form-group col-md-6 col-sm-9 col-xs-12">
								<input type="hidden" name="idpago" id="idpago">                       
                        	</div>                        
                        </div>
						<div class="row">
                            <div class="form-group col-sm-8 col-xs-12 mx-auto">
								<label>Subir documento (Formato: rar, pdf)</label>
								<input type="file" name="documento" id="documento" class="form-control" required>
                        	</div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-5 col-xs-12 mx-auto">
                                <button title="Guardar factura" class="btn btn-primary btn-block" type="submit" id="btnGuardar"><i class="far fa-save"></i> Guardar</button>
                                <button title="Cancelar registro" class="btn btn-danger btn-block" type="button" id="btncancelarfregistro"><i class="far fa-arrow-alt-circle-left"></i> Cancelar</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body align-items-center justify-content-between" id="formularioregistrospago">
                    <form name="formulariopago" id="formulariopago" method="POST">
                        <div class="row">
                           <div class="form-group col-md-6 col-xs-12">
								<input type="hidden" name="idpagof" id="idpagof">                  
                        	</div>                        
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-5 col-xs-12 mx-auto">
                                <label>Fecha de pago</label>
                                <input type="date" class="form-control text-center" name="fechapago" id="fechapago" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-5 col-xs-12 mx-auto">
                                <button title="Guardar fecha de pago" class="btn btn-primary btn-block" type="submit" id="btnGuardarpago"><i class="far fa-save"></i> Guardar</button>
                                <button title="Cancelar registro" class="btn btn-danger btn-block" type="button" id="btncancelarfpago"><i class="far fa-arrow-alt-circle-left"></i> Cancelar</button>
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

<script type="text/javascript" src="scripts/pagos.js"></script>

<?php
}
ob_end_flush();
?>

