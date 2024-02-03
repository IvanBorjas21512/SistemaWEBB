<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION["nombre"]))
{
  header("Location: login.php");
}
else
{
require 'header.php';
if ($_SESSION['Gastos']==1)
{
?>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gastos</h1>
        <button class="btn btn-sm btn-success shadow-sm" title="Registrar cliente" id="btnagregar"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Registrar Gasto</button>
    </div>
    <!-- Inicio Contenido PHP-->
    <div class="row">
        <div class="col-lg-12">
            <div class="card p-2 shadow">
                <div class="card-body" id="listadoregistros">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0" id="tbllistado">
                            <thead>
                                <tr>
                                    <th>TRABAJADOR</th>
                                    <th>FECHA</th>
                                    <th>CONCEPTO</th>
                                    <th>MONTO</th>
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
                            <div class="form-group col-xl-8 col-lg-10 col-md-12 mx-auto">
                                <label>Usuario</label>
                                <input type="hidden" name="idgasto" id="idgasto">
                                <select id="idusuario" name="idusuario" class="form-control selectpicker" data-live-search="true" required></select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xl-8 col-lg-10 col-md-12 mx-auto">
                                <label>Concepto</label>
                                <textarea class="form-control" name="concepto" id="concepto" rows="4" placeholder="Motivo del gasto" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-2 col-lg-1 mx-auto"></div>
                            <div class="form-group col-xl-4 col-lg-5 col-sm-6 mx-auto">
                                <label>Monto S/.</label>
                                <input type="number" name="monto" id="monto" class="form-control" placeholder="Monto" step="0.01" required>
                            </div>
                            <div class="form-group col-xl-4 col-lg-5 col-sm-6 mx-auto">
                                <label>Fecha</label>
                                <input type="date" class="form-control" name="fecha" id="fecha" required>
                            </div>
                            <div class="col-xl-2 col-lg-1 mx-auto"></div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-5 col-xs-12 mx-auto">
                                <button title="Guardar gasto" class="btn btn-primary btn-block" type="submit" id="btnGuardar"><i class="far fa-save"></i> Guardar</button>
                                <button title="Cancelar registro" class="btn btn-danger btn-block" type="button" id="btncancelar"><i class="far fa-arrow-alt-circle-left"></i> Cancelar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Contenido PHP-->
    <?php
}
else
{
  require 'noacceso.php';
}

require 'footer.php';
?>
        <script type="text/javascript" src="scripts/gastos.js"></script>
<?php 
}
ob_end_flush();
?>