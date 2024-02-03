<?php 
require_once "../modelos/Servicios.php";

$servicio=new Servicios();

$idservicio=isset($_POST["idservicio"])? limpiarCadena($_POST["idservicio"]):"";
$nombre=isset($_POST["servicio"])? limpiarCadena($_POST["servicio"]):"";

switch ($_GET["op"]){
        
	case 'guardaryeditar':
		if (strlen(trim($nombre))>0){
        	if (empty($idservicio)){
					$rspta=$servicio->insertar($nombre);
					echo $rspta ? "Servicio registrado exitosamente" : "El Servicio no se pudo registrar, revise datos ingresados";
			}else {
				$rspta=$servicio->editar($idservicio,$nombre);
				echo $rspta ? "Servicio actualizado exitosamente" : "El Servicio no se pudo actualizar";
			}
		}else{
			echo "vacio";
		}
	break;

	case 'desactivar':
		$rspta=$servicio->desactivar($idservicio);
 		echo $rspta ? "Servicio Desactivado" : "El Servicio no se puede desactivar";
	break;

	case 'activar':
		$rspta=$servicio->activar($idservicio);
 		echo $rspta ? "Servicio activado" : "El Servicio no se puede activar";
	break;
        
	case 'mostrar':
		$rspta=$servicio->mostrar($idservicio);
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$servicio->listar($idservicio);
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->nombre,
				"1"=>($reg->estado)?'<span class="badge badge-pill badge-secondary">Activo</span>':'<span class="badge badge-pill badge-danger">Inactivo</span>',
 				"2"=>($reg->estado)?'<button class="btn btn-warning btn-circle btn-sm" onclick="mostrar('.$reg->idservicio.')"><i class="far fa-edit"></i></button>'.' <button class="btn btn-danger btn-circle btn-sm" onclick="desactivar('.$reg->idservicio.')"><i class="fas fa-ban"></i></button>':' <button class="btn btn-primary btn-circle btn-sm" onclick="activar('.$reg->idservicio.')"><i class="far fa-edit"></i></button>'
			);    
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case "seleccionarServicios":       
        $rspta = $servicio->seleccionarServicios();
        while($reg = $rspta->fetch_object())
        {
            echo '<option value='.$reg->idservicio .'>'.$reg->nombre .'</option>';
        }
    break;
}
?>