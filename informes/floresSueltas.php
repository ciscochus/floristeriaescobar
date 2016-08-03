<?php
    require '../core/Security.php';
?>
<?php

   $allClientes = getClientes();
   $allArticulos = getArticulos();
    

   $content = "<page>";
    $content = $content."<html><body><h1>Pedidos 'Flores Sueltas' - Flores Escobar</h1><br>";
    $content = $content."<table border='1'>
    <tr>
        <th width='35'>&nbsp; Nº </th>
        <th width='250'>&nbsp; Cliente</th>";
        foreach ($allArticulos as $item) {
            $content = $content."<th width='42'>&nbsp; ".$item->getAbreviatura()."</th>";
            // <th width='42'>&nbsp; CLB</th>
            // <th width='42'>&nbsp; CLR</th>
            // <th width='45'>&nbsp; CLRS</th>
            // <th width='42'>&nbsp; CLA</th>
            // <th width='42'>&nbsp; CLV</th>
            // <th width='42'>&nbsp; GLB</th>
            // <th width='42'>&nbsp; GLR</th>
            // <th width='45'>&nbsp; GLRS</th>
            // <th width='42'>&nbsp; GLS</th>
            // <th width='42'>&nbsp; PA</th>
            // <th width='42'>&nbsp; MB</th>
            // <th width='42'>&nbsp; MA</th>
            // <th width='42'>&nbsp; LIL</th>
            // <th width='42'>&nbsp; RR</th>
            // <th width='42'>&nbsp; RB</th>
            // <th width='42'>&nbsp; RRO</th>
        }
    $content = $content."</tr>";

    $count = 1;
   foreach ($allClientes as $item) {
        $content = $content."<tr>";
        $content = $content."<td align='right'>".$count."&nbsp;</td>";
        $content = $content."<td>&nbsp;".$item->getApellido_1()."&nbsp;".$item->getApellido_2().", &nbsp;".$item->getNombre()."</td>";
        $content = $content."<td>&nbsp; </td>";
        $content = $content."<td>&nbsp; </td>";
        $content = $content."<td>&nbsp; </td>";
        $content = $content."<td>&nbsp; </td>";
        $content = $content."<td>&nbsp; </td>";
        $content = $content."<td>&nbsp; </td>";
        $content = $content."<td>&nbsp; </td>";
        $content = $content."<td>&nbsp; </td>";
        $content = $content."<td>&nbsp; </td>";
        $content = $content."<td>&nbsp; </td>";
        $content = $content."<td>&nbsp; </td>";
        $content = $content."<td>&nbsp; </td>";
        $content = $content."<td>&nbsp; </td>";
        $content = $content."<td>&nbsp; </td>";
        $content = $content."<td>&nbsp; </td>";
        $content = $content."<td>&nbsp; </td>";
        $content = $content."</tr>";
        $count++;
    }

    $content = $content."</table></body></html></page>";

    print_r($content);
    /*ob_end_clean();
    require_once('../view/lib/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('L','A4','fr');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output('listado_clientes.pdf');*/

    function getClientes()
    {
        require_once("../controller/ClientesController.php");
        //Creamos el objeto cliente
        $cliControlador = new ClientesController;
        $allClientes = $cliControlador->listarInfClientes();
        $cliControlador->destroy();
        return $allClientes;
    }
    
    function getArticulos()
    {
        require_once("../controller/ArticulosController.php");

        //Creamos el objeto articulo
        $artControlador = new ArticulosController;
        $allArticulos = $artControlador->listarArtInformes();
        $artControlador->destroy();
        return $allArticulos;
    }

?>
