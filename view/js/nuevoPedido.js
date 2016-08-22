var info = new Array();

$(document).ready(function(){


	$(document).on("input",'#buscarCliente #cliente',function(){
		$("#buscarCliente #resultados").html("");
		if($("#clienteSeleccionado").hasClass("hidden")==false){
			$("#clienteSeleccionado").addClass("hidden");
			$("#info .cliente .seleccionado").html("false");
			$("#info .cliente .id").html("");
			$("#info .pedido .seleccionado").html("false");
			$("#info .pedido .id").html("");
			$("#tipo").prop('selectedIndex',0).change();
			info = new Array();
		}
		if($("#panel-pedido").hasClass("hidden")==false)
				$("#panel-pedido").addClass("hidden");
		if($("#botonera").hasClass("hidden")==false)
				$("#botonera").addClass("hidden");
		if($(this).val().length < 3)
			return false;
			
		$.ajax({
          url: "autocompletar.php",
          type: "POST",
          dataType: "json",
          data: {
          	findBy:"cliente",
            q: $(this).val()
          },
          success: function( data ) {
          	if(data.res=="full"){
          		$("#buscarCliente #resultados").show();
				$salida = "<ul>";
				$.each(data.data, function() {
					$salida+="<li class='"+this.idCliente+"'>";
						$salida+="<span class='nombre'>"+this.nombre+"</span> ";
						$salida+="<span class='apellido_1'>"+this.apellido_1+"</span> ";
						$salida+="<span class='apellido_2'>"+this.apellido_2+"</span>";
						$salida+="<span class='id hidden'>"+this.idCliente+"</span>";
						$salida+="<span class='telefono hidden'>"+this.telefono+"</span>";
					$salida+="</li>";
				});
				$salida += "</ul>";
				$("#buscarCliente #resultados").html($salida);
          	}
          	else{
          		$("#buscarCliente #resultados").html('<span class="error">No se han encontrado clientes con el nombre o apellidos introducido.</span>');
          	}
            
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) { 
	        console.log("ERROR: "+XMLHttpRequest.responseText); 
	    }  
        });
		
	});
	
	$(document).on("click",'#buscarCliente #resultados li',function(){
		var id= $(this).find(".id").html();
		var nombre= $(this).find(".nombre").html();
		var apellido_1= $(this).find(".apellido_1").html();
		var apellido_2= $(this).find(".apellido_2").html();
		var telefono= $(this).find(".telefono").html();
		
		seleccionarCliente(id, nombre, apellido_1, apellido_2, telefono);
		
	});
	
	
	
	$(document).on("input",'#busqueda-articulo #nomArtic',function(){
		$.ajax({
          url: "autocompletar.php",
          type: "POST",
          dataType: "json",
          data: {
          	findBy:"articulo",
            q: $(this).val()
          },
          success: function( data ) {
          	if(data.res=="full"){
          		$("#busqueda-articulo #articulos-resultados").show();
				$salida = "<ul>";
				$.each(data.data, function() {
					$salida+="<li class='"+this.idArticulo+"'>";
						$salida+="<span class='nombre'>"+this.nombre+"</span> ";
						$salida+="(<span class='abreviatura'>"+this.abreviatura+"</span>)";
						$salida+="<span class='precio hidden'>"+this.precio+"</span>";
						$salida+="<span class='id hidden'>"+this.idArticulo+"</span>";
						$salida+="<span class='stock hidden'>"+this.stock+"</span>";
					$salida+="</li>";
				});
				$salida += "</ul>";
				$("#busqueda-articulo #articulos-resultados").html($salida);
          	}
          	else{
          		$("#busqueda-articulo #articulos-resultados").html('<span class="error">No se han encontrado articulos con el nombre o abreviatura introducido.</span>');
          	}
            
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) { 
	        console.log("ERROR: "+XMLHttpRequest.responseText); 
	    }  
        });
	});
	
	$(document).on("click",'#busqueda-articulo #articulos-resultados li',function(){

		var articulo = new Array();
		articulo["idArticulo"] = $(this).find(".id").html();
		articulo["nombre"] = $(this).find(".nombre").html();
		articulo["abreviatura"] = $(this).find(".abreviatura").html();
		articulo["precio"] = $(this).find(".precio").html();
		articulo["stock"] = $(this).find(".stock").html();
		$("#busqueda-articulo #articulos-resultados").html("");
		$("#busqueda-articulo #nomArtic").val("");
		if(estaIncluido(articulo)==true){
 			alert("El articulo seleccionado ya se encuentra en la lista");
	 	}
	 	else{
			addArticulo(articulo);
		}
		
	});
	
	
	// $(document).on("click",function(){
		// alert("subnormal");
		// if($(this).attr("id") != "buscarCliente" || $(this).attr("id") != "busqueda-articulo"){
			// $("#buscarCliente #resultados").html("");
			// $("#busqueda-articulo #articulos-resultados").html("");
		// }
// 			
	// });
	
	$(document).on("change",'#tipoPedido #tipo',function(){
		resetEntrega();
		if($("#panel-entrega").hasClass("hidden")==false)
			$("#panel-entrega").addClass("hidden");
		$("#lista-articulos table tbody").html("");
		$("#listado-subpedidos").html("");
		delete info["subpedido"];
		if($("#nuevoSubPedido").hasClass("hidden")==false)
			$("#nuevoSubPedido").addClass("hidden");
		var seleccionado = $("#tipoPedido #tipo option:selected");
		var texto = $(seleccionado).val();
		var id = $(seleccionado).attr("id");
		if(id==0){
			$("#tipoPedido #seleccionado").html("");
			if($("#busqueda-articulo").hasClass("hidden")==false)
				$("#busqueda-articulo").addClass("hidden");
			if($("#lista-articulos").hasClass("hidden")==false)
				$("#lista-articulos").addClass("hidden");
				delete info["tipo"];
				
		}
		else{
			var idPedido = $("#info .pedido .id").html();
			obtenerSubpedido(idPedido,id);
			if(id==1){
				$("#busqueda-articulo").removeClass("hidden");
				$("#lista-articulos").removeClass("hidden");
			}
			else{

				if(info.hasOwnProperty("subpedido")!=true){
					$("#busqueda-articulo").removeClass("hidden");
					$("#lista-articulos").removeClass("hidden");
					$("#panel-entrega").removeClass("hidden");
				}
				else{
					if($("#busqueda-articulo").hasClass("hidden")==false)
						$("#busqueda-articulo").addClass("hidden");
					if($("#lista-articulos").hasClass("hidden")==false)
						$("#lista-articulos").addClass("hidden");
					if($("#panel-entrega").hasClass("hidden")==false)
						$("#panel-entrega").addClass("hidden");
				}
				
			}
			
			info["tipo"] = id;
		}
		if($("#botonera").hasClass("hidden")==false)
				$("#botonera").addClass("hidden");
	});
	
	$(document).on("click",".elimArticulo",function(event){
		event.preventDefault();
		$(this).parents("tr").remove();
	});
	
	$(document).on("keyup paste","#tablaArticulos .articulo .cantidad",function(){
		$(this).attr("value",$(this).val());
	});
	$(document).on("change","#tablaArticulos .articulo .cantidad",function(){
		if($(this).val()>1){
			if($("#botonera").hasClass("hidden")!=false)
				$("#botonera").removeClass("hidden");
		}
		else{
			if($("#tablaArticulos .articulo .cantidad").length == $("#tablaArticulos .articulo .cantidad[value='0']").length){
				if($("#botonera").hasClass("hidden")==false)
					$("#botonera").addClass("hidden");
			}
		}
	});
	
	$(document).on("click","#botonera #guardarPedido",function(){
		guardarPedido();
	});
	
	// --- Editar un pedido
	$(document).on("click","#listado-subpedidos a",function(){
		var idSubPedido = $(this).attr("id").split("-")[1];
		editarSubPedido(idSubPedido);
	});
	// --- Fin Editar un pedido
	$(document).on("click","a#nuevoSubPedido",function(){
		delete info["subpedido"];
		$("#lista-articulos").removeClass("hidden");
		$("#busqueda-articulo").removeClass("hidden");
		$("#panel-entrega").removeClass("hidden");
	});
 });
 
 
 
 function obtenerPedido(idCliente){
 	var accion = "obtener";
 	var idCliente = $("#info .cliente .id").html();
 	
 	$.ajax({
          url: "../controller/PedidosController.php",
          type: "POST",
          dataType: "json",
          data: {
          	accion:"obtener",
            idCliente: idCliente
          },
          success: function( data ) {
          	if(data.mensaje=="true"){
          		$("#info .pedido .seleccionado").html("true");
          		$("#info .pedido .id").html(data.idPedido);
          		info["pedido"] = data.idPedido;
          	}
            
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) { 
	        console.log("ERROR: "+XMLHttpRequest.responseText); 
	    }  
        });
 	return false;
 }
 
 function obtenerSubpedido(idPedido, tipo){
 	var accion = "obtener";
 	 	
 	$.ajax({
          url: "../controller/SubPedidosController.php",
          type: "POST",
          dataType: "json",
          data: {
          	accion:"obtener",
            idPedido: idPedido,
            tipo: tipo
          },
          success: function( data ) {
          	if(data.mensaje=="true"){
          		if(tipo == 1){
          			$.each(data.subpedidos, function() {
						obtenerArticulosSubpedido(this.idSubPedido);
						info["subpedido"] = this.idSubPedido;
					});
          		}
          		else{
          			$.each(data.subpedidos, function() {
						info["subpedido"] = this.idSubPedido;
						mostrarSubpedidos(this);
					});
          		}
          		
          	}
          	else{
          		delete info["subpedido"];
          	}
            
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) { 
	        console.log("ERROR: "+XMLHttpRequest.responseText); 
	    }  
        });
 	return false;
 }
 
 function obtenerArticulosSubpedido(idSubPedido,lugar){
 	var accion = "obtener";
 	var id = idSubPedido;
 	$.ajax({
          url: "../controller/CompraArticulosController.php",
          type: "POST",
          dataType: "json",
          data: {
          	accion:"obtener",
            idSubPedido: id
          },
          success: function( data ) {
          	if(data.mensaje=="true"){
          		$.each(data.articulos, function() {
          			if(lugar == "lista"){
          				addArticuloLista(this,idSubPedido);
          			}
          			else{
          				addArticulo(this);
          			}
						
				});
          	}
          	else{
          		alert("no hay articulos");
          	}
            
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) { 
	        console.log("ERROR: "+XMLHttpRequest.responseText); 
	    }  
        });
 	return false;
 }
 
 function addArticulo(articulo){
		if($("#botonera").hasClass("hidden"))
			$("#botonera").removeClass("hidden");
 		var salida = "<tr id='"+articulo.idArticulo+"' class='articulo'>";
 		
	 	salida += "<td>"+articulo.nombre+"</td>";
	 	if((typeof(articulo.cantidadArticulo) == "undefined")|| (articulo.cantidadArticulo == "")){
	 		salida += "<td><input type='text' name'cantidad' class='cantidad' value='1'></td>";
	 	}
	 	else{
	 		salida += "<td><input type='text' name'cantidad' class='cantidad' value='"+articulo.cantidadArticulo+"'></td>";
	 	}
	 	
		salida += "<td width='25'><a class='elimArticulo' name='elimArticulo' class='btn'>Eliminar</a></td>";
		salida += "</tr>";
		
		$("#lista-articulos tbody").append(salida);
 }
 
 /* comprueba si el articulo pasado ya se encuentra en la tabla de articulos devuelve true o false
 */
 function estaIncluido(articulo){
 	if(typeof($("#lista-articulos tr#"+articulo.idArticulo).html()) == "undefined")
 		return false;
 	else
 		return true;
 }

