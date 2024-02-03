<?php

require_once "../modelos/Pagos.php";

$pagos=new Pagos();
$idpago=isset($_POST["idpago"])? limpiarCadena($_POST["idpago"]):"";

switch ($_GET["op"]){

	case 'listar':
	$rspta=$pagos->listar();
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>$reg->idpago,
 				"1"=>$reg->idorden,
				"2"=>$reg->razonSocial,
				"3"=>$reg->monto,
 				"4"=>$reg->fpago,
 				"5"=>($reg->estado)==0?'<span class="badge badge-pill badge-danger">Sin factura</span>':($reg->estado==1?'<span class="badge badge-pill badge-info">Factura registrada</span>':'<span class="badge badge-pill badge-success">Factura pagada</span>'),
               	"6"=>($reg->estado)==0?'<button title="Visualizar factura" class="btn btn-info btn-circle btn-sm" onclick="mostrarConsulta('.$reg->idpago.')"> <i class="far fa-eye"></i></button>':'<button title="Visualizar factura" class="btn btn-info btn-circle btn-sm" onclick="mostrarConsulta('.$reg->idpago.')"><i class="far fa-eye"></i></button>'.' <a href="../controladores/download.php?factura='.$reg->documento.'"> </i></button></a>'
			);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
	break;

	case 'mostrarConsulta':
		$rspta=$pagos->mostrarConsulta($idpago);
 		echo json_encode($rspta);
	break;

}
?>
