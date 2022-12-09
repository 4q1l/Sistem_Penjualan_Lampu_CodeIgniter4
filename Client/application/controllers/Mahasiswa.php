<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{

    public function index()
    {

        $data['tampil'] = json_decode($this->client->simple_get(APIMAHASISWA));

        // foreach($data["tampil"] -> mahasiswa as $result)
        // {
        //     echo $result->npm_mhs."<br>";
        // }

        $this->load->view('vw_mahasiswa', $data);
    }

    function setDelete()
    {
        //buat variabel json
        $json = file_get_contents("php://input");
        $hasil = json_decode($json);

        $delete = json_decode($this->client->simple_delete(APIMAHASISWA, array("npm" => $hasil->npmnya)));



        // isi nilai err
        // $err = 0;

        // kirim hasil ke "vw_mahasiswa"
        echo json_encode(array("statusnya" => $delete->status));
    }

    function addMahasiswa()
    {
        $this->load->view('en_mahasiswa');
    }

    // buat fungsi untuk simpan data mahasiswa
    function setSave()
    {
        // baca nilai dari fetch
        $data = array(
            "npm" => $this->input->post("npmnya"),
            "nama" => $this->input->post("namanya"),
            "telepon" => $this->input->post("teleponnya"),
            "jurusan" => $this->input->post("jurusannya"),
            "token" => $this->input->post("npmnya"),
        );

        $save = json_decode(
            $this->client->simple_post(APIMAHASISWA, $data)
        );

        // kirim hasil ke "vw_mahasiswa"
        echo json_encode(array("statusnya" => $save->status));
    }
}
        