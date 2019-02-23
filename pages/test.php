<?php

require_once 'dompdf/autoload.inc.php';
// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$t="hello world";
$dompdf->loadHtml('<h1 id="hi" style="background-color:red;">hello world</h1><hr width="100%"><p>sadwe <br> ads'.$t.'</p>');

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();
?>