<?php 
App::import('Vendor','tcpdf');  
$tcpdf = new XTCPDF(); 
$textfont = 'freesans'; // looks better, finer, and more condensed than 'dejavusans' 

$tcpdf->SetAuthor("Usuario Administrador (parametrizar)"); 
$tcpdf->SetAutoPageBreak( false ); 
$tcpdf->setHeaderFont(array($textfont,'',40)); 
$tcpdf->xheadercolor = array(150,0,0); 
$tcpdf->xheadertext = 'Cinemateca Uruguaya'; 
$tcpdf->xfootertext = 'Copyright Â© Cinemateca Uy. Todos los derechos reservados.'; 

// add a page (required with recent versions of tcpdf) 
$tcpdf->AddPage(); 

// Now you position and print your page content 
// example:  
$tcpdf->SetTextColor(0, 0, 0); 
$tcpdf->SetFont($textfont,'B',20); 
$tcpdf->Cell(0,14, "Hello World", 0,1,'L'); 
// ... 
// etc. 
// see the TCPDF examples  

echo $tcpdf->Output('filename.pdf', 'D'); 

?>  