function getInfo(){
	console.log(info);
}


/* Crear pedido */
function nuevoPedido(idCliente){
	var idPedido = null;
	$.ajax({
		  async: false,
          url: "../controller/PedidosController.php",
          type: "POST",
          dataType: "json",
          data: {
          	accion:"crear",
            idCliente: idCliente
          },
          success: function( data ) {
          	if(data.mensaje=="true"){
          		idPedido = data.idPedido;
          	}            
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) { 
	        console.log("ERROR: "+XMLHttpRequest.responseText); 
	    }  
        });
 	return idPedido;
}
/* Fin Crear pedido */

/* Crear subpedido */
function nuevoSubPedido(){
	//recogemos todos los valores de subpedido
	var idSubPedido = "";
	
    console.log("Creando subpedido de tipo: "+info["tipo"]);
	
	$.ajax({
		  async: false,
          url: "../controller/SubPedidosController.php",
          type: "POST",
          dataType: "json",
          data: {
      			accion: "crear",
      			idPedido: info["pedido"],
      			tipoEncargo: info["tipo"]
          },
          success: function( data ) {
          	if(data.mensaje=="true"){
          		idSubPedido = data.idSubPedido;
          	}            
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) { 
	        console.log("ERROR: "+XMLHttpRequest.responseText); 
	    }  
        });
 	return idSubPedido;
}
/* Fin Crear subpedido */

