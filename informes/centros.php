<?php
    require '../core/Security.php';
?>
<?php
require_once("../controller/ClientesController.php");


//Creamos el objeto cliente
    $cliControlador = new ClientesController;
    $allClientes = $cliControlador->listarInfClientes();

   $content = "<page>";
    $content = $content."<html><body><h1>Pedidos 'Centros' para fecha:  - Flores Escobar</h1><br>";
    $content = $content."<table border='1'>
    <tr>
        <th widt='40'>&nbsp; Número&nbsp;</th>
        <th width='500'>&nbsp; Apellidos</th>
        <th width='250'>&nbsp; Nombre</th>
        <th width='150'>&nbsp; Telefono</th>
    </tr>";

    $count = 1;
   foreach ($allClientes as $item) {
        $content = $content."<tr>";
        $content = $content."<td align='right'>".$count."&nbsp;</td>";
        $content = $content."<td>&nbsp;".$item->getApellido_1()."&nbsp;".$item->getApellido_2()."</td>";
        $content = $content."<td>&nbsp;".$item->getNombre()."</td>";
        $content = $content."<td>&nbsp;".$item->getTelefono()."</td>";
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