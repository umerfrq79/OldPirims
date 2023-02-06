<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('./assets/dist/vendors/TCPDF-master/tcpdf.php');
class Pdf extends TCPDF
{
    public $footerText = 'This is Computer Generated Document. Errors and omissions excepted and it does not require any Manual Signature or Stamp.';

    protected $letterType;

    public function setLetterType($var){
        $this->letterType = $var;
    }

    function __construct()
    {
        parent::__construct();
    }
	public function Header() {
        // Logo

        $image_file =  'http://pirims.dra.gov.pk/uploads/company/DRAP/logo/logo.png';

		//$this->Image(K_PATH_IMAGES.'logo.png', '19', '13', PDF_HEADER_LOGO_WIDTH, $h=25, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='');

		$this->Image( $image_file, 15, 19, '', '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        // Title
		
		if(isset($this->isnotesheet) && !$this->isnotesheet && isset($this->licfileno)){
			$this->HeadY = $this->GetY();           
			$this->SetY($this->GetY() + 5);
			$this->setCellMargins(20, 0, 0, 0);
			$this->Cell(0, 5, $this->licfileno, 0, false, 'C', 0, '', 0, false, 'M', 'M');
			$this->HeadY = $this->GetY();           
			$this->SetY($this->GetY() + 4);
		}else{
			$this->HeadY = $this->GetY();           
			$this->SetY($this->GetY() + 8);
		}
		$this->setCellMargins(20, 0, 0, 0);
        $this->Cell(0, 5, 'Goverment of Pakistan', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		$this->HeadY = $this->GetY();           
        $this->SetY($this->GetY() + 5);
		$this->setCellMargins(20, 0, 0, 0);
        $this->Cell(0, 5, 'Ministry of National Health Services, Regulations & Coordination', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		
		$this->HeadY = $this->GetY();           
        $this->SetY($this->GetY() + 5);
		$this->setCellMargins(20, 0, 0, 0);
        $this->Cell(0, 3, 'Drug Regulatory Authority Of Pakistan', 0, false, 'C', 0, '', 0, false, 'M', 'M');

		$this->HeadY = $this->GetY();           
        $this->SetY($this->GetY() + 8);
		$this->setCellMargins(20, 0, 0, 0);
		
		if(isset($this->isnotesheet) && $this->isnotesheet && isset($this->licfileno)){
			$text = 'Licensing Division                  *****************                  '.$this->licfileno;
		}else{
			$text =  '*****************';
		}
		
		$this->SetFont(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN);
        $this->Cell(0, 3, $text, 0, false, 'C', 0, '', 0, false, 'M', 'M');
		//$this->SetFont(PDF_FONT_NAME_MAIN, '', 12);
		$this->HeadY = $this->GetY();           
        $this->SetY($this->GetY() + 4);
		$this->Line(PDF_MARGIN_LEFT, $this->getY(), $this->getPageWidth()-PDF_MARGIN_LEFT, $this->getY());

		if(isset($this->isnotesheet) && $this->isnotesheet && isset($this->compName)){
			$this->HeadY = $this->GetY();           
			$this->SetY($this->GetY() + 5);
			$this->setCellMargins(20, 0, 0, 0);
			$this->Cell(0, 5, 'Subject :        '.$this->compName, 0, false, 'L', 0, '', 0, false, 'M', 'M');
            //$this->MultiCell(0, 5, 'Subject :        '.$this->compName."\n", 0, 'J',false,1, 1, '' ,'', true);
            //$this->MultiCell()
            if(isset($this->compSite)){
                $this->SetY($this->GetY() + 5);
                $this->setCellMargins(40, 0, 0, 0);
                $this->Cell(0, 5, $this->compSite, 0, false, 'L', 0, '', 0, false, 'M', 'M');
            }
            $this->HeadY = $this->GetY();
			$this->SetY($this->GetY() + 4);

			$this->Line(PDF_MARGIN_LEFT, $this->getY(), $this->getPageWidth()-PDF_MARGIN_LEFT, $this->getY());
		}else{
			$this->HeadY = $this->GetY();           
			$this->SetY($this->GetY() + 4);
			$this->SetFont(PDF_FONT_NAME_MAIN, 'B', 12);
			$this->Cell(0, 5, '"SAY NO TO CORRUPTION"', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		}
        if(isset($this->letterType)){
            $x = $this->GetX();
            $y = $this->GetY();
            $this->SetX(200);
            $this->SetY(5);
            $this->Cell(0, 15, $this->letterType, 0, false, 'R', 0, '', 0, false, 'M', 'M');
            $this->SetX($x);
            $this->SetY($y);
        }
		if(isset($this->barcode_no)){
			$style = array(
                'border' => 2,
                'vpadding' => 2, //'auto',
                'hpadding' => 2, //'auto',
                'fgcolor' => array(0,0,0),
                'bgcolor' => false, //array(255,255,255)
                'module_width' => 1, // width of a single module in points
                'module_height' => 1 // height of a single module in points
            );
			$this->write2DBarcode($this->barcode_no, 'QRCODE,H', 180, 10, 15, 15, $style, 'N');
		}
		$this->SetFont(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN);
		$this->SetMargins(PDF_MARGIN_LEFT, 60, PDF_MARGIN_RIGHT);
		$this->Ln();
	}

	public function Footer() {
        // Position at 15 mm from bottom
		$this->SetFont(PDF_FONT_NAME_MAIN, 'I', 8);

		if(isset($this->isnotesheet) && !$this->isnotesheet){
			$this->SetY(-15);

			// Set font
			// Page number
			$text = isset($this->footerText)?$this->footerText:'This is Computer Generated Document. Errors and omissions excepted and it does not require any Manual Signature or Stamp.';
            $this->Cell(0, 10,$text, 0, false, 'L', 0, '', 0, false, 'T', 'M');
		}
		$this->SetFont(PDF_FONT_NAME_MAIN, '', 8);
		$this->SetY(-7);
		$this->Line(PDF_MARGIN_LEFT, $this->getY(), $this->getPageWidth()-PDF_MARGIN_LEFT, $this->getY());
		$this->Cell(0, 10, $this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
		$this->SetFont(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN);

	}

	public function setting($companyNick,$data){
		// set document information
				$this->SetCreator(PDF_CREATOR);
				$this->SetAuthor('CyberSoft Technologies');
				$this->SetTitle($companyNick.' | '.$data['pageTitle'][0]->friendlyName);
				$this->SetSubject('');
				$this->SetKeywords('');

				// set default header data
				$this->SetHeaderData('logo.png', PDF_HEADER_LOGO_WIDTH, '', '', array(0,64,255), array(0,64,128));

				$this->setFooterData(array(0,64,0), array(0,64,128));

				// set header and footer fonts
				$this->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', 12));
				$this->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

				// set default monospaced font
				$this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

				// set margins
				$this->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
				$this->SetHeaderMargin(PDF_MARGIN_HEADER);
				$this->SetFooterMargin(PDF_MARGIN_FOOTER);

				// set auto page breaks
				$this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

				// set image scale factor
				$this->setImageScale(PDF_IMAGE_SCALE_RATIO);

				// set some language-dependent strings (optional)
				if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
					require_once(dirname(__FILE__).'/lang/eng.php');
					$this->setLanguageArray($l);
				}

				// ---------------------------------------------------------

				// set default font subsetting mode
				$this->setFontSubsetting(true);

				// Set font
				// dejavusans is a UTF-8 Unicode font, if you only need to
				// print standard ASCII chars, you can use core fonts like
				// helvetica or times to reduce file size.

				//$pdf->SetFont('dejavusans', '', 14, '', true);
				//$pdf->SetFont('times', '', 14, '', true);
				//$pdf->SetFont('aealarabiya', '', 14, '', true);
				//$pdf->SetFont('aefurat', '', 14, '', true);
				//$pdf->SetFont('cid0ct', '', 14, '', true); // using this
				//$pdf->SetFont('freemono', '', 14, '', true);
				//$pdf->SetFont('freesans', '', 14, '', true);
				//$pdf->SetFont('freeserif', '', 14, '', true);
				//$pdf->SetFont('helvetica', '', 14, '', true);
				$this->SetFont('helvetica', '', 12, '', true);

				// Add a page
				// This method has several options, check the source code documentation for more information.
				$this->AddPage();

				// set text shadow effect
				//$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));



	}
}