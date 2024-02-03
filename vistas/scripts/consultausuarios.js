var tabla;

function init(){
    mostrarform(false);
    listar();
}

function limpiar(){
    $("#idusuario").val("");
	$("#estado0").text("");
	$("#estado1").text("");
    $("#dni").val("");
	$("#nombre").val("");
	$("#apellido").val("");
	$("#telefono").val("");
	$("#email").val("");
	$("#direccion").val("");
	$("#usuario").val("");
}

function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#dni").prop("disabled",true);
		$("#nombre").prop("disabled",true);
		$("#apellido").prop("disabled",true);
		$("#email").prop("disabled",true);
		$("#telefono").prop("disabled",true);
		$("#direccion").prop("disabled",true);
		$("#usuario").prop("disabled",true);
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#formtrabajador").hide();
	}
}

function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    /*buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'pdf'
		        ],*/
		"ajax":
				{
					url: '../controladores/consultausuarios.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación
	    "order": [[ 0, "asc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

function mostrarConsulta(idusuario)
{
	$.post("../controladores/consultausuarios.php?op=mostrarConsulta",{idusuario : idusuario}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);
		$("#idusuario").text(data.idusuario);
		if(data.estado=="0")
			$("#estado0").text("Usuario inactivo");
		else
		$("#estado1").text("Usuario activo");
		$("#dni").val(data.dni);
		$("#nombre").val(data.nombre);
		$("#apellido").val(data.apellido);
		$("#telefono").val(data.telefono);
		$("#email").val(data.email);
		$("#direccion").val(data.direccion);
		$("#usuario").val(data.usuario);
		if(data.trabajador!==null){
			$("#trabajador").val(data.trabajador);
			$("#formtrabajador").show();
		}

 	});
}

function cancelarform()
{
    limpiar();
    mostrarform(false);
}

$(document).ready(function(){

	$("#btnregresar").click(function(){
		limpiar();
		mostrarform(false);
	});
});

init();