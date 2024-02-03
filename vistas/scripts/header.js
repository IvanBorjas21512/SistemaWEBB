$(document).ready(function(){
    SpanCantidadTrabajosPendientes();
    setInterval(
        function(){
            $("#spantpendientes").load(SpanCantidadTrabajosPendientes());
        },1000
    );
});

function SpanCantidadTrabajosPendientes()
{
    $.ajax({
        url: '../controladores/escritorio.php?op=contarTrabajos',
        type: 'POST',
        data: {},
        success: function(res){
            data= JSON.parse(res);
            if(data.tpendientes>0)
                $("#spantpendientes").text(data.tpendientes+'+');
        }
    });
}
