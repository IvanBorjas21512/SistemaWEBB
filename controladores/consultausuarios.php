<?php 
require_once "../modelos/Usuarios.php";

$usuarios=new Usuarios();

$idusuario=isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";


switch ($_GET["op"]){

	case 'listar':
		$rspta=$usuarios->listar();
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>$reg->usuario,
				"1"=>$reg->nombre,
				"2"=>$reg->apellido,
				"3"=>$reg->email,
				"4"=>"<img src='../archivos/perfil_usuarios/".$reg->imagen."' height='50px' width='50px' class='rounded-circle'>",
				"5"=>($reg->estado)?'<span class="badge badge-pill badge-secondary">Activo</span>':'<span class="badge badge-pill badge-danger">Inactivo</span>',
				"6"=>'<button title="Visualizar datos del usuario" class="btn btn-info btn-circle btn-sm" onclick="mostrarConsulta('.$reg->idusuario.')"> <i class="far fa-eye"></i></button>'
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
		$rspta=$usuarios->mostrar($idusuario);
 		echo json_encode($rspta);
	break;

}
?>