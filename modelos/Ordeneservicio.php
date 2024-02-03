<?php 

require "../config/conexion.php";
    
Class OrdeneServicio
{
	
    public function __construct()
    {   
    }
    
    public function insertar($idservicio,$descripcion,$costo,$fechainicio,$fechafinal,$idcliente)
    {
        $sql="INSERT INTO ordenservicio (idservicio,descripcion,costo,fechaInicio,fechaFinal,estado,idcliente) 
        VALUES ('$idservicio',(Upper('$descripcion')),'$costo','$fechainicio','$fechafinal','0','$idcliente')";
        return ejecutarConsulta($sql);
    }
    
    public function editar($idorden,$idservicio,$descripcion,$costo,$fechainicio,$fechafinal,$idcliente)
	{
		$sql="UPDATE ordenservicio SET 
                     idservicio='$idservicio',
                     descripcion=(Upper('$descripcion')),
                     costo='$costo',
                     fechaInicio='$fechainicio',
                     fechaFinal='$fechafinal',  
                     idcliente='$idcliente' 
					 WHERE idorden='$idorden' AND estado='0'";
		return ejecutarConsulta($sql);
	}
    
	public function eliminar($idorden)
	{
		$sql="DELETE FROM ordenservicio WHERE idorden='$idorden'";
		return ejecutarConsulta($sql);
	}
    
	public function trabajoasignado($idorden)
	{
		$sql="UPDATE ordenservicio SET estado='1' WHERE idorden='$idorden' AND estado='0'";
		return ejecutarConsulta($sql);
	}

	public function trabajoeliminado($idorden)
	{
		$sql="UPDATE ordenservicio SET estado='0' WHERE idorden='$idorden' AND estado='1'";
		return ejecutarConsulta($sql);
	}	
    
	public function mostrar($idorden)
	{
		$sql="SELECT idorden,idcliente as cliente,idservicio as servicio,descripcion,costo,DATE(fechaInicio) as finicio,DATE(fechaFinal) as ffinal,estado FROM ordenservicio WHERE idorden='$idorden'";
		return ejecutarConsultaSimpleFila($sql);
	}
    
    public function listar()
	{
		$sql="SELECT o.idorden,c.razonSocial as cliente,s.nombre as servicio,o.descripcion,CONCAT('S/. ',FORMAT(o.costo,2)) as costo,DATE(o.fechaInicio) as finicio,DATE(o.fechaFinal) as ffinal,o.estado 
        FROM ordenservicio o INNER JOIN cliente c ON 
        o.idcliente=c.idcliente INNER JOIN servicio s ON 
        o.idservicio=s.idservicio";
		return ejecutarConsulta($sql);		
	}

	public function mostrarConsulta($idorden)
	{
		$sql="SELECT o.idorden,s.nombre,o.descripcion,o.fechaInicio,o.fechaFinal,CONCAT('S/. ',FORMAT(o.costo,'2')) as costo,o.estado,c.ruc,c.razonSocial,CONCAT(u.apellido,' ',u.nombre) as trabajador FROM ordenservicio o LEFT JOIN servicio s ON s.idservicio=o.idservicio LEFT JOIN cliente c ON c.idcliente=o.idcliente LEFT JOIN trabajo t ON o.idorden=t.idorden LEFT JOIN usuario u ON u.idusuario=t.idusuario WHERE o.idorden='$idorden'";
		return ejecutarConsultaSimpleFila($sql);
	}

}
?>