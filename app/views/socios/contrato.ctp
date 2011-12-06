<?php
ini_set('memory_limit','128M');
require_once('app\vendors\tcpdf\config\lang\spa.php');
require_once('app\vendors\xtcpdf.php');


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($users_username);
$pdf->SetTitle('Formulario Nuevo Asociado');
$pdf->SetSubject('Formulario Nuevo Asociado');
$pdf->SetKeywords($users_username, 'Contrato', $socio['Socio']['surname'], $socio['Socio']['name'], $socio['Socio']['documento_identidad']);

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

// add a page
$pdf->AddPage();

/*
It is possible to create text fields, combo boxes, check boxes and buttons.
Fields are created at the current position and are given a name.
This name allows to manipulate them via JavaScript in order to perform some validation for instance.
*/


// nombre completo
$ncna = $socio['Socio']['name']. ' '.$socio['Socio']['surname'];
$ncan = $socio['Socio']['surname']. ', '.$socio['Socio']['name'];

// set default form properties
//$pdf->setFormDefaultProp(array('lineWidth'=>1, 'borderStyle'=>'solid', 'fillColor'=>array(255, 255, 200), 'strokeColor'=>array(255, 128, 128)));



$pdf->SetFont('helvetica', 'B', 14);

$estado =$socio['Socio']['estado'];
if($estado== 1){


$pdf->setTextRenderingMode($stroke=0.2, $fill=false, $clip=false);
$pdf->Cell(0, 5, 'DATOS DEL SOCIO', 0, 1, 'C');
$pdf->Ln(8);



    
}  else {
// set color for text stroke
$pdf->SetDrawColor(127, 127, 127);

$pdf->setTextRenderingMode($stroke=0.4, $fill=true, $clip=false);
$pdf->Cell(0, 5, 'ATENCION : SOCIO DADO DE BAJA ', 0, 1, 'C');
$pdf->Ln(8);
    
}
$pdf->setTextRenderingMode($stroke=0, $fill=true, $clip=false);
$pdf->SetFont('helvetica', '', 12);

$foto =$socio['Socio']['image_url'];
if(!empty($foto)){

$pdf->Image($foto, 170, 5, 15, 15, 'JPG', '', '', true, 150, '', false, false, 1, false, false, false);
}

$pdf->SetFont('helvetica', '', 12);

$text = 'Por la presente solicito mi ingreso en calidad de Socio suscripto de  <strong>Cinemateca Uruguaya</strong> en la modalidad de socio <strong>'.$socio['Suscription']['name'].'</strong>';
$pdf->writeHTML($text, true, 0, true, 0);
$pdf->Ln(4);

// set color for background

//Nombre y Apellido
$text='Nombres: '.$socio['Socio']['name'];
$pdf->SetFillColor(220, 255, 220);
$pdf->MultiCell(0, 0,$text, 1, 'L', 1, 0, '', '', true);
$pdf->Ln(8);

$text='Apellidos: '.$socio['Socio']['surname'];
$pdf->SetFillColor(220, 255, 220);
$pdf->MultiCell(0, 0,$text, 1, 'L', 1, 0, '', '', true);
$pdf->Ln(8);

// Documento de Identidad

$text='Documento de Identidad N° : '.$socio['Socio']['documento_identidad'];
$pdf->SetFillColor(220, 255, 220);
$pdf->MultiCell(0, 0,$text, 1, 'L', 1, 0, '', '', true);
$pdf->Ln(8);

// Fecha de nacimiento

$text='Fecha de nacimiento : '.$socio['Socio']['fec_nac'];
$pdf->SetFillColor(220, 255, 220);
$pdf->MultiCell(0, 0,$text, 1, 'L', 1, 0, '', '', true);
$pdf->Ln(8);

//Direccion particular

$text='Domicilio particular : '.$socio['Socio']['calle_princ'];
$pdf->SetFillColor(220, 255, 220);
$pdf->MultiCell(0, 0,$text, 1, 'L', 1, 0, '', '', true);
$pdf->Ln(12);
//Nacionalidad

$text='Pais : '.$socio['State']['name'];
$pdf->SetFillColor(220, 255, 220);
$pdf->MultiCell(0, 0,$text, 1, 'L', 1, 0, '', '', true);
$pdf->Ln(8);

//Ocupacion
$text='Ocupacion : '.$socio['Socio']['ocupacion'];
$pdf->SetFillColor(220, 255, 220);
$pdf->MultiCell(0, 0,$text, 1, 'L', 1, 0, '', '', true);
$pdf->Ln(8);


//Telefonos

$text='Telefono fijo : '.$socio['Socio']['tel_fijo'];
$pdf->SetFillColor(220, 255, 220);
$pdf->MultiCell(0, 0,$text, 1, 'L', 1, 0, '', '', true);
$pdf->Ln(8);

$text='Celular : '.$socio['Socio']['celular'];
$pdf->SetFillColor(220, 255, 220);
$pdf->MultiCell(0, 0,$text, 1, 'L', 1, 0, '', '', true);
$pdf->Ln(8);

//em@il
$text='Email : '.$socio['Socio']['email'];
$pdf->SetFillColor(220, 255, 220);
$pdf->MultiCell(0, 0,$text, 1, 'L', 1, 0, '', '', true);
$pdf->Ln(8);


