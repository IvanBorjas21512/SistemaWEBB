var tabla;

function init(){
    limpiar();
    mostrarform(false);
    mostrarConsulta();
    mostrarCantidadTrabajos();
    mostrarMisGastos();
    
    $("#dni").prop("disabled",true);
    $("#nombre").prop("disabled",true);
    $("#apellido").prop("disabled",true);

    $("#formMostrarDatos").on("submit",function(e){
        modificardatos(e);
    });

    $("#formCambiarContraseña").on("submit",function(e){
        cambiarcontraseña(e);
    });
    
    const li = document.querySelector('#nav-li-escritorio');
    li.classList.add('active');

}

function limpiar(){
    $("#contraactual").val("");
    $("#contranueva").val("");
    $("#contraconfirmar").val("");
}

function mostrarform(flag){
    if(flag){
        $("#direccion").prop("disabled",false);
        $("#telefono").prop("disabled",false);
        $("#email").prop("disabled",false);
        $("#formbtnmodificar").show();
        $("#formbtninicial").hide();
    }else{
        $("#direccion").prop("disabled",true);
        $("#telefono").prop("disabled",true);
        $("#email").prop("disabled",true);
        $("#formbtnmodificar").hide();
        $("#formContraseña").hide();
        $("#formbtninicial").show();
        $("#formMostrar").show();
    }
}

function mostrarConsulta()
{
    $.ajax({
        url: "../controladores/escritorio.php?op=mostrarConsulta",
        type: 'POST',
        data: {},
        success: function(res){
            data= JSON.parse(res);
            $("#dni").val(data.dni);
            $("#nombre").val(data.nombre);
            $("#apellido").val(data.apellido);
            $("#direccion").val(data.direccion);
            $("#telefono").val(data.telefono);
            $("#email").val(data.email);
        }
    });
}

function mostrarCantidadTrabajos()
{
    $.ajax({
        url: '../controladores/escritorio.php?op=contarTrabajos',
        type: 'POST',
        data: {},
        success: function(res){
            data= JSON.parse(res);
            $("#tterminados").text(data.tterminados);
            $("#tpendientes").text(data.tpendientes);
            $("#totaltrabajos").text(parseInt(data.tterminados)+parseInt(data.tpendientes));
        }
    });
}

function mostrarMisGastos()
{
    $.ajax({
        url: '../controladores/escritorio.php?op=sumaGastos',
        type: 'POST',
        data: {},
        success: function(res){
            data= JSON.parse(res);
            if(data.tgastos!==null)
                $("#misgastos").text(data.tgastos);
        }
    });
}

function modificardatos(e) {
    e.preventDefault();
    var formData = new FormData($("#formMostrarDatos")[0]);
    $.ajax({
        url: '../controladores/escritorio.php?op=modificarDatos',
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
                mostrarConsulta();
            }
        }
    });
}

function cambiarcontraseña(e) {
    e.preventDefault();
    var formData = new FormData($("#formCambiarContraseña")[0]);

    $.ajax({
        url: '../controladores/escritorio.php?op=cambiarContraseña',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function (datos) {
            bootbox.alert(datos);
            if(datos=="Su contraseña ha sido modificado con éxito"){
                mostrarform(false);
                ajax.reload();
                limpiar();
            }
        }
    });
}

$(document).ready(function(){

    $("#btnmodificar").click(function(){
		mostrarform(true);
    });
    $("#btncancelar").click(function(){
		mostrarform(false);
    });
    $("#btncambiarcontraseña").click(function(){
        limpiar();
        $("#formMostrar").hide();
        $("#formContraseña").show();
    });
    $("#btncancelarcontra").click(function(){
        limpiar();
        mostrarform(false);
    })
});

init();
