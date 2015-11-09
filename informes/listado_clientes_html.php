<?php
require_once("../core/ControladorBase.php");
require_once("../core/EntidadBase.php");
require_once("../model/Cliente.php");

//Creamos el objeto usuario
$cliente = new Cliente();

//Conseguimos todos los usuarios
$allClientes = $cliente -> getAllOrderBy("nombre", "ASC");
?>
<html>
	<head>
        <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap-combined.min.css" rel="stylesheet">
        <style type="text/css">
            
        </style>
	</head>
	<body>
		<div id="header">
            <h1>Listado de clientes</h1>
		</div>
		<div id="table" class="well">
            <table class="table">
                <thead><th>Nombre</th><th>Apellidos</th><th>Telefono</th></thead>
                <tbody>
                <?php
                    foreach ($allClientes as $c) {?>
                        <tr>
                            <td><?php echo $c -> nombre; ?></td>
                            <td><?php echo $c -> apellido_1 . " " . $c -> apellido_2; ?></td>
                            <td><?php echo $c -> telefono; ?></td>
                        </tr>
                  <?php  }
                ?>
                </tbody>
            </table>
		</div>
        <div id="footer">
            <p><span>Pie de pagina</span></p>
        </div>
	</body>
</html>