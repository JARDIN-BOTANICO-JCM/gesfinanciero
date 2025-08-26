<?php
class TCPDF_acappdemy extends TCPDF {
    
    public $imgalto = 50;
    public $imgcontent = 48;
    
    public $lineaheader = true;
    public $lineatamanoheader = 0.5;
    public $lineaheadercolor = array(0,0,0);
    public $lineaheadertop = 23;
    
    public $lineafooter = true;
    public $lineatamanofooter = 0.5;
    public $lineafootercolor = array(0,0,0);
    public $lineafootertop = 10;
    
    //Page header
    public function Header() {
        $html1 ='<img src="repo/recursos/logo_inst.jpg" height="' . $this->imgalto . '" vhspace="0" />';
        
        $htmlruta = dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'sistema' . DIRECTORY_SEPARATOR . 'email' . DIRECTORY_SEPARATOR . 'encabezadopdf.html';
        $html2 = file_get_contents( $htmlruta );
        
        $dim = $this->getPageDimensions();
        $marg = $this->getMargins();
        
        $this->writeHTMLCell( $this->imgcontent , '', '', '', $html1, 0, 0, false, true, 'J', true);
        $this->writeHTMLCell('', '', '', '', $html2, 0, 1, false, true, 'L', true);
        
        if ( $this->lineaheader ) {
            $this->SetLineStyle(array('width' => $this->lineatamanoheader, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => $this->lineaheadercolor ) );
            $this->Line($marg['left'], $this->lineaheadertop, $dim['wk'] - $marg['right'], $this->lineaheadertop);
        }
        
        $this->setPageMark();
    }
    
    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-1 * $this->lineafootertop );
        
        $dim = $this->getPageDimensions();
        $marg = $this->getMargins();
        
        if ( $this->lineaheader ) {
            $this->SetLineStyle(array('width' => $this->lineatamanofooter, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => $this->lineafootercolor ) );
            $this->Line( $marg['left'], $this->GetY(), $dim['wk'] - $marg['right'], $this->GetY());
        }
        
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        
        $htmlruta = dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'sistema' . DIRECTORY_SEPARATOR . 'email' . DIRECTORY_SEPARATOR . 'piepaginapdf.html';
        $html = file_get_contents( $htmlruta );
        
        /*
        $replacement_array = array(
            'pagecur' => $this->getAliasNumPage(),
            'pagenum' => $this->getAliasNbPages()
        );
        
        $hdHtml = preg_replace_callback(
            '~\{\$(.*?)\}~si',
            function($match) use ($replacement_array) {
                return str_replace($match[0], isset($replacement_array[$match[1]]) ? $replacement_array[$match[1]] : $match[0], $match[0]);
            },
            $html);
        */
        // Page number
        //$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 1, false, 'R', 0, '', 0, false, 'T', 'M');
        
        $this->writeHTMLCell(0, $this->lineafootertop, '', '', $html, 0, 0, false, true, 'L', true);
    }
}
?>