/* Añadir articulos al pedido */
function insertarArticulosPedido(idSubPedido){
	var articulos = [];
	//recogemos los articulos de la tabla
	
	$.each($("#lista-articulos tr.articulo"), function(index, item){
		id = $(this).attr("id");
		cantidad = $(this).find(".cantidad").val();
		
		articulo = new Object();
		articulo.idArticulo = id;
		articulo.cantidadArticulo = cantidad;
		articulos.push(articulo);
	});

	console.log(articulos);	
	$.ajax({
          url: "../controller/CompraArticulosController.php",
          type: "POST",
          dataType: "json",
          data: {
          	accion:"crear",
          	idSubPedido: idSubPedido,
            articulos: JSON.stringify(articulos)
          },
          success: function( data ) {
          	if(data.mensaje=="true"){
          		notif({
						msg : "El pedido se ha guardado correctamente.",
						type : "success",
						position : "center"
					});
          	}
          	else{
          		console.log("error al añadir articulos");
          	}            
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) { 
	        console.log('Error al ejecutar la petición'); 
	    }  
        });
}
/* Fin Añadir articulos al pedido */

/* Guardar pedido */
function guardarPedido(){
	//comprobamos que tenemos todos los datos
	if(info.hasOwnProperty("cliente")==false){
		alert("No ha seleccionado ningun cliente");
		return false;
	}
	if(info.hasOwnProperty("pedido")==false){
		info["pedido"] = nuevoPedido(info["cliente"]);
	}
	if(info.hasOwnProperty("tipo")==false){
		alert("No ha seleccionado ningun tipo de pedido");
		return false;
	}
	
	if(info.hasOwnProperty("subpedido")==false){
		info["subpedido"] = nuevoSubPedido();
	}
	console.log("Añadiendo articulos........ ");
	console.log("Subpedido: "+info["subpedido"]);
	console.log("Tipo: "+info["tipo"]);
	if(info["subpedido"]!=""){
		
		if(info["tipo"]!=1){
			editarEntrega(info["subpedido"]);
		}
		insertarArticulosPedido(info["subpedido"]);
	}
		
	
}
/* Fin Guardar pedido */

