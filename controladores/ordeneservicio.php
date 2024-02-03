<?php

require_once "../modelos/Ordeneservicio.php";
require_once "../modelos/Ordenestrabajo.php";

$ordens=new OrdeneServicio();
$idorden=isset($_POST["idorden"])? limpiarCadena($_POST["idorden"]):"";
$idservicio=isset($_POST["idservicio"])? limpiarCadena($_POST["idservicio"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$costo=isset($_POST["costo"])? limpiarCadena($_POST["costo"]):"";
$fechainicio=isset($_POST["fechainicio"])? limpiarCadena($_POST["fechainicio"]):"";
$fechafinal=isset($_POST["fechafin"])? limpiarCadena($_POST["fechafin"]):"";
$idcliente=isset($_POST["idcliente"])? limpiarCadena($_POST["idcliente"]):"";

$ordent=new OrdenesTrabajo();
$idtrabajo=isset($_POST["idtrabajo"])? limpiarCadena($_POST["idtrabajo"]):"";
$idordentb=isset($_POST["idordentb"])? limpiarCadena($_POST["idordentb"]):"";
$idusuario=isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (strlen(trim($idcliente))>0 && strlen(trim($idservicio))>0 && strlen(trim($descripcion))>0 && strlen(trim($costo))>0 && strlen(trim($fechainicio))>0 && strlen(trim($fechafinal))>0 && $costo>=0){
			if (empty($idorden)){
				$rspta=$ordens->insertar($idservicio,$descripcion,$costo,$fechainicio,$fechafinal,$idcliente);
				echo $rspta ? "Orden de servicio registrado con éxito" : "La Orden de servicio no se pudo registrar";
			}
			else {
				$rspta=$ordens->editar($idorden,$idservicio,$descripcion,$costo,$fechainicio,$fechafinal,$idcliente);
				echo $rspta ? "Orden de servicio actualizada con éxito" : "La Orden de servicio no se pudo actualizar";
			}
		}else{
			echo "vacio";
		}	
	break;
        
    case 'eliminar':
		$rspta=$ordens->eliminar($idorden);
 		echo $rspta ? "Orden de Servicio eliminado" : "La Orden de Servicio no se puede eliminar";
	break;

	case 'mostrar':
		$rspta=$ordens->mostrar($idorden);
 		echo json_encode($rspta);
	break;

	case 'listar':
	$rspta=$ordens->listar();
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>$reg->idorden,
 				"1"=>$reg->cliente,
 				"2"=>$reg->servicio,
 				"3"=>$reg->costo,
 				"4"=>$reg->finicio,
                "5"=>$reg->ffinal,
 				"6"=>($reg->estado)?'<span class="badge badge-pill badge-success">Orden de trabajo asignado</span>':'<span class="badge badge-pill badge-danger">Sin orden de trabajo</span>',
               	"7"=>($reg->estado)?'':'<button title="Añadir trabajador" class="btn btn-info btn-circle btn-sm" onclick="mostrartb('.$reg->idorden.')"> <i class="fas fa-plus"> </i></button>'.
 			        ' <button title="Editar datos" class="btn btn-warning btn-circle btn-sm" onclick="mostrar('.$reg->idorden.')"> <i class="far fa-edit"> </i></button>'.
 			        ' <button title="Eliminar dato" class="btn btn-danger btn-circle btn-sm" onclick="eliminar('.$reg->idorden.')"> <i class="fas fa-trash"> </i></button>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
	break;

//LA TABLA ORDEN DE TRABAJO

	case 'addtrabajo':
		if (strlen(trim($idusuario))>0){
			if (empty($idtrabajo)){
				$rsptasql=$ordens->trabajoasignado($idordentb);
				$rspta=$ordent->insertar($idordentb,$idusuario);
				echo $rspta ? "Orden de Trabajo asignado con éxito" : "La Orden de Trabajo no se puedo asignar";
				
			}
			else {
				$rspta=$ordent->editar($idtrabajo,$idusuario);
				echo $rspta ? "Orden de Trabajo actualizado con éxito" : "La Orden de Trabajo no se pudo actualizar";
			}
		}else{
			echo "vacio";
		}
	break;

	case 'editartb':
		$rspta=$ordent->mostrar($idtrabajo);
		echo json_encode($rspta);
	break;

    case 'eliminartb':
		$rsptasql=$ordent->eliminar($idtrabajo);
		$rspta=$ordens->trabajoeliminado($idorden);
 		echo $rspta ? "Orden de Trabajo eliminado con éxito" : "La Orden de Trabajo no se puedo eliminar";
	break;	

	case 'listartb':
		$rspta=$ordent->listar();
			 $data= Array();
	
			 while ($reg=$rspta->fetch_object()){
				 $data[]=array(
					 "0"=>$reg->usuario,
					 "1"=>$reg->idorden,
					 "2"=>$reg->documento,
					 "3"=>$reg->fechaE,
					 "4"=>($reg->estado)?'<span class="badge badge-pill badge-success">Terminado</span>':
					 '<span class="badge badge-pill badge-danger">En proceso</span>',
					"5"=>($reg->estado)?'<a href="../controladores/download.php?file='.$reg->documento.'">
					<button title="Descargar documento" class="btn btn-info btn-circle btn-sm"> <i class="fas fa-download"> </i></button></a>':'<button class="btn btn-warning btn-circle btn-sm" onclick="editartb('.$reg->idtrabajo.')"> <i class="far fa-edit"> </i></button>'.
						' <button class="btn btn-danger btn-circle btn-sm" onclick="eliminartb('.$reg->idtrabajo.','.$reg->idorden.')" > <i class="fa fa-trash"> </i></button>'				
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