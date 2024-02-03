var tabla;

function init() {
    mostrarform(false);
    listar();

    const li = document.querySelector('#nav-li-consulta');
    li.classList.add('active');
}

function limpiar() {
    $("#idcliente").val("");
    $("#estado0").text("");
	$("#estado1").text("");
    $("#ruc").val("");
    $("#razonsocial").val("");
    $("#representante").val("");
    $("#direccion").val("");
	$("#telefono").val("");
	$("#email").val("");
	$("#fecharegistro").val("");
	$("#formFechaRegistro").hide();
	
}

function mostrarform(flag) {
    limpiar();
    if (flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#ruc").prop("disabled",true);
		$("#razonsocial").prop("disabled",true);
        $("#representante").prop("disabled",true);
        $("#direccion").prop("disabled",true);
	    $("#telefono").prop("disabled",true);
	    $("#email").prop("disabled",true);
	    $("#fecharegistro").prop("disabled",true);
	    $("#formFechaRegistro").prop("disabled",true);
    } else {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
    }
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
            url: '../controladores/consultaclientes.php?op=listar',
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

function mostrarConsulta(idcliente) {
    $.post("../controladores/consultaclientes.php?op=mostrarConsulta", { idcliente: idcliente  }, function (data, status) {
        data = JSON.parse(data);
        mostrarform(true);
        if(data.estado=="0")
        $("#estado0").text("Cliente inactivo");
        else
        $("#estado1").text("Cliente activo");
        $("#ruc").val(data.ruc);
        $("#razonsocial").val(data.razonSocial);
		$("#representante").val(data.representante);
        $("#direccion").val(data.direccion);
        $("#telefono").val(data.telefono);
		$("#email").val(data.email);
		$("#fecharegistro").val(data.fechaRegistro);
        $("#idcliente").text(data.idcliente);
    })
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