/* Cargar multiples subpedidos */
//para los pedidos de tipo 2 y 3 que pueden tener varios subpedidos
function mostrarSubpedidos(subpedido){
	if(subpedido.diaEntrega == null){
		var fechaEntrega = "Fecha de entrega no especificada";
	}
	else{
		var fechaEntrega = subpedido.diaEntrega;
	}
	var salida = "<div id='subpedido-"+subpedido.idSubPedido+"' class='panel-heading'>";
		salida +="<h2 class='verde panel-title'>"+fechaEntrega+" - "+subpedido.numOrden+" <a href='#' id='edit-"+subpedido.idSubPedido+"'>Editar</a></h2>";
		salida +="<table><thead><tr><th>Articulo</th><th>Cantidad</th></tr></thead><tbody></tbody></table>";
		salida +="</div>";
		
	$("#listado-subpedidos").append(salida);
	
	if($("#busqueda-articulo").hasClass("hidden")==false)
		$("#busqueda-articulo").addClass("hidden");
	if($("#lista-articulos").hasClass("hidden")==false)
		$("#lista-articulos").addClass("hidden");
	if($("#panel-entrega").hasClass("hidden")==false)
			$("#panel-entrega").addClass("hidden");
	obtenerArticulosSubpedido(subpedido.idSubPedido, "lista");
	$("#nuevoSubPedido").removeClass("hidden");
}
/* Fin Cargar multiples subpedidos */


function addArticuloLista(articulo,idSubPedido){
 		var salida = "<tr id='"+articulo.idArticulo+"' class='articulo'>";
 		
	 	salida += "<td>"+articulo.nombre+"</td>";
	 	if((typeof(articulo.cantidadArticulo) == "undefined")|| (articulo.cantidadArticulo == "")){
	 		salida += "<td>0</td>";
	 	}
	 	else{
	 		salida += "<td>"+articulo.cantidadArticulo+"</td>";
	 	}
	 	
		salida += "</tr>";
		
		$("#listado-subpedidos #subpedido-"+idSubPedido+" tbody").append(salida);
 }


