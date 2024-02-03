<?php 

require "../config/conexion.php";

Class Usuarios
{
	
	public function __construct()
	{

	}

	public function insertar($dni,$nombre,$apellido,$direccion,$telefono,$email,$imagen,$usuario,$password,$permisos)
	{
		$sql="INSERT INTO usuario (dni,nombre,apellido,direccion,telefono,email,imagen,usuario,password,estado)
		VALUES ('$dni',(Upper('$nombre')),(Upper('$apellido')),(Upper('$direccion')),'$telefono','$email','$imagen',(Upper('$usuario')),'$password','1')";
      
        $idusuarionew=ejecutarConsulta_retornarID($sql);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($permisos))
		{
			$sql_detalle = "INSERT INTO usuariopermiso(idusuario, idpermiso) VALUES('$idusuarionew', '$permisos[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;
	}

	public function editar($idusuario,$dni,$nombre,$apellido,$direccion,$telefono,$email,$permisos)
	{
		$sql="UPDATE usuario SET
		dni='$dni',
        nombre=(Upper('$nombre')),
		apellido=(Upper('$apellido')),
        direccion=(Upper('$direccion')),
        telefono='$telefono',
		email='$email'   
        WHERE idusuario='$idusuario'";
		
        ejecutarConsulta($sql);

		$sqldel="DELETE FROM usuariopermiso WHERE idusuario='$idusuario'";
		ejecutarConsulta($sqldel);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($permisos))
		{
			$sql_detalle = "INSERT INTO usuariopermiso(idusuario, idpermiso) VALUES('$idusuario', '$permisos[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;

	}

	public function desactivar($idusuario)
	{
		$sql="UPDATE usuario SET estado='0' WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	public function activar($idusuario)
	{
		$sql="UPDATE usuario SET estado='1' WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	public function mostrar($idusuario)
	{
		$sql="SELECT * FROM usuario WHERE idusuario='$idusuario'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listar()
	{
		$sql="SELECT * FROM usuario";
		return ejecutarConsulta($sql);		
	}
	
	public function listarmarcados($idusuario)
	{
		$sql="SELECT * FROM usuariopermiso WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	public function verificar($login,$clave)
    {
    	$sql="SELECT * FROM usuario WHERE usuario='$login' AND password='$clave' AND estado='1'"; 
    	return ejecutarConsulta($sql);  
    }
    
    public function seleccionarUsuarios()
	{
		$sql="SELECT idusuario,CONCAT(nombre,' ',apellido) as nomcompleto FROM usuario WHERE estado='1' ORDER BY usuario ASC";
		return ejecutarConsulta($sql);		
	}

	public function resetearContraseña($idusuario,$nuevaclavehash)
	{
		$sql="UPDATE usuario SET password='$nuevaclavehash' WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	public function modificarDatos($idusuario,$direccion,$telefono,$email)
	{
		$sql="UPDATE usuario SET direccion='$direccion',telefono='$telefono',email='$email' WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	public function devolverContraseñaActual($idusuario,$password)
	{
		$sql="SELECT u.usuario FROM usuario u WHERE u.idusuario='$idusuario' AND u.password='$password'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function cambiarContraseña($idusuario,$passwordnuevo)
	{
		$sql="UPDATE usuario u SET u.password='$passwordnuevo' WHERE u.idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	public function verificarExisteUsuario($usuario)
	{
		$sql="SELECT COUNT(idusuario) FROM usuario WHERE usuario='$usuario'";
		return ejecutarConsultaSimpleFila($sql);
	}
}

?>