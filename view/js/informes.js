$(document).ready(function() {
	$("#imprInforme").on("click", function() {
		//recogemos el formulario insertado
		opcion = $('input:radio[name=informes]:checked').val();


		if (opcion == 'infClientes'){
			$(location).attr('href','../informes/listado_clientes.php');
		}else if (opcion == 'infAriculos'){
			$(location).attr('href','../informes/listado_articulos.php');
		}else if (opcion == 'infCentros'){
				bootbox.confirm('<p>Elija una fecha</p><input type="date" class="form-control" id="busFecInforme" name="busFecInforme"/>', function(result) {
					if(result){
					/*	var request = $.ajax({
							url : "../informes/centros.php",
							method : "POST",
							dataType : "json",
							data : {
								accion : "infCentros",
								fechaReserva : busFecInforme
							}
						});*/
							$(location).attr('href','../informes/centros.php');
					}
				});

		}else if (opcion == 'infRamos'){
			bootbox.confirm('<p>Elija una fecha</p><input type="date" class="form-control" id="busFecInforme" name="busFecInforme"/>', function(result) {
				if(result){
					/*	var request = $.ajax({
							url : "../informes/ramos.php",
							method : "POST",
							dataType : "json",
							data : {
								accion : "infRamos",
								fechaReserva : busFecInforme
							}
						});*/
						$(location).attr('href','../informes/ramos.php');
				}
			});
		}else if (opcion == 'infPedidos'){
			//$(location).attr('href','../informes/floresSueltas.php');
			window.open('../informes/floresSueltas.php','_blank');
		}else if (opcion == 'infStock'){
			$(location).attr('href','../informes/stock.php');
		}else{
			notif({
				msg : "Error en la selección de informes.",
				type : "error",
				position : "center"
			});
		};



	});

});
