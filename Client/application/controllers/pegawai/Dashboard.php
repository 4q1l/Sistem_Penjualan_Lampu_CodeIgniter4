<?php

class Dashboard extends CI_Controller{
    
    public function __construct(){
        parent::__construct();

        if ($this->session->userdata('hak_akses') != '2'){
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Anda belum login!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
			redirect("/");
        }
    }

    public function index()
    {
        $data['title'] = "Dashboard";
        $send = array('id' => $this->session->userdata('id_pegawai'));
        $pegawai = json_decode($this->client->simple_get(API_DATA_PEGAWAI, $send));
        $data['pegawai'] = $pegawai->pegawai;

        $this->load->view('templates_admin/header',$data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('pegawai/dashboard',$data);
        $this->load->view('templates_admin/footer');
    }
}

?>