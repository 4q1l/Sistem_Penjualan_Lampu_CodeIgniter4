<?php
defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH."libraries/Server.php";

class UpdatePassword extends Server {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Madmin","model",TRUE);
    }

    function service_post()
    {
        $data = array(
            "password" => $this->post("password_baru")
        );
    

        $hasil = $this->model->update_data($data, $this->post("id_admin"));
        if($hasil == 0 ) $this->response(array("pesan" => "true"),200);
        else $this->response(array("pesan" => "false"),200);
    }
}