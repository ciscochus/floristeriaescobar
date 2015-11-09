<?php
    require '../core/Security.php';
?>
<?php
require_once("../controller/ArticulosController.php");

//Creamos el objeto cliente
    $artControlador = new ArticulosController();
    $allArticulos = $artControlador->listarArtInformes();

    $content = "<page>";
    $content = $content."<html><body><h1>Listado de Artículos - Flores Escobar</h1><br>";
    $content = $content."<table border='1'>
    <tr>
        <th width='500'>&nbsp; Nombre</th>
        <th width='70'>&nbsp; Precio</th>
        <th width='70'>&nbsp; Stock</th>
    </tr>";

   foreach ($allArticulos as $item) {
        $content = $content."<tr>";
        $content = $content."<td>&nbsp;".$item->getNombre()."</td>";
        $content = $content."<td>&nbsp;".$item->getPrecio()."&nbsp;€&nbsp;</td>";
        $content = $content."<td align='center'>&nbsp;".$item->getStock()."</td>";
        $content = $content."</tr>";
    }

    $content = $content."</table></body></html></page>";

    ob_end_clean();
    require_once('../view/lib/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('L','A4','fr');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output('listado_articulos.pdf');

?>
