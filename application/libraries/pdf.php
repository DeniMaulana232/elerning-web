<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once('assets/dompdf/autoload.inc.php');

use Dompdf\Dompdf;

class Pdf
{
    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
    }

    public function generate($view, $data = array(), $filename = 'laporan', $paper = 'A4', $orientation = 'portrait')
    {
        // $html = $this->ci->load->view($view, $data, TRUE);
        // $dompdf->loadHtml($html);
        // $dompdf->setPaper($paper, $orientation);
        // // Render the PDF
        // $dompdf->render();
        // // Output the generated PDF to Browser
        // $dompdf->stream($filename . ".pdf", array("Attachment" => false));
    }
}
