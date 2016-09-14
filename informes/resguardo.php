<?php
    require '../core/Security.php';
?>
<?php
require_once("../controller/ClientesController.php");


    $fechaInsertada = filter_input(INPUT_GET, 'fecha');
    $cliente = filter_input(INPUT_GET, 'cliente');
    $orden = filter_input(INPUT_GET, 'orden');
    $tiesto = filter_input(INPUT_GET, 'tiesto');
    $descripcion = filter_input(INPUT_GET, 'descripcion');
    
    $date = new DateTime($fechaInsertada); //Auxiliar para mostrar la fecha con formato español

    
    $content = '<page><html>';
    $content = $content."<body>";
    $content = $content."<h4 align='center'>Flores Escobar<br/><br/>";
    $content = $content."Resguardo: ".$cliente."<br/><br/>Fecha recogida: ".$date->format('d-m-Y')."  --- Orden recogida: ".$orden."</h4><br/>";
    
    
    $content = $content."<table border='0.5' width='500'>";

    if ($tiesto == 0 || $tiesto == NULL || $tiesto == ''){
        $auxTiesto = 'No';
    }else{
        $auxTiesto = 'Si';
    }

    $content = $content."<tr><td>
    <br/>
    <div align='center'>
    <strong>Descripción</strong><br/><br/>
        <textarea disabled rows='7' cols='55'>".$descripcion."</textarea>
    </div><br/>
    <div><strong>  ¿Entrega tiesto?</strong> ".$auxTiesto."</div><br/>
    </td></tr>"; 

    $content = $content."</table>";    
    $content = $content."<br/><br/><br/>"; //Separador de las copias
    $content = $content."<h4 align='center'>Flores Escobar<br/><br/>";
    $content = $content."Resguardo: ".$cliente."<br/><br/>Fecha recogida: ".$date->format('d-m-Y')."  --- Orden recogida: ".$orden."</h4><br/>";
    
    
    $content = $content."<table border='0.5' width='500'>";
    $content = $content."<tr><td>
        <br/>
        <div align='center'>
        <strong>Descripción</strong><br/><br/>
            <textarea disabled rows='7' cols='55'>".$descripcion."</textarea>
        </div><br/>
        <div><strong>  ¿Entrega tiesto?</strong> ".$auxTiesto."</div><br/>
        </td></tr>"; 

    $content = $content."</table>";

    $content = $content."</body></html></page>";


    ob_end_clean();
    require_once('../view/lib/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('H','A5','fr');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output('listado_clientes.pdf');

    //03/08/2016 19:15
?>