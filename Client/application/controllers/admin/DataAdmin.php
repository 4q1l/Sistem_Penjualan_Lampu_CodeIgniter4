<?php

class DataAdmin extends CI_Controller{
    
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
        $data['title'] = "Data Admin";
        $jabatan = json_decode($this->client->simple_get(API_DATA_ADMIN, $send));
        $data['admin'] = $jabatan['admin'];

        $this->load->view('templates_admin/header',$data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/data_admin',$data);
        $this->load->view('templates_admin/footer');
    }

    public function tambah_data()
    {
        $send = array('id' => "");
        $data['title'] = "Tambah Data Admin";
        $data['jabatan'] = json_decode($this->client->simple_get(API_DATA_JABATAN, $send))->jabatan;
        $this->load->view('templates_admin/header',$data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/tambah_admin',$data);
        $this->load->view('templates_admin/footer');
    }

    public function tambah_data_aksi()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE){
            $this->tambah_data();
        } else {
            $nik = $this->input->post('nik');
            $nama_admin = $this->input->post('nama_admin');
            $jenis_kelamin = $this->input->post('jenis_kelamin');
            $tangga_masuk = $this->input->post('tangga_masuk');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $jabatan = $this->input->post('jabatan');
            $status = $this->input->post('status');
            $hak_akses = $this->input->post('hak_akses');
            $photo = $_FILES['photo']['name'];

            if($photo= ''){

            } else {
                $config['upload_path'] = './ext/photo';
                $config['allowed_types'] = 'jpg|jpeg|png|tiff';
                $this->load->library('upload', $config);
                if(!$this->upload->do_upload('photo')){
                    echo "Photo Gagal diupload!";
                } else {
                    $photo = $this->upload->data('file_name');
                }
            }

            $data = array(
                'nik'           => $this->input->post('nik'),
                'nama_admin'  => $this->input->post('nama_admin'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'jabatan'       => $this->input->post('jabatan'),
                'tanggal_masuk' => $this->input->post('tanggal_masuk'),
                'status'        => $this->input->post('status'),
                'hak_akses'     => $this->input->post('hak_akses'),
                'username'      => $this->input->post('username'),
                'password'      => $this->input->post('password'),
                'photo'         => $photo
            );

            $response = json_decode($this->client->simple_post(API_DATA_ADMIN, $data));
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
        $send = array('id' => "");
        $response = json_decode($this->client->simple_get(API_DATA_JABATAN, $send));
        $data['jabatan'] = $response->jabatan;

        $send = array('id' => $id);
        $response = json_decode($this->client->simple_get(API_DATA_ADMIN, $send));
        $data['admin'] = $response->admin;

        $data['title'] = "Update Data Admin";
        $this->load->view('templates_admin/header',$data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/update_admin',$data);
        $this->load->view('templates_admin/footer');
    }

    public function update_data_aksi()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE){
            $this->index();
        } else {
            $id_admin = $this->input->post('id_admin');
            $nik = $this->input->post('nik');
            $nama_admin = $this->input->post('nama_admin');
            $jenis_kelamin = $this->input->post('jenis_kelamin');
            $tangga_masuk = $this->input->post('tangga_masuk');
            $jabatan = $this->input->post('jabatan');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $status = $this->input->post('status');
            $hak_akses = $this->input->post('hak_akses');
            $photo = $_FILES['photo']['name'];

            if($photo){
                $config['upload_path'] = './ext/photo';
                $config['allowed_types'] = 'jpg|jpeg|png|tiff';
                $this->load->library('upload', $config);
                if($this->upload->do_upload('photo')){
                    $photo = $this->upload->data('file_name');
                    
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $data = array(
                'id_admin'    => $this->input->post('id_admin'),
                'nik'           => $this->input->post('nik'),
                'nama_admin'  => $this->input->post('nama_admin'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'jabatan'       => $this->input->post('jabatan'),
                'tanggal_masuk' => $this->input->post('tanggal_masuk'),
                'status'        => $this->input->post('status'),
                'hak_akses'     => $this->input->post('hak_akses'),
                'username'      => $this->input->post('username'),
                'password'      => $this->input->post('password'),
                'photo'         => $photo
            );

            $response = json_decode($this->client->simple_post(API_DATA_ADMIN . 'Update', $data));
            if ($response->pesan){
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil diUpdate</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Data gagal diUpdate</strong>
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
            'id_admin' => $id
        );

        $response = json_decode($this->client->simple_get(API_DATA_ADMIN . 'Update', $data));
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
        $this->form_validation->set_rules('nik', 'NIK', 'required');
        $this->form_validation->set_rules('nama_admin', 'Nama Admin', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('hak_akses', 'Hak Akses', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
    }
}

?>