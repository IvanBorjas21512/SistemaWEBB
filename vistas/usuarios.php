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

	if ($_SESSION['Usuarios']==1)
	{
?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Usuarios</h1>
    <button class="btn btn-sm btn-success shadow-sm" title="Registrar cliente" id="btnagregar"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Registrar Usuario</button>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="card p-2 shadow">
            <div class="card-body" id="listadoregistros">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0" id="tbllistado">
                        <thead>
                            <tr>
								<th>IMAGEN</th>
								<th>USUARIO</th>
								<th>NOMBRE</th>
							  	<th>APELLIDO</th>
								<th>TELEFONO</th>
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
            			<div class="form-group col-lg-6 col-xs-12">
							<label>Nombres</label>
							<input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombres" maxlength="50" required>
						</div>
					<!-- </div>
					<div class="row"> -->
						<div class="form-group col-lg-6 col-xs-12">
							<label>Apellidos</label>
								<input type="text" name="apellido" id="apellido" class="form-control" placeholder="Apellidos" maxlength="50" required>
						</div>
            		</div>					
            		<div class="row">
                		<div class="form-group col-lg-3 col-xs-12">
							<label>DNI</label>
							<input type="hidden" name="idusuario" id="idusuario">
							<input type="text" name="dni" id="dni" class="form-control" placeholder="DNI" minlength="8" maxlength="8" pattern="[0-9]{8,8}" title="DNI solo contiene números(8 digitos), no se permiten letras u otro caracter." required>
            			</div>
            		<!-- </div>
            		<div class="row"> -->
                		<div class="form-group col-lg-9 col-xs-12">
              				<label>Dirección</label>
              				<input type="text" name="direccion" id="direccion" class="form-control" placeholder="Dirección" maxlength="100" required>
            			</div>
            		</div>					
            		<div class="row">
                		<div class="form-group col-lg-3 col-xs-12">
              				<label>Teléfono</label>
                			<input type="text" name="telefono" id="telefono" class="form-control" placeholder="Teléfono" maxlength="9" pattern="[0-9]{0,9}" title="Ingrese solo números(max. 9 digitos), no se permiten letras u otro caracter." required>
            			</div>
            		<!-- </div>
            		<div class="row"> -->
                		<div class="form-group col-lg-9 col-xs-12">
              				<label>E-mail</label>
                			<input type="email" name="email" id="email" class="form-control" placeholder="Correo Electrónico" maxlength="100" required>
            			</div>
            		</div>
            		<div class="row" id="frmDatoslogeo">
                		<div class="form-group col-sm-6 col-xs-12">
              				<label>Usuario</label>
              				<input type="text" name="login" id="login" class="form-control" placeholder="Usuario" maxlength="50" required>
            			</div>
                 		<div class="form-group col-sm-6 col-xs-12">
              				<label>Contraseña</label>
              				<input type="password" name="clave" id="clave" class="form-control" placeholder="Contraseña" maxlength="100" pattern="[A-Z|a-z|0-9|.|@|+|$|%|-]{8,100}" title="Tu contraseña debe tener más de 8 caracteres entre letras y simbolos (permitidos: - @ + $ % .) y no debe incluir espacios." required>
            			</div>
             		</div>
             		<div class="row">
					 	<div class="form-group col-xs-12" id="frmDatosimagen">
            				<label>Imagen (Formato: jpg, jpeg, png)</label>
							<input type="file" class="form-control" name="imagen" id="imagen"><br>
						</div>
                 		<div class="form-group col-xs-12">
                 			<label>Permisos:</label>
                			<ul id="permisos">
                			</ul>
                		</div>
            		</div>
					<div class="row">					
						<div class="form-group col-sm-5 col-xs-12 mx-auto">
							<button title="Guardar usuario" class="btn btn-primary btn-block" type="submit" id="btnGuardar"><i class="far fa-save"></i> Guardar </button>
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

<?php
	}
	else
	{
	  require 'noacceso.php';
	}
	require 'footer.php';
?>
	<script type="text/javascript" src="scripts/usuarios.js"></script>
<?php
	}
	ob_end_flush();
?>