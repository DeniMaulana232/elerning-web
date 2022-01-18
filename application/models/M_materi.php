
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_materi extends CI_Model
{
    public function TampilData()
    {
        return $this->db->get('materi');
    }
    public function materi_user($id)
    {
        $this->db->select('*');
        $this->db->from('materi');
        $this->db->join('guru', 'guru.id_guru = materi.id_guru');
        $this->db->join('mapel', 'mapel.id_mapel = materi.id_mapel');
        $this->db->join('pertemuan', 'pertemuan.id_pertemuan = materi.id_pertemuan');
        $this->db->where('materi.id_guru', $id);
        return $this->db->get()->result();
    }
    public function getMateri()
    {
        $this->db->select('*');
        $this->db->from('materi');
        // $this->db->where('materi.id_pertemuan');
        // $this->db->from('pertemuan');
        // $this->db->join('materi', 'materi.id_pertemuan = pertemuan.id_pertemuan');
        return $this->db->get();
    }
    public function DataMateri($nama)
    {
        $this->db->select('*');
        $this->db->where('nama', $nama);

        $query = $this->db->get('materi');
        return $query->result_array();
    }
}
