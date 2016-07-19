<?php
    require('../core/Security.php');
    require_once("../controller/ClientesController.php");


//Creamos el objeto clienteListado
    $cliControlador = new ClientesController;
    $allClientes = $cliControlador->listadoClientesSueltas();

   $content = "<page>";
    $content = $content."<html><body><h1>Pedidos 'Flores Sueltas' - Flores Escobar</h1><br>";
    $content = $content."<table border='1'>
    <tr>
        <th width='35'>&nbsp; Nº </th>
        <th width='250'>&nbsp; Cliente</th>
        <th width='42'>&nbsp; CLB</th>
        <th width='42'>&nbsp; CLR</th>
        <th width='45'>&nbsp; CLRS</th>
        <th width='42'>&nbsp; CLA</th>
        <th width='42'>&nbsp; CLV</th>
        <th width='42'>&nbsp; GLB</th>
        <th width='42'>&nbsp; GLR</th>
        <th width='45'>&nbsp; GLRS</th>
        <th width='42'>&nbsp; GLS</th>
        <th width='42'>&nbsp; PA</th>
        <th width='42'>&nbsp; MB</th>
        <th width='42'>&nbsp; MA</th>
        <th width='42'>&nbsp; LIL</th>
        <th width='42'>&nbsp; RR</th>
        <th width='42'>&nbsp; RB</th>
        <th width='42'>&nbsp; RRO</th>
    </tr>";

    $count = 1;
    //Hay que modificar para según lo que hagamos con clienteDao la función sería una u otra
    foreach ($allClientes as $item){
        $content = $content."<tr>";
        $content = $content."<td align='right'>".$count."&nbsp;</td>";
        $content = $content."<td>&nbsp;".$item->getNombre()."</td>";
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

    ob_end_clean();
    require_once('../view/lib/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('L','A4','fr');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output('listado_clientes.pdf');



?>
