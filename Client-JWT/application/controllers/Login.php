<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller {

	function index(){
		$this->load->view('login');
	}

	function aksi_login(){
		$user = $this->input->post('username');
		$pass = $this->input->post('password');

		$cek = $this->Mlogin->aksi_login($user,$pass);

		if($cek){
			redirect("Lampu/");

		}else{
			//$data=array('galon' => "Username dan Password Anda Salah");
			//$this->load->view('login',$data);
			echo "anda galon, gagal login";
		}

		// baca nilai dari fetch
		$data = array(
			"user" => $this->input->post("usernya"),
			"pass" => $this->input->post("passnya"),
		);

		$save = json_decode($this->Client->simple_post(APILAMPU, $data));

		if ($save->result == 0) {
			echo json_encode(array("statusnya" => $save->error));
		} else {
			echo json_encode(array("statusnya" => $save->status));
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect('Login');
	}

}
