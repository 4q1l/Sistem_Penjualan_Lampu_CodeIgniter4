<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller {
	// buat konstruktor
    public function __construct()
    {
        parent::__construct();

        // panggil model "Mlogin"
        $this->load->model("Mlogin", "model", TRUE);

    }

	public function service_login()
	{
		if ($this->authtoken() == 0) {
			return $this->response(array("result" => 0, "error" => "Kode Signature Tidak Sesuai !"), 200);
		} else {
			// ambil paramater token "(kode)"
			$token = $this->get("username");
	
			// panggil fungsi "get_data"
			$hasil = $this->model->get_data(base64_encode($token));
	
			$this->response(array("login" => $hasil, "result" => 1, "error" => ""), 200);
		}
		
		$this->load->model("Mlogin", "model", TRUE);

		$user = $this->input->post('username');
		$pass = $this->input->post('password');
		
		$login = $this->user_model->authenticate($user,$pass);
		if($login)
		{
			$this->session->set_userdata('isLogin1',$login->user_id);
			$this->session->set_userdata('loginstatus',$login->level);
			$this->session->set_userdata('username',$login->username);
		}
		else
		{
			$this->session->set_flashdata('admin_login_msg', 'username atau password salah');
		}
        
	}
	
	public function logout()
	{
		$this->session->unset_userdata('isLogin1');
		$this->session->unset_userdata('loginstatus');
	}
	
	public function cekLogin()
	{
		if($this->session->userdata('isLogin1'))
	}

}