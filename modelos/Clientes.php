<?php 

require "../config/conexion.php";

Class Clientes
{
	public function __construct()
	{

	}
	
	public function insertar($ruc,$razonsocial,$representante,$direccion,$telefono,$email,$fregistro)
	{
		$sql="INSERT INTO cliente (ruc,razonSocial,representante,direccion,telefono,email,fechaRegistro,estado)
		VALUES ('$ruc',(Upper('$razonsocial')),(Upper('$representante')),(Upper('$direccion')),'$telefono','$email','$fregistro','1')";
		return ejecutarConsulta($sql);
	}
    
	public function editar($idcliente,$ruc,$razonsocial,$representante,$direccion,$telefono,$email)
	{
		$sql="UPDATE cliente SET ruc='$ruc',razonSocial=(Upper('$razonsocial')),representante=(Upper('$representante')),direccion=(Upper('$direccion')),telefono='$telefono',email='$email' WHERE idcliente='$idcliente'";
		return ejecutarConsulta($sql);
	}
	
	public function desactivar($idcliente)
	{
		$sql="UPDATE cliente SET estado ='0' WHERE idcliente='$idcliente'";
		return ejecutarConsulta($sql);
	}
    
	public function activar($idcliente)
	{
		$sql="UPDATE cliente SET estado ='1' WHERE idcliente='$idcliente'";
		return ejecutarConsulta($sql);
	}
	
	public function mostrar($idcliente)
	{
		$sql="SELECT * FROM cliente WHERE idcliente='$idcliente'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function mostrarConsulta($idcliente)
	{
		$sql="SELECT * FROM cliente WHERE idcliente='$idcliente'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listar()
	{
		$sql="SELECT * FROM cliente";
		return ejecutarConsulta($sql);		
	}
    
	public function seleccionarClientes()
	{
		$sql="SELECT idcliente,razonSocial FROM cliente WHERE estado='1' ORDER BY razonSocial ASC";
		return ejecutarConsulta($sql);		
	}
}
?>