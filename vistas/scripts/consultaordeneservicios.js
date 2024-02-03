var tabla;

function init(){
    mostrarform(false);
    listar();
    
	const li = document.querySelector('#nav-li-consulta');
    li.classList.add('active');
}

function limpiar(){
    $("#idorden").val("");
	$("#estado0").text("");
	$("#estado1").text("");
    $("#ruc").val("");
	$("#razonsocial").val("");
	$("#descripcion").val("");
	$("#finicio").val("");
	$("#ffinal").val("");
	$("#costo").val("");
	$("#trabajador").val("");
}

function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#ruc").prop("disabled",true);
		$("#razonsocial").prop("disabled",true);
		$("#servicio").prop("disabled",true);
		$("#descripcion").prop("disabled",true);
		$("#finicio").prop("disabled",true);
		$("#ffinal").prop("disabled",true);
		$("#costo").prop("disabled",true);
		$("#trabajador").prop("disabled",true);
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
					url: '../controladores/consultaordeneservicios.php?op=listar',
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

function mostrarConsulta(idorden)
{
	$.post("../controladores/consultaordeneservicios.php?op=mostrarConsulta",{idorden : idorden}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);
		$("#idorden").text(data.idorden);
		if(data.estado=="0")
			$("#estado0").text("Sin orden de trabajo");
		else
			$("#estado1").text("Orden de trabajo asignado");
		$("#ruc").val(data.ruc);
		$("#razonsocial").val(data.razonSocial);
		$("#servicio").val(data.nombre);
		$("#descripcion").val(data.descripcion);
		$("#finicio").val(data.fechaInicio);
		$("#ffinal").val(data.fechaFinal);
		$("#costo").val(data.costo);
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