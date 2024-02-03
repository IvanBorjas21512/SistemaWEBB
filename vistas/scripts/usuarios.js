var tabla;

function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})

	$.post("../controladores/usuarios.php?op=permisos&id=",function(r){
	        $("#permisos").html(r);
	});

	const li = document.querySelector('#nav-li-usuario');
    li.classList.add('active');
}

function limpiar()
{
	$("#dni").val("");
	$("#nombre").val("");
	$("#apellido").val("");
	$("#direccion").val("");
	$("#telefono").val("");
	$("#email").val("");
	$("#login").val("");
	$("#clave").val("");
	$("#imagen").attr("src","");
	$("#imagen").val("");
	//$("#imagenactual").val("");
	$("#idusuario").val("");
	//$("#imagenmuestra").hide();
	$("#frmDatoslogeo").show();
	$("#frmDatosimagen").show();
	$("#login").prop("required",true);
	$("#clave").prop("required",true);
	$("#imagen").prop("required",true);		
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
		const li = document.querySelector('#login');
		li.classList.remove('is-invalid');	
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

function listar() {
    tabla = $('#tbllistado').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del control de tabla
        /*buttons: [
            'copyHtml5',
            'excelHtml5',
            'pdf'
        ],*/
        "ajax": {
            url: '../controladores/usuarios.php?op=listar',
            type: "get",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10, //Paginación
        "order": [
            [2, "asc"]
        ] //Ordenar (columna,orden)
    }).DataTable();
}

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	//$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../controladores/usuarios.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,
	    success: function(datos)
	    {                    
	        if(datos=="vacio"){
				bootbox.alert("Existen campos vacios, por favor verifique");
			}else{
				if(datos=="ERROR")
				{
					bootbox.alert("El usuario ingresado ya existe, por favor ingrese otro usuario");
					const li = document.querySelector('#login');
					li.classList.add('is-invalid');
					$("#login").val("");
				}
				else
				{
					bootbox.alert(datos);	          
					mostrarform(false);
					tabla.ajax.reload();
				}  
			}
	    }
		
	});
}

function mostrar(idusuario)
{
	$.post("../controladores/usuarios.php?op=mostrar",{idusuario : idusuario}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#dni").val(data.dni);
		$("#nombre").val(data.nombre);
		$("#apellido").val(data.apellido);
		$("#direccion").val(data.direccion);
		$("#telefono").val(data.telefono);
		$("#email").val(data.email);
		$("#idusuario").val(data.idusuario);
		$("#frmDatoslogeo").hide();
		$("#frmDatosimagen").hide();
		$("#login").removeAttr("required");
		$("#clave").removeAttr("required");
		$("#imagen").removeAttr("required");
 	});
 	$.post("../controladores/usuarios.php?op=permisos&id="+idusuario,function(r){
	        $("#permisos").html(r);
	});
}

//Función para desactivar registros
function desactivar(idusuario)
{
	bootbox.confirm("¿Está Seguro de desactivar el usuario?", function(result){
		if(result)
        {
        	$.post("../controladores/usuarios.php?op=desactivar", {idusuario : idusuario}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(idusuario)
{
	bootbox.confirm("¿Está Seguro de activar el Usuario?", function(result){
		if(result)
        {
        	$.post("../controladores/usuarios.php?op=activar", {idusuario : idusuario}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Funcion para resetearContraseña
function resetearContraseña(idusuario)
{
	bootbox.confirm("¿Está Seguro de restaurar la contraseña del Usuario?", function(result){
		if(result)
        {
        	$.post("../controladores/usuarios.php?op=resetearContraseña", {idusuario : idusuario}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

$(document).ready(function(){

	$("#btnagregar").click(function(){
		mostrarform(true);
	});

	$("#btncancelar").click(function(){
		cancelarform();
	});
	
});


$("#login").on('keypress',function(e)
{
	forceKeyPressUppercase(e);
});

function forceKeyPressUppercase(e)
{
  var charInput = e.keyCode;
  if((charInput >= 97) && (charInput <= 122)) { // lowercase
    if(!e.ctrlKey && !e.metaKey && !e.altKey) { // no modifier key
      var newChar = charInput - 32;
      var start = e.target.selectionStart;
      var end = e.target.selectionEnd;
      e.target.value = e.target.value.substring(0, start) + String.fromCharCode(newChar) + e.target.value.substring(end);
      e.target.setSelectionRange(start+1, start+1);
      e.preventDefault();
    }
  }
}

init();