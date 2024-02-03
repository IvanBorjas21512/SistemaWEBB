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

if ($_SESSION['Ordenes de Trabajo']==1)
{
?>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ordenes de Trabajo</h1>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card p-2 shadow">
                <div class="card-body" id="listadoregistros">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0" id="tbllistado">
                            <thead>
                                <tr>
                                    <th>ORDEN DE TRABAJO</th>
                                    <th>ORDEN DE SERVICIO</th>
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

                <div class="card-body align-items-center justify-content-between" id="formularioregistros">
                    <form name="formulario" id="formulario" method="POST">
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-9 col-xs-12">
								<input type="hidden" name="idtrabajo" id="idtrabajo">                        
                        	</div>                        
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-8 col-xs-12 mx-auto">
								<label>Subir documento (Formato: rar, pdf, xls, xlsx)</label>
								<input type="file" name="documento" id="documento" class="form-control" required>
                        	</div>
                        </div>
                        <div class="form-group col-sm-5 col-xs-12 mx-auto">
                            <button title="Guardar documento" class="btn btn-primary btn-block" type="submit" id="btnGuardar"><i class="far fa-save"></i> Guardar</button>
                            <button title="Cancelar registro" class="btn btn-danger btn-block" type="button" id="btncancelarform"><i class="far fa-arrow-alt-circle-left"></i> Cancelar</button>
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

<script type="text/javascript" src="scripts/ordenestrabajo.js"></script>

<?php 
}
ob_end_flush();
?>

