<?php 
session_start(); 
require_once "../modelos/Usuarios.php";

$usuarios=new Usuarios();

$idusuario=isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";
$dni=isset($_POST["dni"])? limpiarCadena($_POST["dni"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$apellido=isset($_POST["apellido"])? limpiarCadena($_POST["apellido"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";
$login=isset($_POST["login"])? limpiarCadena($_POST["login"]):"";
$clave=isset($_POST["clave"])? limpiarCadena($_POST["clave"]):"";

switch ($_GET["op"]){
        
	case 'guardaryeditar':
        
		
		$ext = explode(".", $_FILES["imagen"]["name"]);
		
		//Hash SHA256 en la contraseña
		$clavehash=hash("SHA256",$clave);
		if (empty($idusuario)){
			if (strlen(trim($dni))>0 && strlen(trim($nombre))>0 && strlen(trim($apellido))>0 && strlen(trim($direccion))>0 && strlen(trim($telefono))>0 && strlen(trim($email))>0 && strlen(trim($login))>0 && strlen(trim($clave))>0){
				$existeuser=$usuarios->verificarExisteUsuario($login);
				if($existeuser["COUNT(idusuario)"]==0)
				{
					if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
					{
						$imagen = round(microtime(true)) . '.' . end($ext);
						move_uploaded_file($_FILES["imagen"]["tmp_name"], "../archivos/perfil_usuarios/" . $imagen);
						$rspta=$usuarios->insertar($dni,$nombre,$apellido,$direccion,$telefono,$email,$imagen,$login,$clavehash,$_POST['permiso']);
						echo $rspta ? "Usuario registrado exitosamente" : "Usuario no se pudo registrar, compruebe datos ingresados";				
					}else{
						echo "ERROR: Extensión del archivo no permitido";
					}
				}else
					echo "ERROR";
			}else{
				echo "vacio";
			}
		}else{
			if (strlen(trim($dni))>0 && strlen(trim($nombre))>0 && strlen(trim($apellido))>0 && strlen(trim($direccion))>0 && strlen(trim($telefono))>0 && strlen(trim($email))>0){
					$rspta=$usuarios->editar($idusuario,$dni,$nombre,$apellido,$direccion,$telefono,$email,$_POST['permiso']);
					echo $rspta ? "Usuario actualizado exitosamente" : "Usuario no se pudo actualizar, compruebe datos ingresados";
			}else{
				echo "vacio";
			}
		}
	break;
	case 'desactivar':
		$rspta=$usuarios->desactivar($idusuario);
 		echo $rspta ? "Usuario Desactivado" : "Usuario no se puede desactivar";
	break;

	case 'activar':
		$rspta=$usuarios->activar($idusuario);
 		echo $rspta ? "Usuario activado" : "Usuario no se puede activar";
	break;
        
	case 'mostrar':
		$rspta=$usuarios->mostrar($idusuario);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$usuarios->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(

 				"0"=>"<img src='../archivos/perfil_usuarios/".$reg->imagen."' height='50px' width='50px' class='rounded-circle'>",
 				"1"=>$reg->usuario,
 				"2"=>$reg->nombre,
 				"3"=>$reg->apellido,
 				"4"=>$reg->telefono,
 				"5"=>($reg->estado)?'<span class="badge badge-pill badge-secondary">Activo</span>':'<span class="badge badge-pill badge-danger">Inactivo</span>',
 				"6"=>($reg->estado)?'<button title="Editar usuario" class="btn btn-warning btn-circle btn-sm" onclick="mostrar('.$reg->idusuario.')"><i class="far fa-edit"></i></button>'.' <button title="Desactivar usuario" class="btn btn-danger btn-circle btn-sm" onclick="desactivar('.$reg->idusuario.')"><i class="fas fa-ban"></i></button>'.' <button title="Resetear contraseña" class="btn btn-info btn-circle btn-sm" onclick="resetearContraseña('.$reg->idusuario.')"><i class="fas fa-key"></i></button>':' <button title="Activar usuario" class="btn btn-primary btn-circle btn-sm" onclick="activar('.$reg->idusuario.')"><i class="fas fa-check"></i></button>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
    
    case 'permisos':
		//Obtenemos todos los permisos de la tabla permisos
		require_once "../modelos/Permiso.php";
		$permiso = new Permisos();
		$rspta = $permiso->listar();

		//Obtener los permisos asignados al usuario
		$id=$_GET['id'];
		$marcados = $usuarios->listarmarcados($id);
		//Declaramos el array para almacenar todos los permisos marcados
		$valores=array();

		//Almacenar los permisos asignados al usuario en el array
		while ($per = $marcados->fetch_object())
			{
				array_push($valores, $per->idpermiso);
			}

		//Mostramos la lista de permisos en la vista y si están o no marcados
		$i=0;
		while ($reg = $rspta->fetch_object())
				{
					$sw=in_array($reg->idpermiso,$valores)?'checked':'';
					if($i==0 || $i==4 || $i==8){
						echo '<li class="form-check form-switch"><input class="form-check-input" type="checkbox" '.$sw.'  name="permiso[]" value="'.$reg->idpermiso.'" checked="true" readonly="readonly" onclick="javascript: return false;"><label class="form-check-label">'.$reg->permiso.'</label></li>';
						//var_dump($i);
					}else{
						echo '<li class="form-check form-switch"><input class="form-check-input" type="checkbox" '.$sw.'  name="permiso[]" value="'.$reg->idpermiso.'"><label class="form-check-label">'.$reg->permiso.'</label></li>';
					}
					$i++;
				}
	break;
        
    case 'verificar':
		$logina=$_POST['logina'];
	    $clavea=$_POST['clavea'];

	    //Hash SHA256 en la contraseña
		$clavehash=hash("SHA256",$clavea);

		$rspta=$usuarios->verificar($logina, $clavehash);
		$fetch=$rspta->fetch_object();

		if (isset($fetch))
	    {
	        //Declaramos las variables de sesión
	        $_SESSION['idusuario']=$fetch->idusuario;
	        $_SESSION['nombre']=$fetch->usuario;
	        $_SESSION['imagen']=$fetch->imagen;
	        $_SESSION['login']=$fetch->login;

	        //Obtenemos los permisos del usuario
	    	$marcados = $usuarios->listarmarcados($fetch->idusuario);

	    	//Declaramos el array para almacenar todos los permisos marcados
			$valores=array();

			//Almacenamos los permisos marcados en el array
			while ($per = $marcados->fetch_object())
				{
					array_push($valores, $per->idpermiso);
				}

			//Determinamos los accesos del usuario
			in_array(1,$valores)?$_SESSION['Escritorio']=1:$_SESSION['Escritorio']=0;
			in_array(2,$valores)?$_SESSION['Clientes']=1:$_SESSION['Clientes']=0;
			in_array(3,$valores)?$_SESSION['Servicios']=1:$_SESSION['Servicios']=0;
			in_array(4,$valores)?$_SESSION['Ordenes de Servicio']=1:$_SESSION['Ordenes de Servicio']=0;
			in_array(5,$valores)?$_SESSION['Ordenes de Trabajo']=1:$_SESSION['Ordenes de Trabajo']=0;
			in_array(6,$valores)?$_SESSION['Pagos']=1:$_SESSION['Pagos']=0;
			in_array(7,$valores)?$_SESSION['Usuarios']=1:$_SESSION['Usuarios']=0;
			in_array(8,$valores)?$_SESSION['Gastos']=1:$_SESSION['Gastos']=0;
			in_array(9,$valores)?$_SESSION['Consultas']=1:$_SESSION['Consultas']=0;

	    }
	    echo json_encode($fetch);
	break;
        
    case 'salir':
		//Limpiamos las variables de sesión   
        session_unset();
        //Destruìmos la sesión
        session_destroy();
        //Redireccionamos al loginPrestamos
        header("Location: ../index.php");

	break;

	case 'resetearContraseña':
		$nuevaclavehash=hash("SHA256","user1234");
		$rspta=$usuarios->resetearContraseña($idusuario,$nuevaclavehash);
		echo nl2br($rspta ? "La contraseña fue restaurada con éxito \n Nueva contraseña: user1234" : "No se pudo restaurar la contraseña");
	break;

	case "seleccionarUsuarios":
        $rspta = $usuarios->seleccionarUsuarios();   
        while($reg = $rspta->fetch_object())
        {
            echo '<option value='.$reg->idusuario .'>'.$reg->nomcompleto .'</option>';
        }
    break;
}
?>
