<?php 

require "../config/conexion.php";
    
Class OrdenesTrabajo
{
	
    public function __construct()
    {   
    }
    
    public function insertar($idorden,$idusuario)
    {
        $sql="INSERT INTO trabajo (idorden,idusuario,estado) 
        VALUES ('$idorden','$idusuario','0')";
        return ejecutarConsulta($sql);
    }
    
    public function editar($idtrabajo,$idusuario)
	{
		$sql="UPDATE trabajo SET idusuario='$idusuario' WHERE idtrabajo='$idtrabajo' AND estado='0'";
		return ejecutarConsulta($sql);
	}
    
	public function eliminar($idtrabajo)
	{
		$sql="DELETE FROM trabajo WHERE idtrabajo='$idtrabajo'";
		return ejecutarConsulta($sql);
	}
    
	public function mostrar($idtrabajo)
	{
		$sql="SELECT idtrabajo,idorden,idusuario,documento,estado,DATE(fechaEntrega) as fentrega FROM trabajo WHERE idtrabajo='$idtrabajo'";
		return ejecutarConsultaSimpleFila($sql);
	}
      
    public function listar()
	{
		$sql="SELECT t.idtrabajo,t.idorden,CONCAT(u.nombre,' ',u.apellido) as usuario, t.documento, DATE(t.fechaEntrega) as fechaE, t.estado FROM trabajo t INNER JOIN usuario u ON t.idusuario=u.idusuario";
		return ejecutarConsulta($sql);
	}

    public function listarporusuario($usuario)
	{
		$sql="SELECT t.idtrabajo,t.idorden,CONCAT(u.nombre,' ',u.apellido) as usuario, t.documento, DATE(t.fechaEntrega) as fechaE, t.estado FROM trabajo t INNER JOIN usuario u ON t.idusuario=u.idusuario WHERE u.usuario='$usuario'";
		return ejecutarConsulta($sql);
	}	

    public function guardardocumento($idtrabajo,$documento,$fechaentrega)
	{
		$sql="UPDATE trabajo SET documento='$documento',estado='1',fechaEntrega='$fechaentrega' WHERE idtrabajo='$idtrabajo' AND estado='0'";
		return ejecutarConsulta($sql);
	}	

    public function eliminardocumento($idtrabajo)
	{
		$sql="UPDATE trabajo SET documento=NULL,estado='0',fechaEntrega=NULL WHERE idtrabajo='$idtrabajo' AND estado='1'";
		return ejecutarConsulta($sql);
	}
	
	public function buscarDocumento($idtrabajo)
	{
		$sql="SELECT documento FROM trabajo WHERE idtrabajo='$idtrabajo'";
		return ejecutarConsultaSimpleFila($sql);
	}
    
	public function contarTrabajosUsuarios($idusuario)
	{
		$sql="SELECT COUNT(CASE WHEN estado = '0' THEN idusuario END) tpendientes,
					 COUNT(CASE WHEN estado = '1' THEN idusuario END) tterminados
 			  FROM trabajo WHERE idusuario ='$idusuario'";
		return ejecutarConsultaSimpleFila($sql);
	}

}
?>