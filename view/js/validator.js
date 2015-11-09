$(document).ready(function() {
	$("#insertUser").on("click", function() {
    usuario = $("#newUsername").val();
    password = $("#newPass").val();

    cadena = "";
   if(usuario.length < 1)
   {
     cadena += "<div class='alert alert-danger-alt alert-dismissable'>";
     cadena += "<span class='glyphicon glyphicon-certificate'></span>";
         cadena += "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>";
     cadena += "×</button>Debe de introducir un usuario.</div>";

     $("#msgError").append(cadena);
     return false;
   }
  });
});
