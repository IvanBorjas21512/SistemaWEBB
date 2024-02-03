<?php

require_once "../modelos/Ordenestrabajo.php";
require_once "../modelos/Pagos.php";

$ordent=new OrdenesTrabajo();
$pagos=new Pagos();
$idtrabajo=isset($_POST["idtrabajo"])? limpiarCadena($_POST["idtrabajo"]):"";
$documento=isset($_POST["documento"])? limpiarCadena($_POST["documento"]):"";

$Date = new DateTime();  
$Date->setTimezone(new DateTimeZone('America/Lima'));
$fregistro = $Date->format("Y-m-d");

switch ($_GET["op"]){
	case 'guardaryeditar':
		$ext = explode(".", $_FILES["documento"]["name"]);
		if ($_FILES['documento']['type'] == "application/octet-stream" || $_FILES['documento']['type'] == "application/pdf" || $_FILES['documento']['type'] == "application/vnd.ms-excel" || $_FILES['documento']['type'] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")
		{
			$documento = round(microtime(true)) . '.' . end($ext);
			move_uploaded_file($_FILES["documento"]["tmp_name"], "../archivos/documentos/" . $documento);
			if (strlen(trim($documento))>0){
				if (empty($idtrabajo)){
					echo "No ha seleccionado ninguna orden de trabajo";
				}
				else {
					$rsptasql=$ordent->guardardocumento($idtrabajo,$documento,$fregistro);
					$rspta=$pagos->insertar($idtrabajo);
					echo $rspta ? "Archivo guardado con éxito" : "El Archivo no se pudo guardar";
				}
			}else{
				echo "vacio";
			}
		}else{
			echo "ERROR: Extensión del archivo no permitido";
		}		
	break;
        
    case 'eliminardocumento':
		$comprobar=$pagos->buscarfregistrofactura($idtrabajo);
		if(empty($comprobar['fregistro'])){
			$pagos->eliminar($idtrabajo);
			$doc=$ordent->buscarDocumento($idtrabajo);
			//var_dump($doc);
			$rspta=$ordent->eliminardocumento($idtrabajo);
			unlink("../archivos/documentos/$doc[documento]");
			echo $rspta ? "Documento eliminado con éxito" : "No se puede eliminar el documento";
		}else{
			echo "ERROR: No se puede eliminar el documento porque existe un registro de factura";
		}

	break;

	case 'trabajoasignado':
		$rspta=$ordens->trabajoasignado($idorden);
 		echo $rspta ? "Orden de Trabajo asignado con éxito" : "La Orden de Trabajo no se puedo crear";
	break;

	case 'mostrar':
		$rspta=$ordent->mostrar($idtrabajo);
 		echo json_encode($rspta);
	break;

	case 'listar':
	session_start();	
	$rspta=$ordent->listarporusuario($_SESSION["nombre"]);
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->idtrabajo,
 				"1"=>$reg->idorden,
 				"2"=>$reg->documento,
 				"3"=>$reg->fechaE,
 				"4"=>($reg->estado)?'<span class="badge badge-pill badge-success">Terminado</span>':
 				'<span class="badge badge-pill badge-danger">En proceso</span>',
               	"5"=>($reg->estado)?'<a href="../controladores/download.php?file='.$reg->documento.'">
				<button title="Descargar documento" class="btn btn-info btn-circle btn-sm"> <i class="fas fa-download"> </i></button></a>'.' 
				<button title="Eliminar documento" class="btn btn-danger btn-circle btn-sm" onclick="eliminardocumento('.$reg->idtrabajo.')"> <i class="fas fa-trash"></i></button>':' 
				<button title="Subir documento" class="btn btn-warning btn-circle btn-sm" onclick="mostrar('.$reg->idtrabajo.')"> <i class="fas fa-upload"> </i></button>'
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