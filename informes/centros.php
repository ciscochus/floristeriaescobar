<?php
    require '../core/Security.php';
?>
<?php
require_once("../controller/ClientesController.php");


//Creamos el objeto cliente
    $cliControlador = new ClientesController;
    //$allPedidos = $cliControlador->listarInfClientes();

    
    //Es para probar, esto hay que quitarlo por lo que devuelva la función
    $allPedidos = array(cliente1,cliente2,cliente3,cliente4,cliente5,cliente6);
    
    $fechaInsertada = '20/07/2016';    //HAy que pasarle la fecha seleccionada en la pantalla y por la que se realiza la búsqueda 
    
    $content = '<page><html>';
    $content = $content."<body>";
    $content = $content."<h1>Centros para: ".$fechaInsertada."  - Flores Escobar</h1><br>";
    $content = $content."<table border='1'>
    ";
    
    foreach ($allPedidos as $item) {
        
        $content = $content."<tr><td>
            <div><strong>Num Orden: </strong></div> <!--Quiero ponerlo con css pero me tengo que pelear con la librería-->
            <div>Cliente.............. </div> 
            <br/>
            <div>Artículos</div>
            <table border='1'><tr>";
                for ($count=1; $count<7; $count++){ //Sería 6 los que entran en horizontal
            	$content = $content."
            		<th width='50'>	MPB</th>
                        <td width='50'>23</td>
            	";
                }
            $content = $content."</tr></table>
            <br/>
                    <textarea rows='2' cols='85'>Texto </textarea>
        	
        	<br/><br/>
                <div>¿Tiene tiesto? </div>
        </td></tr>"; 
            
    };        
    
    $content = $content."</table></body></html></page>";

    ob_end_clean();
    require_once('../view/lib/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('H','A4','fr');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output('listado_clientes.pdf');



?>
