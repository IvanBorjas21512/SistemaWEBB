var tabla;

function init(){
    mostrarform(false);
    listar();
    
    $("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	});

	const li = document.querySelector('#nav-li-ordentrabajo');
    li.classList.add('active');
}

function limpiar(){
    $("#idtrabajo").val("");
	$("#documento").attr("src","");
    $("#documento").val("");
}

function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
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
					url: '../controladores/ordenestrabajo.php?op=listar',
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
		url: "../controladores/ordenestrabajo.php?op=guardaryeditar",
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
                mostrarform(false);
                tabla.ajax.reload();
            }
	    }

	});
}

function mostrar(idtrabajo)
{
	$.post("../controladores/ordenestrabajo.php?op=mostrar",{idtrabajo : idtrabajo}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);
		$("#idtrabajo").val(data.idtrabajo);
 	});
    }

function eliminardocumento(idtrabajo)
{
	bootbox.confirm("¿Está Seguro de eliminar el documento de la orden de trabajo?", function(result){
		if(result)
        {
        	$.post("../controladores/ordenestrabajo.php?op=eliminardocumento", {idtrabajo : idtrabajo}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

$(document).ready(function(){

	$("#btncancelarform").click(function(){
		cancelarform();
	});
});

init();