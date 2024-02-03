<?php 
//Incluimos inicialmente la conexion a la base de datos
require "../config/Conexion.php";
    
Class Gastos
{
    //implementamos nuestro constructor
    public function __construct()
    {   
    }
    
    //implementamos un metodo para insertar registros
    public function insertar($idusuario,$fecha,$concepto,$monto)
    {
        $sql="INSERT INTO gasto (idusuario,fecha,concepto,monto)
		                  VALUES ('$idusuario','$fecha',(Upper('$concepto')),'$monto')";
		return ejecutarConsulta($sql);
    }
    
    //Implementamos el metodo para Editar Registros
    public function editar($idgasto,$idusuario,$fecha,$concepto,$monto)
	{
		$sql="UPDATE gasto SET idusuario='$idusuario',
                                fecha='$fecha',
                                concepto=(Upper('$concepto')),
                                monto='$monto' 
                                WHERE idgasto='$idgasto'";
		return ejecutarConsulta($sql);
	}
    
    //implementamos el metodo eliminar
    public function eliminar($idgasto)
	{
		$sql="DELETE FROM gasto WHERE idgasto='$idgasto'";
		return ejecutarConsulta($sql);
	}
    
    //Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idgasto)
	{
		$sql="SELECT * FROM gasto WHERE idgasto='$idgasto'";
		return ejecutarConsultaSimpleFila($sql);
	}
    
    //mostrar lista de la tabla gastos    
    public function listar()
	{
		$sql="SELECT g.idgasto,
                    g.idusuario,
                    CONCAT(u.nombre,' ',u.apellido) as usuario, 
                    g.fecha,
                    g.concepto,
                    CONCAT('S/. ',FORMAT(g.monto,2)) as monto 
                    FROM gasto g INNER JOIN usuario u 
                    ON g.idusuario=u.idusuario";
		return ejecutarConsulta($sql);		
	}

    public function sumaGastosUsuario($idusuario)
    {
        $sql="SELECT CONCAT('S/. ',FORMAT(SUM(monto),2)) as tgastos FROM gasto WHERE idusuario='$idusuario'";
        return ejecutarConsultaSimpleFila($sql);
    }

}

?>