<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . "/third_party/PHPExcel.php";
class hasil extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        cek_login();
        is_user();
    }

    public function index()
    {
        $data['tittle'] = 'Hasil Ujian';
        $data['guru'] = $this->db->get_where('guru', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['pilgan'] = $this->M_guru->ujian_peserta()->result();
        $this->load->view('guru/hasil_ujian', $data);
    }
    public function cetakPdf()
    {
        $data['pilgan'] = $this->M_guru->ujian_peserta()->result();
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Laporan-Data-Siswa-" . date('d-m-Y') . ".pdf";
        $this->pdf->load_view('guru/pdfcetak', $data);
    }
    function export_excel()
    {
        $this->load->library('PHPexcel');
        $data = $this->M_guru->ujian_peserta()->result();
        $objekPHPExcel = new PHPExcel;
        $filename = date('d-m-y');

        $objekPHPExcel->getProperties()->setCreator('SDN 2 Badran Sari')
            ->setLastModifiedBy('SDN 2 Badran Sari')
            ->setTitle("Data Siswa")
            ->setSubject("Siswa")
            ->setDescription("Laporan Semua Data Siswa")
            ->setKeywords("Data Nilai Siswa");

        $style_col = array(
            'font' => array('bold' => true), // Set font nya jadi bold
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );
        $objekPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "DATA NILAI SISWA"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $objekPHPExcel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
        $objekPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $objekPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $objekPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1


        $objekPHPExcel->getActiveSheet()->setCellValue('A2', 'No');
        $objekPHPExcel->getActiveSheet()->setCellValue('B2', 'Nama');
        $objekPHPExcel->getActiveSheet()->setCellValue('C2', 'Mata Pelajaran');
        $objekPHPExcel->getActiveSheet()->setCellValue('D2', 'Pertemuan');
        $objekPHPExcel->getActiveSheet()->setCellValue('E2', 'Nilai');

        $objekPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray($style_col);
        $objekPHPExcel->getActiveSheet()->getStyle('B2')->applyFromArray($style_col);
        $objekPHPExcel->getActiveSheet()->getStyle('C2')->applyFromArray($style_col);
        $objekPHPExcel->getActiveSheet()->getStyle('D2')->applyFromArray($style_col);
        $objekPHPExcel->getActiveSheet()->getStyle('E2')->applyFromArray($style_col);

        $row = 3;
        $nomor = 1;

        foreach ($data as $val) {
            $objekPHPExcel->getActiveSheet()->setCellValue('A' . $row, $nomor);
            $objekPHPExcel->getActiveSheet()->setCellValue('B' . $row, $val->nama);
            $objekPHPExcel->getActiveSheet()->setCellValue('C' . $row, $val->nama_mapel);
            $objekPHPExcel->getActiveSheet()->setCellValue('D' . $row, $val->no_pertemuan);
            $objekPHPExcel->getActiveSheet()->setCellValue('E' . $row, $val->nilai);

            $objekPHPExcel->getActiveSheet()->getStyle('A' . $row)->applyFromArray($style_row);
            $objekPHPExcel->getActiveSheet()->getStyle('B' . $row)->applyFromArray($style_row);
            $objekPHPExcel->getActiveSheet()->getStyle('C' . $row)->applyFromArray($style_row);
            $objekPHPExcel->getActiveSheet()->getStyle('D' . $row)->applyFromArray($style_row);
            $objekPHPExcel->getActiveSheet()->getStyle('E' . $row)->applyFromArray($style_row);
            $row++;
            $nomor++;
        }

        $objekPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $objekPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
        $objekPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $objekPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(17); // Set width kolom D
        $objekPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10); // Set width kolom E

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $objekPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $objekPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);



        $objWriter = PHPExcel_IOFactory::createWriter($objekPHPExcel, 'Excel2007');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        header('Content-Disposition: attachment; filename="Data Nilai Siswa-' . $filename . '.xlsx"');
        header('Cache-Control:max-age=0');
        ob_end_clean();

        $objWriter->save('php://output');
        exit();
    }
}
