<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_kelas extends CI_Model
{
    public function TampilData()
    {
        $this->db->select('*');
        $this->db->from('kelas');
        $this->db->join('guru', 'guru.id_guru = kelas.id_guru');
        $this->db->join('tipe_kelas', 'tipe_kelas.id_tipe = kelas.id_tipe');
        $this->db->order_by('kelas.nama_kelas', 'asc');
        return $this->db->get();

        // $query = "SELECT `kelas`.`id_kelas`,`kelas`.`nama_kelas`, `guru`.`nama` ,`kelas`.`tipe`
        // FROM `kelas`
        // INNER JOIN guru ON `kelas`.`id_guru` = `guru`.`id_guru`  ";

        // return $this->db->query($query);
    }
    public function Data()
    {
        return $this->db->get('kelas');
    }

    public function delete_kelas($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function delete_pengumuman($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }


    public function get_all_kelas()
    {
        $this->db->select('*');
        $this->db->from('kelas');
        $this->db->order_by('kelas.nama_kelas', 'asc');

        return $this->db->get()->result();
    }

    public function get_kelas($id)
    {
        $this->db->select('*');
        $this->db->from('kelas');
        $this->db->join('guru', 'guru.id_guru = kelas.id_guru');
        $this->db->where('kelas.id_guru', $id);
        return $this->db->get()->result();
    }

    public function tipekelas()
    {
        return $this->db->get('tipe_kelas');
    }
}
