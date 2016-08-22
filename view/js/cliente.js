$(document).ready(function() {
	//--- Nuevo Cliente --->
	$(document).on("click","#pedidoNuevoCliente",function(){
		$("#nuevoCliente #accion").val("nuevoPedido");
		$("#nuevoCliente").modal("show");
	});
	
	$(document).on('hidden.bs.modal', '#nuevoCliente',function () {
    	$("#nuevoCliente #accion").val("");
	});
	
	$("#newCliente").submit(function() {
		nombre = $("#nombreCliente").val();
		ape1 = $("#1apellido").val();
		ape2 = $("#2apellido").val();
		telf = $("#telefono").val();
		accion = $("#accion").val();

		var request = $.ajax({
			url: "../view/cambiosClientes.php",
			method: "POST",
			data: { nombre: nombre, apellido1: ape1, apellido2: ape2, telefono: telf, Submit: "ok"},
			dataType: "text"
		});
		request.done(function(data){
			if(accion == "nuevoPedido"){
				id = data;
				$('#nuevoCliente .closeModal').click();
				$('#newCliente').trigger("reset");
				seleccionarCliente(id, nombre, ape1, ape2, telf);
			}
			else{
				$('#nuevoCliente .closeModal').click();
				$('#newCliente').trigger("reset");
				if($("#pedNuevoCli").hasClass("activo") == false)
				{
					$('#clientes').click();
				}
			}
			
			notif({
				msg: "El cliente ha sido creado correctamente.",
				type: "success",
				position: "center"
			});
		});
		request.fail(function(result){
			notif({
				msg: "Se ha `producido un error.",
				type: "error",
				position: "center"
			});
		});
		$('#editClienteForm').trigger("reset");
		return false;
	});
	//--- Fin Nuevo Cliente --->
	
	//--- Editar Cliente --->
	$("#editClienteForm").submit(function() {
	
		id = $('#editClienteForm .id').val();
		nombre = $("#editClienteForm #nombreCliente").val();
		ape1 = $("#editClienteForm #1apellido").val();
		ape2 = $("#editClienteForm #2apellido").val();
		telf = $("#editClienteForm #telefono").val();
		
		var request = $.ajax({
			url : "../controller/ClientesController.php",
			method: "POST",
			dataType : "json",
			data: { accion : "edit", idCliente: id, nombre: nombre, apellido1: ape1, apellido2: ape2, telefono: telf}
		});
		request.done(function(result) {
				$("#editarCliente .closeModal").click();
				if (result.mensaje == "ok") {
					$('#clientes').click();
					notif({
						msg : "El cliente ha sido modificado correctamente.",
						type : "success",
						position : "center"
					});
				} else {
					notif({
						msg : "Se ha producido un error.",
						type : "error",
						position : "center"
					});
				}
			});
			request.fail(function(jqXHR, textStatus, errorThrown) {

				$('#main').html('<h2>Error !!!!: ' + jqXHR.statusText + '</h2>' + errorThrown);
				alert(jqXHR.responseText);

			});
			return false;
	});
	//--- Fin Editar Cliente --->
});
