$(document).ready(function() {
	$("#nuevoUsuario").submit(function() {
		usuario = $("#newUsername").val();
		nombre = $("#newNombre").val();
		pass = $("#newPass").val();
		email = $("#newEmail").val();

	
		var request = $.ajax({
			url: "cambiosUser.php",
			method: "POST",
			data: { username: usuario, name: nombre, password: pass, mail: email, Submit: "ok"}
		});
		request.done(function(result){
			//alert(result);
			//$("#msgError").html(result);
			$("#newUser .cerrarModal").click();
			notif({
				msg: "El usuario ha sido creado correctamente. Se ha enviado un correo de activación.",
				type: "success",
				position: "center"
			});
		});
		request.fail(function(result){
			$("#newUser .cerrarModal").click();
			notif({
				msg: "Se ha producido un error.",
				type: "error",
				position: "center"
			});
		});
	
	return false;
});

});
