<?php
defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH."libraries/Server.php";

class DataLampuUpdate extends Server {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Mlampu", "model", TRUE);
    }

    function service_get()
    {
        if($this->model->delete_data($this->input->get('id_lampu')) == 0) {
            $this->response(array("pesan" => "true"),200);
        } else {
            $this->response(array("pesan" => "false"),200);
        }
    }

    function service_post()
    {
        $data = array(
            'nama_lampu' => $this->input->post('nama_lampu'),
            'kode_lampu' => $this->input->post('kode_lampu'),
            'harga' => $this->input->post('harga'),
            'tegangan' => $this->input->post('tegangan')
        );

        $hasil = $this->model->update_data($this->input->post('id_lampu'), $data);
        
        if($hasil == 0) {
            $this->response(array("pesan" => "true"),200);
        } else {
            $this->response(array("pesan" => "false"),200);
        }
    }
}