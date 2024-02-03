<?php

require_once "../modelos/Pagos.php";

$pagos=new Pagos();
$idpago=isset($_POST["idpago"])? limpiarCadena($_POST["idpago"]):"";
$idpagof=isset($_POST["idpagof"])? limpiarCadena($_POST["idpagof"]):"";
$fechapago=isset($_POST["fechapago"])? limpiarCadena($_POST["fechapago"]):"";
$documento=isset($_POST["documento"])? limpiarCadena($_POST["documento"]):"";

$Date = new DateTime();  
$Date->setTimezone(new DateTimeZone('America/Lima'));
$fregistro = $Date->format("Y-m-d");

switch ($_GET["op"]){
	case 'guardarfactura':
		$ext = explode(".", $_FILES["documento"]["name"]);
		if ($_FILES['documento']['type'] == "application/octet-stream" || $_FILES['documento']['type'] == "application/pdf")
		{
			$documento = round(microtime(true)) . '.' . end($ext);
			move_uploaded_file($_FILES["documento"]["tmp_name"], "../archivos/facturas/" . $documento);
			if (empty($idpago)){
				echo "No ha seleccionado ninguna orden de pago";
			}
			else {
				session_start();
				//var_dump($_SESSION['idusuario']);
				$rspta=$pagos->guardarfactura($idpago,$fregistro,$documento,$_SESSION['idusuario']);
				echo $rspta ? "Factura guardada con éxito" : "La Factura no se pudo guardar";
			}
		}
		else{
			echo "ERROR: Extensión del archivo no permitido";
		}		
	break;
        
    case 'eliminarfactura':
		$doc=$pagos->buscarFactura($idpago);
		//var_dump($doc);
		$rspta=$pagos->eliminarfactura($idpago);
		unlink("../archivos/facturas/$doc[documento]");
 		echo $rspta ? "Registro de factura eliminado con éxito" : "La factura no se puedo eliminar";
	break;

	case 'eliminarfechapago':
		$rspta=$pagos->eliminarfechapago($idpago);
		echo $rspta ? "Se eliminó con éxito la fecha de pago de la factura" :"No se pudo eliminar la fecha de pago de la factura";
	break;	

	case 'addregistropago':
		if (strlen(trim($fechapago))>0){
			session_start();
			$rspta=$pagos->addregistropago($idpagof,$fechapago,$_SESSION['idusuario']);
			//var_dump($rspta);
			 echo $rspta ? "Se registró con éxito la fecha de pago de la factura" : "No se puedo registrar la fecha de pago de la factura";
		}else{
			echo "vacio";
		}
	break;

	case 'mostrar':
		$rspta=$pagos->mostrar($idpago);
 		echo json_encode($rspta);
	break;

	case 'listar':
	$rspta=$pagos->listar();
 		$data= Array();
 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->idpago,
 				"1"=>$reg->idorden,
 				"2"=>$reg->fregistro,
 				"3"=>$reg->fpago,
				"4"=>$reg->monto,
 				"5"=>($reg->estado)==0?'<span class="badge badge-pill badge-danger">Sin factura</span>':($reg->estado==1?'<span class="badge badge-pill badge-info">Factura registrada</span>':'<span class="badge badge-pill badge-success">Factura pagada</span>'),
               	"6"=>($reg->estado)==0?'<button title="Subir factura" class="btn btn-warning btn-circle btn-sm" onclick="mostrar('.$reg->idpago.')"> <i class="fas fa-upload"> </i></button>':($reg->estado==1?'<a href="../controladores/download.php?factura='.$reg->documento.'"><button title="Descargar factura" class="btn btn-info btn-circle btn-sm"> <i class="fas fa-download"> </i></button></a>'.' <button title="Eliminar factura" class="btn btn-danger btn-circle btn-sm" onclick="eliminarfactura('.$reg->idpago.')"> <i class="fas fa-trash"></i></button>'.' <button title="Registrar pago" class="btn btn-primary btn-circle btn-sm" onclick="mostrarpago('.$reg->idpago.')"><i class="far fa-calendar-check"></i></button>':'<a href="../controladores/download.php?factura='.$reg->documento.'"><button title="Descargar factura" class="btn btn-info btn-circle btn-sm"> <i class="fas fa-download"> </i></button></a>'.' <button title="Eliminar registro de pago" class="btn btn-danger btn-circle btn-sm" onclick="eliminarfechapago('.$reg->idpago.')"> <i class="far fa-calendar-times"></i></button>')
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
	break;
}
?>