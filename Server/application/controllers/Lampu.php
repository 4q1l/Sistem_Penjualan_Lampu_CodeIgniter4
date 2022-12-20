<?php
defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH."libraries/Server.php";

class Lampu extends Server {

    //buat konstruktor
    public function __construct()
        {
                parent::__construct();
                 //panggil model "Mlampu"
                $this->load->model("Mlampu","model",TRUE);
        }

	//buat fungsi "GET"
    function service_get()
    {
        //ambil parameter token "(kode)"
        $token = $this->get("kode");
        
        //panggil fungsi "get_data"
        $hasil = $this->model->get_data(base64_encode($token));

        $this->response(array("lampu" =>
        $hasil),200);

    }

    //buat fungsi "POST"
    function service_post()
    {
       
        //ambil parameter token data yang akan diisi
        $data = array(
            "kode" => $this->post("kode"),
            "nama" => $this->post("nama"),
            "harga" => $this->post("harga"),
            "tegangan" => $this->post("tegangan"),
            "token" => base64_encode($this->post("kode")),
        );
        // panggil method "save data"
        $hasil = $this->model->save_data($data["kode"],
        $data["nama"],$data["harga"],$data["tegangan"],$data["token"]);
        // jika hasil = 0
        if($hasil == 0 )
        {
            $this->response(array("status" =>"Data lampu Berhasil Disimpan"),200);
        }
        // jika hasil != 0
        else
        {
            $this->response(array("status" =>"Data lampu Gagal Disimpan !"),200);
        }

 
    }
    //buat fungsi "PUT"
    function service_put()
    {
     //panggil model "Mlampu"
     $this->load->model("Mlampu","model",true);
     //ambil parameter token data yang akan diisi
     $data = array(
         "kode" => $this->put("kode"),
         "nama" => $this->put("nama"),
         "harga" => $this->put("harga"),
         "tegangan" => $this->put("tegangan"),
         "token" => base64_encode($this->put("token")),
     );   

      // panggil method "update_data"
      $hasil = $this->model->update_data($data
      ["kode"],$data["nama"],$data["harga"],$data["tegangan"],$data["token"]);

      //jika hasil == 0
        if($hasil == 0 )
        {
            $this->response(array("status" =>"Data lampu Berhasil Diubah"),200);
        }
        // jika hasil != 0
        else
        {
            $this->response(array("status" =>"Data lampu Gagal Diubah !"),200);
        }
    }
    //buat fungsi "DELETE"
    function service_delete()
    {
        // panggil model "Mlampu"
        $this->load->model("Mlampu","model",TRUE);
        //ambil parameter token "(kode)"
        $token = $this->delete("kode");
        //panggil fungsi "delete_data"
        $hasil = $this->model->delete_data
        (base64_encode($token));
        if($hasil == 1)
        {
            $this->response(array("status" =>"Data lampu Berhasil Dihapus"),200);
        }
        // jika proses delete gagal
        else
        {
            $this->response(array("status" => "Data
            lampu Gagal Dihapus !"),200);
        }

    }
}
