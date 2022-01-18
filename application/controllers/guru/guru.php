<?php
defined('BASEPATH') or exit('No direct script access allowed');

class guru extends CI_Controller
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
        $data['tittle'] = 'Guru - SDN 2 Badran Sari';
        $data['guru'] = $this->db->get_where('guru', ['email' =>
        $this->session->userdata('email')])->row_array();
        $id = $data['guru']['id_guru'];
        $data['info'] = $this->M_guru->tampil3($id)->result();
        $this->load->view('guru/index', $data);
    }

    public function myProfile()
    {
        $data['tittle'] = 'Admin - My Profile';
        $data['guru'] = $this->db->get_where('guru', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['user'] = $this->M_guru->ProfileGuru()->result();
        $this->load->view('guru/profile', $data);
    }
    public function data_mapel()
    {

        $data['tittle'] = 'Guru - Mata Pelajaran';
        $data['guru'] = $this->db->get_where('guru', ['email' =>
        $this->session->userdata('email')])->row_array();
        $id = $data['guru']['id_guru'];
        $data['materi_user'] = $this->M_materi->materi_user($id);
        $data['materi'] = $this->M_materi->TampilData()->result();

        $this->load->view('guru/data_mapel', $data);
    }


    public function tambah_materi()
    {
        // if (isset($_POST['submit'])) {
        $this->form_validation->set_rules('judul', 'Judul', 'required');

        $config['upload_path']          = './assets/pdf/';
        $config['allowed_types']        = 'pdf|mp4|mkv|3gp';
        $config['max_size']             = 0;
        $config['overwrite']            = true;


        $this->load->library('upload', $config);

        if (!empty($_FILES['pdf']['name'])) {
            $this->upload->do_upload('pdf');
            $data1 = $this->upload->data();
            $pdf = $data1['file_name'];
        }
        if (!empty($_FILES['video']['name'])) {
            $this->upload->do_upload('video');
            $data2 = $this->upload->data();
            $video = $data2['file_name'];
        }

        if ($this->form_validation->run() == false) {
            $data['tittle'] = 'tambah materi';
            $data['guru'] = $this->db->get_where('guru', ['email' =>
            $this->session->userdata('email')])->row_array();
            $data['mapel'] = $this->M_mapel->TampilData()->result();
            $id = $data['guru']['id_guru'];
            $data['kelas'] = $this->M_kelas->get_kelas($id);
            $data['NamaGuru'] = $this->M_guru->tampil3($id)->result();
            $this->load->view('guru/tambah_materi', $data, array('error' => ' '));
        } else {
            $judul_materi = htmlspecialchars($this->input->POST('judul', true));
            $deskripsi_materi = htmlspecialchars($this->input->POST('deskripsi', true));
            $id_guru = htmlspecialchars($this->input->POST('guru', true));
            $id_kelas = htmlspecialchars($this->input->POST('kelas', true));
            $id_mapel = htmlspecialchars($this->input->POST('mapel', true));
            $id_pertemuan = htmlspecialchars($this->input->POST('pertemuan', true));
            // $file_pdf = htmlspecialchars($this->input->POST('pdf', true));
            // $video = htmlspecialchars($this->input->POST('video', true));

            $data = ['judul_materi' => $judul_materi, 'deskripsi_materi' => $deskripsi_materi, 'id_guru' => $id_guru, 'id_kelas' => $id_kelas, 'id_mapel' => $id_mapel, 'id_pertemuan' => $id_pertemuan, 'file_pdf' => $pdf, 'video' => $video];

            $this->db->insert('materi', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            materi berhasil ditambah </div>');
            redirect('guru/guru/tambah_materi');
        }
        // if (!$this->upload->do_upload('pdf')) {
        //     $error = array('error' => $this->upload->display_errors());
        // } else {
        //     $upload_data = $this->upload->data();
        //     $data = [
        //         'file_pdf' => $upload_data['file_name'],
        //         'judul_materi' => htmlspecialchars($this->input->POST('judul', true)),
        //         'deskripsi_materi' => htmlspecialchars($this->input->POST('deskrpsi', true)),
        //         'id_guru' => htmlspecialchars($this->input->POST('guru', true)),
        //         'id_kelas' => htmlspecialchars($this->input->POST('kelas', true)),
        //         'id_mapel' => htmlspecialchars($this->input->POST('mapel', true)),
        //         'id_pertemuan' => htmlspecialchars($this->input->POST('pertemuan', true))
        //     ];

        //     $this->db->insert('materi', $data);
        //     $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        //     materi berhasil ditambah </div>');
        //     redirect('guru/guru/tambah_materi');
        // }
        // }
    }

    //javascript tambah materi
    public function getMapel()
    {
        $id_kelas = $this->input->POST('id_kelas');
        $data = $this->M_pertemuan->getDataMapel($id_kelas);
        $output = '<option value="">---Matapelajaran--- </option>';
        foreach ($data as $row) {
            $output .= '<option value="' . $row->id_mapel . '">' . $row->nama_mapel . '</option>';
        }
        $this->output->set_content_type('application/JSON')->set_output(json_encode($output));
    }
    public function getPertemuan()
    {
        $id_mapel = $this->input->POST('id_mapel');
        $data = $this->M_pertemuan->getDataTemu($id_mapel);
        $output = '<option value="">---Pertemuan ke--- </option>';
        foreach ($data as $row) {
            $output .= '<option value="' . $row->id_pertemuan . '">' . $row->no_pertemuan . '</option>';
        }
        $this->output->set_content_type('application/JSON')->set_output(json_encode($output));
    }
    public function getMateri()
    {
        $id_pertemuan = $this->input->POST('id_pertemuan');
        $data = $this->M_pertemuan->getDataMateri($id_pertemuan);
        $output = '<option value="">---Materi--- </option>';
        foreach ($data as $row) {
            $output .= '<option value="' . $row->id_materi . '">' . $row->judul_materi . '</option>';
        }
        $this->output->set_content_type('application/JSON')->set_output(json_encode($output));
    }

    public function soal_tugas()
    {
        $data['tittle'] = 'Guru - Data Tugas';
        $data['guru'] = $this->db->get_where('guru', ['email' =>
        $this->session->userdata('email')])->row_array();
        $id_kelas = $data['guru']['id_guru'];
        $data['tugas'] = $this->M_guru->soal_siswa($id_kelas)->result();

        $this->load->view('guru/doc_tugas', $data);
    }

    public function tugas_siswa()
    {

        $data['tittle'] = 'Guru - Tugas Siswa';
        $data['guru'] = $this->db->get_where('guru', ['email' =>
        $this->session->userdata('email')])->row_array();
        $id_kelas = $data['guru']['id_guru'];
        $data['tugas'] = $this->M_guru->jawaban_siswa($id_kelas)->result();

        $this->load->view('guru/tugas_siswa', $data);
    }

    public function delete_tugas($id_siswa)
    {

        $where = array('id_jawab' => $id_siswa);
        $this->M_guru->delete_tugasSiswa($where, 'file_jawaban');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Berhasil Menghapus Jawaban Siswa</div>');
        redirect('guru/guru/tugas_siswa');
    }

    public function tambah_tugas()
    {

        $this->form_validation->set_rules('soal', 'Soal', 'required|trim', ['required' => 'soal tidak boleh kosong']);

        if ($this->form_validation->run() == false) {
            $data['tittle'] = 'Guru - Tambah tugas';
            $data['guru'] = $this->db->get_where('guru', ['email' =>
            $this->session->userdata('email')])->row_array();
            $data['mapel'] = $this->M_mapel->TampilData()->result();
            $id = $data['guru']['id_guru'];
            $data['kelas'] = $this->M_kelas->get_kelas($id);
            $this->load->view('guru/tambah_tugas', $data);
        } elseif ($this->form_validation->run() == true) {
            $data = [
                'soal' => htmlspecialchars($this->input->POST('soal', true)),
                'id_kelas' => htmlspecialchars($this->input->POST('kelas', true)),
                'id_mapel' => htmlspecialchars($this->input->POST('mapel', true)),
                'id_pertemuan' => htmlspecialchars($this->input->POST('pertemuan', true)),

                'id_materi' => htmlspecialchars($this->input->POST('materi', true))
            ];
            $this->db->insert('tugas', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
          tugas berhasil posting </div>');
            redirect('guru/guru/tugas_siswa');
        }
    }

    public function update_tugas($id_tugas)
    {
        $data['tittle'] = 'Edit Tugas';
        $data['guru'] = $this->db->get_where('guru', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['mapel'] = $this->M_mapel->TampilData()->result();
        $id = $data['guru']['id_guru'];
        $data['kelas'] = $this->M_kelas->get_kelas($id);
        $where = array('id_tugas' => $id_tugas);
        $data['edit_tugas'] = $this->M_guru->update_tugas($where, 'tugas')->result();
        $this->load->view('guru/update_tugas', $data);
    }

    public function tugas_edit()
    {

        $id = $this->input->post('id_tugas');
        $soal = $this->input->post('soal');
        $kelas = $this->input->post('kelas');
        $mapel = $this->input->post('mapel');
        $pertemuan = $this->input->post('pertemuan');
        $materi = $this->input->post('materi');


        $data = array(
            'soal' => $soal,
            'id_kelas' => $kelas,
            'id_mapel' => $mapel,
            'id_pertemuan' => $pertemuan,
            'id_materi' => $materi

        );

        $where = array(
            'id_tugas' => $id,
        );

        $this->M_guru->update_data($where, $data, 'tugas');
        $this->session->set_flashdata('success-edit', 'berhasil');
        redirect('guru/guru/soal_tugas');
    }

    public function delete_soal($id_soal)
    {

        $where = array('id_soal' => $id_soal);
        $this->M_guru->delete_soal($where, 'soal_pilgan');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Berhasil Menghapus Soal</div>');
        redirect('guru/guru/data_pilgan');
    }
    public function delete_materi($id_materi)
    {

        $where = array('id_materi' => $id_materi);
        $this->M_guru->delete_soal($where, 'materi');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Berhasil Menghapus materi</div>');
        redirect('guru/guru/data_mapel');
    }
    public function data_pilgan()
    {
        $data['tittle'] = 'olah pilihan ganda';
        $data['guru'] = $this->db->get_where('guru', ['email' =>
        $this->session->userdata('email')])->row_array();
        $id_guru = $data['guru']['id_guru'];
        $data['pilgan'] = $this->M_guru->DataPilgan($id_guru)->result();
        $this->load->view('guru/data_pilgan', $data);
    }

    public function tambah_pilgan()
    {
        $data['tittle'] = 'Tambah Soal Pilihan Ganda';
        $data['guru'] = $this->db->get_where('guru', ['email' =>
        $this->session->userdata('email')])->row_array();
        $id = $data['guru']['id_guru'];
        $data['NamaGuru'] = $this->M_guru->tampil3($id)->result();
        $data['kelas'] = $this->M_kelas->get_kelas($id);

        $this->load->view('guru/tambah_pilgan', $data);
    }

    public function file_config()
    {
        $allowed_type     = [
            "image/jpeg", "image/jpg", "image/png", "image/gif",
            "audio/mpeg", "audio/mpg", "audio/mpeg3", "audio/mp3", "audio/x-wav", "audio/wave", "audio/wav",
            "video/mp4", "application/octet-stream"
        ];
        $config['upload_path']      = FCPATH . 'assets/file_pilgan/';
        $config['allowed_types']    = 'jpeg|jpg|png|gif|mpeg|mpg|mpeg3|mp3|wav|wave|mp4';
        $config['encrypt_name']     = TRUE;

        return $this->load->library('upload', $config);
    }

    public function soal_uploaded()
    {
        $this->form_validation->set_rules('jawaban', 'Kunci Jawaban', 'required');
        $this->form_validation->set_rules('bobot', 'Bobot Soal', 'required|max_length[2]');
        $this->file_config();
        if ($this->form_validation->run() == false) {
            $data['tittle'] = 'Tambah Soal Pilihan Ganda';
            $data['guru'] = $this->db->where('guru', ['email' =>
            $this->session->userdata('email')])->row_array();
            $id = $data['guru']['id_guru'];
            $data['NamaGuru'] = $this->M_guru->tampil3($id)->result();
            $data['kelas'] = $this->M_kelas->get_kelas($id);

            $this->load->view('guru/tambah_pilgan', $data);
        } else {
            $upload_data = $this->upload->data();
            $data = [
                'id_guru'       => $this->input->post('guru', true),
                'id_kelas'      => $this->input->post('kelas', true),
                'id_mapel'      => $this->input->post('mapel', true),
                'id_pertemuan'  => $this->input->post('pertemuan', true),
                'id_materi'     => $this->input->post('materi', true),
                'file'          => $upload_data['file_name'],
                'soal'          => $this->input->post('soal', true),
                'opsi_a'        => $this->input->post('jawaban_a', true),
                'opsi_b'        => $this->input->post('jawaban_b', true),
                'opsi_c'        => $this->input->post('jawaban_c', true),
                'opsi_d'        => $this->input->post('jawaban_d', true),
                'kunci_jawaban'       => $this->input->post('jawaban', true),
                'bobot'         => $this->input->post('bobot', true),
            ];
            $this->db->insert('soal_pilgan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil Menambah Soal </div>');
            redirect('guru/guru/tambah_pilgan');
        }
    }


    public function hasil_ujian()
    {
        $data['tittle'] = 'Hasil Ujian';
        $data['guru'] = $this->db->get_where('guru', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['pilgan'] = $this->M_guru->ujian_peserta('pilgan')->result();
        $this->load->view('guru/hasil_ujian', $data);
    }


    // {
    //     $data['pilgan'] = $this->M_guru->ujian_peserta('pilgan')->result();
    //     require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel.php');
    //     require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

    //     $objPHPExcel = new PHPExcel();

    //     $objPHPExcel->getProperties()->setCreator("SDN 2 Badran Sari");
    //     $objPHPExcel->getProperties()->setLastModifiedBy("SDN 2 Badran Sari");
    //     $objPHPExcel->getProperties()->setTitle("Data Nilai Siswa");
    //     $objPHPExcel->getProperties()->setSubject("");
    //     $objPHPExcel->getProperties()->setDescription("");

    //     $objPHPExcel->setActiveSheetIndex(0);

    //     $objPHPExcel->getActiveSheet()->setCellValue('A1', 'No');
    //     $objPHPExcel->getActiveSheet()->setCellValue('B1', 'id_peserta');
    //     $objPHPExcel->getActiveSheet()->setCellValue('C1', 'id_mapel');
    //     $objPHPExcel->getActiveSheet()->setCellValue('D1', 'id_pertemuan');
    //     $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Nilai');

    //     $baris = 2;
    //     $nomor = 1;

    //     foreach ($data['pilgan'] as $data) {
    //         $objPHPExcel->getActiveSheet()->setCellValue('A' . $baris, $nomor);
    //         $objPHPExcel->getActiveSheet()->setCellValue('B' . $baris, $data->id_peserta);
    //         $objPHPExcel->getActiveSheet()->setCellValue('C' . $baris, $data->id_mapel);
    //         $objPHPExcel->getActiveSheet()->setCellValue('D' . $baris, $data->id_pertemuan);
    //         $objPHPExcel->getActiveSheet()->setCellValue('E' . $baris, $data->nilai);

    //         $nomor++;
    //         $baris++;
    //     }

    //     $filename = "Data-Nilai-Siswa" . date("d-m-Y-H-i-s") . '.xlsx';

    //     $objPHPExcel->getActiveSheet()->setTitle("Data Nilai Siswa");

    //     header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //     header('Content-Disposition: attachment;filename="' . $filename . '"');
    //     header('Cache-Control: max-age=0');

    //     $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    //     $writer->save('php://output');

    //     exit;
    // }
}
