<?php
App::import('Vendor','tcpdf/tcpdf');
class XTCPDF  extends TCPDF
{

    var $xheadertext  = 'CINEMATECA URUGUAYA';
    var $xheadercolor = array(0,0,200);
    var $xfootertext  = 'Copyright © %d XXXXXXXXXXX. Reservados todos los derechos.';
    var $xfooterfont  = PDF_FONT_NAME_MAIN ;
    var $xfooterfontsize = 8 ;

    function Header()
    {

        list($r, $b, $g) = $this->xheadercolor;
        $this->setY(10);
        $this->SetFillColor($r, $b, $g);
        $this->SetTextColor(0 , 0, 0);
        $this->Cell(0,20, '', 0,1,'C', 1);
        $this->Text(15,26,$this->xheadertext );
    }

    function Footer()
    {
        $year = date('Y');
        $footertext = sprintf($this->xfootertext, $year);
        $this->SetY(-20);
        $this->SetTextColor(0, 0, 0);
        $this->SetFont($this->xfooterfont,'',$this->xfooterfontsize);
        $this->Cell(0,8, $footertext,'T',1,'C');
    }
    
}
?>