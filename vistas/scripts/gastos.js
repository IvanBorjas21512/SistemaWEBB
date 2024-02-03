var tabla;

//Funcion que se ejecuta al inicio

function init() {

    $.post("../controladores/usuarios.php?op=seleccionarUsuarios", function(r){
        $("#idusuario").html(r);
        $('#idusuario').selectpicker('refresh');
    });

    mostrarform(false);
    listar();
    $("#formulario").on("submit", function (e) {
        guardaryeditar(e);
    });

    const li = document.querySelector('#nav-li-gasto');
    li.classList.add('active');
}

//Funcion Limpiar
function limpiar() {
    $("#idgasto").val("");
    $("#idusuario").val("");
    $("#fecha").val("");
    $("#concepto").val("");
    $("#monto").val("");
    
    //Obtenemos la fecha actual
	var fecha = new Date();
	var dia = ("0" + fecha.getDate()).slice(-2);
	var mes = ("0" + (fecha.getMonth() + 1)).slice(-2);
	var hoy = fecha.getFullYear()+"-"+(mes)+"-"+(dia) ;
    $('#fecha').val(hoy);
    $('#fecha').prop("max",hoy);
}

//Mostrar Formulario

function mostrarform(flag) {
    limpiar();
    if (flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnagregar").hide();
    } else {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#btnagregar").show();
    }
}

function cancelarform() {
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
            url: '../controladores/gastos.php?op=listar',
            type: "get",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10, //Paginación
        "order": [
            [1, "desc"]
        ] //Ordenar (columna,orden)
    }).DataTable();
}

function guardaryeditar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    //$("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../controladores/gastos.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function (datos) {
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

function mostrar(idgasto) {
    $.post("../controladores/gastos.php?op=mostrar", {
        idgasto: idgasto
    }, function (data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#idusuario").val(data.idusuario);
        $('#idusuario').selectpicker('refresh');
        $("#fecha").val(data.fecha);
        $("#concepto").val(data.concepto);
        $("#monto").val(data.monto);
        $("#idgasto").val(data.idgasto);
    });
}
//Función para eliminar registros
function eliminar(idgasto)
{
	bootbox.confirm("¿Está Seguro de eliminar el Gasto?", function(result){
		if(result)
        {
        	$.post("../controladores/gastos.php?op=eliminar", {idgasto : idgasto}, function(e){
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

init();