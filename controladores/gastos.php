<?php
require_once "../modelos/Gastos.php";

$gastos=new Gastos();

$idgasto=isset($_POST["idgasto"])? limpiarCadena($_POST["idgasto"]):"";
$idusuario=isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";
$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
$concepto=isset($_POST["concepto"])? limpiarCadena($_POST["concepto"]):"";
$monto=isset($_POST["monto"])? limpiarCadena($_POST["monto"]):"";


switch($_GET["op"]){
        
   case 'guardaryeditar':
    if (strlen(trim($idusuario))>0 && strlen(trim($fecha))>0 && strlen(trim($concepto))>0 && strlen(trim($monto))>0 && $monto>=0){
        if (empty($idgasto)){
			$rspta=$gastos->insertar($idusuario,$fecha,$concepto,$monto);
			echo $rspta ? "Gasto registrado" : "Gasto no se pudo registrar";
		}
		else {
			$rspta=$gastos->editar($idgasto,$idusuario,$fecha,$concepto,$monto);
			echo $rspta ? "Gasto actualizado" : "Gasto no se pudo actualizar";
		}
    }else{
        echo "vacio";
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
                "4"=>'<button title="Editar gasto" class="btn btn-warning btn-circle btn-sm" onclick="mostrar('.$reg->idgasto.')"> <i class="far fa-edit"> </i></button>'.' <button title="Eliminar gasto" class="btn btn-danger btn-circle btn-sm" onclick="eliminar('.$reg->idgasto.')"> <i class="fas fa-trash"> </i></button>'            
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