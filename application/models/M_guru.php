<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_guru extends CI_Model
{
    public function TampilData()
    {

        $query = "SELECT `guru`.`nign`, `guru`.`nama`, `guru`.`email`,`mapel`.`nama_mapel` 
            FROM `guru`
            INNER JOIN mapel ON `guru`.`id_mapel` = `mapel`.`id_mapel`";

        return $this->db->query($query);
    }

    public function delete_guru($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function tampil()
    {
        return $this->db->get('guru');
    }
    public function tampil2()
    {
        $this->db->select('*');
        $this->db->from('kelas');
        $this->db->join('guru', 'guru.id_guru = kelas.id_guru');
        return $this->db->get();
    }
    public function tampil3($id)
    {
        $this->db->select('*');
        $this->db->from('guru');
        $this->db->join('kelas', 'kelas.id_guru = guru.id_guru');
        $this->db->where('guru.id_guru', $id);
        return $this->db->get();
    }
    //db tugas

    public function tugas_siswa($id)
    {
        $this->db->select('*');
        $this->db->from('tugas ');
        $this->db->join('kelas', 'kelas.id_kelas = tugas.id_kelas');
        $this->db->join('pertemuan ', 'pertemuan.id_pertemuan = tugas.id_pertemuan');
        $this->db->join('mapel ', 'mapel.id_mapel = tugas.id_mapel');
        $this->db->join('materi ', 'materi.id_materi = tugas.id_materi');
        $this->db->where('kelas.id_guru', $id);
        return $this->db->get();
    }

    public function soal_siswa($id_kelas)
    {
        $this->db->select('*');
        $this->db->from('kelas');
        $this->db->join('guru', 'guru.id_guru = kelas.id_guru');
        $this->db->join('tugas', 'tugas.id_kelas = kelas.id_kelas');
        $this->db->where('kelas.id_guru', $id_kelas);
        return $this->db->get();
    }

    public function update_tugas($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    public function delete_tugas($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function delete_soal($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function delete_tugasSiswa($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function jawaban_siswa($id_kelas)
    {
        $this->db->select('*');
        $this->db->from('file_jawaban');
        $this->db->join('guru', 'guru.id_guru = file_jawaban.id_guru');
        $this->db->join('siswa', 'siswa.id = file_jawaban.id');
        // $this->db->join('materi', 'siswa.id_materi = file_jawaban.id_materi');
        $this->db->where('file_jawaban.id_guru', $id_kelas);
        return $this->db->get();
    }
    public function DataPilgan($id_guru)
    {
        $this->db->select('*');
        $this->db->from('soal_pilgan');
        $this->db->join('guru', 'guru.id_guru = soal_pilgan.id_guru');
        $this->db->join('kelas', 'kelas.id_kelas = soal_pilgan.id_kelas');
        $this->db->join('materi', 'materi.id_materi = soal_pilgan.id_materi');
        $this->db->join('mapel', 'mapel.id_mapel = soal_pilgan.id_mapel');
        $this->db->join('pertemuan', 'pertemuan.id_pertemuan = soal_pilgan.id_pertemuan');
        $this->db->where('soal_pilgan.id_guru', $id_guru);

        return $this->db->get();
    }

    public function ujian_peserta()
    {
        $data['guru'] = $this->db->get_where('guru', ['email' =>
        $this->session->userdata('email')])->row_array();
        $id = $data['guru']['id_guru'];
        $this->db->select('*');
        $this->db->from('tb_peserta');
        $this->db->join('guru', 'guru.id_guru = tb_peserta.id_guru');
        $this->db->join('siswa', 'siswa.id = tb_peserta.id');
        $this->db->join('mapel', 'mapel.id_mapel = tb_peserta.id_mapel');
        $this->db->join('pertemuan', 'pertemuan.id_pertemuan = tb_peserta.id_pertemuan');
        $this->db->where('tb_peserta.id_guru', $id);
        return $this->db->get();
    }
    public function excel()
    {
        return $this->db->get('tb_peserta');
    }
    public function getSoalById($id)
    {
        return $this->db->get_where('soal_pilgan', ['id_soal' => $id])->row();
    }

    public function updateGuru($where, $table)
    {
        return $this->db->get_where($table, $where);
    }
    public function update_guru($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    public function updateAdmin()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $id = $data['user']['id'];
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user.id', $id);
        return $this->db->get();
    }
    public function ProfileGuru()
    {
        $data['guru'] = $this->db->get_where('guru', ['email' =>
        $this->session->userdata('email')])->row_array();
        $id = $data['guru']['id_guru'];
        $this->db->select('*');
        $this->db->from('guru');
        $this->db->where('guru.id_guru', $id);
        return $this->db->get();
    }
    public function update_admin($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
