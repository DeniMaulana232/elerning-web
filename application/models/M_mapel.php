<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_mapel extends CI_Model
{
    public function TampilData()
    {

        return $this->db->get('mapel');
    }


    public function delete_mapel($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function mapel($id_kelas)
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
    public function detail_mapel($id_mapel)
    {
        $this->db->select('*');
        $this->db->from('mapel');
        // $this->db->join('kelas', 'kelas.id_kelas = pertemuan.id_kelas');
        // $this->db->join('mapel', 'mapel.id_mapel = pertemuan.id_mapel');
        $this->db->join('kelas', 'kelas.id_kelas = mapel.id_kelas');
        $this->db->where('mapel.id_kelas', $id_mapel);

        // $this->db->order_by('mapel.nama_mapel', 'asc');
        // $this->db->order_by('pertemuan.no_pertemuan', 'asc');
        // $this->db->where(array('mapel.nama_mapel', $mapel));
        // $this->db->where(array('nama_kelas' => 'Kelas 1B'));

        return $this->db->get()->result();
    }

    public function get_all_mapel()
    {
        $this->db->select('*');
        $this->db->from('mapel');
        $this->db->order_by('mapel.nama_mapel', 'asc');

        return $this->db->get()->result();
    }
}
