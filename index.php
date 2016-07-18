
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Acceso - Gestión "Santos"</title>

    <!-- Bootstrap core CSS -->
    <link href="view/css/bootstrap.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Hind' rel='stylesheet' type='text/css'>
    <!-- Bootstrap -->

    <link href="view/style.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- notifIt -->
    <script type="text/javascript" src="view/js/notifIt.min.js"></script>
    <link rel="stylesheet" type="text/css" href="view/css/notifIt.css">
    <style type="text/css">
body
{
    padding-top: 200px;
}

.input-group-addon
{
    background-color: rgb(50, 118, 177);
    border-color: rgb(40, 94, 142);
    color: rgb(255, 255, 255);

}
.form-control:focus
{
    background-color: rgb(50, 118, 177);
    border-color: rgb(40, 94, 142);
    color: rgb(255, 255, 255);
}
.form-signup input[type="text"],.form-signup input[type="password"] { border: 1px solid rgb(50, 118, 177); }
.alert-danger-alt { border-color: #B63E5A;background: #E26868;color: #fff; }
h2 {color:#245D92; }
h3 {color:#245D92; }

.textoModal {color:#000;}
    </style>
  </head>

  <body>
<div class="container">
    <div class="row">
        <div id="msgDiv" class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2 class="text-center">Gestión Santos </h2>
                    <form class="form form-signup" role="form" method="post" action="view/login.php">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Usuario" /><span id="msgUser" class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Contrase&ntilde;a" /><span id="msgPass" class="error"></span>
                        </div>
                    </div>
                </div>
                <input id="submitLogin" type="submit" name="Submit" value="Iniciar Sesion"  class="btn btn-sm btn-primary btn-block">

                </form>
               <br>
               
               <p style="text-align:center;"><a data-toggle="modal" href="#pass">¿Has olvidado tu contraseña?</a></p>
               <div id="pass" class="modal fade">
                  <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                           ×
                           </button>
                           <h3>Recuperar Contraseña</h3>
                           <p class="textoModal">Cambia tu contraseña.</p>
                        </div>
                        <div class="modal-body">
                        <form id="submitPass" class="form form-signup" role="form" method="post" action="view/cambia.php">
                          <div class="form-group">
                              <div class="input-group">
                                  <span class="input-group-addon">Usuario:</span>
                                  <input type="text" class="form-control" name="passUsername" id="passUsername" placeholder="Usuario" required/>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="input-group">
                                  <span class="input-group-addon">e-Mail: </span>
                                  <input type="email" id="passEmail" name="passEmail" class="form-control" placeholder="e-Mail" required />
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="input-group">
                                  <span class="input-group-addon">Nueva contraseña: </span>
                                  <input type="password" id="passCambio" name="passCambio" class="form-control" placeholder="Contrase&ntilde;a" required />
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
            </div>
         	<div id="msgError"></div>
         	
        </div>
    </div>
</div>
</div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="view/js/jquery.min.js"></script>
    <script src="view/js/bootstrap.min.js"></script>
    <script src="view/js/bootstrap-modal.js"></script>
    <script src="view/js/login.js"></script>

  </body>
</html>
