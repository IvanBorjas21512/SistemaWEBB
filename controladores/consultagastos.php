<?php
require_once "../modelos/Gastos.php";

$gastos=new Gastos();

$idgasto=isset($_POST["idgasto"])? limpiarCadena($_POST["idgasto"]):"";


switch($_GET["op"]){
        
   case 'guardaryeditar':
		if (empty($idgasto)){
			$rspta=$gastos->insertar($idusuario,$fecha,$concepto,$monto);
			echo $rspta ? "Gasto registrado" : "Gasto no se pudo registrar";
		}
		else {
			$rspta=$gastos->editar($idgasto,$idusuario,$fecha,$concepto,$monto);
			echo $rspta ? "Gasto actualizado" : "Gasto no se pudo actualizar";
		}
	break;
        
   case 'eliminar':
		$rspta=$gastos->eliminar($idgasto);
 		echo $rspta ? "Gasto Eliminado" : "Gasto no se puede eliminar";
	break;
        
    case 'mostrar':
        $rspta=$gastos->mostrar($idgasto);
        //Codificar el resultado con json
        echo json_encode($rspta);
    break;
        
    case 'listar':
        $rspta=$gastos->listar();
        //vamos a declarar un array
        $data= Array();
        
        while ($reg=$rspta->fetch_object()){
 			$data[]=array(
                "0"=>$reg->usuario,
                "1"=>$reg->fecha,
                "2"=>$reg->concepto,
                "3"=>$reg->monto,                
            );
        }
        
        $results = array(
        "sEcho"=>1, //Informacion para el datatables
            "iTotalRecords"=>count($data), //Enviamos el total registros al datatable
            "iTotalDisplayRecords"=>count($data), //Enviamos el total de registros a visualizar
            "aaData"=>$data);
        echo json_encode($results);
    break;
}

?>