var tabla;
var tablatb;

function init(){

	$.post("../controladores/clientes.php?op=seleccionarClientes", function(r){
		$("#idcliente").append(r);
		$("#idcliente").selectpicker('refresh');
	});

	$.post("../controladores/servicios.php?op=seleccionarServicios", function(r){
		$("#idservicio").append(r);
		$("#idservicio").selectpicker('refresh');
	});

	$.post("../controladores/usuarios.php?op=seleccionarUsuarios", function(r){
		$("#idusuario").append(r);
		$("#idusuario").selectpicker('refresh');
	});

    mostrarform(false);
    listar();
	listartb();
    
    $("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	});

    $("#formulariotb").on("submit",function(e)
	{
		addtrabajo(e);	
	});

	const li = document.querySelector('#nav-li-ordenservicio');
    li.classList.add('active');
}

function limpiar(){
    $("#idorden").val("");
    $("#idservicio").val("");
    $("#idcliente").val("");
    $("#descripcion").val("");
    $("#costo").val("");    
    //Obtenemos la fecha actual
	var fecha = new Date();
	var dia = ("0" + fecha.getDate()).slice(-2);
	var mes = ("0" + (fecha.getMonth() + 1)).slice(-2);
	var hoy = fecha.getFullYear()+"-"+(mes)+"-"+(dia) ;
    $('#fechainicio').val(hoy);
	$('#fechafin').val(hoy);
	$('#fechafin').prop("min",hoy);
}


$("#fechainicio").on('change',function(e)
{
	var x = document.getElementById("fechainicio").value;
	$('#fechafin').val((x));
	$('#fechafin').prop("min",x);
});

function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#formOrdenTrabajo").hide();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
		$("#titulo2").hide();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formOrdenTrabajo").show();
		$("#formularioregistrostb").hide();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
		$("#titulo2").show();
	}
}

function cancelarform()
{
    limpiar();
    mostrarform(false);
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
					url: '../controladores/ordeneservicio.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

function listartb()
{
	tablatb=$('#tbllistadotb').dataTable(
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
					url: '../controladores/ordeneservicio.php?op=listartb',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación
	    "order": [[ 1, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

function guardaryeditar(e)
{
	e.preventDefault();
	//$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../controladores/ordeneservicio.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
            if(datos=="vacio")
                bootbox.alert("Existen campos vacios o valores negativos, por favor verifique");
            else{
                bootbox.alert(datos);
                mostrarform(false);
                tabla.ajax.reload();
            }
	    }

	});
}

function addtrabajo(e)
{
	e.preventDefault();
	//$("#btnGuardartb").prop("disabled",true);
	var formData = new FormData($("#formulariotb")[0]);

	$.ajax({
		url: "../controladores/ordeneservicio.php?op=addtrabajo",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	        if(datos=="vacio")
                bootbox.alert("Existen campos vacios, por favor verifique");
            else{  
				bootbox.alert(datos);	          
			  	$("#formOrdenServicio").show();
			  	$("#listadoregistrostb").show();
			  	$("#formularioregistrostb").hide();
	          	tabla.ajax.reload();
			  	tablatb.ajax.reload();
				limpiar();
			}
	    }

	});
}

function mostrar(idorden)
{
	$.post("../controladores/ordeneservicio.php?op=mostrar",{idorden : idorden}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);
		$("#idorden").val(data.idorden);
		$("#idcliente").val(data.cliente);
        $('#idcliente').selectpicker('refresh');
        $("#idservicio").val(data.servicio);
        $('#idservicio').selectpicker('refresh');
		$("#descripcion").val(data.descripcion);
		$("#costo").val(data.costo);
		$("#fechainicio").val(data.finicio);
		$("#fechafin").val(data.ffinal);
 	});
}

function mostrartb(idorden)
{
		$.post("../controladores/ordeneservicio.php?op=mostrar",{idorden : idorden}, function(data, status)
		{
			data = JSON.parse(data);		
			mostrarformtb();
			$("#idordentb").val(data.idorden);
			/*$("#idcliente").val(data.cliente);
			$('#idcliente').selectpicker('refresh');*/
			
		 });
	}

function editartb(idtrabajo)
{
		$.post("../controladores/ordeneservicio.php?op=editartb",{idtrabajo : idtrabajo}, function(data, status)
		{
			data = JSON.parse(data);		
				mostrarformtb();
				$("#idtrabajo").val(data.idtrabajo);
				$("#idusuario").val(data.idusuario);
				$('#idusuario').selectpicker('refresh');
				
		});		
	}

function mostrarformtb()
{
	$("#formOrdenServicio").hide();
	$("#listadoregistrostb").hide();
	$("#formularioregistrostb").show();
	$("#idordentb").val("");
	$("#titulo1").hide();
	$("#btnagregar").hide();
}

function cancelarformtb()
{
	$("#formOrdenServicio").show();
	$("#listadoregistrostb").show();
	$("#formularioregistrostb").hide();
	$("#titulo1").show();
	$("#btnagregar").show();
}

function eliminar(idorden)
{
	bootbox.confirm("¿Está Seguro de eliminar la Orden de Servicio?", function(result){
		if(result)
        {
        	$.post("../controladores/ordeneservicio.php?op=eliminar", {idorden : idorden}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

function eliminartb(idtrabajo,idorden)
{
	bootbox.confirm("¿Está Seguro de eliminar la Orden de Trabajo?", function(result){
		if(result)
        {
        	$.post("../controladores/ordeneservicio.php?op=eliminartb", {idtrabajo : idtrabajo,idorden : idorden}, function(e){
        		bootbox.alert(e);
				tablatb.ajax.reload();
	            tabla.ajax.reload();
        	});	
        }
	})
}

$(document).ready(function(){

	$("#btnagregar").click(function(){
		mostrarform(true);
	});
	$("#btncancelarform").click(function(){
		cancelarform();
	});
	$("#btncancelarformtb").click(function(){
		cancelarformtb();
	});
});
init();