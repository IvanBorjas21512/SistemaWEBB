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

if ($_SESSION['Clientes']==1)
{
?>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Clientes</h1>
        <button class="btn btn-sm btn-success shadow-sm" title="Registrar cliente" id="btnagregar"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Registrar Cliente</button>
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
                                    <th>TELEFONO</th>
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
                            <div class="form-group col-sm-5 col-xs-12">
								<label>RUC</label>
								<input type="hidden" name="idcliente" id="idcliente">
								<input type="text" name="ruc" id="ruc" class="form-control" placeholder="RUC" minlength="11" maxlength="11" pattern="[0-9]{11,11}" title="RUC solo contiene números(11), no se permiten letras u otro caracter." required>
                       		</div>
                        <!-- </div>
                        <div class="row"> -->
                            <div class="form-group col-sm-7 col-xs-12">
								<label>Razón Social</label>
								<input type="text" name="razonsocial" id="razonsocial" class="form-control" placeholder="Razón Social" maxlength="100" required>
                        	</div>
                        </div>						
                        <div class="row">
                            <div class="form-group col-sm-5 col-xs-12">
								<label>Representante</label>
								<input type="text" name="representante" id="representante" class="form-control" placeholder="Representante de la Empresa" maxlength="100" required>
                        	</div>
                        <!-- </div>
                        <div class="row"> -->
                            <div class="form-group col-sm-7 col-xs-12">
								<label>Dirección</label>
								<input type="text" name="direccion" id="direccion" class="form-control" placeholder="Dirección de la Empresa" maxlength="100" required>
                        	</div>
                        </div> 
                        <div class="row">
							<div class="form-group col-sm-5 col-xs-12">
								<label>Teléfono</label>
								<input type="text" name="telefono" id="telefono" class="form-control" maxlength="9" placeholder="Teléfono" pattern="[0-9]{0,9}" title="Telefono solo contiene números(9), no se permiten letras u otro caracter." required>
							</div>
                        <!-- </div>
						<div class="row"> -->
							<div class="form-group col-sm-7 col-xs-12">
								<label>E-mail</label>
								<input type="email" name="email" id="email" class="form-control" placeholder="Correo Electrónico" maxlength="100" required>
							</div>
						</div>
                        <div class="row">					
                            <div class="form-group col-sm-5 col-xs-12 mx-auto">
                                <button title="Guardar cliente" class="btn btn-primary btn-block" type="submit" id="btnGuardar"><i class="far fa-save"></i> Guardar</button>
                            </div>
                            <div class="form-group col-sm-5 col-xs-12 mx-auto">    
                                <button title="Cancelar registro" class="btn btn-danger btn-block" type="button" id="btncancelar"><i class="far fa-arrow-alt-circle-left"></i> Cancelar</button>
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
    <div style="text-align: center">
    <a href="fpdf-tutoriales-master/PruebaV.php" download>
        <button style="width: 150px; margin-right: 10px; background-color: #d9534f; color: white;" onclick="generarPDF()">Generar PDF</button>
    </a>
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
        <script type="text/javascript" src="scripts/clientes.js"></script>
<?php 
}
ob_end_flush();
?>

