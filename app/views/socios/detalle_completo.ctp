<?php
ini_set('memory_limit','128M');
require_once('app'.DS.'vendors'.DS.'tcpdf'.DS.'config'.DS.'lang'.DS.'spa.php');
//require_once('app\vendors\tcpdf\tcpdf.php');
require_once('app'.DS.'vendors'.DS.'xtcpdf.php');


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($users_username);
$pdf->SetTitle('Formulario  Asociado');
$pdf->SetSubject('Formulario  Asociado');
$pdf->SetKeywords($users_username, 'Ficha', $socio['Socio']['surname'], $socio['Socio']['name'], $socio['Socio']['documento_identidad']);

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'FICHA DEL SOCIO N° : '.$socio['Socio']['documento_identidad'],'Montevideo,'.gmdate('D, d M Y'));


// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
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
$pdf->SetFont('helvetica', '', 10, '', false);

// nombre completo
$ncna = $socio['Socio']['name']. ' '.$socio['Socio']['surname'];
$ncan = $socio['Socio']['surname']. ', '.$socio['Socio']['name'];

// add a page
$pdf->AddPage();

/*
It is possible to create text fields, combo boxes, check boxes and buttons.
Fields are created at the current position and are given a name.
This name allows to manipulate them via JavaScript in order to perform some validation for instance.
*/

// set default form properties
//$pdf->setFormDefaultProp(array('lineWidth'=>1, 'borderStyle'=>'solid', 'fillColor'=>array(255, 255, 200), 'strokeColor'=>array(255, 128, 128)));
$pdf->SetFont('helvetica', 'B', 14);

$estado =$socio['Socio']['estado'];
if($estado== 1){


$pdf->setTextRenderingMode($stroke=0.2, $fill=false, $clip=false);
$pdf->Cell(0, 5, 'DATOS DEL SOCIO', 0, 1, 'C');
$pdf->Ln(10);



    
}  else {
// set color for text stroke
$pdf->SetDrawColor(127, 127, 127);

$pdf->setTextRenderingMode($stroke=0.4, $fill=true, $clip=false);
$pdf->Cell(0, 5, 'ATENCION : SOCIO DADO DE BAJA ', 0, 1, 'C');
$pdf->Ln(10);
    
}
$pdf->setTextRenderingMode($stroke=0, $fill=true, $clip=false);
$pdf->SetFont('helvetica', '', 12);

$foto =$socio['Socio']['image_url'];
if(!empty($foto)){

$pdf->Image($foto, 170, 5, 15, 15, 'JPG', '', '', true, 150, '', false, false, 1, false, false, false);
}

$pdf->SetFont('helvetica', '', 12);

//Nombre y Apellido
$text='Nombres: '.$socio['Socio']['name'];
$pdf->SetFillColor(220, 255, 220);
$pdf->MultiCell(0, 0,$text, 1, 'L', 1, 0, '', '', true);
$pdf->Ln(10);

$text='Apellidos: '.$socio['Socio']['surname'];
$pdf->SetFillColor(220, 255, 220);
$pdf->MultiCell(0, 0,$text, 1, 'L', 1, 0, '', '', true);
$pdf->Ln(10);

// Documento de Identidad

$text='Documento de Identidad N° : '.$socio['Socio']['documento_identidad'];
$pdf->SetFillColor(220, 255, 220);
$pdf->MultiCell(0, 0,$text, 1, 'L', 1, 0, '', '', true);
$pdf->Ln(10);

// Fecha de nacimiento

$text='Fecha de nacimiento : '.$socio['Socio']['fec_nac'];
$pdf->SetFillColor(220, 255, 220);
$pdf->MultiCell(0, 0,$text, 1, 'L', 1, 0, '', '', true);
$pdf->Ln(10);

//Direccion

$text='Domicilio particular : '.$socio['Socio']['calle_princ'];
$pdf->SetFillColor(220, 255, 220);
$pdf->MultiCell(0, 0,$text, 1, 'L', 1, 0, '', '', true);
$pdf->Ln(12);

//Nacionalidad

$text='Pais : '.$socio['State']['name'];
$pdf->SetFillColor(220, 255, 220);
$pdf->MultiCell(0, 0,$text, 1, 'L', 1, 0, '', '', true);
$pdf->Ln(10);

//Ocupacion
$text='Ocupacion : '.$socio['Socio']['ocupacion'];
$pdf->SetFillColor(220, 255, 220);
$pdf->MultiCell(0, 0,$text, 1, 'L', 1, 0, '', '', true);
$pdf->Ln(10);


//Telefonos

$text='Telefono fijo : '.$socio['Socio']['tel_fijo'];
$pdf->SetFillColor(220, 255, 220);
$pdf->MultiCell(0, 0,$text, 1, 'L', 1, 0, '', '', true);
$pdf->Ln(10);

$text='Celular : '.$socio['Socio']['celular'];
$pdf->SetFillColor(220, 255, 220);
$pdf->MultiCell(0, 0,$text, 1, 'L', 1, 0, '', '', true);
$pdf->Ln(10);

//em@il
$text='Email : '.$socio['Socio']['email'];
$pdf->SetFillColor(220, 255, 220);
$pdf->MultiCell(0, 0,$text, 1, 'L', 1, 0, '', '', true);
$pdf->Ln(10);


$text = 'Afiliado en forma : ';

if($socio['Socio']['colectivo']== 0) $text.='"individual"'; else $text = $text.'"colectiva"'; 

$pdf->SetFillColor(220, 255, 220);
$pdf->MultiCell(0, 0,$text, 1, 'L', 1, 0, '', '', true);
$pdf->Ln(10);

//forma de pago

$text='Forma de Pago : '.$socio['PaymentMethod']['name'];
$pdf->SetFillColor(220, 255, 220);
$pdf->MultiCell(0, 0,$text, 1, 'L', 1, 0, '', '', true);
$pdf->Ln(10);

//Direccion cobro

$text='Dirección de Cobro : '.$socio['Socio']['calle_cobro'];
$pdf->SetFillColor(220, 255, 220);
$pdf->MultiCell(0, 0,$text, 1, 'L', 1, 0, '', '', true);
$pdf->Ln(12);

/*if($socio['Socio']['payment_method_id']== 2){
//Datos de la tarjeta de credito.
$text='Emisor: '.$socio['CreditcarsSocio']['creditcard_id']. ' Numero : '.$socio['CreditcarsSocio']['name'];
$pdf->SetFillColor(220, 255, 220);
$pdf->MultiCell(0, 0,$text, 1, 'L', 1, 0, '', '', true);
$pdf->Ln(10);
    
} 
*/
// EAN 13
$style = array(
    'position' => 'R',
    'align' => 'R',
    'stretch' => false,
    'fitwidth' => true,
    'cellfitalign' => '',
    'border' => true,
    'hpadding' => 'auto',
    'vpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false,
    'text' => true,
    'font' => 'helvetica',
    'fontsize' => 8,
    'stretchtext' => 4
);
$pdf->writeHTML($ncan, true, 0, false, 0,'R');
$pdf->write1DBarcode($socio['Socio']['documento_identidad'], 'EAN13', '', '', '', 18, 0.4, $style, 'N');
// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('contrato'.$socio['Socio']['id'].'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>