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

if ($_SESSION['Servicios']==1)
{
?>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Servicios</h1>
        <button class="btn btn-sm btn-success shadow-sm" title="Registrar servicio" id="btnagregar"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Registrar Servicio</button>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card p-2 shadow">
                <div class="card-body" id="listadoregistros">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0" id="tbllistado">
                            <thead>
                                <tr>
                                    <th>NOMBRE DEL SERVICIO</th>
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
                            <div class="form-group col-sm-8 col-xs-12 mx-auto">
								<label>Nombre del Servicio</label>
								<input type="hidden" name="idservicio" id="idservicio">
								<input type="text" name="servicio" id="servicio" class="form-control" placeholder="Nombre del Servicio" maxlength="100" required>
                       		</div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-5 col-xs-12 mx-auto">
                                <button title="Guardar servicio" class="btn btn-primary btn-block" type="submit" id="btnGuardar"><i class="far fa-save"></i> Guardar</button>
                                <button title="Cancelar registro" class="btn btn-danger btn-block" type="button" id="btncancelar"><i class="far fa-arrow-alt-circle-left"></i> Cancelar</button>
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
        <script type="text/javascript" src="scripts/servicios.js"></script>
<?php 
}
ob_end_flush();
?>

