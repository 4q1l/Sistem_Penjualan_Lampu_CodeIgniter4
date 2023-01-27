<?php

class DataGaji extends CI_Controller{
    
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
        $data['title'] = "Data Gaji Pegawai";
        $gaji = json_decode($this->client->simple_get(API_VALIDASI, array('nik' => $this->session->userdata('nik'))));
        $potonganGaji = json_decode($this->client->simple_get(API_POTONGAN_GAJI));
        $data['gaji'] = $gaji->gaji;
        $data['potongan_gaji'] = $potonganGaji->potongan_gaji[0]->jml_potongan;
        $this->load->view('templates_admin/header',$data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('pegawai/data_gaji',$data);
        $this->load->view('templates_admin/footer');
    }
}

?>