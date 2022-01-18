<?php
defined('BASEPATH') or exit('No direct script access allowed');

class authguru extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->form_validation->set_rules(
            'email',
            'Email',
            'trim|required|valid_email',
            ['required' => 'email tidak boleh kosong'],
            ['valid_email' => 'email tidak valid']
        );

        $this->form_validation->set_rules(
            'password',
            'Password',
            'trim|required|min_length[6]',
            ['required' => 'password tidak boleh kosong'],
            ['min_length' => 'minimal 6 karakter']
        );



        if ($this->form_validation->run() == false) {
            $data['tittle'] = 'Login - Guru';
            $this->load->view('tamplate/auth_header', $data);
            $this->load->view('user/login_guru');
            $this->load->view('tamplate/auth_footer');
        } else {

            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('guru', ['email' => $email])->row_array();

        if ($user) {
            //jika user aktif

            if (password_verify($password, $user['password'])) {
                $data = [
                    'email' => $user['email'],
                    'role_id' => $user['role_id']
                ];
                $this->session->set_userdata($data);

                redirect('guru/guru');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    password salah!! </div>');
                redirect('guru/authguru');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            email belum terdaftar</div>');
            redirect('guru/authguru');
        }
    }



    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Berhasil Keluar </div>');
        redirect('guru/authguru');
    }
}
