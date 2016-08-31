<?php
    require '../core/Security.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Gestión "Santos" Flores Escobar</title>

    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Hind' rel='stylesheet' type='text/css'>
    <!-- Bootstrap -->
    <link href="style.css" rel="stylesheet">
    <!-- notifIt -->
    <script type="text/javascript" src="js/notifIt.js"></script>
    <link rel="stylesheet" type="text/css" href="css/notifIt.css">
    <!-- font-awesome -->
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <!-- custom -->
    <link rel="stylesheet" type="text/css" href="css/custom.css" />
    
    <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


<style  type="text/css">
    .aCubo {color:#fff;}
    .h3Modal {color:#245D92; }
    .textoModal {color:#000;}
</style>

  </head>
  <body>


  <div id="header" class="col-md-12 text-center">
      <i class="fa fa-cube fa-2x"></i>
      <h4>Gestión "Santos" Flores Escobar</h4>
  </div>

  <div class="container">
    <div class="col-md-12">
      <div class="well">

      <!-- menu -->
      <div id="menu" class="col-md-12">
        <!-- navbar -->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">

        <!--Comprobar porque no coge la variable de sesión-->
        <li class="dropdown"><a href="#">Usuario:
          <?php
            echo $_SESSION['usuario'];
          ?>
        </a></li>

        <li class="dropdown"><a href="#">Fecha:
            <?php
            // Establecer la zona horaria predeterminada a usar. Disponible desde PHP 5.1
            date_default_timezone_set('UTC');
            //Imprimimos la fecha actual dandole un formato
            echo date("d / m / Y");
        ?></a></li>

        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Configuración<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <li><a data-toggle="modal" href="#cambiosPass">Cambiar contraseña</a></li>
                <li class="divider"></li>
                <li><a data-toggle="modal" href="#newUser">Nuevo usuario</a></li>
                <li class="divider"></li>
                <li><a href="logout.php">Cerrar Sesión</a></li>
            </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
        <!-- navbar -->
      </div>
      <!-- menu -->

      <!-- content -->
      <div id="sidebar" class="col-md-3">
         <!-- panels -->
          <div class="panel panel-default">
            <div class="panel-heading"><i class="fa fa-link"></i> Enlaces importantes</div>
            <div class="panel-body panel-links">
              <!-- links -->
               <a id="inicio" href="#"><i class="fa fa-code"></i> Inicio</a>
               <a id="clientes" href="#nothing"><i class="fa fa-code"></i> Clientes</a>
               <a id="articulos" href="#nothing"<i class="fa fa-code"></i> Articulos</a>
               <a id="busPedidos" href="#"><i class="fa fa-code"></i> Buscar Pedido</a>
               <a id="verStock" href="#"><i class="fa fa-code"></i> Ver Stock</a>
              <!-- links -->
            </div>
          </div>

      </div>
      <!-- content -->
      <!-- right bar -->
      <div id="admincontent" class="col-md-9">
        <div class="col-md-12"><label>Acceso rápido</label></div>
        <!-- stats -->
        <div class="col-md-3 stats-cubes stats-cubes-green">
          <i class="fa fa-cubes"></i>
          <a class="aCubo" data-toggle="modal" href="#" id="nuevoPedido"><p>Nuevo Pedido</p></a>
        </div>

        <div class="col-md-3 stats-cubes stats-cubes-blue">
          <i class="fa fa-history"></i>
          <a class="aCubo" data-toggle="modal" href="#nuevoCliente"><p>Nuevo Cliente</p></a>
        </div>

        <div class="col-md-3 stats-cubes stats-cubes-purple">
          <i class="fa fa-spinner"></i>
          <a class="aCubo" data-toggle="modal" href="#nuevoArticulo"><p>Nuevo Articulo</p></a>
        </div>

        <div class="col-md-3 stats-cubes stats-cubes-red">
          <i class="fa fa-table"></i>
          <a class="aCubo" data-toggle="modal" href="#informes"><p>Informes</p></a>
        </div>

        <!-- panels -->

        <!-- panels -->

        <!--Parte que se va a mostrar desde el frontController.js-->
         <div id="main" class="col-md-12 negro">


        </div>
      <!-- right bar -->

      </div>
    </div>
  </div>
  <!-- Modal para nuevo usuario -->
  <div id="newUser" class="modal fade" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                 ×
                 </button>
                 <h3>Nuevo Usuario</h3>
                 <p class="textoModal">Inserte un nuevo usuario.</p>
              </div>
                <div class="modal-body">
                    <form id="nuevoUsuario" class="form form-signup" role="form" method="post">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Nombre usuario:</span>
                            <input type="text" class="form-control" name="newNombre" id="newNombre" placeholder="Nombre usuario" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Usuario:</span>
                            <input type="text" class="form-control" name="newUsername" id="newUsername" placeholder="Usuario" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Contraseña: </span>
                            <input type="password" id="newPass" name="newPass" class="form-control" placeholder="Contraseña" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">e-Mail: </span>
                            <input type="email" id="newEmail" name="newEmail" class="form-control" placeholder="e-Mail" required="">
                        </div>
                    </div>
                
                    <div class="modal-footer">
                       <input id="submitLogin" type="submit" name="submitLogin" value="Guardar usuario" class="btn btn-success">
                       <a href="#" data-dismiss="modal" class="btn cerrarModal">Cerrar</a>
                    </div>
                </form></div>
        </div>
    </div>
  </div>
  
  <!-- /Modal para nuevo usuario -->

  <!--Modal para un cambiar la contraseña-->
  <div id="cambiosPass" class="modal fade">
     <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              ×
              </button>
              <h3 class="h3Modal">Cambio contraseña</h3>
           </div>
           <div class="modal-body">
             <form id="changePass" class="form form-signup" role="form" method="post" action="view/cambia.php">
               <div class="form-group">
                   <div class="input-group">
                       <span class="input-group-addon">Antigua contraseña:</span>
                       <input type="text" class="form-control" name="passOld" id="passOld" placeholder="Antigua contraseña" required/>
                   </div>
               </div>
               <div class="form-group">
                   <div class="input-group">
                       <span class="input-group-addon">Nueva contraseña:</span>
                       <input type="password" class="form-control" name="passNew" id="passNew" placeholder="Nueva contraseña" required/>
                   </div>
               </div>
               <div class="form-group">
                   <div class="input-group">
                       <span class="input-group-addon">Repita nueva contraseña:</span>
                       <input type="password" class="form-control" name="passNewRep" id="passNewRep" placeholder="Repita nueva contraseña" required/>
                   </div>
               </div>
           </div>
           <div class="modal-footer">
             <input id="submitPass" type="submit" name="submitPass" value="Cambiar contraseña"  class="btn btn-success">
              <a href="#" data-dismiss="modal" class="btn">Cerrar</a>
           </div>
         </form>
       </div>
     </div>
  </div>

  <!--Modal para un nuevo pedido-->
<!--  <div id="nuevoPedido" class="modal fade">
     <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              ×
              </button>
              <h3 class="h3Modal">Nuevo Pedido</h3>
           </div>
           <div class="modal-body">
              <h4 class="textoModal">Texto de la ventana</h4>
              <p class="textoModal">Mas texto en la ventana.</p>
           </div>
           <div class="modal-footer">
              <a href="#" class="btn btn-success">Guardar</a>
              <a href="#" data-dismiss="modal" class="btn">Cerrar</a>
           </div>
       </div>
     </div>
  </div> -->

  <!--Modal para búsqueda de cliente-->
 <div id="selClienteBus" class="modal fade">
  <!-- <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
            </button>
            <h3 class="h3Modal">Nuevo Pedido</h3>
         </div>
         <div class="modal-body">
            <h4 class="textoModal">Texto de la ventana</h4>
            <p class="textoModal">Mas texto en la ventana.</p>
         </div>
         <div class="modal-footer">
            <input id="prueba" type="submit" name="submitPass" value="Seleccionar"  class="btn btn-success">
            <a href="#" data-dismiss="modal" class="btn">Cerrar</a>
         </div>
     </div>
   </div>-->
  </div>

<!--Modal para un nuevo cliente-->
  <div id="nuevoCliente" class="modal fade">
     <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              ×
              </button>
              <h3 class="h3Modal">Nuevo Cliente</h3>
           </div>
           <div class="modal-body">
             <form id="newCliente" class="form form-signup" role="form" method="post" action="#">
               <div class="form-group">
                   <div class="input-group">
                       <span class="input-group-addon">Nombre:</span>
                       <input type="text" class="form-control" name="nombreCliente" id="nombreCliente" placeholder="Nombre" required/>
                       <input type="hidden" id="accion" />
                   </div>
               </div>
               <div class="form-group">
                   <div class="input-group">
                       <span class="input-group-addon">Primer Apellido:</span>
                       <input type="text" class="form-control" name="1apellido" id="1apellido" placeholder="Primer Apellido" required/>
                   </div>
               </div>
               <div class="form-group">
                   <div class="input-group">
                       <span class="input-group-addon">Segundo Apellido:</span>
                       <input type="text" class="form-control" name="2apellido" id="2apellido" placeholder="Segundo Apellido" required/>
                   </div>
               </div>
               <div class="form-group">
                   <div class="input-group">
                       <span class="input-group-addon">Teléfono:</span>
                       <input type="phone" class="form-control" name="telefono" id="telefono" placeholder="Teléfono"/>
                   </div>
               </div>
           </div>
           <div class="modal-footer">
             <input id="newCliente" type="submit" name="submitPass" value="Nuevo cliente"  class="btn btn-success">
              <a href="#" data-dismiss="modal" class="btn closeModal">Cerrar</a>
           </div>
         </form>
       </div>
     </div>
  </div>
  <!-- Modal de prueba -->
  
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
  
<!--Modal para editar un cliente-->
  <div id="editarCliente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              ×
              </button>
              <h3 class="h3Modal">Editar cliente</h3>
           </div>
           <div class="modal-body">
             <form id="editClienteForm" class="form form-signup" role="form" method="post" action="#">
               <input type="hidden" class="id" value=""/>
               <div class="form-group">
                   <div class="input-group">
                       <span class="input-group-addon">Nombre:</span>
                       <input type="text" class="form-control" name="nombreCliente" id="nombreCliente" placeholder="Nombre" required/>
                   </div>
               </div>
               <div class="form-group">
                   <div class="input-group">
                       <span class="input-group-addon">Primer Apellido:</span>
                       <input type="text" class="form-control" name="1apellido" id="1apellido" placeholder="Primer Apellido" required/>
                   </div>
               </div>
               <div class="form-group">
                   <div class="input-group">
                       <span class="input-group-addon">Segundo Apellido:</span>
                       <input type="text" class="form-control" name="2apellido" id="2apellido" placeholder="Segundo Apellido"/>
                   </div>
               </div>
               <div class="form-group">
                   <div class="input-group">
                       <span class="input-group-addon">Teléfono:</span>
                       <input type="phone" class="form-control" name="telefono" id="telefono" placeholder="Teléfono"/>
                   </div>
               </div>
           </div>
           <div class="modal-footer">
             <input id="editarClienteSubmit" type="submit" name="submitPass" value="Modificar"  class="btn btn-success">
              <a href="#" data-dismiss="modal" class="btn closeModal">Cerrar</a>
           </div>
         </form>
       </div>
     </div>
  </div>
<!--Modal para un nuevo artículo-->
  <div id="nuevoArticulo" class="modal fade">
     <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              ×
              </button>
              <h3 class="h3Modal">Nuevo Articulo</h3>
              <p class="textoModal">Añada un artículo:</p>
           </div>
           <div class="modal-body">
             <div class="form-group">
                 <div class="input-group">
                     <span class="input-group-addon">Nombre:</span>
                     <input type="text" class="form-control" name="nombre" id="nombreArticulo" placeholder="Nombre"/>
                 </div>
             </div>
             <div class="form-group">
                 <div class="input-group">
                     <span class="input-group-addon">Abreviatura:</span>
                     <input type="text" class="form-control" maxlength="4" name="abreviatura" id="abreviaturaArticulo" placeholder="Abreviatura"/>
                 </div>
             </div>
             <div class="form-group">
                 <div class="input-group">
                     <span class="input-group-addon">Precio (€):</span>
                     <input type="number" min='0' step='0.01' class="form-control" name="precio" id="precioArticulo" placeholder="Precio"/>
                 </div>
             </div>
             <div class="form-group">
                 <div class="input-group">
                     <span class="input-group-addon">Stock:</span>
                     <input type="number" min='0' step='0.5' class="form-control" name="stock" id="stockArticulo" placeholder="Stock"/>
                 </div>
             </div>
           </div>
           <div class="modal-footer">
              <a href="#" class="btn btn-success guardar">Guardar</a>
              <a href="#" data-dismiss="modal" class="btn closeModal">Cerrar</a>
           </div>
       </div>
     </div>
  </div>
<!--Modal para editar un artículo-->
  <div id="editarArticuloModal" class="modal fade">
     <div class="modal-dialog">
        <div class="modal-content"> 
           <form id="editArticuloForm" class="form form-signup" role="form" method="post" action="#">
           <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              ×
              </button>
              <h3 class="h3Modal">Modificar Articulo</h3>
              <p class="textoModal">Edite un artículo:</p>
           </div>
           <div class="modal-body">
            
                <input type="hidden" class="id" value=""/>
             <div class="form-group">
                 <div class="input-group">
                     <input type="hidden" class="id" value=""/>
                     <span class="input-group-addon">Nombre:</span>
                     <input type="text" class="form-control" name="nombre" id="nombreArticulo" placeholder="Nombre"/>
                 </div>
             </div>
             <div class="form-group">
                 <div class="input-group">
                     <span class="input-group-addon">Abreviatura:</span>
                     <input type="text" class="form-control" maxlength="4" name="abreviatura" id="abreviaturaArticulo" placeholder="Abreviatura"/>
                 </div>
             </div>
             <div class="form-group">
                 <div class="input-group">
                     <span class="input-group-addon">Precio (€):</span>
                     <input type="number" min='0' step='0.01' class="form-control" name="precio" id="precioArticulo" placeholder="Precio"/>
                 </div>
             </div>
             <div class="form-group">
                 <div class="input-group">
                     <span class="input-group-addon">Stock:</span>
                     <input type="number" min='0' step='0.5' class="form-control" name="stock" id="stockArticulo" placeholder="Stock"/>
                 </div>
             </div>
           </div>
           <div class="modal-footer">
              <input id="editarArticuloSubmit" type="submit" name="submitPass" value="Modificar"  class="btn btn-success">
              <a href="#" data-dismiss="modal" class="btn closeModal">Cerrar</a>
           </div>
           </form>
       </div>
     </div>
  </div>
  <!--Modal para ver informes-->
    <div id="informes" class="modal fade">
       <div class="modal-dialog">
          <div class="modal-content">
             <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                ×
                </button>
                <h3 class="h3Modal">Informes</h3>
                <p class="textoModal">Elija el informe a imprimir:</p>
             </div>
             <div class="modal-body">
                <div class="radio">
                  <label><input type="radio" id="infPedidos" value="infPedidos" name="informes">Informe de pedidos y clientes del tipo "Flores sueltas"</label>
                </div>
                <div class="radio">
                  <label><input type="radio" id="infCentros" value="infCentros" name="informes">Informe de pedidos "Centros" y "Ramos" por fecha</label>
                </div>
              <!--  <div class="radio">
                  <label><input type="radio" id="infRamos" value="infRamos" name="informes">Informe de pedidos "Ramos" por fecha</label>
                </div>-->
                <div class="radio">
                  <label><input type="radio" id="infStock" value="infStock" name="informes">Informe de Stock</label>
                </div>
                <div class="radio">
                  <label><input type="radio" id="infClientes" value="infClientes" name="informes">Listado de Clientes</label>
                </div>
                <div class="radio">
                  <label><input type="radio" id="infAriculos" value="infAriculos" name="informes">Listado de Artículos</label>
                </div>
             </div>
             <div class="modal-footer">
                <a href="#" id="imprInforme" class="btn btn-success">Imprimir informe</a>
                <a href="#" data-dismiss="modal" class="btn">Cerrar</a>
             </div>
         </div>
       </div>
    </div>




   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
    <script src="js/nuevoPedido.js"></script>
    <!-- dataTable -->
    <script src="js/datatables.js"></script>
    
    <!-- Page Functions -->
    <script src="js/frontController.js"></script>
    <!--Bootstrap modal-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="js/cliente.js"></script>
    <script src="js/articulo.js"></script>
    <script src="js/informes.js"></script>
    <!-- bootbox -->
    <script type="text/javascript" src="js/bootbox.js"></script>
    
    <script src="js/usuario.js"></script>
    
    <div id="script"></div>


  </body>
</html>
<!-- 03/08/2016 19:15 -->