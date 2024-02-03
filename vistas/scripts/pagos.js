var tabla;

function init(){
    mostrarform(false);
    listar();
    
    $("#formulario").on("submit",function(e)
	{
		guardarfactura(e);
	});

	$("#formulariopago").on("submit",function(e)
	{
		addregistropago(e);
	});
    
	const li = document.querySelector('#nav-li-pago');
    li.classList.add('active');
}

function limpiar(){
    $("#idpago").val("");
    $("#documento").attr("src","");
    $("#documento").val("");
    //Obtenemos la fecha actual
	var fecha = new Date();
	var dia = ("0" + fecha.getDate()).slice(-2);
	var mes = ("0" + (fecha.getMonth() + 1)).slice(-2);
	var hoy = fecha.getFullYear()+"-"+(mes)+"-"+(dia) ;
    $('#fechapago').val(hoy);
	$('#fechapago').prop("max",hoy);
}

function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#formularioregistrospago").hide();
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
					url: '../controladores/pagos.php?op=listar',
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

function guardarfactura(e)
{
	e.preventDefault();
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../controladores/pagos.php?op=guardarfactura",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          bootbox.alert(datos);
	          mostrarform(false);
	          tabla.ajax.reload();
	    }

	});
}

function addregistropago(e)
{
	e.preventDefault();
	var formData = new FormData($("#formulariopago")[0]);

	$.ajax({
		url: "../controladores/pagos.php?op=addregistropago",
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
			  	$("#listadoregistros").show();
			  	$("#formularioregistrospago").hide();
	          	tabla.ajax.reload();
				limpiar();
			}
	    }

	});
}

function mostrar(idpago)
{
	$.post("../controladores/pagos.php?op=mostrar",{idpago : idpago}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);
        $("#idpago").val(data.idpago);
 	});
}

function mostrarpago(idpago)
{
	$.post("../controladores/pagos.php?op=mostrar",{idpago : idpago}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarformpago();
        $("#idpagof").val(data.idpago);
 	});
}

function mostrarformpago()
{
	$("#listadoregistros").hide();
	$("#formularioregistrospago").show();
	$("#idpagof").val("");
}

function eliminarfactura(idpago)
{
	bootbox.confirm("¿Está Seguro de eliminar la factura registrada?", function(result){
		if(result)
        {
        	$.post("../controladores/pagos.php?op=eliminarfactura",{idpago : idpago}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}

function eliminarfechapago(idpago)
{
	bootbox.confirm("¿Está Seguro de eliminar la fecha de registro de pago de la factura?", function(result){
		if(result)
        {
        	$.post("../controladores/pagos.php?op=eliminarfechapago",{idpago : idpago}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}

$(document).ready(function(){

	$("#btncancelarfregistro").click(function(){
		cancelarform();
	});

	$("#btncancelarfpago").click(function(){
		cancelarform();
	});

});

init();