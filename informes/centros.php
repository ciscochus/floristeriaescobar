<?php
    require '../core/Security.php';
?>
<?php
require_once("../controller/ClientesController.php");


//Creamos el objeto cliente
    $cliControlador = new ClientesController;
    $allClientes = $cliControlador->listarInfClientes();

    $fechaInsertada = '20/07/2016';    //HAy que pasarle la fecha seleccionada en la pantalla y por la que se realiza la búsqueda 
    
    $content = '<page><html>';
    $content = $content."<body>";
    $content = $content."<h1>Centros para: ".$fechaInsertada."  - Flores Escobar</h1><br>";
    $content = $content."<table border='1'>
    <tr>";
    
    for ($count=1; $count<3; $count++){ //Sería 4 pedidos por hoja
 
        $content = $content."<td width='425'>
            <div>Cliente.............. </div> 
            <div><strong>Num Orden: </strong></div>
            <br/>
            <div>Artículos</div>
            <table border='1'> 
            	<tr id='texto-uno-center'>
            		<th width='50'>MRB</th>
            		<th width='50'>MRB</th>
            		<th width='50'>MRB</th>
            		<th width='50'>MRB</th>
            		<th width='50'>MRB</th>
            		<th width='50'>MRB</th>
            		<th width='50'>MRB</th>
            		<th width='50'>MRB</th>
            	</tr>
            	<tr>
            		<td width='50'>23</td>
            		<td width='50'>23</td>
            		<td width='50'>23</td>
            		<td width='50'>23</td>
            		<td width='50'>23</td>
            		<td width='50'>23</td>
            		<td width='50'>23</td>
            		<td width='50'>23</td>
            	</tr>
            </table>
            <br/>
            <div>Descripción: <br/>
                    <textarea rows='5' cols='55'>Texto Observaciones</textarea>
        	</div>
        	<br/>
                <div>¿Tiene tiesto? </div>
        </td>";       
        
    }
    
    $content = $content."</tr></table></body></html></page>";

    ob_end_clean();
    require_once('../view/lib/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('L','A4','fr');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output('listado_clientes.pdf');



?>
