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
    $content = $content."<h1>Ramos para: ".$fechaInsertada."  ---- Flores Escobar</h1><br>";
    
    
    if ($numeroLineas == 0){
        $content = $content."<h4>No hay datos para la fecha solicitada</h4>";      
    }else{
        $content = $content."<table border='1' width='750'>";
    
        foreach ($result as $item) {

            if ($item->tiesto == 0 || $item->tiesto == NULL){
                $auxTiesto = 'No';
            }else{
                $auxTiesto = 'Si';
            }
            
            if ($item->estadoAlmacen == 1){
                $auxEstAlmacen = 'Sin Realizar';
            }else if ($item->estadoAlmacen == 2){
                $auxEstAlmacen = 'En Proceso';
            }else if ($item->estadoAlmacen == 3){
                $auxEstAlmacen = 'Realizado';
            }else{
                $auxEstAlmacen = 'Desconocido';
            }
            
            $auxIdSub = $item->idSubPedido;
            
            $busqArt ="SELECT articulo.abreviatura, SUM(compraarticulo.cantidadArticulo) AS cantidad FROM articulo, compraarticulo WHERE compraarticulo.idSubPedido = '$auxIdSub' AND articulo.idArticulo = compraarticulo.idArticulo GROUP BY articulo.abreviatura";
            
            $queryArt=$dao->executeQuery($busqArt);          
            if ($queryArt){
                while ($rowArt = $queryArt->fetch_object()) {
                   $articulosResult[]=$rowArt;
                }
            }
                  
            
            $content = $content."<tr><td>
                <div><strong>Num Orden: </strong>".$item->numOrden."</div> <!--Quiero ponerlo con css pero me tengo que pelear con la librería-->
                <div><strong>Cliente: </strong>".$item->nombre."</div> 
                <br/>
                <table border='0.2'><tr><th width='70' rowspan='2'>Artículos</th>";
                    foreach ($articulosResult as $art){
                        $content = $content."
                        <th align='center' width='50'>".$art->abreviatura."</th>
                        ";
                    }
                    $content = $content."</tr><tr>";
                    foreach ($articulosResult as $art){ 
                        $content = $content."
                        
                        <td align='right' width='50'>".$art->cantidad."</td>
                        ";
                    }
                $content = $content."</tr></table>
                <br/><strong>Descripción</strong>
                        <textarea disabled rows='2' cols='75'>".$item->descripcion."</textarea>

                <br/><br/>
                    <div><strong>¿Tiene tiesto?</strong> ".$auxTiesto."</div>
                    <div><strong>Estado Almacen:</strong> ".$auxEstAlmacen."</div>
            </td></tr>"; 

        }
        $content = $content."</table>";
    }
    $content = $content."</body></html></page>";


    ob_end_clean();
    require_once('../view/lib/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('H','A4','fr');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output('listado_clientes.pdf');

    //03/08/2016 19:15
?>