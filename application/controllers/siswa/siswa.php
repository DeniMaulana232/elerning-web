<?php
defined('BASEPATH') or exit('No direct script access allowed');

class siswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        cek_siswa();
    }

    public function index()
    {
        $data['tittle'] = 'Siswa';

        $data['siswa'] = $this->db->get_where('siswa', ['nama_siswa' =>
        $this->session->userdata('name')])->row_array();
        $data['tipe'] = $this->M_kelas->tipekelas()->result();
        $data['pengumuman'] = $this->M_siswa->pengumuman()->result();
        $this->load->view('siswa/index', $data);
    }


    public function myProfile()
    {
        $data['tittle'] = 'My Profile';
        $data['siswa'] = $this->db->get_where('siswa', ['nama_siswa' =>
        $this->session->userdata('name')])->row_array();
        $data['user'] = $this->M_siswa->ProfileSiswa()->result();
        $this->load->view('siswa/profile', $data);
    }

    public function kelas($id_tipe)
    {
        $data['tittle'] = 'Kelas';
        $data['siswa'] = $this->db->get_where('siswa', ['nama_siswa' =>
        $this->session->userdata('name')])->row_array();
        $data['kelas'] = $this->M_siswa->detail_kelas($id_tipe);
        $this->load->view('siswa/kelas/kelas', $data);
    }
    public function mapel($id_kelas)
    {
        $data['tittle'] = 'Matapelajaran';
        $data['siswa'] = $this->db->get_where('siswa', ['nama_siswa' =>
        $this->session->userdata('name')])->row_array();
        $data['mapel'] = $this->M_siswa->detail_mapel($id_kelas);
        $this->load->view('siswa/mapel', $data);
    }
    public function pertemuan($id_mapel)
    {
        $data['tittle'] = 'Pertemuan';
        $data['siswa'] = $this->db->get_where('siswa', ['nama_siswa' =>
        $this->session->userdata('name')])->row_array();
        $data['pertemuan'] = $this->M_siswa->detail_pertemuan($id_mapel);
        $this->load->view('siswa/pertemuan', $data);
    }
    public function materi($id_pertemuan)
    {
        $data['tittle'] = 'Materi Siswa';
        $data['siswa'] = $this->db->get_where('siswa', ['nama_siswa' =>
        $this->session->userdata('name')])->row_array();
        $data['materi'] = $this->M_siswa->detail_materi($id_pertemuan);
        $this->load->view('siswa/materi', $data);
    }


    public function kumpul_tugas($id_materi)
    {
        $data['tittle'] = 'Upload Tugas';
        $data['siswa'] = $this->db->get_where('siswa', ['nama_siswa' =>
        $this->session->userdata('name')])->row_array();
        $data['tugas'] = $this->M_siswa->detail_tugas($id_materi);
        $id = $data['siswa']['id'];
        $data['siswaa'] = $this->M_siswa->session_siswa($id)->result();

        $this->load->view('siswa/kumpul_tugas', $data, array('error' => ''));
        $config['upload_path']          = './assets/tugas/';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['max_size']             = 2048;
        $config['overwrite']            = true;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('file')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $upload_data = $this->upload->data();

            $data = [
                'id_guru' => htmlspecialchars($this->input->POST('kelas', true)),
                'file_tugas' => $upload_data['file_name'],
                'id' => htmlspecialchars($this->input->POST('siswa', true)),

            ];

            $this->db->insert('file_jawaban', $data);
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">
            materi berhasil ditambah </div>');
            redirect('siswa/siswa/kumpul_tugas/' . $id_materi);
        }
    }

    public function TestPrepare($id_materi)
    {
        $this->form_validation->set_rules('id_soal', 'ID', 'required');

        if ($this->form_validation->run() == false) {
            $data['tittle'] = 'Latihan pilihan ganda';
            $data['siswa'] = $this->db->get_where('siswa', ['nama_siswa' =>
            $this->session->userdata('name')])->row_array();

            $data['prepare'] = $this->M_siswa->getPrepareSoal($id_materi);

            $this->load->view('siswa/prepare', $data);
        } else {
            redirect('siswa/siswa/ujian/' . $id_materi);
        }
    }
}
