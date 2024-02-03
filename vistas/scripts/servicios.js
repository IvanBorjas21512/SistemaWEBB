var tabla;

function init() {
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function (e) {
        guardaryeditar(e);
    });

    const li = document.querySelector('#nav-li-servicio');
    li.classList.add('active');
}

function limpiar() {
    $("#idservicio").val("");
    $("#servicio").val("");	
}

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
            url: '../controladores/servicios.php?op=listar',
            type: "get",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10, //Paginación
        "order": [
            [0, "asc"]
        ] //Ordenar (columna,orden)
    }).DataTable();
}

function guardaryeditar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    //$("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../controladores/servicios.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function (datos) {
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

function mostrar(idservicio) {
    $.post("../controladores/servicios.php?op=mostrar", {
        idservicio: idservicio
    }, function (data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#servicio").val(data.nombre);
        $("#idservicio").val(data.idservicio);

    })
}

function desactivar(idservicio) {
    bootbox.confirm("¿Está Seguro de desactivar el Servicio?", function (result) {
        if (result) {
            $.post("../controladores/servicios.php?op=desactivar", {
                idservicio: idservicio
            }, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

function activar(idservicio) {
    bootbox.confirm("¿Está Seguro de activar Servicio?", function (result) {
        if (result) {
            $.post("../controladores/servicios.php?op=activar", {
                idservicio: idservicio
            }, function (e) {
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