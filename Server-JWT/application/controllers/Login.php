<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct(){
		parent::__construct();

		$this->load->model('Mlogin');
	}

	
	public function index()
	{
		$data['title'] = "Login";
		$this->load->view('login',$data);
	}

	public function service_login()
	{
		$this->load->model('Mlogin');
		
		$user = $this->input->post('username');
		$pass = $this->input->post('password');
		
		$login = $this->user_model->authenticate($user,$pass);
		if($login)
		{
			$this->session->set_userdata('isLogin1',$login->user_id);
			$this->session->set_userdata('loginstatus',$login->level);
			$this->session->set_userdata('username',$login->user);
			
			redirect('Lampu/');
		}
		else
		{
			$this->session->set_flashdata('admin_login_msg', 'username atau password salah');
			redirect('login');
		}
        
	}
	
	public function logout()
	{
		$this->session->unset_userdata('isLogin1');
		$this->session->unset_userdata('loginstatus');
		redirect('login');
	}
	
	public function cekLogin()
	{
		if($this->session->userdata('isLogin1'))
			redirect('Lampu');
	}

}