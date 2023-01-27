<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->_rules();
		if ($this->form_validation->run() == FALSE){
			$data['title'] = "Form - Login";
            $this->load->view('templates_admin/header',$data);
			$this->load->view('welcome_message',$data);
        } else {
			$send = array('username' => $this->input->post('username'), 'password' => $this->input->post('password'));
			$check = json_decode($this->client->simple_post(API_VALIDASI, $send));
			if ($check->login == 1){
				$this->session->set_userdata('hak_akses', $check->hak_akses);
				$this->session->set_userdata('nama_admin', $check->nama_admin);
				$this->session->set_userdata('photo', $check->photo);
				$this->session->set_userdata('id_admin', $check->id_admin);
				$this->session->set_userdata('nik', $check->nik);
				switch($check->hak_akses){
					case 1:
						redirect("/admin/Dashboard");
						break;
					case 2:
						redirect("/pegawai/Dashboard");
						break;

					default:
						break;
				}
			} else {
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Username atau password Salah</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
				redirect("/");
			}
		}
        
	}

	public function _rules(){
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
    }

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('Welcome');
	}
}
