<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function index()
	{
		$this->load->view('tamplate/nav');
		$this->load->view('index');
		$this->load->view('tamplate/footer');
	}

	public function tentang()
	{
		$this->load->view('tamplate/nav');
		$this->load->view('tentang');
		$this->load->view('tamplate/footer');
	}
	public function login_guru()
	{
		$this->load->view('tamplate/auth_header');
		$this->load->view('guru/authguru');
		$this->load->view('tamplate/auth_footer');
	}
}
