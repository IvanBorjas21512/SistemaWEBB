$("#frmAcceso").on('submit',function(e)
{
	e.preventDefault();
    logina=$("#logina").val();
    clavea=$("#clavea").val();

    $.post("../controladores/usuarios.php?op=verificar",
        {"logina":logina,"clavea":clavea},
        function(data)
    {
        if (data!="null")
        {
            $(location).attr("href","escritorio.php");         
        }
        else
        {
            bootbox.alert("Usuario y/o Password incorrectos");
        }
    });
});

$("#logina").on('keypress',function(e)
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