<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Pertemuan extends CI_Model
{
    public function TampilData()
    {
        return $this->db->get('pertemuan');
    }

    public function delete_pertemuan($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function kelas($id_kelas)
    {
        $this->db->select('*');
        $this->db->from('kelas');
        // $this->db->join('kelas', 'kelas.id_kelas = pertemuan.id_kelas');
        // $this->db->join('mapel', 'mapel.id_mapel = pertemuan.id_mapel');
        $this->db->where('id_kelas', $id_kelas);
        // $this->db->where(array('mapel.nama_mapel', $mapel));
        // $this->db->where(array('nama_kelas' => 'Kelas 1B'));

        return $this->db->get()->row();
    }
    public function detail_pertemuan($id_kelas)
    {
        $this->db->select('*');
        $this->db->from('pertemuan');
        // $this->db->join('kelas', 'kelas.id_kelas = pertemuan.id_kelas');
        $this->db->join('mapel', 'mapel.id_mapel = pertemuan.id_mapel');
        $this->db->join('kelas', 'kelas.id_kelas = pertemuan.id_kelas');
        $this->db->where('pertemuan.id_kelas', $id_kelas);

        $this->db->order_by('mapel.nama_mapel', 'asc');
        $this->db->order_by('pertemuan.no_pertemuan', 'asc');
        // $this->db->where(array('mapel.nama_mapel', $mapel));
        // $this->db->where(array('nama_kelas' => 'Kelas 1B'));

        return $this->db->get()->result();
    }

    public function pertemuan($where, $table)
    {
        return $this->db->get_where($table, $where);
    }
    public function getDataMapel($id_kelas)
    {
        return $this->db->get_where('mapel', ['id_kelas' => $id_kelas])->result();
    }
    public function getDataTemu($id_mapel)
    {
        return $this->db->get_where('pertemuan', ['id_mapel' => $id_mapel])->result();
    }
    public function getDataMateri($id_pertemuan)
    {
        return $this->db->get_where('materi', ['id_pertemuan' => $id_pertemuan])->result();
    }
}
