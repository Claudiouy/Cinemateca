<?php
require_once('app'.DS.'vendors'.DS.'tcpdf'.DS.'config'.DS.'lang'.DS.'spa.php');
//require_once('app\vendors\tcpdf\tcpdf.php');
require_once('app'.DS.'vendors'.DS.'xtcpdf.php');
  


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($users_username);
$pdf->SetTitle('Identificacion Socio');
$pdf->SetSubject('Tarjeta Personal Socio');
$pdf->SetKeywords($users_username, 'Tarjeta', $socio['Socio']['surname'], $socio['Socio']['name'], $socio['Socio']['documento_identidad']);

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, 10, 'Cinemateca Uruguaya','Carnet de Socio : '.$socio['Socio']['documento_identidad']);


// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', 5));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', 5));

//// set default monospaced font
//$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//
////set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//set JPEG quality
$pdf->setJPEGQuality(75);
//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// IMPORTANT: disable font subsetting to allow users editing the document
$pdf->setFontSubsetting(false);

// set font
$pdf->SetFont('helvetica', '', 5, '', false);

// nombre completo
$ncna = $socio['Socio']['name']. ' '.$socio['Socio']['surname'];
$ncan = $socio['Socio']['surname']. ', '.$socio['Socio']['name'];

// add a page
$pdf->AddPage('L','A7');

/*
It is possible to create text fields, combo boxes, check boxes and buttons.
Fields are created at the current position and are given a name.
This name allows to manipulate them via JavaScript in order to perform some validation for instance.
*/

// set default form properties
//$pdf->setFormDefaultProp(array('lineWidth'=>1, 'borderStyle'=>'solid', 'fillColor'=>array(255, 255, 200), 'strokeColor'=>array(255, 128, 128)));
$pdf->SetFont('helvetica', 'B', 5);



$pdf->setTextRenderingMode($stroke=0.1, $fill=false, $clip=false);
$pdf->Cell(0, 4, 'CINEMATECA URUGUAYA', 0, 1, 'C');
$pdf->Ln(1);

    

$pdf->setTextRenderingMode($stroke=0, $fill=true, $clip=false);
$pdf->SetFont('helvetica', '', 7);

$foto =$socio['Socio']['image_url'];
if(!empty($foto)&& $foto !=('/img/files/unknown.jpg')){

$pdf->Image($foto, 80,15, 8, 8, 'JPG', '', 'N', true, 600, '', false, false, 0, false, false, false);
}

$pdf->SetFont('helvetica', '', 4);

//Nombre y Apellido
$text='Nombre completo: '.$ncna;
$pdf->writeHTML($text, true, false, false, false,'L');



// Documento de Identidad

$text='Documento de Identidad N° : '.$socio['Socio']['documento_identidad'];
$pdf->writeHTML($text, true, false, false, false,'L');




//Direccion
   
$text='Direccion : '.$socio['Socio']['calle_princ'];

//if($socio['Socio']['colectivo']== 0) $text.='individual.'; else $text = $text.'colectiva.'; 

$pdf->writeHTML($text, true, false, false, false,'L');

// EAN 13
$style = array(
    'position' => 'R',
    'align' => 'R',
    'stretch' => false,
    'fitwidth' => true,
    'cellfitalign' => '',
    'border' => '',
    'hpadding' => 'auto',
    'vpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false,
    'text' => true,
    'font' => 'helvetica',
    'fontsize' => 3,
    'stretchtext' => 4
);
$pdf->SetFont('helvetica', '', 3);
$pdf->writeHTML($ncan, true, false, false, false,'R');
$pdf->write1DBarcode($socio['Socio']['documento_identidad'], 'EAN13', '', '', 30, 10, 0.1, $style, 'N');
// ---------------------------------------------------------
// Documento de Identidad

$text='Administracion: Lorenzo Carnelli 1311. TelFax: 24195795';
$pdf->writeHTML($text, true, false, false, false,'L');
$text='www.cinemateca.org.uy';
$pdf->writeHTML($text, true, false, false, false,'L');

$text='TARJETA NO TRANSFERIBLE';
$pdf->writeHTML($text, true, false, false, false,'C');
//Close and output PDF document
$pdf->Output('idCard'.$socio['Socio']['id'].'.pdf', 'D');

//============================================================+
// END OF FILE
//============================================================+
?>