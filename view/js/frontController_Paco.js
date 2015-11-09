$(document).ready(function() {

	$("#clientes").on("click", function() {

        var request = $.ajax({
		  url: "../controller/ClientesController.php",
		  method: "POST",
		  data: "listar",
		  dataType: "json"
		});

        request.done(function( result ){
        	//alert(result);

        	var salida = "";
					salida += "<br/>";
					salida += "<div class='col-md-12'><label>Clientes</label></div>";
        	salida += "<table class='table table-striped'>";
        	salida += "<thead><tr><th>Apellidos</th><th>Nombre</th><th>Teléfono</th></tr></thead>";
            salida += "<tbody>";
            $.each(result, function() {
			    salida += "<tr>";
			    salida += "<td>"+this.apellido_1+" "+this.apellido_2+"</td>";
			    salida += "<td>"+this.nombre+"</td>";
			    if(this.telefono == null){
			    	salida += "<td> - </td>";
			    	}else{
			    		salida += "<td>"+this.telefono+"</td>";
			    	}
			    salida += "</tr>";
			});
        	salida += "<tr>";
        	salida += "</table>";
        	$("#main").html(salida);
    	});

    	request.fail(function( jqXHR, textStatus, errorThrown ) {

    		$('#main').html('<h2>Error !!!!: ' + jqXHR.statusText +'</h2>'+errorThrown);
			alert(jqXHR.responseText);

    	});
	});

	$("#articulos").on("click", function() {

        var request = $.ajax({
		  url: "../controller/ArticulosController.php",
		  method: "POST",
		  data: "listar",
		  dataType: "json"
		});
        request.done(function( result ){
        	//alert(result);

        	var salida = "";
					salida += "<br/>";
					salida += "<div class='col-md-12'><label>Artículos</label></div>";
        	salida += "<table class='table table-striped'>";
        	salida += "<thead><tr><th>#</th><th>Nombre</th><th>Precio</th><th>Stock</th></tr></thead>";
            salida += "<tbody>";
            $.each(result, function() {
			    salida += "<tr>";
			    salida += "<th scope='row'>"+this.idArticulo+"</th>";
			    salida += "<td>"+this.nombre+"</td>";
			    salida += "<td>"+this.precio+"€</td>";
			    salida += "<td>"+this.stock+"</td>";
			    salida += "</tr>";
			});
        	salida += "<tr>";
        	salida += "</table>";
        	$("#main").html(salida);
    	});

    	request.fail(function( jqXHR, textStatus, errorThrown ) {

    		$('#main').html('<h2>Error !!!!: ' + jqXHR.statusText +'</h2>'+errorThrown);
			alert(jqXHR.responseText);

    	});
	});

	$("#inicio").on("click", function() {

  		var salida = "";

			$("#main").html(salida);
	});

	$("#busPedidos").on("click", function() {

  		var salida = "";
			salida += "<br/>";
			salida += "<div class='col-md-12'><label>Búsqueda de pedidos:</label></div>";

			$("#main").html(salida);
	});

	$("#verStock").on("click", function() {

			var salida = "";
			salida += "<br/>";
			salida += "<div class='col-md-12'><label>Stock por artículo:</label></div>";
			salida += "<table class='table table-striped'>";
			salida += "<thead><tr><th>Nombre Artículo</th><th>Stock en Almacen</th><th>Stock en Pedidos</th><th>Diferencia</th></tr></thead>";
			salida += "<tbody>";
			salida += "<tr>";
			salida += "<th scope='row'>Articulo 1</th>";
			salida += "<td align='center'>4</td>";
			salida += "<td align='center'>3</td>";
			salida += "<td align='center'>1</td>";
			salida += "</tr>";
			salida += "</table>";

			$("#main").html(salida);
	});

	$("#nuevoPedido").on("click", function() {

  		var salida = "";
			salida += "<br/>";
			salida += "<div class='col-md-12'><label>Nuevo pedido:</label></div><br/><br/>";

//Cliente
			salida += "<div class='col-md-2'>";
			salida += "<p>Cliente: </p>";
			salida += "</div>";
			// Despegable cliente
			salida += "<div class='col-md-10'>";
			salida += "<div class='panel-group' id='selCliPedido'>";
			salida += "<div class='panel panel-default'>";
			salida += "<div class='panel-heading'>";
			salida += "<h4 class='panel-title'>";
			salida += "<a href='#' id='pedNuevoCli'>";
			salida += "Nuevo Cliente";
			salida += "</a></h4></div>";
			salida += "<div id='pedNuevoCli' class='panel-collapse collapse'>";
			salida += "<div class='panel-body'>";
			salida += "Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.";
			salida += "</div></div></div>";
			salida += "<div class='panel panel-default'>";
			salida += "<div class='panel-heading'>";
			salida += "<h4 class='panel-title'>";
			salida += "<a data-toggle='collapse' data-parent='#selCliPedido' href='#pedSelCli'>";
			salida += "Selecciona Cliente";
			salida += "</a></h4></div>";
			salida += "<div id='pedSelCli' class='panel-collapse collapse'>";
			salida += "<div class='panel-body'>";
			salida += "<p>Búsqueda de Cliente</p>";
			salida += "<form class='form form-signup' role='form' method='post' action='#'>";
			salida += "<input type='text' class='form-control' name='nombreCl' id='nombreCl' placeholder='Nombre' required/> <br/> ";
			salida += "<input type='text' class='form-control' name='1_apellido' id='1_apellido' placeholder='Primer Apellido' required/> <br/> ";
			salida += "<input id='busqCliente' type='submit' name='submitBusCl' value='Buscar'  class='btn btn-success'>";
			salida += "</form>";
			salida += "</div></div></div>";
			salida += "</div>";
			salida += "</div>";

			$("#main").html(salida);
	});
	
	$("#main").on("click","#pedNuevoCli",function(){
		$(this).addClass("activo");
		$("#nuevoCliente").modal("show");
	});


});
