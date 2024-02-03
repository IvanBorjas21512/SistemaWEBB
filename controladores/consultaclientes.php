<?php 
require_once "../modelos/Clientes.php";

$cliente=new Clientes();

$idcliente=isset($_POST["idcliente"])? limpiarCadena($_POST["idcliente"]):"";


switch ($_GET["op"]){

	case 'listar':
		$rspta=$cliente->listar($idcliente);
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->ruc,
 				"1"=>$reg->razonSocial,
				"2"=>$reg->representante,
 				"3"=>$reg->telefono,
 				"4"=>($reg->estado)?'<span class="badge badge-pill badge-secondary">Activo</span>':'<span class="badge badge-pill badge-danger">Inactivo</span>',
				"5"=>'<button title="Visualizar información" class="btn btn-info btn-circle btn-sm" onclick="mostrarConsulta('.$reg->idcliente.')"> <i class="far fa-eye"></i></button>'
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
		$rspta=$cliente->mostrarConsulta($idcliente);
 		echo json_encode($rspta);
	break;

}
?>