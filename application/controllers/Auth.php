<?php
defined('BASEPATH') or exit('No direct script access allowed');

class auth extends CI_Controller
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
            $data['tittle'] = 'Halaman Login';
            $this->load->view('tamplate/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('tamplate/auth_footer');
        } else {
            // ketika validasi lolos/sukses
            $this->_login();
        }
    }
    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            //jika user aktif

            if ($user['is_active'] == 1) {
                //cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);

                    redirect('admin');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    password salah!! </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            email belum aktif </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            email belum terdaftar</div>');
            redirect('auth');
        }
    }

    public function registration()
    {

        $this->form_validation->set_rules(
            'name',
            'Name',
            'required|trim',
            ['required' => 'nama tidak boleh kosong']
        );
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|trim|valid_email|is_unique[user.email]',
            [
                'is_unique' => 'email sudah terdaftar', 'required' => 'email tidak boleh kosong'
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
                'matches' => 'password tidak sama'
            ]
        );

        if ($this->form_validation->run() == false) {

            $data['tittle'] = 'Register auth';
            $this->load->view('tamplate/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('tamplate/auth_footer');
        } else {
            $data = [
                'username' => htmlspecialchars($this->input->POST('name', true)),
                'email' => htmlspecialchars($this->input->POST('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->POST('password1'), PASSWORD_DEFAULT),
                'role_id' => 1,
                'is_active' => 1

            ];

            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            selamat anda berhasil mendaftar </div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Berhasil Keluar </div>');
        redirect('auth');
    }
}
