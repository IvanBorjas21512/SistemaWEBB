<?php 
session_start();
require_once "../modelos/Usuarios.php";
require_once "../modelos/Ordenestrabajo.php";
require_once "../modelos/Gastos.php";

$usuarios=new Usuarios();
$ordent=new OrdenesTrabajo();
$gastos=new Gastos();

$idusuario=$_SESSION['idusuario'];
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$contraactual=isset($_POST["contraactual"])? limpiarCadena($_POST["contraactual"]):"";
$contranueva=isset($_POST["contranueva"])? limpiarCadena($_POST["contranueva"]):"";
$contraconfirmar=isset($_POST["contraconfirmar"])? limpiarCadena($_POST["contraconfirmar"]):"";

switch ($_GET["op"]){
        
	case 'modificarDatos':
		if (strlen(trim($direccion))>0 && strlen(trim($telefono))>0 && strlen(trim($email))>0){    
			if(empty($idusuario)){
				echo "No se pudo modificar tus datos ingresados";
			}
			else {
				$rspta=$usuarios->modificarDatos($idusuario,$direccion,$telefono,$email);
				echo $rspta ? "Se modificaron tus datos correctamente" : "ERROR";
			}
		}else{
			echo "vacio";
		}
	break;

	case 'cambiarContraseña':
		if(!empty($contraactual) & !empty($contranueva) & !empty($contraconfirmar)){
			$clavehashactual=hash("SHA256",$contraactual);
			$rspta = $usuarios->devolverContraseñaActual($idusuario,$clavehashactual);
			if(isset($rspta)){
				if($contranueva==$contraconfirmar){
					$clavehashnueva=hash("SHA256",$contranueva);
					$rsptafinal = $usuarios->cambiarContraseña($idusuario,$clavehashnueva);
					echo $rsptafinal ? "Su contraseña ha sido modificado con éxito":"No se pudo cambiar su contraseña";
				}else{
					echo "Su contraseña nueva no coincide con su contraseña de confirmar: ambas deben ser iguales";
				}		
			}else{
				echo "Su contraseña actual es incorrecta";
			}
			
		}else{
			echo "Por favor ingrese contraseñas";
		}
	break;
        
	case 'mostrarConsulta':
		$rspta=$usuarios->mostrar($idusuario);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'contarTrabajos':
		$rspta=$ordent->contarTrabajosUsuarios($idusuario);
		echo json_encode($rspta);
	break;

	case 'sumaGastos':
		$rspta=$gastos->sumaGastosUsuario($idusuario);
		echo json_encode($rspta);
	break;

}

?>