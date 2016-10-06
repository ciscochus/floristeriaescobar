<?php
    require '../core/Security.php';
?>
<?php
require_once("../dao/ArticuloDao.php");
require_once("../model/Cliente.php");

    //obtenemos los articulos para la cabecera de la tabla
    //creamos un array con los articulos para trabajar con ellos
    
    $dao=new ArticuloDao();
    
        
    $q = "SELECT        DISTINCT(cliente.idCliente), cliente.nombre, cliente.apellido_1, cliente.apellido_2, cliente.telefono
            FROM        cliente, pedido, subpedido, compraarticulo, articulo
            WHERE       cliente.idCliente = pedido.idCliente AND
                        pedido.idPedido = subpedido.idPedido AND
                        subpedido.tipoEncargo = 1 AND
                        compraarticulo.idSubPedido = subpedido.idSubPedido AND
                        compraarticulo.idArticulo = articulo.idArticulo AND
                        articulo.abreviatura IN ('CLB', 'CLR', 'CLA', 'CLV', 'CLRS', 'GLB', 'GLR', 'GLRS', 'GLS', 'PA', 'MB', 'MA', 'LIL', 'RR', 'RB', 'RRO')
                        
            ORDER BY    cliente.apellido_1, 
                        cliente.apellido_2, 
                        cliente.nombre";
    
    $query=$dao->executeQuery($q);
        if ($query){
                while ($row = $query->fetch_object()) {
                $resultSetCliente[]=$row;
            }
            $listaClientes=array();
            
            foreach ($resultSetCliente as $item){
                $x = new Cliente();
                
                $x->setApellido_1($item->apellido_1);
                $x->setApellido_2($item->apellido_2);
                $x->setIdCliente($item->idCliente);
                $x->setNombre($item->nombre);
                $x->setTelefono($item->telefono);
                
                $listaClientes[]=$x;
            }
        }
        
        
        
        $content = "<page>";
        $content = $content."<html><body><h1>Pedidos 'Flores Sueltas' - Flores Escobar</h1><br>";
        $content = $content."<table border='1'>
        <tr>
            <th width='35'>&nbsp; Nº </th>
            <th width='250'>&nbsp; Cliente</th>";
            
        $listaArticulos = array("CLB" => 0, "CLR" => 0, "CLR" => 0, "CLA" => 0, "CLV" => 0, "CLRS" => 0, "GLB" => 0, "GLR" => 0, "GLR" => 0, "GLRS" => 0, "GLS" => 0, "PA" => 0, "MB" => 0, "MA" => 0, "LIL" => 0, "RR" => 0, "RB" => 0, "RRO" => 0);    
        $totalArticulos = array("CLB" => 0, "CLR" => 0, "CLR" => 0, "CLA" => 0, "CLV" => 0, "CLRS" => 0, "GLB" => 0, "GLR" => 0, "GLR" => 0, "GLRS" => 0, "GLS" => 0, "PA" => 0, "MB" => 0, "MA" => 0, "LIL" => 0, "RR" => 0, "RB" => 0, "RRO" => 0);
        
        foreach($listaArticulos as $abreviatura=>$cantidad)
        {
            $content = $content."<th width='42'>".$abreviatura."</th>";
        }
        $content = $content."</th>";

    $count = 1;
    foreach ($listaClientes as $item) {
        $content = $content."<tr>";
        $content = $content."<td align='right'>".$count."&nbsp;</td>";
        $content = $content."<td>&nbsp;".$item->getApellido_1()."&nbsp;".$item->getApellido_2().", &nbsp;".$item->getNombre()."</td>";
        //para cada cliente inicializo la lista de Articulos a cantidad 0
        $articulosAux = $listaArticulos;
        
        foreach($articulosAux as $abreviatura=>$cantidad)
        {
            $q = "SELECT 
                    IFNULL(SUM(
                        compraarticulo.cantidadArticulo
                    ),0) as 'CANTIDAD'
                FROM 
                    cliente, 
                    pedido, 
                    subpedido, 
                    compraarticulo, 
                    articulo 
                WHERE 
                    cliente.idCliente = pedido.idCliente 
                    AND cliente.idCliente = ".$item->getIdCliente()."
                    AND pedido.idPedido = subpedido.idPedido 
                    AND compraarticulo.idSubPedido = subpedido.idSubPedido 
                    AND compraarticulo.idArticulo = articulo.idArticulo 
                    AND subpedido.tipoEncargo = 1 
                    AND articulo.abreviatura = '".$abreviatura."'";
                    
            $query=$dao->executeQuery($q);
            
            if ($query){
                while ($row = $query->fetch_object()) {
                    $resultSetCantidad[]=$row;
                }
                $cantidad = $resultSetCantidad[count($resultSetCantidad)-1]->CANTIDAD;
            }
            
            if($cantidad>0){
                $content = $content."<td align='center'><b>".$cantidad."</b></td>";
                $totalArticulos[$abreviatura]+=$cantidad;
            }
            else{
                $content = $content."<td align='center'> </td>";
            }
            
        }
        $content = $content."</tr>";
        $count++;
    }

    $content = $content."</table>";
    $content = $content."<table border='1' style='margin-top:10px;'>
    <tr>
            <th width='291'>&nbsp; Total</th>";
            
    foreach($totalArticulos as $abreviatura=>$cantidad)
    {
        if($cantidad>0){
            $content = $content."<th width='42'>".$cantidad."</th>";
        }
        else{
            $content = $content."<th width='42'> </th>";
        }
        
    }        
            
    $content = $content."</table></body></html></page>";
    
    echo $content;
    
    // ob_end_clean();
    // require_once('../view/lib/html2pdf/html2pdf.class.php');
    // $html2pdf = new HTML2PDF('H','A4','fr');
    // $html2pdf->WriteHTML($content);
    // $html2pdf->Output('listado_clientes.pdf');



?>
