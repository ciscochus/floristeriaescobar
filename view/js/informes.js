$(document).ready(function() {
	$("#imprInforme").on("click", function() {
		//recogemos el formulario insertado
		opcion = $('input:radio[name=informes]:checked').val();


		if (opcion == 'infClientes'){
			window.open('../informes/listado_clientes.php', '_blank');
		}else if (opcion == 'infAriculos'){
			window.open('../informes/listado_articulos.php', '_blank');
		}else if (opcion == 'infCentros'){
				bootbox.confirm('<p>Elija una fecha</p><input type="date" class="form-control" id="busFecInforme" name="busFecInforme"/>', function(result) {
					if(result){
                                            window.open('../informes/centros.php',' _blank');
					}
				});

		}else if (opcion == 'infRamos'){
			bootbox.confirm('<p>Elija una fecha</p><input type="date" class="form-control" id="busFecInforme" name="busFecInforme"/>', function(result) {
				if(result){
                                    window.open('../informes/ramos.php', '_blank');
				}
			});
		}else if (opcion == 'infPedidos'){
                    window.open('../informes/floresSueltas.php', '_blank');
                    //$(location).attr('href','../informes/floresSueltas.php');
		}else if (opcion == 'infStock'){
			window.open('../informes/stock.php', '_blank');
		}else{
			notif({
				msg : "Error en la selección de informes.",
				type : "error",
				position : "center"
			});
		};



	});

});