$text = 'Esta afiliación se realiza en forma ';

if($socio['Socio']['colectivo']== 0) $text.='INDIVIDUAL'; else $text = $text.'COLECTIVA'; 

$pdf->SetFillColor(220, 255, 220);
$pdf->MultiCell(0, 0,$text, 1, 'L', 1, 0, '', '', true);
$pdf->Ln(8);

//forma de pago

$text='Forma de Pago : '.$socio['PaymentMethod']['name'];
$pdf->SetFillColor(220, 255, 220);
$pdf->MultiCell(0, 0,$text, 1, 'L', 1, 0, '', '', true);
$pdf->Ln(8);


/*if($socio['Socio']['payment_method_id']== 2){
//Datos de la tarjeta de credito.
$text='Emisor: '.$socio['CreditcarsSocio']['creditcard_id']. ' Numero : '.$socio['CreditcarsSocio']['name'];
$pdf->SetFillColor(220, 255, 220);
$pdf->MultiCell(0, 0,$text, 1, 'L', 1, 0, '', '', true);
$pdf->Ln(8);
    
} 
 * S
 */
//Direccion cobro

$text='Dirección de Cobro : '.$socio['Socio']['calle_cobro'];
$pdf->SetFillColor(220, 255, 220);
$pdf->MultiCell(0, 0,$text, 1, 'L', 1, 0, '', '', true);
$pdf->Ln(12);


$pdf->SetFont('helvetica', '', 6, '', false);
$text = 'Asimismo declaro conocer y aceptar las disposiciones generales que a continuacion se establecen:';
$pdf->writeHTML($text, true, 0, false, 0);

$text='<h0>DISPOSICIONES GENERALES.</h0>';
$pdf->writeHTML($text, true, 0, false, 0);

$text='<strong>1.</strong>La vigencia de la mensualidad del socio de Cinemateca Uruguaya es del 15 de un mes hasta el 14 del siguiente.
    Si el aspirante a socio lo hace en función de algún convenio vigente deberá comunicarlo en el momento de la afiliación presentando la documentación necesaria que acredite su condición.
    
    El carné semestral se extiende del 15 de enero al 14 de julio, o del 15 de julio al 14 de enero. El carné anual se extiende del 15 de enero al 14 de enero del año siguiente';
$pdf->writeHTML($text, true, 0, false, 0);

$text='<strong>2.</strong>La tarjeta es personal e instransferible. Y solo puede ser usada por su titular.';
$pdf->writeHTML($text, true, 0, false, 0);

$text='<strong>3.</strong>La tarjeta mensual ,semestral o anual vigente habilita el ingreso de su titular a cualquiera de las salas de Cinemateca Uruguaya.
    En caso de tratarse de una sala de estreno, el socio deberá abonar una entrada de valor reducida cada vez que concurra.
    En oportunidad del Festival Internacional el socio deberá pagar un abono bonificado que habilitara su ingreso.
    Cada socio tendrá derecho al retiro del boletín mensual.
    El socio obtendrá importantes descuentos, en los comercios adheridos mediante la presentación de su tarjeta vigente.
    La lista de comercios se publicará en el boletín mensual.';
$pdf->writeHTML($text, true, 0, false, 0);
$text='<strong>4.</strong>La calidad del socio mensual se pierde automáticamente una vez que se verifique la falta de pago de tres cuotas consecutivas.
    En el caso de anuales y semestrales podrán renovar en cualquier momento mediante el pago del total de la anualidad o semstralidad.
    De optar por otra modalidad de afiliación deberan pagar la matrícula correspondiente';
$pdf->writeHTML($text, true, 0, false, 0);

$text='<strong>5.</strong>Si la afiliación es mensual, para que proceda la desvinculación unilateral del socio, éste deberá comunicar fehacientemente a Cinemateca Uruguaya por lo menos
    un mes antes de su decisión y estar al día con sus obligaciones sociales al momento de la comunicación.
    El socio mensual que se encutnre retrasado en sus pagos por lo mennos de tres meses y desea actualizar su situación, deberá abonar la mitad de cada mes no pago mas la cuota mensual correspondiente al mes vigente.
    En caso que hubieran pasado mas de 3 meses del último pago, para su ingreso deberá abonar el pago de la cuota mensual vigente mas la matricula.';
$pdf->writeHTML($text, true, 0, false, 0);

$text='<strong>6.</strong>Si el ingreso del socio mensual se produjo por cualquier convenio vigente,
    el beneficio de éste se mantendra en la medida que se conserve el numero de integrantes que se adhirieron al citado convenio.
    En caso de verificarse una baja del 20 % de socios pertenenciente al alguno de los convenios vigentes, 
    se comunicará a los demás socios suscriptores de ese convenio el cambio de categoría otorgando un plazo de un mes 
    para optar por el pasaje al mantenimiento de la membresía sin descuentos.
    De no mediar comunicación alguna, se tomará por desistimiento.';

$pdf->writeHTML($text, true, 0, false, 0);
$pdf->Ln(8);

$text='<strong>Firma del Socio :</strong>';
$text.='. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . ';

$pdf->writeHTML($text, true, 0, false, 0);
$pdf->Ln(5);

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
$pdf->Output('contrato'.$socio['Socio']['id'].'.pdf', 'D');

//============================================================+
// END OF FILE
//============================================================+
?>