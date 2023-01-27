<?php

class DataLampu extends CI_Controller{
    
    public function __construct(){
        parent::__construct();

        if ($this->session->userdata('hak_akses') != '1'){
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
        $send = array('id' => "");
        $data['title'] = "Data Lampu";
        $lampu = json_decode($this->client->simple_get(API_DATA_LAMPU, $send));
        $data['lampu'] = $lampu['lampu'];

        $this->load->view('templates_admin/header',$data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/data_lampu',$data);
        $this->load->view('templates_admin/footer');
    }

    public function tambah_data()
    {
        $data['title'] = "Tambah Data Lampu";
        $this->load->view('templates_admin/header',$data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/tambah_lampu',$data);
        $this->load->view('templates_admin/footer');
    }

    public function tambah_data_aksi()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE){
            $this->tambah_data();
        } else {
            $nama_lampu = $this->input->post('nama_lampu');
            $kode_lampu = $this->input->post('kode_lampu');
            $harga = $this->input->post('harga');
            $tegangan = $this->input->post('tegangan');

            $data = array(
                'nama_lampu' => $this->input->post('nama_lampu'),
                'kode_lampu' => $this->input->post('kode_lampu'),
                'harga' => $this->input->post('harga'),
                'tegangan' => $this->input->post('tegangan')
            );

            $response = json_decode($this->client->simple_post(API_DATA_LAMPU, $data));
            if ($response->pesan){
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil ditambahkan</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Data gagal ditambahkan</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            }

            $this->index();
        }
    }

    public function update_data($id)
    {
        $send = array('id' => $id);
        $response = json_decode($this->client->simple_get(API_DATA_LAMPU, $send));
        $data['lampu'] = $response['lampu'];
        $data['title'] = "Update Data Lampu";
        $this->load->view('templates_admin/header',$data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/update_lampu',$data);
        $this->load->view('templates_admin/footer');
    }

    public function update_data_aksi()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE){
            $this->index();
        } else {
            $id = $this->input->post('id_lampu');
            $nama_lampu = $this->input->post('nama_lampu');
            $kode_lampu = $this->input->post('kode_lampu');
            $harga = $this->input->post('harga');
            $tegangan = $this->input->post('tegangan');

            $data = array(
                'id_lampu' => $this->input->post('id_lampu'),
                'nama_lampu' => $this->input->post('nama_lampu'),
                'kode_lampu' => $this->input->post('kode_lampu'),
                'harga' => $this->input->post('harga'),
                'tegangan' => $this->input->post('tegangan')
            );

            $response = json_decode($this->client->simple_post(API_DATA_LAMPU . 'Update', $data));
            if ($response->pesan){
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil diupdate</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Data gagal diupdate</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            }

            $this->index();
        }
    }

    public function delete_data($id)
    {
        $data = array(
            'id_lampu' => $id
        );

        $response = json_decode($this->client->simple_get(API_DATA_LAMPU . 'Update', $data));
        if ($response->pesan){
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data berhasil dihapus</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Data gagal dihapus</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        }

        $this->index();
    }

    public function _rules(){
        $this->form_validation->set_rules('nama_lampu', 'nama lampu', 'required');
        $this->form_validation->set_rules('kode_lampu', 'kode lampu', 'required');
        $this->form_validation->set_rules('harga', 'harga', 'required');
        $this->form_validation->set_rules('tegangan', 'tegangan', 'required');
    }
}

?>