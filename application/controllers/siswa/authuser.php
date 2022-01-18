<?php
defined('BASEPATH') or exit('No direct script access allowed');

class authuser extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }


    public function index()
    {
        $this->form_validation->set_rules(
            'name',
            'Name',
            'required|trim',
            ['required' => 'Username tidak boleh kosong']
        );
        $this->form_validation->set_rules(
            'password',
            'Password',
            'trim|required|min_length[6]',
            ['required' => 'password tidak boleh kosong'],
            ['min_length' => 'minimal 6 karakter']
        );

        if ($this->form_validation->run() == false) {
            $data['tittle'] = 'Website elearning - Login User';
            $this->load->view('tamplate/auth_header', $data);
            $this->load->view('user/login');
            $this->load->view('tamplate/auth_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $nama = $this->input->post('name');
        $password = $this->input->post('password');

        $siswa = $this->db->get_where('siswa', ['nama_siswa' => $nama])->row_array();

        if ($siswa) {
            //cek password
            if (password_verify($password, $siswa['password'])) {
                $data = [
                    'name' => $siswa['nama_siswa'],
                    'role_id' => $siswa['role_id']
                ];
                $this->session->set_userdata($data);

                redirect('siswa/siswa');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    password salah!! </div>');
                redirect('siswa/authuser');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Siswa belum terdaftar </div>');
            redirect('siswa/authuser');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('nama_siswa');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Berhasil Keluar </div>');
        redirect('siswa/authuser');
    }
}
