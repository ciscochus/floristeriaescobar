<?php
    require '../core/Security.php';
    require_once("../dao/Dao.php");
?>
<?php
require_once("../controller/ClientesController.php");


//Creamos el objeto cliente
    //$cliControlador = new ClientesController;
    //$allPedidos = $cliControlador->listarInfClientes();

    
    //Es para probar, esto hay que quitarlo por lo que devuelva la función
    $allPedidos = array(cliente1,cliente2,cliente3,cliente4,cliente5,cliente6);
    
    $fechaInsertada = filter_input(INPUT_GET, 'fechaReserva');
    
    $dao=new Dao();
    $sentencia ="SELECT subpedido.idSubPedido, subpedido.numOrden, CONCAT(cliente.nombre, ' ', cliente.apellido_1, ' ', cliente.apellido_2) AS nombre, articulo.abreviatura, SUM(compraarticulo.cantidadArticulo), subpedido.descripcion, subpedido.tiesto, subpedido.estadoAlmacen FROM cliente, pedido, subpedido, compraarticulo, articulo WHERE cliente.idCliente = pedido.idCliente AND pedido.idPedido = subpedido.idPedido AND compraarticulo.idSubPedido = subpedido.idSubPedido AND compraarticulo.idArticulo = articulo.idArticulo AND subpedido.tipoEncargo = 2 AND subpedido.diaEntrega = '$fechaInsertada' GROUP BY cliente.idCliente, cliente.nombre, cliente.apellido_1, cliente.apellido_2, pedido.idPedido, articulo.abreviatura ORDER BY subpedido.numOrden";
    $query=$dao->executeQuery($sentencia);
    
    if ($query){
                while ($row = $query->fetch_object()) {
                $result[]=$row;
            }
    }
    
    $content = '<page><html>';
    $content = $content."<body>";
    $content = $content."<h1>Centros para: ".$fechaInsertada."  ---- Flores Escobar</h1><br>";
    $content = $content."<table border='1'>
    ";
    
    $numeroLineas = count($result);
    
    if ($numeroLineas < 0){
        $content = $content."<tr><th>No hay datos para la fecha solicitada</th></td>";      
    
        
    }else{
    
        foreach ($result as $item) {

            $content = $content."<tr><td>
                <div><strong>Num Orden: </strong>".$item->numOrden."</div> <!--Quiero ponerlo con css pero me tengo que pelear con la librería-->
                <div>Cliente: ".$item->nombre."</div> 
                <br/>
                <div>Artículos</div>
                <table border='1'><tr>";
                    for ($count=1; $count<7; $count++){ //Sería 6 los que entran en horizontal
                    $content = $content."
                        <th width='50'> MPB</th>
                            <td width='50'>23</td>
                    ";
                    }
                $content = $content."</tr></table>
                <br/>
                        <textarea rows='2' cols='85'>".$item->descripcion."</textarea>

                <br/><br/>
                    <div>¿Tiene tiesto? ".$item->tiesto."</div>
                    <div>Estado Almacen ".$item->tiesto."</div>
            </td></tr>"; 

        };        
    }
    $content = $content."</table></body></html></page>";

    ob_end_clean();
    require_once('../view/lib/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('H','A4','fr');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output('listado_clientes.pdf');


    //03/08/2016 19:14
?>