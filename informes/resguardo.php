<?php
    require '../core/Security.php';
?>
<?php
require_once("../controller/ClientesController.php");


    $fechaInsertada = filter_input(INPUT_GET, 'fechaReserva');
    
    $dao=new Dao();
    $sentencia ="SELECT cliente.idCliente, CONCAT(cliente.nombre, ' ', cliente.apellido_1, ' ', cliente.apellido_2) AS nombre, subpedido.idSubPedido, subpedido.diaEntrega, subpedido.numOrden, subpedido.tiesto, subpedido.descripcion, subpedido.estadoAlmacen
                        FROM    cliente, 
                                pedido, 
                                subpedido 
                        WHERE   pedido.idCliente = cliente.idCliente AND 
                                subpedido.idPedido = pedido.idPedido AND 
                                subpedido.tipoEncargo = '3' and subpedido.diaEntrega = '$fechaInsertada'
                        ORDER BY subpedido.numOrden";
    $query=$dao->executeQuery($sentencia);
    
    $numeroLineas = 0;    
    if ($query){
        while ($row = $query->fetch_object()) {
           $result[]=$row;
           $numeroLineas++;
        }
    }
    
    $content = '<page><html>';
    $content = $content."<body>";
    $content = $content."<h4 align='center'>Flores Escobar<br/><br/>";
    $content = $content."Resguardo: nombreCliente<br/><br/>Fecha recogida: fechaPedido  --- Orden recogida: numOrden</h4><br/>";
    
    
//    if ($numeroLineas == 0){
//        $content = $content."<h4>No hay datos para la fecha solicitada</h4>";      
//    }else{
        $content = $content."<table border='0.5' width='500'>";
    
//        foreach ($result as $item) {

            if ($item->tiesto == 0 || $item->tiesto == NULL){
                $auxTiesto = 'No';
            }else{
                $auxTiesto = 'Si';
            }

            $content = $content."<tr><td>
                <br/>
                <div align='center'>
                <strong>Descripción</strong><br/><br/>
                        <textarea disabled rows='5' cols='55'>".$item->descripcion."</textarea>

                </div><br/><br/>
                    <div><strong>  ¿Entrega tiesto?</strong> ".$auxTiesto."</div><br/>
            </td></tr>"; 

//        }
        $content = $content."</table>";
        
        $content = $content."<br/><br/><br/><br/>"; //Separador de las copias
        
        $content = $content."<h4 align='center'>Flores Escobar<br/><br/>";
        $content = $content."Resguardo: nombreCliente<br/><br/>Fecha recogida: fechaPedido  --- Orden recogida: numOrden</h4><br/>";
    
    
//    if ($numeroLineas == 0){
//        $content = $content."<h4>No hay datos para la fecha solicitada</h4>";      
//    }else{
        $content = $content."<table border='0.5' width='500'>";
    
//        foreach ($result as $item) {


            $content = $content."<tr><td>
                <br/>
                <div align='center'>
                <strong>Descripción</strong><br/><br/>
                        <textarea disabled rows='5' cols='55'>".$item->descripcion."</textarea>

                </div><br/><br/>
                    <div><strong>  ¿Entrega tiesto?</strong> ".$auxTiesto."</div><br/>
            </td></tr>"; 

//        }
        $content = $content."</table>";
//    }
    $content = $content."</body></html></page>";


    ob_end_clean();
    require_once('../view/lib/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('H','A5','fr');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output('listado_clientes.pdf');

    //03/08/2016 19:15
?>