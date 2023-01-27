<?php

class GantiPassword extends CI_Controller{
    
    public function index()
    {
        $data['title'] = "Ganti Password";
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('ganti_password', $data);
        $this->load->view('templates_admin/footer');
    }

    public function ganti_password_aksi()
    {
        $this->_rules();
        if ($this->form_validation->run() != FALSE){
            $data = array('password_baru' => $this->input->post('password_baru'), 'id_admin' => $this->session->userdata('id_admin'));

            $response = json_decode($this->client->simple_post(API_UPDATE_PASSWORD, $data));
            if($response->pesan) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Password Berhasil diUbah</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Password Gagal diUbah</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            }
            
			redirect("GantiPassword");
        } else {
            $this->index();
        }
    }

    public function _rules(){
        $this->form_validation->set_rules('password_baru', 'Password Baru', 'required|matches[ulangi_password]');
        $this->form_validation->set_rules('ulangi_password', 'Ulangi Password', 'required');
    }
}

?>