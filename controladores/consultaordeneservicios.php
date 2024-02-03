<?php

require_once "../modelos/Ordeneservicio.php";

$ordens=new OrdeneServicio();
$idorden=isset($_POST["idorden"])? limpiarCadena($_POST["idorden"]):"";

switch ($_GET["op"]){

	case 'mostrarConsulta':
		$rspta=$ordens->mostrarConsulta($idorden);
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
 				"3"=>$reg->finicio,
 				"4"=>$reg->costo,
 				"5"=>($reg->estado)?'<span class="badge badge-pill badge-success">Orden de trabajo asignado</span>':'<span class="badge badge-pill badge-danger">Sin orden de trabajo</span>',
               	"6"=>'<button title="Visualizar datos de la orden" class="btn btn-info btn-circle btn-sm" onclick="mostrarConsulta('.$reg->idorden.')"> <i class="far fa-eye"></i></button>'
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