
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_siswa extends CI_Model
{
    public function TampilData()
    {
        return $this->db->get('siswa');
    }
    public function session_siswa($id)
    {
        $this->db->select('*');
        $this->db->from('siswa');
        $this->db->where('siswa.id', $id);
        return $this->db->get();
    }

    public function delete_siswa($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function detail_kelas($id_tipe)
    {
        $this->db->select('*');
        $this->db->from('kelas');
        $this->db->join('tipe_kelas', 'tipe_kelas.id_tipe = kelas.id_tipe');
        $this->db->join('guru', 'guru.id_guru = kelas.id_guru');
        // $this->db->join('guru', 'guru.id_guru = tipe_kelas.id_tipe');
        $this->db->where('kelas.id_tipe', $id_tipe);

        return $this->db->get()->result();
    }

    public function detail_mapel($id_kelas)
    {
        $this->db->select('*');
        $this->db->from('mapel');
        $this->db->join('kelas', 'kelas.id_kelas = mapel.id_kelas');
        $this->db->where('mapel.id_kelas', $id_kelas);
        return $this->db->get()->result();
    }
    public function detail_pertemuan($id_mapel)
    {
        $this->db->select('*');
        $this->db->from('pertemuan');
        $this->db->join('mapel', 'mapel.id_mapel = pertemuan.id_mapel');
        $this->db->where('pertemuan.id_mapel', $id_mapel);
        return $this->db->get()->result();
    }

    public function detail_materi($id_pertemuan)
    {
        $this->db->select('*');
        $this->db->from('materi a');
        $this->db->join('pertemuan b', 'b.id_pertemuan = a.id_pertemuan');
        $this->db->join('kelas c', 'c.id_kelas = a.id_kelas');
        $this->db->join('guru d', 'd.id_guru = a.id_guru');
        $this->db->where('a.id_pertemuan', $id_pertemuan);
        return $this->db->get()->result();
    }

    public function detail_tugas($id_materi)
    {
        $this->db->select('*');
        $this->db->from('materi');
        $this->db->join('tugas', 'tugas.id_materi = materi.id_materi');
        $this->db->join('guru', 'guru.id_guru = materi.id_guru');
        // $this->db->join('materi', 'materi.id_materi = tugas.id_tugas');
        $this->db->where('materi.id_materi', $id_materi);
        return $this->db->get()->result();
    }

    public function getPrepareSoal($id_materi)
    {
        $this->db->select('*');
        $this->db->from('materi');
        // $this->db->join('kelas', 'kelas.id_kelas = materi.id_kelas');
        $this->db->join('pertemuan', 'pertemuan.id_pertemuan = materi.id_pertemuan');
        $this->db->where('materi.id_materi', $id_materi);
        return $this->db->get()->result();
    }

    public function pengumuman()
    {
        return $this->db->get('pengumuman');
    }

    // $query=mysqli_query("select * from tbl_soal where id_soal='$nomor' and knc_jawaban='$jawaban'");

    public function ujian($id_pertemuan)
    {
        $this->db->select('*');
        $this->db->from('soal_pilgan');
        $this->db->where('soal_pilgan.id_pertemuan', $id_pertemuan);
        return $this->db->get();
    }

    public function UpdateNilai($id_jawaban, $data)
    {
        $this->db->where('id_jawaban', $id_jawaban);
        $this->db->update('tb_jawaban', $data);
    }

    public function UpdateNilai2($id_peserta, $data)
    {
        $this->db->where('id_peserta', $id_peserta);
        $this->db->update('tb_peserta', $data);
    }

    public function cekJawaban($id_pertemuan)
    {
        $data['siswa'] = $this->db->get_where('siswa', ['nama_siswa' =>
        $this->session->userdata('name')])->row_array();
        $id = $data['siswa']['id'];
        $this->db->select('*');
        $this->db->from('tb_jawaban');
        $this->db->join('soal_pilgan', 'soal_pilgan.id_soal = tb_jawaban.id_soal');
        // $this->db->join('tb_peserta', 'tb_peserta.id_peserta = tb_jawaban.id_peserta');
        $this->db->where('tb_jawaban.id', $id);
        $this->db->where('tb_jawaban.id_pertemuan', $id_pertemuan);
        return $this->db->get();
    }

    public function nilai($id_pertemuan)
    {
        $data['siswa'] = $this->db->get_where('siswa', ['nama_siswa' =>
        $this->session->userdata('name')])->row_array();
        $id = $data['siswa']['id'];
        $this->db->select('*');
        $this->db->from('tb_peserta');
        $this->db->where('tb_peserta.id', $id);
        $this->db->where('tb_peserta.id_pertemuan', $id_pertemuan);

        return $this->db->get();
    }

    public function Jawaban($id)
    {


        $this->db->select('*');
        $this->db->from('tb_jawaban');
        // $this->db->join('tb_jawaban', 'tb_jawaban.id_soal = soal_pilgan.id_soal');
        $this->db->where('tb_jawaban.id_peserta', $id);
        return $this->db->get();
    }

    public function getSum()
    {
        $sql = "SELECT sum(skor) as skor FROM tb_jawaban WHERE tb_jawaban.id";
        $result = $this->db->query($sql);
        return $result->row()->skor;
    }
    public function getSumSoal()
    {
        $sql = "SELECT sum(id_soal) as id_soal FROM soal_pilgan Where soal_pilgan.id_pertemuan";
        $result = $this->db->query($sql);
        return $result->row()->id_soal;
    }

    public function getPertemuan($id_pertemuan)
    {
        $this->db->select('*');
        $this->db->from('materi');
        $this->db->join('pertemuan', 'pertemuan.id_pertemuan = materi.id_pertemuan');
        $this->db->join('guru', 'guru.id_guru = materi.id_guru');
        $this->db->join('mapel', 'mapel.id_mapel = materi.id_mapel');
        $this->db->where('materi.id_pertemuan', $id_pertemuan);
        return $this->db->get();
    }
    public function getGuru($id_materi)
    {
        $this->db->select('*');
        $this->db->from('materi');
        $this->db->join('guru', 'guru.id_guru = materi.id_guru');
        $this->db->where('materi.id_guru', $id_materi);
        return $this->db->get();
    }

    public function update_siswa($where, $table)
    {
        return $this->db->get_where($table, $where);
    }
    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function ProfileSiswa()
    {
        $data['siswa'] = $this->db->get_where('siswa', ['nama_siswa' =>
        $this->session->userdata('name')])->row_array();
        $id = $data['siswa']['id'];
        $this->db->select('*');
        $this->db->from('siswa');
        $this->db->where('siswa.id', $id);
        return $this->db->get();
    }
}
