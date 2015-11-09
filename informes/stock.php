<?php
    require '../core/Security.php';
?>
<?php
require_once("../controller/ArticulosController.php");


//Creamos el objeto cliente
    $artControlador = new ArticulosController();
    $allStock = $artControlador->muestraInformeStock();

   $content = "<page>";
    $content = $content."<html><body><h1>Stock - Flores Escobar</h1><br>";
    $content = $content."<table border='1'>
    <tr>
        <th widt='35'>&nbsp; Nº&nbsp;</th>
        <th width='250'>&nbsp; Nombre Artículo</th>
        <th width='50'>&nbsp; Atr</th>
        <th width='125'>&nbsp; Cantidad Almacen</th>
        <th width='125'>&nbsp; Cantidad Pedidos</th>
        <th width='125'>&nbsp; Diferencia</th>
    </tr>";

    $diferencia = 0;
    $count = 0;
   foreach ($allStock as $item) {
        $content = $content."<tr>";
        $content = $content."<td align='right'>".$count."&nbsp;</td>";
        $content = $content."<td>&nbsp;".$item->getNombre()."</td>";
        $content = $content."<td>&nbsp;".$item->getAbreviatura()."</td>";
        $content = $content."<td>&nbsp;".$item->getStock()."</td>";
        if ($item->getSumaStock()== null){
            $content = $content."<td>&nbsp;0</td>";
            $diferencia = $item->getStock();
        }else{
            $content = $content."<td>&nbsp;".$item->getSumaStock()."</td>";
            $diferencia = $item->getStock() - $item->getSumaStock();
        }
        
        $content = $content."<td>&nbsp;".$diferencia."</td>";
        $content = $content."</tr>";
        $count++;
    }

    $content = $content."</table></body></html></page>";

    ob_end_clean();
    require_once('../view/lib/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('P','A4','fr');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output('listado_clientes.pdf');

    
?>
