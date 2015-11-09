$(document).ready(function() {
	$("#submitLogin").on("click", function() {
		usuario = $("#username").val();
		password = $("#password").val();


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
		else if (password.length < 1) {

			cadena += "<div class='alert alert-danger-alt alert-dismissable'>";
			cadena += "<span class='glyphicon glyphicon-certificate'></span>";
        	cadena += "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>";
			cadena += "×</button>No ha introducido una contraseña.</div>";

			$("#msgError").html(cadena);
			return false;
		}
		else {
		//	alert("usuario: "+usuario+"\n password: " + password);

			var request = $.ajax({
			  url: "view/login.php",
			  method: "POST",
			  data: { user: usuario, pass: password, Submit: "ok"},
			  dataType: "json"
			});
			request.done(function(result){
				
				if(result.message == "true")
				{
					//var url = “tu-URL-a-direccionar”;
					$(location).attr('href',"view/inicio.php");
				}
				else{
					cadena += "<div class='alert alert-danger-alt alert-dismissable'>";
					cadena += "<span class='glyphicon glyphicon-certificate'></span>";
		        	cadena += "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>";
					cadena += "×</button>Usuario/contraseña invalidos. </div>";
					$("#msgError").html(cadena);

				}
			});
			request.fail(function(result){
				$("#newUser .cerrarModal").click();
				notif({
					msg: "Usuario o contraseña incorrectos",
					type: "error",
					position: "center"
				});
			});
			return false;
		}
	});
});
