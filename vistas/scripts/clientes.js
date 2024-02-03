var tabla;

function init() {
    mostrarform(false);
    listar();
    
    $("#formulario").on("submit", function (e) {
        guardaryeditar(e);
    })

    const li = document.querySelector('#nav-li-cliente');
    li.classList.add('active');
}

function limpiar() {
    $("#idcliente").val("");
    $("#ruc").val("");
    $("#razonsocial").val("");
    $("#representante").val("");
    $("#direccion").val("");
	$("#telefono").val("");
	$("#email").val("");
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
            url: '../controladores/clientes.php?op=listar',
            type: "get",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10, //Paginación
        "order": [
            [1, "asc"]
        ] //Ordenar (columna,orden)
    }).DataTable();
}

function guardaryeditar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    //$("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../controladores/clientes.php?op=guardaryeditar",
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

function mostrar(idcliente) {
    $.post("../controladores/clientes.php?op=mostrar", {
        idcliente: idcliente
    }, function (data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#ruc").val(data.ruc);
        $("#razonsocial").val(data.razonSocial);
		$("#representante").val(data.representante);
        $("#direccion").val(data.direccion);
        $("#telefono").val(data.telefono);
		$("#email").val(data.email);
        $("#idcliente").val(data.idcliente);

    })
}

function desactivar(idcliente) {
    
    bootbox.confirm("¿Está seguro de desactivar el Cliente?", function (result) {
        if (result) {
            $.post("../controladores/clientes.php?op=desactivar", {
                idcliente: idcliente
            }, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

function activar(idcliente) {
    bootbox.confirm("¿Está seguro de activar Cliente?", function (result) {
        if (result) {
            $.post("../controladores/clientes.php?op=activar", {
                idcliente: idcliente
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