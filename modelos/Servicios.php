<?php 

require "../config/conexion.php";

Class Servicios
{
	public function __construct()
	{

	}
	
	public function insertar($servicio)
	{
		$sql="INSERT INTO servicio (nombre) VALUES (UPPER('$servicio'))";
		return ejecutarConsulta($sql);
	}
    
	public function editar($idservicio,$servicio)
	{
		$sql="UPDATE servicio SET nombre=(Upper('$servicio')) WHERE idservicio='$idservicio'";		
		return ejecutarConsulta($sql);
	}
	
	public function desactivar($idservicio)
	{
		$sql="UPDATE servicio SET estado ='0' WHERE idservicio='$idservicio'";
		return ejecutarConsulta($sql);
	}
    
	public function activar($idservicio)
	{
		$sql="UPDATE servicio SET estado ='1' WHERE idservicio='$idservicio'";
		return ejecutarConsulta($sql);
	}
	
	public function mostrar($idservicio)
	{
		$sql="SELECT * FROM servicio WHERE idservicio='$idservicio'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listar()
	{
		$sql="SELECT * FROM servicio";
		return ejecutarConsulta($sql);		
	}
    
	public function seleccionarServicios()
	{
		$sql="SELECT idservicio,nombre FROM servicio WHERE estado='1' ORDER BY nombre ASC";
		return ejecutarConsulta($sql);		
	}
}
?>