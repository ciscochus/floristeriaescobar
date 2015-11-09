$(document).ready(function() {

	/* Clientes */
	$("#clientes").on("click", function() {

		var request = $.ajax({
			url : "../controller/ClientesController.php",
			method : "POST",
			data : "listar",
			dataType : "json"
		});

		request.done(function(result) {
			var salida = "";
			salida += "<br/>";
			salida += "<div class='col-md-12'><label>Clientes</label></div>";
			salida += "<table id='tablaClientes' class='table table-striped'>";
			salida += "<thead><tr><th>Apellidos</th><th>Nombre</th><th>Teléfono</th><th class='nosort'></th><th class='nosort'></th></tr></thead>";
			salida += "<tbody>";
			$.each(result, function() {
				salida += "<tr class='cliente_"+this.idCliente+"'>";
				salida += "<td><span class='apellido_1'>" + this.apellido_1 + "</span> <span class='apellido_2'>" + this.apellido_2 + "</span> </td>";
				salida += "<td><span class='nombre'>" + this.nombre + "</span></td>";
				if (this.telefono == null) {
					salida += "<td><span class='telefono'>-</span></td>";
				} else {
					salida += "<td><span class='telefono'>" + this.telefono + "</span></td>";
				}
				salida += "<td><a href='#' class='deleteClientes'><i class='icon-remove-circle'><input class='idCliente' type='hidden' value='" + this.idCliente + "'/></i></a></td>";
				salida += "<td><a href='#' class='editClientes'><i class='icon-edit edit'><input class='idCliente' type='hidden' value='" + this.idCliente + "'/></i></a></td>";
				salida += "</tr>";
			});
			salida += "</table>";
			$("#main").html(salida);


			//inicializamos el plugin datatable
			$('#main #tablaClientes').DataTable( {
			    paging: false,
			    info: false,
			    "oLanguage": {
						      "sSearch": "Buscar clientes:  "
						   },
				"columnDefs": [
							    { "orderable": false, "targets": "nosort" }
							  ]
			});
		});

		request.fail(function(jqXHR, textStatus, errorThrown) {

			$('#main').html('<h2>Error !!!!: ' + jqXHR.statusText + '</h2>' + errorThrown);
			alert(jqXHR.responseText);

		});
	});

	//eliminar clientes
	$(document).on("click", ".deleteClientes", function(event) {
		event.preventDefault();
		var idCliente = $(this).find('.idCliente').val();
		bootbox.confirm("Confirme que desea eliminar el cliente", function(result) {
			if(result){
			var request = $.ajax({
				url : "../controller/ClientesController.php",
				method : "POST",
				dataType : "json",
				data : {
					accion : "delete",
					idCliente : idCliente
				}
			});
			request.done(function(result) {
				if (result.mensaje == "ok") {
					$('#clientes').click();
					notif({
						msg : "El cliente ha sido eliminado correctamente.",
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
		}
		});
	});


	//editar clientes
	$(document).on("click", ".editClientes", function(event) {
		//limpiamos el formulario por si mantiene algun valor residual
		$('#editClienteForm').trigger("reset");
		//inicializamos el formulario del modal con los valores del cliente
		var idCliente = $(this).find('.idCliente').val();
		var fila ="tr.cliente_"+idCliente;
		var nombre = $(fila).find(".nombre").html();
		var apellido_1 = $(fila).find(".apellido_1").html();
		var apellido_2 = $(fila).find(".apellido_2").html();
		var telefono = $(fila).find(".telefono").html();


		$('#editClienteForm .id').val(idCliente);
		$('#editClienteForm #nombreCliente').val(nombre);
		$('#editClienteForm #1apellido').val(apellido_1);
		$('#editClienteForm #2apellido').val(apellido_2);
		if(telefono!="-")
			$('#editClienteForm #telefono').val(telefono);


		$('#editarCliente').modal('show');
	});

	/* ---- Fin Clientes --- */

	/* Articulos */
	$("#articulos").on("click", function() {

		var request = $.ajax({
			url : "../controller/ArticulosController.php",
			method : "POST",
			data : "listar",
			dataType : "json"
		});
		request.done(function(result) {

			var salida = "";
			salida += "<br/>";
			salida += "<div class='col-md-12'><label>Artículos</label></div>";
			salida += "<table id='tablaArticulos' class='table table-striped'>";
			salida += "<thead><tr><th>Nombre</th><th>Abreviatura</th><th>Precio</th><th>Stock</th><th class='nosort'></th><th class='nosort'></th></tr></thead>";
			salida += "<tbody>";
			$.each(result, function() {
				salida += "<tr class='articulo_"+this.idArticulo+"'>";
				salida += "<td><span class='nombre'>" + this.nombre + "</span></td>";
				salida += "<td><span class='abreviatura'>" + this.abreviatura + "</span></td>";
				salida += "<td><span class='precio'>" + this.precio + "</span>€</td>";
				salida += "<td><span class='stock'>" + this.stock + "</span></td>";
				salida += "<td><a href='#' class='deleteArticulo'><i class='icon-remove-circle'><input class='idArticulo' type='hidden' value='" + this.idArticulo + "'/></i></a></td>";
				salida += "<td><a href='#' class='editArticulo'><i class='icon-edit edit'><input class='idArticulo' type='hidden' value='" + this.idArticulo + "'/></i></a></td>";


				salida += "</tr>";
			});
			salida += "</tbody>";
			salida += "</table>";
			$("#main").html(salida);


			//inicializamos el plugin datatable
			$('#main #tablaArticulos').DataTable( {
			    paging: false,
			    info: false,
			    "oLanguage": {
						      "sSearch": "Buscar articulos:  "
						   },
				"columnDefs": [
							    { "orderable": false, "targets": "nosort" }
							  ]
			});
		});

		request.fail(function(jqXHR, textStatus, errorThrown) {

			$('#main').html('<h2>Error !!!!: ' + jqXHR.statusText + '</h2>' + errorThrown);
			alert(jqXHR.responseText);

		});
	});


	//eliminar articulo
	$(document).on("click", ".deleteArticulo", function(event) {
		event.preventDefault();
		var idArticulo = $(this).find('.idArticulo').val();
		bootbox.confirm("Confirme que desea eliminar el articulo", function(result) {
			if(result){
				var request = $.ajax({
				url : "../controller/ArticulosController.php",
				method : "POST",
				dataType : "json",
				data : {
					accion : "delete",
					idArticulo : idArticulo
				}
			});
			request.done(function(result) {
				if (result.mensaje == "ok") {
					$('#articulos').click();
					notif({
						msg : "El articulo ha sido eliminado correctamente.",
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
			}
			});


	});


	//editar articulo
	$(document).on("click", ".editArticulo", function(event) {
		//limpiamos el formulario por si mantiene algun valor residual
		$('#editarArticuloModal input[type="text"]').val("");
		//inicializamos el formulario del modal con los valores del cliente
		var idArticulo = $(this).find('.idArticulo').val();
		var fila ="tr.articulo_"+idArticulo;
		var nombre = $(fila).find(".nombre").html();
		var precio = $(fila).find(".precio").html();
		var stock = $(fila).find(".stock").html();
		var abreviatura = $(fila).find(".abreviatura").html();


		$('#editarArticuloModal .id').val(idArticulo);
		$('#editarArticuloModal #nombreArticulo').val(nombre);
		$('#editarArticuloModal #precioArticulo').val(precio);
		$('#editarArticuloModal #stockArticulo').val(stock);
		$('#editarArticuloModal #abreviaturaArticulo').val(abreviatura);




		$('#editarArticuloModal').modal('show');
	});








	/* --- Fin Articulos ---- */
	$("#inicio").on("click", function() {

		var salida = "";

		$("#main").html(salida);
	});

	$("#busPedidos").on("click", function() {

		var salida = "";
		salida += "<br/>";
		salida += "<div class='col-md-12'><label>Búsqueda de pedidos:</label></div>";

		salida += "<div class='col-md-12'>";
		salida += "<div class='col-md-2'>";
		salida += "<p>Por cliente: </p>";
		salida += "</div>";
		salida += "<form class='form form-signup' role='form' method='post' action='#'>";
		salida += "<div class='col-md-8'>";
		salida += "<input type='text' class='form-control' name='1_apellido' id='1_apellido' placeholder='Primer Apellido' required/> <br/> ";
		salida += "</div>";
		salida += "<div class='col-md-2'>";
		salida += "<a href='#' id='busqCliente' type='submit' name='busqCliente' class='btn btn-success'>Buscar</a>";
		salida += "</div>";
		salida += "</form>";
		salida += "</div>";

		salida += "<div class='col-md-12'>";
		salida += "<div class='col-md-2'>";
		salida += "<p>Cliente: </p>";
		salida += "</div>";
		salida += "<div class='col-md-8'>";
		salida += "<p><label>El cliente seleccionado hay que cogerlo de la modal</label></p>";
		salida += "</div>";
		salida += "<div class='col-md-2'>";
		salida += "<a href='#' id='finPedido' type='submit' name='finPedido' class='btn btn-success'>Finalizar Pedido</a>";
		salida += "</div>";
		salida += "</div>";
//Tipo flores sueltas
		salida += "<div class='col-md-12'>";
		salida += "<div class='col-md-2'>";
		salida += "<p><label>Flores Sueltas</label></p>";
		salida += "</div>";
		salida += "<div class='col-md-10'>";
		salida += "<table class='table table-striped'>";
		salida += "<thead><tr><th>Artículo</th><th>Cantidad</th><th>P.U.</th><th>P.T.</th></tr>	</thead>";
		salida += "<tbody>";
		salida += "<tr>";
		salida += "<th scope='row'>Articulo 1</th>";
		salida += "<td align='center'>4</td>";
		salida += "<td align='center'>3€</td>";
		salida += "<td align='center'>12€</td>";
		salida += "<td width='25'><a href='#' id='modArticuloPed' type='submit' name='modArticulo' class='btn'>Modificar</a></td>";
		salida += "<td width='25'><a href='#' id='elimArticuloPed' type='submit' name='elimArticulo' class='btn'>Eliminar</a></td>";
		salida += "</tr>";
		salida += "</table>";
		salida += "</div>";
		salida += "<div class='col-md-2'>";
		salida += "<p>Entregado: </p>";
		salida += "</div>";
		salida += "<div class='col-md-2'>";
		salida += "<input type='checkbox'  id='entr' name='entr' value='Entregado'/>";
		salida += "</div>";
		salida += "<div class='col-md-8' align='right'>";
		salida += "<a href='#' id='modPedido' type='submit' name='modPedido' class='btn btn-success'>Modificar</a>";
		salida += "<a href='#' id='elimPedido' type='submit' name='elimPedido' class='btn'>Eliminar</a>";
		salida += "</div>";
		salida += "</div>";
//Tipo centros
		salida += "<div class='col-md-12'>";
		salida += "<div class='col-md-2'>";
		salida += "<p></p>";
		salida += "<p><label>Centros</label></p>";
		salida += "</div>";
		salida += "<div class='col-md-10'>";
		salida += "<p></p>";
		salida += "<table class='table table-striped'>";
		salida += "<thead><tr><th>Artículo</th><th>Cantidad</th><th>P.U.</th><th>P.T.</th></tr>	</thead>";
		salida += "<tbody>";
		salida += "<tr>";
		salida += "<th scope='row'>Articulo 1</th>";
		salida += "<td align='center'>4</td>";
		salida += "<td align='center'>3€</td>";
		salida += "<td align='center'>12€</td>";
		salida += "<td width='25'><a href='#' id='modArticuloPed' type='submit' name='modArticulo' class='btn'>Modificar</a></td>";
		salida += "<td width='25'><a href='#' id='elimArticuloPed' type='submit' name='elimArticulo' class='btn'>Eliminar</a></td>";
		salida += "</tr>";
		salida += "</table>";
		salida += "</div>";
		salida += "</div>";
		//Fecha de entrega y orden de llegada
		salida += "<div class='col-md-12'>";
		salida += "<div class='col-md-2'>";
		salida += "Fecha de entrega:";
		salida += "</div>";
		salida += "<div class='col-md-4'>";
		salida += "<input type='date' class='form-control' id='fecEntrega' name='fecEntrega'/>";
		salida += "</div>";
		salida += "<div class='col-md-2'>";
		salida += "Orden Llegada:";
		salida += "</div>";
		salida += "<div class='col-md-2'>";
		salida += "<input type='number' maxlength='4' size='4' min='0' class='form-control' name='ordLlegada' id='ordLlegada' required/> <br/> ";
		salida += "</div>";
		salida += "</div>";

		//Tiesto
		salida += "<div class='col-md-12'>";
		salida += "<div class='col-md-2'>";
		salida += "Tiene tiesto:";
		salida += "</div>";
		salida += "<div class='col-md-4'>";
		salida += "<input type='checkbox'  id='tiesto' name='tiesto' value='Tiene tiesto'/>";
		salida += "</div>";
		salida += "<div class='col-md-2'>";
		salida += "Tipo:";
		salida += "</div>";
		salida += "<div class='col-md-4'>";
		salida += "<select class='form-control'>";
		//Cambiar todo esto, esta puesto de prueba!
		salida += "<option id='1'>Flores Sueltas</option>";
		salida += "<option id='2'>Centros</option>";
		salida += "<option id='3'>Ramos</option>";
		salida += "</select>";
		salida += "</div>";
		salida += "</div>";
		salida += "<div><p></p></div>";

		//Descripción
		salida += "<div class='col-md-12'>";
		salida += "<div class='col-md-2'>";
		salida += "<p></p>";
		salida += "Descripción:";
		salida += "</div>";
		salida += "<div class='col-md-10'>";
		salida += "<p></p>";
		salida += "<textarea rows='4' cols='50' maxlength='180' class='form-control' id='descr' name='descr' placeholder='Descripción'/>";
		salida += "</div>";
		salida += "</div>";

		salida += "<div class='col-md-12'>";
		salida += "<div class='col-md-2'>";
		salida += "<p></p>";
		salida += "<p>Entregado: </p>";
		salida += "</div>";
		salida += "<div class='col-md-4'>";
		salida += "<p></p>";
		salida += "<input type='checkbox'  id='entr' name='entr' value='Entregado'/>";
		salida += "</div>";
		salida += "<div class='col-md-2'>";
		salida += "<p></p>";
		salida += "<p>Estado Almacen: </p>";
		salida += "</div>";
		salida += "<div class='col-md-4'>";
				salida += "<p></p>";
		salida += "<select class='form-control'>";
				//Les dejo los valores 1, 2 y 3 que son los que van a llevar cada uno en la base de datos
				//esta variable en la tabla subpedido sería tipoEncargo
  	salida += "<option id='1EstadoAlmacen'>Sin realizar</option>";
		salida += "<option id='2EstadoAlmacen'>En pronceso</option>";
		salida += "<option id='3EstadoAlmacen'>Realizado</option>";
		salida += "</select>";
		salida += "</div>";
		salida += "</div>";

		salida += "<div class='col-md-12'>";
		salida += "<p></p>";
		salida += "<div class='col-md-12' align='right'>";
		salida += "<a href='#' id='modPedido' type='submit' name='modPedido' class='btn btn-success'>Modificar</a>";
		salida += "<a href='#' id='elimPedido' type='submit' name='elimPedido' class='btn'>Eliminar</a>";
		salida += "</div>";
		salida += "</div>";

		//Tipo ramos
				salida += "<div class='col-md-12'>";
				salida += "<div class='col-md-2'>";
				salida += "<p></p>";
				salida += "<p><label>Ramos</label></p>";
				salida += "</div>";
				salida += "<div class='col-md-10'>";
				salida += "<p></p>";
				salida += "<table class='table table-striped'>";
				salida += "<thead><tr><th>Artículo</th><th>Cantidad</th><th>P.U.</th><th>P.T.</th></tr>	</thead>";
				salida += "<tbody>";
				salida += "<tr>";
				salida += "<th scope='row'>Articulo 1</th>";
				salida += "<td align='center'>4</td>";
				salida += "<td align='center'>3€</td>";
				salida += "<td align='center'>12€</td>";
				salida += "<td width='25'><a href='#' id='modArticuloPed' type='submit' name='modArticulo' class='btn'>Modificar</a></td>";
				salida += "<td width='25'><a href='#' id='elimArticuloPed' type='submit' name='elimArticulo' class='btn'>Eliminar</a></td>";
				salida += "</tr>";
				salida += "</table>";
				salida += "</div>";
				salida += "</div>";
				//Fecha de entrega y orden de llegada
				salida += "<div class='col-md-12'>";
				salida += "<div class='col-md-2'>";
				salida += "Fecha de entrega:";
				salida += "</div>";
				salida += "<div class='col-md-4'>";
				salida += "<input type='date' class='form-control' id='fecEntrega' name='fecEntrega'/>";
				salida += "</div>";
				salida += "<div class='col-md-2'>";
				salida += "Orden Llegada:";
				salida += "</div>";
				salida += "<div class='col-md-2'>";
				salida += "<input type='number' maxlength='4' size='4' min='0' class='form-control' name='ordLlegada' id='ordLlegada' required/> <br/> ";
				salida += "</div>";
				salida += "</div>";

				//Tiesto
				salida += "<div class='col-md-12'>";
				salida += "<div class='col-md-2'>";
				salida += "Tiene búcaro:";
				salida += "</div>";
				salida += "<div class='col-md-4'>";
				salida += "<input type='checkbox'  id='tiesto' name='tiesto' value='Tiene tiesto'/>";
				salida += "</div>";
				salida += "</div>";
				salida += "<div><p></p></div>";

				//Descripción
				salida += "<div class='col-md-12'>";
				salida += "<div class='col-md-2'>";
				salida += "<p></p>";
				salida += "Descripción:";
				salida += "</div>";
				salida += "<div class='col-md-10'>";
				salida += "<p></p>";
				salida += "<textarea rows='4' cols='50' maxlength='180' class='form-control' id='descr' name='descr' placeholder='Descripción'/>";
				salida += "</div>";
				salida += "</div>";

				salida += "<div class='col-md-12'>";
				salida += "<div class='col-md-2'>";
				salida += "<p></p>";
				salida += "<p>Entregado: </p>";
				salida += "</div>";
				salida += "<div class='col-md-4'>";
				salida += "<p></p>";
				salida += "<input type='checkbox'  id='entr' name='entr' value='Entregado'/>";
				salida += "</div>";
				salida += "<div class='col-md-2'>";
				salida += "<p></p>";
				salida += "<p>Estado Almacen: </p>";
				salida += "</div>";
				salida += "<div class='col-md-4'>";
						salida += "<p></p>";
				salida += "<select class='form-control'>";
						//Les dejo los valores 1, 2 y 3 que son los que van a llevar cada uno en la base de datos
						//esta variable en la tabla subpedido sería tipoEncargo
		  	salida += "<option id='1EstadoAlmacen'>Sin realizar</option>";
				salida += "<option id='2EstadoAlmacen'>En pronceso</option>";
				salida += "<option id='3EstadoAlmacen'>Realizado</option>";
				salida += "</select>";
				salida += "</div>";
				salida += "</div>";

				salida += "<div class='col-md-12'>";
				salida += "<p></p>";
				salida += "<div class='col-md-12' align='right'>";
				salida += "<a href='#' id='modPedido' type='submit' name='modPedido' class='btn btn-success'>Modificar</a>";
				salida += "<a href='#' id='elimPedido' type='submit' name='elimPedido' class='btn'>Eliminar</a>";
				salida += "</div>";
				salida += "</div>";



		$("#main").html(salida);
	});

//Mostrar Stock
	$("#verStock").on("click", function() {

		var request = $.ajax({
			url : "../controller/ArticulosController.php",
			method : "POST",
			data : "mostrarStock",
			dataType : "json"
		});


                request.done(function(result) {
				var diferencia = 0;
				var salida = "";
				salida += "<br/>";
				salida += "<div class='col-md-12'><label>Stock por artículo:</label></div>";
				salida += "<table class='table table-striped'>";
				salida += "<thead><tr><th>Nombre Artículo</th><th>Atributo</th><th>Stock en Almacen</th><th>Stock en Pedidos</th><th>Diferencia</th></tr></thead>";
				salida += "<tbody>";
                                salida += "<tr>";
				$.each(result, function() {
					salida += "<tr>";
					salida += "<th scope='row'>"+ this.nombre +"</th>";
                                        salida += "<td align='left'>"+ this.abreviatura +"</td>";
					salida += "<td align='center'>"+ this.stock +"</td>";
					if (this.sumaStock == null) {
						salida += "<td align='center'><span>0</span></td>";
						diferencia = this.stock;
					} else {
						salida += "<td align='center'>"+ this.sumaStock +"</td>";
						diferencia = this.stock - this.sumaStock;
					};
					salida += "<td align='center'>"+ diferencia +"</td>";
					salida += "</tr>";
				});
				salida += "</tbody>";
				salida += "</table>";
                                $("#main").html(salida);
		});
		
	});

	$("#nuevoPedido").on("click", function() {
		$("#main").load("nuevoPedido.html");
	});

	//JavaScript para mostrar y levantar la ventana modal con la búsqueda de clientes
	$("#main").on("click", "#busqCliente", function() {
		var pulsar = document.getElementById("1_apellido").value;
		if (pulsar != '') {
			$(this).addClass("activo");
			$("#selClienteBus").modal("show");

			var request = $.ajax({
				url : "../controller/ClientesController.php",
				method : "POST",
				data : "listarBus",
				dataType : "json"
			});

			request.done(function(result) {
				//alert(result);

				var salida = "";
				salida += "<br/>";
				salida += "<div class='modal-dialog'>";
				salida += "<div class='modal-content'>";
				salida += "<div class='modal-header'><button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>";
				salida += "<h3 class='h3Modal'>Búsqueda Clientes</h3></div>";

				salida += "<div class='modal-body'>";
				salida += "<table class='table table-striped textoModal'>";
				salida += "<thead><tr><th>Apellidos</th><th>Nombre</th><th>Teléfono</th></tr></thead>";
				salida += "<tbody>";
				$.each(result, function() {
					salida += "<tr>";
					salida += "<td>" + this.apellido_1 + " " + this.apellido_2 + "</td>";
					salida += "<td>" + this.nombre + "</td>";
					if (this.telefono == null) {
						salida += "<td> - </td>";
					} else {
						salida += "<td>" + this.telefono + "</td>";
					}
					salida += "</tr>";
				});
				salida += "<tr>";
				salida += "</table>";
				salida += "</div>";

				salida += "<div class='modal-footer'>";
				salida += "<a href='#nuevoPedido' data-dismiss='modal' class='btn btn-success'>Seleccionar</a><a href='#' data-dismiss='modal' class='btn'>Cerrar</a>";
				salida += "</div>";
				salida += "</div>";

				$("#selClienteBus").html(salida);
			});

		} else {
			//mostrar bien el mensaje de error
			alert('Debe de rellenar el campo "Primer Apellido"');
		}
	});

	$("#main").on("click", "#pedNuevoCli", function() {
		$(this).addClass("activo");
		$("#nuevoCliente").modal("show");
	});

});
