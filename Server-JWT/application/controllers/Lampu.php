<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'controllers/Token.php';

class Lampu extends Token
{

    // buat variabel global
	var $key_name = 'KEY-API';
	var $key_value = 'RESTAPI';
	var $key_bearer = 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJleHAiOjE2NzQwNTY3MTd9.K27c5_YCGG41EA2o4wqkkuFRC6eOMTeMnGyXxSxdCfHr-nQVL4uRtkIUiSlIhYVDts2Sdnq_7bZE0cNJkMp5CnZhLIdBU8RfUD0YLgBncVo1IiAAj-sqlcto9139kKnocIbZOawdJNWBOfQGF9f4vo6--T_uxWppOSSdouEr_Dw';

    // buat konstruktor
    public function __construct()
    {
        parent::__construct();

        // panggil model "Mlampu"
        $this->load->model("Mlampu", "model", TRUE);

    }

    // buat fungsi "GET"
    function service_get()
    {
        if ($this->authtoken() == 0) {
            return $this->response(array("result" => 0, "error" => "Kode Signature Tidak Sesuai !"), 200);
        } else {
            // ambil paramater token "(kode)"
            $token = $this->get("kode");

            // panggil fungsi "get_data"
            $hasil = $this->model->get_data(base64_encode($token));

            $this->response(array("lampu" => $hasil, "result" => 1, "error" => ""), 200);
        }
    }


    //buat fungsi "POST"
    function service_post()
    {
        if ($this->authtoken() == 0) {
            return $this->response(array("result" => 0, "error" => "Kode Signature Tidak Sesuai !"), 200);
        } else {

            // ambil parameter data yang akan diisi
            $data = array(
                "kode" => $this->post("kode"),
                "nama" => $this->post("nama"),
                "harga" => $this->post("harga"),
                "tegangan" => $this->post("tegangan"),
                "token" => base64_encode($this->post("kode")),
            );

            // panggil method "save_data"
            $hasil = $this->model->save_data($data["kode"], $data["nama"], $data["harga"], $data["tegangan"], $data["token"]);
            // jika hasil = 0
            if ($hasil == 0) {
                $this->response(array("status" => "Data Lampu Berhasil Disimpan", "result" => 1, "error" => ""), 200);
            }
            // jika hasil != 0
            else {
                $this->response(array("status" => "Data Lampu Gagal Disimpan !", "result" => 1, "error" => ""), 200);
            }
        }
    }
    //buat fungsi "PUT"
    function service_put()
    {
        if ($this->authtoken() == 0) {
            return $this->response(array("result" => 0, "error" => "Kode Signature Tidak Sesuai !"), 200);
        } else {
            // ambil parameter data yang akan diisi
            $data = array(
                "kode" => $this->put("kode"),
                "nama" => $this->put("nama"),
                "harga" => $this->put("harga"),
                "tegangan" => $this->put("tegangan"),
                "token" => base64_encode($this->put("token")),
            );

            // panggil method "update_data"
            $hasil = $this->model->update_data($data["kode"], $data["nama"], $data["harga"], $data["tegangan"], $data["token"]);

            // jika hasil = 0
            if ($hasil == 0) {
                $this->response(array("status" => "Data Lampu Berhasil Diubah", "result" => 1, "error" => ""), 200);
            }
            // jika hasil != 0
            else {
                $this->response(array("status" => "Data Lampu Gagal Diubah !", "result" => 1, "error" => ""), 200);
            }
        }
    }
    //buat fungsi "DELETE"
    function service_delete()
    {
        if ($this->authtoken() == 0) {
            return $this->response(array("result" => 0, "error" => "Kode Signature Tidak Sesuai !"), 200);
        } else {
            // ambil paramater token "(kode)"
            $token = $this->delete("kode");
            // panggil fungsi "delete_data"
            $hasil = $this->model->delete_data(base64_encode($token));
            // jika proses delete berhasil
            if ($hasil == 1) {
                $this->response(array("status" => "Data Lampu Berhasil Dihapus", "result" => 1, "error" => ""), 200);
            }
            // jika proses delete gagal
            else {
                $this->response(array("status" => "Data Lampu Gagal Dihapus !", "result" => 1, "error" => ""), 200);
            }
        }
    }
}
