<?php
 
class PdfHelper extends AppHelper {
 
    var $tcpdf;
 
    function __construct() {
        App::import('Vendor', 'TCPDF', array('file' => 'tcpdf/tcpdf.php'));
        $this->tcpdf = new TCPDF();
        /* I didn't need a header or footer for my project,
         * so I decided to disable them here in the helper.
         */
        $this->tcpdf->setPrintHeader(false);
        $this->tcpdf->setPrintFooter(false);
    }
 
    function __call($method, $args) {
        return call_user_func_array(array($this->tcpdf, $method), $args);
    }
 
    function render() {
        return $this->tcpdf->output('', 'S');
    }
}
 
?>