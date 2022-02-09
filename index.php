<?php

require_once('vendor/autoload.php');

// plmatilla html
require_once('plantilla/index.php');

// codigo css de la plantilla
$css = file_get_contents('plantilla/style.css');

$mpdf = new \Mpdf\Mpdf([]);

$plantilla = getPlantilla();
$mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($plantilla, \Mpdf\HTMLParserMode::HTML_BODY);

$mpdf->Output();


$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output();
