<?php
require_once("../core/ControladorBase.php");
require_once("../core/EntidadBase.php");
require_once("../model/Cliente.php");

//Creamos el objeto usuario
    $cliente=new Cliente();
    
    //Conseguimos todos los usuarios
    $allClientes=$cliente->getAll();
    
    
    $content = "<page>";
    $content = $content."<html><body><h1>Listado de clientes - Cutre edition</h1><br>";
    $content = $content."<table border='1'>
    <tr>
        <th>#</th>
        <th>Nombre</th> 
        <th>Apellidos</th>
        <th>Telefono</th>
    </tr>";
    
    foreach ($allClientes as $c) {
        $content = $content."<tr>";
        $content = $content."<td>".$c->idCliente."</td>";
        $content = $content."<td>".$c->nombre."</td>";
        $content = $content."<td>".$c->apellido_1." ".$c->apellido_2."</td>";
        $content = $content."<td>".$c->telefono."</td>";
        $content = $content."</tr>";
    }
    
    $content = $content."</table></body></html></page>";
    
    require_once('../view/lib/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('P','A4','fr');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output('listado_clientes.pdf');
    
    //echo $content;
    

?>