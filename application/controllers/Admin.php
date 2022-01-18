<?php
defined('BASEPATH') or exit('No direct script access allowed');

class admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        cek_admin();
    }

    public function index()
    {

        $data['tittle'] = 'Beranda';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['admin'] = $this->M_guru->updateAdmin()->result();
        $this->load->view('admin/index', $data);
    }
    public function myProfile()
    {
        $data['tittle'] = 'Admin - Ubah Guru';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['admin'] = $this->M_guru->updateAdmin()->result();
        $this->load->view('admin/profile', $data);
    }

    public function kelola_user()
    {
        $data['tittle'] = 'Data User';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('admin/kelolauser', $data);
    }

    public function data_guru()
    {
        $data['tittle'] = 'Kelola Data - Guru';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['guru'] = $this->M_guru->tampil()->result();
        $this->load->view('admin/data_guru', $data);
    }

    public function delete_guru($id_guru)
    {
        $this->load->model('M_guru');
        $where = array('id_guru' => $id_guru);
        $this->M_guru->delete_guru($where, 'guru');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Berhasil Menghapus User Guru</div>');
        redirect('admin/data_guru');
    }

    public function update_guru($id)
    {
        $data['tittle'] = 'Admin - Ubah Guru';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $where = array('id_guru' => $id);
        $data['guru'] = $this->M_guru->updateGuru($where, 'guru')->result();
        $this->load->view('admin/update_guru', $data);
    }

    public function guru_edit()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $nign = $this->input->post('nign');
        $alamat = $this->input->post('alamat');
        $gambar = $_FILES['image']['name'];

        $data = array(
            'nama' => $nama,
            'nign' => $nign,
            'alamat' => $alamat
        );

        $config['allowed_types'] = 'jpg|png|gif|jfif';
        $config['max_size'] = '4096';
        $config['upload_path'] = './assets/img/profile';

        $this->load->library('upload', $config);
        //berhasil
        if ($this->upload->do_upload('image')) {
            $gambarLama = $data['guru']['image'];
            if ($gambarLama != 'default.jpg') {
                unlink(FCPATH . '/assets/img/profile/' . $gambarLama);
            }
            $gambarBaru = $this->upload->data('file_name');
            $this->db->set('image', $gambarBaru);
        } else {
            echo $this->upload->display_errors();
        }

        $where = array(
            'id_guru' => $id,
        );

        $this->M_guru->update_guru($where, $data, 'guru');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Siswa berhasil diubah </div>');
        redirect('admin/data_guru');
    }


    public function tambahguru()
    {
        $this->form_validation->set_rules(
            'name',
            'Name',
            'required|trim|is_unique[guru.nama]',
            ['required' => 'nama tidak boleh kosong',  'is_unique' => 'nama guru sudah terdaftar']
        );
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|trim|valid_email|is_unique[guru.email]',
            [
                'is_unique' => 'email sudah terdaftar', 'required' => 'email tidak boleh kosong'
            ]
        );
        $this->form_validation->set_rules(
            'nign',
            'Nign',
            'required|trim|is_unique[guru.nign]',
            [
                'required' => 'NIGN tidak boleh kosong',  'is_unique' => 'Nomor induk guru sudah terdaftar'
            ]
        );


        $this->form_validation->set_rules(
            'alamat',
            'Alamat',
            'required|trim',
            [
                'required' => 'Alamat tidak boleh kosong'
            ]
        );
        $this->form_validation->set_rules(
            'password1',
            'Password',
            'required|trim|min_length[6]|matches[password2]',
            [
                'matches' => ' ', 'min_length' => 'minimal 6 karakter', 'required' => 'password tidak boleh kosong'
            ]
        );
        $this->form_validation->set_rules(
            'password2',
            'Password',
            'required|trim|matches[password1]',
            [
                'matches' => 'password tidak sama', 'required' => 'tidak boleh kosong'
            ]
        );
        if ($this->form_validation->run() == false) {
            $data['tittle'] = 'Tambah user - Guru';


            $this->load->view('tamplate/auth_header');
            $this->load->view('admin/register_guru', $data);
            $this->load->view('tamplate/auth_footer');
        } else {
            $data = [
                'nama' => htmlspecialchars($this->input->POST('name', true)),
                'email' => htmlspecialchars($this->input->POST('email', true)),
                'nign' => htmlspecialchars($this->input->POST('nign', true)),
                'image' => 'default.jpg',
                'alamat' => htmlspecialchars($this->input->POST('alamat', true)),
                'password' => password_hash($this->input->POST('password1'), PASSWORD_DEFAULT),
                'role_id' => 2

            ];

            $this->db->insert('guru', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            user guru berhasil ditambah </div>');
            redirect('admin/data_guru');
        }
    }


    public function tambahsiswa()
    {

        $this->form_validation->set_rules('name', 'Name', 'required|trim', ['required' => 'nama tidak boleh kosong']);
        $this->form_validation->set_rules('nisn', 'nisn', 'required|trim|is_natural', [
            'is_natural' => 'Hanya angka yang dapat dimasukan', 'required' => 'NISN tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'matches' => ' ', 'min_length' => 'minimal 6 karakter', 'required' => 'password tidak boleh kosong'
        ]);
        $this->form_validation->set_rules(
            'password2',
            'Password',
            'required|trim|matches[password1]',
            [
                'matches' => 'password tidak sama'
            ]
        );

        if ($this->form_validation->run() == false) {

            $data['tittle'] = 'User - Tambah Siswa';
            $this->load->view('tamplate/auth_header', $data);
            $this->load->view('admin/register_siswa');
            $this->load->view('tamplate/auth_footer');
        } else {
            $data = [
                'nama_siswa' => htmlspecialchars($this->input->POST('name', true)),
                'nisn' => htmlspecialchars($this->input->POST('nisn', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->POST('password1'), PASSWORD_DEFAULT),
                'alamat' => htmlspecialchars($this->input->POST('alamat', true)),
                'role_id' => 3


            ];

            $this->db->insert('siswa', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Siswa Berhasil ditambahkan </div>');
            redirect('admin/data_siswa');
        }
    }
    public function data_siswa()
    {
        $data['tittle'] = 'Kelola Data - siswa';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();


        $data['siswa'] = $this->M_siswa->TampilData()->result();
        $this->load->view('admin/data_siswa', $data);
    }

    public function delete_siswa($id)
    {
        $this->load->model('M_siswa');
        $where = array('id' => $id);
        $this->M_siswa->delete_siswa($where, 'siswa');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Berhasil Menghapus User siswa</div>');
        redirect('admin/data_siswa');
    }

    public function update_siswa($id)
    {
        $data['tittle'] = 'Admin - Ubah Siswa';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $where = array('id' => $id);
        $data['siswa'] = $this->M_siswa->update_siswa($where, 'siswa')->result();
        $this->load->view('admin/update_siswa', $data);
    }

    public function user_edit()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $nisn = $this->input->post('nisn');
        $gambar = $_FILES['image']['name'];

        $data = array(
            'nama_siswa' => $nama,
            'nisn' => $nisn,
        );

        $config['allowed_types'] = 'jpg|png|gif|jfif';
        $config['max_size'] = '4096';
        $config['upload_path'] = './assets/img/profile';

        $this->load->library('upload', $config);
        //berhasil
        if ($this->upload->do_upload('image')) {
            $gambarLama = $data['siswa']['image'];
            if ($gambarLama != 'default.jpg') {
                unlink(FCPATH . '/assets/img/profile/' . $gambarLama);
            }
            $gambarBaru = $this->upload->data('file_name');
            $this->db->set('image', $gambarBaru);
        } else {
            echo $this->upload->display_errors();
        }

        $where = array(
            'id' => $id,
        );

        $this->M_siswa->update_data($where, $data, 'siswa');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Siswa berhasil diubah </div>');
        redirect('admin/data_siswa');
    }

    public function kelola_kelas()
    {
        $data['tittle'] = 'Admin - Kelola Kelas';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['kelas'] = $this->M_kelas->TampilData()->result();
        // $data['guru'] = $this->M_guru->TampilData()->result();

        $this->load->view('admin/kelolakelas', $data);
    }

    public function tambah_kelas()
    {

        $this->form_validation->set_rules('kelas', 'Kelas', 'required|trim', ['required' => 'nama kelas tidak boleh kosong']);
        $this->form_validation->set_rules(
            'tipe_kelas',
            'Tipe_kelas',
            'required|trim',
            ['required' => 'nama kelas tidak boleh kosong']
        );

        if ($this->form_validation->run() == false) {

            $data['user'] = $this->db->get_where('user', ['email' =>
            $this->session->userdata('email')])->row_array();
            $data['guru'] = $this->M_guru->tampil()->result();
            $data['tipe'] = $this->M_kelas->tipekelas()->result();

            $this->load->view('user/tambah_kelas', $data);
        } elseif ($this->form_validation->run() == true) {
            $data = [
                'nama_kelas' => htmlspecialchars($this->input->POST('kelas', true)),
                'id_tipe' => htmlspecialchars($this->input->POST('tipe_kelas', true)),
                'id_guru' => htmlspecialchars($this->input->POST('id_guru', true))
            ];

            $this->db->insert('kelas', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            kelas berhasil ditambah </div>');
            redirect('admin/kelola_kelas');
        }
    }

    public function delete_kelas($id_kelas)
    {
        $this->load->model('M_kelas');
        $where = array('id_kelas' => $id_kelas);
        $this->M_kelas->delete_kelas($where, 'kelas');
        $error = $this->db->error();
        if ($error['code'] != 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
            Harus Menghapus Mata pelajaran pada kelas ini Dahulu</div>');
        } else {

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil Menghapus Data</div>');
        }


        redirect('admin/kelola_kelas');
    }

    //matapelajaran\
    public function data_mapel()
    {
        $data['tittle'] = 'Admin - Mata Pelajaran';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        // $data['mapel'] = $this->M_mapel->TampilData()->result();
        $this->load->view('admin/data_mapel', $data);
    }
    public function isi_mapel($id_mapel)
    {
        $data['tittle'] = 'Admin - Mata Pelajaran';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['pertemuan'] = $this->M_mapel->detail_mapel($id_mapel);
        $this->load->view('admin/mapel/isi_mapel', $data);
    }

    public function tambah_mapel()
    {
        $this->form_validation->set_rules('mapel', 'Mapel', 'required|trim', ['required' => 'Matapelajaran tidak boleh kosong']);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim', ['required' => 'Deskripsi tidak boleh kosong']);

        if ($this->form_validation->run() == false) {

            $data['user'] = $this->db->get_where('user', ['email' =>
            $this->session->userdata('email')])->row_array();
            $data['kelas'] = $this->M_kelas->TampilData()->result();
            $this->load->view('admin/tambah_mapel', $data);
        } elseif ($this->form_validation->run() == true) {
            $data = [
                'nama_mapel' => htmlspecialchars($this->input->POST('mapel', true)),

                'deskripsi' => htmlspecialchars($this->input->POST('deskripsi', true)),
                'id_kelas' => htmlspecialchars($this->input->POST('kelas', true))
            ];

            $this->db->insert('mapel', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Matapelajaran berhasil ditambah </div>');
            redirect('admin/tambah_mapel');
        }
    }
    public function delete_mapel($id_mapel)
    {
        $this->load->model('M_mapel');
        $where = array('id_mapel' => $id_mapel);
        $this->M_kelas->delete_kelas($where, 'mapel');
        $error = $this->db->error();
        if ($error['code'] != 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
            Harus Menghapus data Pertemuan Dahulu</div>');
        } else {

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil Menghapus Data</div>');
        }

        redirect('admin/data_mapel');
    }
    //mapel javascript
    public function getMapel()
    {
        $id_kelas = $this->input->POST('id_kelas');
        $data = $this->M_pertemuan->getDataMapel($id_kelas);
        $output = '<option value="">--Matapelajaran-- </option>';
        foreach ($data as $row) {
            $output .= '<option value="' . $row->id_mapel . '">' . $row->nama_mapel . '</option>';
        }
        $this->output->set_content_type('application/JSON')->set_output(json_encode($output));
    }

    //akhir matapelajaran
    public function kelas3()
    {
        $data['tittle'] = 'pertemuan';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->view('admin/kelas/kelas3', $data);
    }

    public function isi_pertemuan($id_kelas)
    {
        $data['tittle'] = 'pertemuan';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['pertemuan'] = $this->M_pertemuan->detail_pertemuan($id_kelas);
        $this->load->view('admin/kelas/isi_pertemuan', $data);
    }


    public function delete_pertemuan($id_pertemuan)
    {
        $where = array('id_pertemuan' => $id_pertemuan);
        $this->M_pertemuan->delete_pertemuan($where, 'pertemuan');
        $error = $this->db->error();
        if ($error['code'] != 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
            Harus Menghapus data Materi Dahulu</div>');
        } else {

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil Menghapus Data</div>');
        }

        redirect('admin/kelas3');
    }

    public function pertemuan()
    {
        $data['tittle'] = 'Admin - Pertemuan';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        // $data['pertemuan'] = $this->M_pertemuan->TampilData()->result();
        $this->load->view('admin/pertemuan/daftar_kelas', $data);
    }

    public function tambah_pertemuan()
    {
        $this->form_validation->set_rules('nomor', 'Nomor', 'required|trim', ['required' => 'Nomor Pertemuan tidak boleh kosong']);

        if ($this->form_validation->run() == false) {
            $data['user'] = $this->db->get_where('user', ['email' =>
            $this->session->userdata('email')])->row_array();
            $data['mapel'] = $this->M_mapel->TampilData()->result();
            $data['kelas'] = $this->M_kelas->TampilData()->result();
            $this->load->view('admin/tambah_pertemuan', $data);
        } elseif ($this->form_validation->run() == true) {
            $data = [
                'no_pertemuan' => htmlspecialchars($this->input->POST('nomor', true)),
                'id_mapel' => htmlspecialchars($this->input->POST('mapel')),
                'id_kelas' => htmlspecialchars($this->input->POST('kelas', true))
            ];
            $this->db->insert('pertemuan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Matapelajaran berhasil ditambah </div>');
            redirect('admin/kelas3');
        }
    }

    public function pengumuman()
    {
        $this->form_validation->set_rules('pengumuman', 'Pengumuman', 'required|trim', ['required' => 'tidak boleh kosong']);

        if ($this->form_validation->run() == false) {
            $data['tittle'] = 'Pengumuman';
            $data['user'] = $this->db->get_where('user', ['email' =>
            $this->session->userdata('email')])->row_array();
            $this->load->view('admin/pengumuman', $data);
        } elseif ($this->form_validation->run() == true) {
            $data = [
                'deskripsi_umum' => ($this->input->POST('pengumuman', true)),
            ];
            $this->db->insert('pengumuman', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Pengumuman berhasil posting </div>');
            redirect('admin/pengumuman');
        }
    }
    public function list_pengumuman()
    {
        $data['tittle'] = 'Pengumuman';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['umum'] = $this->M_siswa->pengumuman()->result();
        $this->load->view('admin/list_pengumuman', $data);
    }
    public function delete_pengumuman($id_pengumuman)
    {
        $this->load->model('M_kelas');
        $where = array('id_pengumuman' => $id_pengumuman);
        $this->M_kelas->delete_pengumuman($where, 'pengumuman');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Berhasil Menghapus pengumuman</div>');
        redirect('admin/list_pengumuman');
    }
}
