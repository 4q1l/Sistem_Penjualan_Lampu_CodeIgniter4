<?php
defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH."libraries/Server.php";

class Validation extends Server {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Madmin","model",TRUE);
    }

    function service_get()
    {
        $this->response(array('model' => $this->model->get_data_admin($this->get("jabatan"))) ,200);
    }

    function service_post()
    {
        $data = array(
            "username" => $this->post("username"),
            "password" => $this->post("password"),
       
        );

        $this->response($this->model->get_login($data) ,200);
    }
}