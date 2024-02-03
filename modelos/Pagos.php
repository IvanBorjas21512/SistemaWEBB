<?php 

require "../config/conexion.php";
    
Class Pagos
{
	
    public function __construct()
    {   
    }
    
    public function insertar($idtrabajo)
    {
        $sql="INSERT INTO pago (idtrabajo,estado) VALUES ('$idtrabajo','0')";
        return ejecutarConsulta($sql);
    }

	public function eliminar($idtrabajo){
		$sql="DELETE FROM pago WHERE idtrabajo='$idtrabajo'";
		return ejecutarConsulta($sql);
	}
    
    public function guardarfactura($idpago,$fecharegistro,$documento,$idusuario)
	{
		$sql="UPDATE pago SET fechaRegistro='$fecharegistro',documento='$documento',estado='1',idusuario='$idusuario' WHERE idpago='$idpago'";
		return ejecutarConsulta($sql);
	}
    
	public function eliminarfactura($idpago)
	{
		$sql="UPDATE pago SET fechaRegistro=NULL,documento=NULL,estado='0',idusuario=NULL WHERE idpago='$idpago'";
		return ejecutarConsulta($sql);
	}

	public function eliminarfechapago($idpago)
	{
		$sql="UPDATE pago SET fechaPago=NULL,estado='1' WHERE idpago='$idpago'";
		return ejecutarConsulta($sql);
	}
    
	public function addregistropago($idpago,$fechapago,$idusuario)
	{
		$sql="UPDATE pago SET fechaPago='$fechapago',estado='2',idusuario='$idusuario' WHERE idpago='$idpago'";
		return ejecutarConsulta($sql);
	} 
    
	public function mostrar($idpago)
	{
		$sql="SELECT idpago,idtrabajo,DATE(fechaRegistro) as fregistro,DATE(fechaPago) as fpago,documento,estado FROM pago WHERE idpago='$idpago'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function buscarFactura($idpago)
	{
		$sql="SELECT documento FROM pago WHERE idpago='$idpago'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function buscarfregistrofactura($idtrabajo){
		$sql="SELECT DATE(fechaRegistro) as fregistro FROM pago WHERE idtrabajo='$idtrabajo'";
		return ejecutarConsultaSimpleFila($sql);
	}
    

	public function mostrarConsulta($idpago)
	{
		$sql="SELECT p.idpago, p.fechaRegistro, p.fechaPago, p.estado, o.idorden,s.nombre,o.descripcion,o.fechaInicio,o.fechaFinal,CONCAT('S/. ',FORMAT(o.costo,'2')) as costo,c.ruc,c.razonSocial,CONCAT(u.apellido,' ',u.nombre) as trabajador FROM ordenservicio o LEFT JOIN servicio s ON s.idservicio=o.idservicio LEFT JOIN cliente c ON c.idcliente=o.idcliente LEFT JOIN trabajo t ON o.idorden=t.idorden LEFT JOIN usuario u ON u.idusuario=t.idusuario LEFT JOIN pago p ON p.idtrabajo=t.idtrabajo WHERE idpago='$idpago'";
		// SELECT p.idpago, p.fechaRegistro, p.fechaPago, o.idorden,s.nombre,o.descripcion,o.fechaInicio,o.fechaFinal,CONCAT('S/. ',FORMAT(o.costo,'2')) as costo,o.estado,c.ruc,c.razonSocial,CONCAT(u.apellido,' ',u.nombre) as trabajador FROM ordenservicio o LEFT JOIN servicio s ON s.idservicio=o.idservicio LEFT JOIN cliente c ON c.idcliente=o.idcliente LEFT JOIN trabajo t ON o.idorden=t.idorden LEFT JOIN usuario u ON u.idusuario=t.idusuario LEFT JOIN pago p ON p.idtrabajo=t.idtrabajo WHERE o.idorden=1;
		return ejecutarConsultaSimpleFila($sql);
	}
	//mostrar lista de la tabla   
    public function listar()
	{
		$sql="SELECT p.idpago,c.razonSocial,t.idorden,DATE(p.fechaRegistro) as fregistro,DATE(p.fechaPago) as fpago,CONCAT('S/. ',FORMAT(os.costo,2)) as monto,p.documento,p.estado FROM pago p INNER JOIN trabajo t ON t.idtrabajo=p.idtrabajo INNER JOIN ordenservicio os ON os.idorden = t.idorden INNER JOIN cliente c ON c.idcliente=os.idcliente";
		return ejecutarConsulta($sql);
	}

}

?>