function editarSubPedido(idSubpedido){
	resetListaArticulos();
	$("#busqueda-articulo").removeClass("hidden");
	$("#lista-articulos").removeClass("hidden");
	$("#panel-entrega").removeClass("hidden");
	obtenerArticulosSubpedido(idSubpedido);
	loadEntrega(idSubpedido);
	info["subpedido"] = idSubpedido;
}

function editarEntrega(idSubPedido){
	//recogemos todos los valores de subpedido
	var numOrden = $("#ordLlegada").val();
	var diaEntrega = $("#fecEntrega").val();
	var tiesto = "";
	var descripcion = $("#descr").val();
	var estadoAlmacen = $(".estadoAlmacen :selected").attr("id");
	
	if($("#tiesto").prop("checked")){
		var tiesto = "1";
	}
	
	
	$.ajax({
          url: "../controller/SubPedidosController.php",
          type: "POST",
          dataType: "json",
          data: {
      			accion: "crear",
      			idSubPedido: idSubPedido,
      			numOrden: numOrden,
      			diaEntrega: diaEntrega,
      			tiesto: tiesto,
      			descripcion: descripcion,
      			estadoAlmacen: estadoAlmacen
          },
          success: function( data ) {
          	if(data.mensaje=="true"){
          	}            
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) { 
	        console.log("ERROR: "+XMLHttpRequest.responseText); 
	    }  
        });
}

function resetEntrega(){
	$('#fecEntrega').val('');
	$('#ordLlegada').val('');
	$('.estadoAlmacen select').prop('selectedIndex',0);
	$('#tiesto').prop('checked',false);
	$("#descr").val('');
}

function resetListaArticulos(){
	$("#tablaArticulos tbody tr").remove();
}

function loadEntrega(idSubpedido){
 	 	
 	$.ajax({
          url: "../controller/SubPedidosController.php",
          type: "POST",
          dataType: "json",
          data: {
          	accion:"getSubpedido",
            idSubPedido: idSubpedido,
          },
          success: function( data ) {
          	if(data.mensaje=="true"){
          		subpedido = data.subpedidos[0];
          		$("#ordLlegada").val(subpedido.numOrden);
          		$("#fecEntrega").val(subpedido.diaEntrega);
          		$("#descr").val(subpedido.descripcion);
          		$(".estadoAlmacen select").prop("selectedIndex", (subpedido.estadoAlmacen-1));
          		if(subpedido.tiesto == 1){
          			$("#tiesto").prop("checked", true);
          		}
          		else{
          			$("#tiesto").prop("checked", false);
          		}
          	}
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) { 
	        console.log("ERROR: "+XMLHttpRequest.responseText); 
	    }  
        });
 	return false;
}

function seleccionarCliente(id, nombre, apellido_1, apellido_2, telefono){
		
		
		$("#clienteSeleccionado").addClass("hidden");
		$("#info .cliente .seleccionado").html("false");
		$("#info .cliente .id").html("");
		$("#info .pedido .seleccionado").html("false");
		$("#info .pedido .id").html("");
		$("#tipo").prop('selectedIndex',0).change();
		info = new Array();
		
		$("#buscarCliente #resultados").html("");
			
		$salida = "<h4>Cliente seleccionado</h4>";
		$salida += "<ul>";
		$salida += "<li>";
			$salida+="<span class='nombre'>"+nombre+"</span> ";
			$salida+="<span class='apellido_1'>"+apellido_1+"</span> ";
			$salida+="<span class='apellido_2'>"+apellido_2+"</span>";
			$salida+="<span class='id hidden'>"+id+"</span> ";
		$salida += "</li>";
		if(telefono!="null" && telefono!=""){
			$salida += "<li>";
				$salida+="<span class='telefono'>"+telefono+"</span> ";
			$salida += "</li>";
		}
		$salida += "</ul>";
		
		$("#buscarCliente #cliente").val("");
		$("#clienteSeleccionado").html($salida);
		$("#clienteSeleccionado").removeClass("hidden");
		$("#buscarCliente #resultados").html("");
		$("#info .cliente .seleccionado").html("true");
		$("#info .cliente .id").html(id);
		$("#panel-pedido").removeClass("hidden");
		$("#lista-articulos tbody").html("");
		info["cliente"] = id;
		obtenerPedido(id);
	}




