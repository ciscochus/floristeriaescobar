<?php
    require '../core/Security.php';
?>
<?php
require_once("../dao/ArticuloDao.php");
require_once("../model/Cliente.php");

    //obtenemos los articulos para la cabecera de la tabla
    //creamos un array con los articulos para trabajar con ellos
    
    $dao=new ArticuloDao();
    
    $q = "SELECT * FROM articulo ORDER BY nombre";
    
    $query=$dao->executeQuery($q);
        if ($query){
                while ($row = $query->fetch_object()) {
                $resultSet[]=$row;
            }
                
            $listaArticulos=array();

            foreach ($resultSet as $item){
                $x = new Articulo();
                $x->setAbreviatura($item->abreviatura);
                $x->setIdArticulo($item->idArticulo);
                $x->setNombre($item->nombre);
                $x->setPrecio($item->precio);
                $x->setStock($item->stock);
    
                $listaArticulos[]=$x;
            }
        }
        
        
        
    $q = "SELECT * FROM cliente ORDER BY nombre";
    
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
        
        foreach($listaArticulos as $articulo)
        {
            $content = $content."<th width='42'>".$articulo->getAbreviatura()."</th>";
        }
        $content = $content."</th>";

    $count = 1;
    foreach ($listaClientes as $item) {
        $content = $content."<tr>";
        $content = $content."<td align='right'>".$count."&nbsp;</td>";
        $content = $content."<td>&nbsp;".$item->getApellido_1()."&nbsp;".$item->getApellido_2().", &nbsp;".$item->getNombre()."</td>";
        
        foreach($listaArticulos as $articulo)
        {
            $content = $content."<td>0 </td>";
        }
        $content = $content."</tr>";
        $count++;
    }

    $content = $content."</table></body></html></page>";

    echo $content;
    
    // ob_end_clean();
    // require_once('../view/lib/html2pdf/html2pdf.class.php');
    // $html2pdf = new HTML2PDF('H','A4','fr');
    // $html2pdf->WriteHTML($content);
    // $html2pdf->Output('listado_clientes.pdf');



?>
