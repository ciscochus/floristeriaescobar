<?php
    require '../core/Security.php';
    require_once("../dao/Dao.php");
?>
<?php
require_once("../controller/ClientesController.php");


//Creamos el objeto cliente
    //$cliControlador = new ClientesController;
    //$allPedidos = $cliControlador->listarInfClientes();

    
    $fechaInsertada = filter_input(INPUT_GET, 'fechaReserva');
    
    $date = new DateTime($fechaInsertada); //Auxiliar para mostrar la fecha con formato español
    
    $dao=new Dao();
    /*$sentencia ="SELECT cliente.idCliente, CONCAT(cliente.nombre, ' ', cliente.apellido_1, ' ', cliente.apellido_2) AS nombre, subpedido.idSubPedido, subpedido.diaEntrega, subpedido.numOrden, subpedido.tiesto, subpedido.descripcion, subpedido.estadoAlmacen
                        FROM    cliente, 
                                pedido, 
                                subpedido 
                        WHERE   pedido.idCliente = cliente.idCliente AND 
                                subpedido.idPedido = pedido.idPedido AND 
                                subpedido.tipoEncargo = '2' and subpedido.diaEntrega = 
                        ORDER BY subpedido.numOrden";
     * */
    
    $sentencia = "SELECT subpedido.tipoEncargo, cliente.idCliente, CONCAT(cliente.nombre, ' ', cliente.apellido_1, ' ', cliente.apellido_2) AS nombre, subpedido.idSubPedido, subpedido.diaEntrega, subpedido.numOrden, subpedido.tiesto, subpedido.descripcion, subpedido.estadoAlmacen
                        FROM    cliente, 
                                pedido, 
                                subpedido 
                        WHERE   pedido.idCliente = cliente.idCliente AND 
                                subpedido.idPedido = pedido.idPedido AND 
                                subpedido.tipoEncargo != '1' AND subpedido.diaEntrega = '$fechaInsertada'
                       GROUP BY pedido.idCliente
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
    $content = $content."<h1>Centros y Ramos: ".$date->format('d-m-Y')." --- Flores Escobar</h1>";
    
    if ($numeroLineas == 0){
        $content = $content."<h4>No hay datos para la fecha solicitada</h4>";      
    }else{
        $content = $content."<table border='0.5' width='750'>";
        
        $numPedido = 0  ; //Variable de control bucle
        while ($numPedido < $numeroLineas){
            
            $item = $result[$numPedido];
            
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
            
            if ($item->tipoEncargo == 2){
                $auxTipoEncargo = 'Centro';
            }else if ($item->tipoEncargo == 3){
                $auxTipoEncargo = 'Ramos';                
            }
            
            $auxIdSub = $item->idSubPedido;
            
            //Consulta para sacar artículos
            $busqArt ="SELECT articulo.abreviatura, SUM(compraarticulo.cantidadArticulo) AS cantidad FROM articulo, compraarticulo WHERE compraarticulo.idSubPedido = '$auxIdSub' AND articulo.idArticulo = compraarticulo.idArticulo GROUP BY articulo.abreviatura";
            
            
            $queryArt=$dao->executeQuery($busqArt);          
            if ($queryArt){
                while ($rowArt = $queryArt->fetch_object()) {
                   $articulosResult[]=$rowArt;
                }
            }
            
            $content = $content."<tr><td>
                <div><strong>Num Orden: </strong>".$item->numOrden."</div> 
                <div><strong>Cliente: </strong>".$item->nombre."</div>
                <div><strong>Tipo de Encargo: </strong>".$auxTipoEncargo."</div> 
                <br/>
                <table border='0.2' border-spacing='5px'><tr><th width='70' rowspan='2'>Artículos</th>";
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
            
            $numPedido++;
            
        }
      
        $content = $content."</table>";
    }
    $content = $content."</body></html></page>";
    

    ob_end_clean();
    require_once('../view/lib/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('H','A4','fr');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output('listado_clientes.pdf');

?>