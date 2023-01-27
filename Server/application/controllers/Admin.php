<?php
defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH."libraries/Server.php";

class Admin extends Server {

    //buat konstruktor
    public function __construct()
        {
                parent::__construct();
                 //panggil model "Padmin"
                $this->load->model("Padmin","model",TRUE);
        }

	//buat fungsi "GET"
    function service_get()
    {
        //panggil fungsi "get_data"
       $hasil = $this->model->get_data();

        $this->response(array("admin" =>
        $hasil),200);
    }
    //buat fungsi "POST"
    function service_post()
    {
       
        //ambil parameter token data yang akan diisi
        $data = array(
            "nik" => $this->post("nik"),
            "nama_admin" => $this->post("nama_admin"),
            "jenis_kelamin" => $this->post("jenis_kelamin"),
            "jabatan" => $this->post("jabatan"),
            "tanggal_masuk" => $this->post("tanggal_masuk"),
            "status" => $this->post("status"),
            "photo" => $this->post("photo"),
            "token" => base64_encode($this->post("token")),
        );
        // panggil method "save data"
        $hasil = $this->model->save_data($data["nik"],
        $data["nama_admin"],$data["jenis_kelamin"],$data["jabatan"],$data["tanggal_masuk"],$data["status"],
        $data["photo"],$data["token"]);
        // jika hasil = 0
        if($hasil == 0 )
        {
            $this->response(array("status" =>"Data Admin Berhasil Disimpan"),200);
        }
        // jika hasil != 0
        else
        {
            $this->response(array("status" =>"Data Admin  Gagal Disimpan !"),200);
        }



}
}