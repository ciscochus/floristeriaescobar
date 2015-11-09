$(document).ready(function() {
	$("#nuevoArticulo .guardar").on("click", function() {
		//recogemos los valores del formulario
		nombre = $("#nombreArticulo").val();
		abreviatura = $("#abreviaturaArticulo").val();
		precio = $("#precioArticulo").val();
		stock = $("#stockArticulo").val();

		var request = $.ajax({
			url : "../view/cambiosArticulos.php",
			method : "POST",
			data : {
				nombre : nombre,
				precio : precio,
				stock : stock,
				abreviatura: abreviatura,
				Submit : "ok"}
			});
			
			request.done(function(result){
			$('#nuevoArticulo .closeModal').click();
			$('#articulos').click();
			notif({
				msg: "El articulo ha sido creado correctamente.",
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
	});


	//--- Editar Articulo --->
	$("#editArticuloForm").submit(function() {
	
		id = $('#editArticuloForm .id').val();
		nombre = $("#editArticuloForm #nombreArticulo").val();
		abreviatura = $("#editArticuloForm #abreviaturaArticulo").val();
		precio = $("#editArticuloForm #precioArticulo").val();
		stock = $("#editArticuloForm #stockArticulo").val();

		
		var request = $.ajax({
			url : "../controller/ArticulosController.php",
			method: "POST",
			dataType : "json",
			data: { accion : "edit", idArticulo: id, nombre: nombre, abreviatura: abreviatura, precio: precio, stock: stock}
		});
		request.done(function(result) {
				$("#editarArticuloModal .closeModal").click();
				if (result.mensaje == "ok") {
					$('#articulos').click();
					notif({
						msg : "El articulo ha sido modificado correctamente.",
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
