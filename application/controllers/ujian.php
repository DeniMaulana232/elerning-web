<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ujian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        cek_siswa();
    }


    public function index($id_pertemuan)
    {
        $data['siswa'] = $this->db->get_where('siswa', ['nama_siswa' =>
        $this->session->userdata('name')])->row_array();
        $id_peserta = $this->uri->segment(3);
        $id = $data['siswa']['id'];
        $data['user'] = $this->M_siswa->session_siswa($id)->result();
        $id = $this->db->query('SELECT * FROM siswa WHERE id="' . $id_peserta . '"  ')->row_array();
        $data['soal'] = $this->M_siswa->ujian($id_pertemuan)->result();
        $data['temu'] = $this->M_siswa->getPertemuan($id_pertemuan)->result();

        // $this->M_siswa->update_data($where,  'siswa');


        $this->load->view('ujian/index', $data);
    }

    public function jawab_aksi()
    {

        $id_peserta = $this->input->post('id_peserta');
        $jumlah     = $_POST['jumlah_soal'];
        $id_soal     = $_POST['soal'];
        $jawaban     = $_POST['jawaban'];
        $temu       = $_POST['temu'];
        $guru       = $_POST['guru'];
        $mapel       = $_POST['mapel'];
        for ($i = 0; $i < $jumlah; $i++) {
            $nomor = $id_soal[$i];
            $jawaban[$nomor];
            $data[] = array(
                'id' => $id_peserta,
                'id_soal' => $nomor,
                'jawaban' => $jawaban[$nomor],
                'id_pertemuan' => $temu,
                'id_guru' => $guru,
                'id_mapel' => $mapel
            );
        }
        $this->db->insert_batch('tb_jawaban', $data);
        $cek = $this->db->query('SELECT id_jawaban, jawaban, soal_pilgan.kunci_jawaban FROM tb_jawaban join soal_pilgan ON tb_jawaban.id_soal = soal_pilgan.id_soal WHERE id="' . $id_peserta . '"');
        $jumlah = $cek;
        foreach ($cek->result_array() as $d) {
            $where = $d['id_jawaban'];
            if ($d['jawaban'] == $d['kunci_jawaban']) {
                $data = array(
                    'skor' => 1,
                );
                $this->M_siswa->UpdateNilai($where, $data, 'tb_jawaban');
            } else {
                $data = array(
                    'skor' => 0,
                );
                $this->M_siswa->UpdateNilai($where, $data, 'tb_jawaban');
            }
        }
        $benar = 0;
        $salah = 0;
        $total_nilai = 0;
        $cek2 = $this->db->query('SELECT id_jawaban, jawaban, skor, soal_pilgan.kunci_jawaban FROM tb_jawaban join soal_pilgan ON tb_jawaban.id_soal = soal_pilgan.id_soal WHERE id="' . $id_peserta . '"');
        $jumlah = $cek2->num_rows();
        $where = $id_peserta;
        foreach ($cek2->result_array() as $c) {
            if ($c['jawaban'] == $c['kunci_jawaban']) {
                $benar++;
            } else {
                $salah++;
            }
            $total_nilai += $c['skor'] / $jumlah * 100;
        }
        $data = array(
            'id'    => $id_peserta,
            'id_pertemuan' => $temu,
            'benar' => $benar,
            'salah' => $salah,
            'nilai' => $total_nilai,
            'id_guru' => $guru,
            'id_mapel' => $mapel
        );
        $this->db->insert('tb_peserta', $data);
        redirect(base_url('siswa/siswa/index'));
    }

    // public function index($id_pertemuan)
    // {
    //     $data['siswa'] = $this->db->get_where('siswa', ['nama_siswa' =>
    //     $this->session->userdata('name')])->row_array();
    //     $data['soal'] = $this->M_siswa->ujian($id_pertemuan)->result();
    //     $data['total_soal'] = $this->M_siswa->ujian($id_pertemuan)->num_row();
    //     $this->load->view('ujian/index', $data);
    // }

    public function review($id_pertemuan)
    {
        $data['tittle'] = 'Guru - SDN 2 Badran Sari';
        $data['siswa'] = $this->db->get_where('siswa', ['nama_siswa' =>
        $this->session->userdata('name')])->row_array();
        $data['cek'] = $this->M_siswa->cekJawaban($id_pertemuan)->result();
        // $data['jwb'] = $this->M_siswa->Jawaban($id)->result();
        $data['sum'] = $this->M_siswa->nilai($id_pertemuan)->result();
        $this->load->view('ujian/review', $data);
    }
}
