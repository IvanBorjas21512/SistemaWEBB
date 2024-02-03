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

	if ($_SESSION['Escritorio']==1)
	{

?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Escritorio</h1>
</div>
<!-- Content Row -->
<div class="row">
	
	<!-- Mis Gastos Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-success shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Mis Gastos</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><span id="misgastos">S/. 0.00</span></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-calculator fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Total de trabajos Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-info shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total de trabajos</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><span id="totaltrabajos"></span></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-briefcase fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Trabajos Entregados Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Trabajos Terminados</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><span id="tterminados"></span></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-clipboard-check fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Trabajos Pendientes Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-danger shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Trabajos pendientes</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><span id="tpendientes"></span></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-hourglass-half fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- End Content Row -->
<div class="row">
	<div class="col-lg-12">
    	<div class="card p-2 shadow">
      		<div class="card-body align-items-center justify-content-between" id="formMostrar">
         		<form name="formMostrarDatos" id="formMostrarDatos">
           			<div class="row">
					   	<div class="form-group col-xs-12"><span class="badge badge-secondary p-1">Datos Personales</span></div>
            			<div class="form-group col-xs-12 col-sm-3">
              				<label>DNI</label>
							<input type="text" name="dni" id="dni" class="form-control">
						</div>
					</div>
            		<div class="row">
                		<div class="form-group col-xs-12 col-sm-6">
              				<label>Nombres</label>
              				<input type="text" name="nombre" id="nombre" class="form-control">
            			</div>
						<div class="form-group col-xs-12 col-sm-6">
              				<label>Apellidos</label>
              				<input type="text" name="apellido" id="apellido" class="form-control">
            			</div>
            		</div>
            		<div class="row">
                		<div class="form-group col-xs-12">
              				<label>Dirección</label>
              				<input type="text" name="direccion" id="direccion" class="form-control">
            			</div>
            		</div>					
            		<div class="row">
                		<div class="form-group col-xs-12 col-sm-3">
              				<label>Teléfono</label>
                			<input type="text" name="telefono" id="telefono" class="form-control" maxlength="9" pattern="[0-9]{0,9}">
            			</div>
						<div class="form-group col-xs-12 col-sm-9">
              				<label>E-mail</label>
                			<input type="email" name="email" id="email" class="form-control">
            			</div>
            		</div>
					<div class="row" id="formbtninicial">
						<div class="form-group col-xs-6">
              				<button title="Modificar datos personales" class="btn btn-success btn-block" type="button" id="btnmodificar"><i class="far fa-edit"></i> Modificar Información</button>
            			</div>
						<div class="form-group col-xs-6">
              				<button title="Cambiar contraseña" class="btn btn-success btn-block" type="button" id="btncambiarcontraseña"><i class="far fa-edit"></i> Cambiar Contraseña</button>
            			</div>
					</div>
					<div class="row" id="formbtnmodificar">
						<div class="form-group col-xs-6">
              				<button title="Guardar datos personales" class="btn btn-primary btn-block" type="submit" id="btnguardarinfo"><i class="far fa-save"></i> Guardar Información</button>
            			</div>
						<div class="form-group col-xs-6">
              				<button title="Cancelar modificación" class="btn btn-danger btn-block" type="button" id="btncancelar"><i class="far fa-arrow-alt-circle-left"></i> Cancelar</button>
            			</div>
					</div>
          		</form>
        	</div>

			<div class="card-body align-items-center justify-content-between" id="formContraseña">
         		<form name="formCambiarContraseña" id="formCambiarContraseña">
           			<div class="row">
					   	<div class="form-group col-xs-12"><span class="badge badge-secondary p-1">Cambiar Contraseña</span></div>
            			<div class="form-group col-xs-12 col-sm-6">
              				<label>Contraseña actual</label>
							<input type="password" name="contraactual" id="contraactual" class="form-control" placeholder="Ingrese su contraseña actual" required>
						</div>
					</div>
            		<div class="row">
						<div class="form-group col-xs-12 col-sm-6">
              				<label>Nueva Contraseña</label>
							<input type="password" name="contranueva" id="contranueva" class="form-control" placeholder="Ingrese su nueva contraseña" maxlength="100" pattern="[A-Z|a-z|0-9|.|@|+|$|%|-]{8,100}" title="Tu contraseña debe tener más de 8 caracteres entre letras y simbolos (permitidos: - @ + $ % .) y no debe incluir espacios." required>
						</div>
						<div class="form-group col-xs-12 col-sm-6">
              				<label>Confirmar Contraseña</label>
							<input type="password" name="contraconfirmar" id="contraconfirmar" class="form-control" placeholder="Ingrese su nueva contraseña" required>
						</div>
            		</div>
					<div class="row">
						<div class="form-group col-xs-6">
              				<button title="Guardar cambio de contraseña" class="btn btn-primary btn-block" type="submit" id="btnguardarcontraseña"><i class="far fa-save"></i> Guardar Contraseña</button>
            			</div>
						<div class="form-group col-xs-6">
              				<button title="Cancelar cambio de contraseña" class="btn btn-danger btn-block" type="button" id="btncancelarcontra"><i class="far fa-arrow-alt-circle-left"></i> Cancelar</button>
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
	<script type="text/javascript" src="scripts/escritorio.js"></script>
<?php
	}
	ob_end_flush();
?>