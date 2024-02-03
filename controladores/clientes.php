<?php 
require_once "../modelos/Clientes.php";

$cliente=new Clientes();


$idcliente=isset($_POST["idcliente"])? limpiarCadena($_POST["idcliente"]):"";
$ruc=isset($_POST["ruc"])? limpiarCadena($_POST["ruc"]):"";
$razonsocial=isset($_POST["razonsocial"])? limpiarCadena($_POST["razonsocial"]):"";
$representante=isset($_POST["representante"])? limpiarCadena($_POST["representante"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";

$Date = new DateTime();  
$Date->setTimezone(new DateTimeZone('America/Lima'));
$fregistro = $Date->format("Y-m-d");

switch ($_GET["op"]){
        
	case 'guardaryeditar':
		if (strlen(trim($ruc))>0 && strlen(trim($razonsocial))>0 && strlen(trim($representante))>0 && strlen(trim($direccion))>0 && strlen(trim($telefono))>0 && strlen(trim($email))>0){
			if (empty($idcliente)){
				$rspta=$cliente->insertar($ruc,$razonsocial,$representante,$direccion,$telefono,$email,$fregistro);
				echo $rspta ? "Cliente registrado exitosamente" : "Cliente no se pudo registrar, revise datos ingresados";
			}
			else {
				$rspta=$cliente->editar($idcliente,$ruc,$razonsocial,$representante,$direccion,$telefono,$email);
				echo $rspta ? "Cliente actualizado exitosamente" : "Cliente no se pudo actualizar";
			}
		}else{
			echo "vacio";
		}	
	break;

	case 'desactivar':
		$rspta=$cliente->desactivar($idcliente);
 		echo $rspta ? "Cliente Desactivado" : "Cliente no se puede desactivar";
	break;

	case 'activar':
		$rspta=$cliente->activar($idcliente);
 		echo $rspta ? "Cliente activado" : "Cliente no se puede activar";
	break;
        
	case 'mostrar':
		$rspta=$cliente->mostrar($idcliente);
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$cliente->listar($idcliente);
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->ruc,
 				"1"=>$reg->razonSocial,
				"2"=>$reg->representante,
 				"3"=>$reg->telefono,
 				"4"=>($reg->estado)?'<button title="Editar cliente" class="btn btn-warning btn-circle btn-sm" onclick="mostrar('.$reg->idcliente.')"><i class="far fa-edit"></i></button>'.
 					' <button title="Desactivar cliente" class="btn btn-danger btn-circle btn-sm" onclick="desactivar('.$reg->idcliente.')"><i class="fas fa-ban"></i></button>':
 					' <button title="Activar cliente" class="btn btn-primary btn-circle btn-sm" onclick="activar('.$reg->idcliente.')"><i class="fas fa-check"></i></button>',);
                
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'seleccionarClientes':
		$rspta = $cliente->seleccionarClientes();
		while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' . $reg->idcliente . '>' . $reg->razonSocial . '</option>';
        }
	break;
}
?>