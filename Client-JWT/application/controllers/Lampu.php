<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lampu extends CI_Controller
{
	// buat variabel global
	var $key_name = 'KEY-API';
	var $key_value = 'RESTAPI';
	var $key_bearer = 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJleHAiOjE2NzQyODY2NDZ9.X3pe0XtinTsNdYOEkuMdZilApE7zCoe94I3FaG46nzBafICdC23jmm-qAj7Ip5EVnQb3TydkHR1fvyYaq1IY3RCgyc6PVqvQ5UCoVUKmfXMSJUrE-1N6m-CPPPaYlkWlC19OAbo-JuUrfes8rdZygzykOJD0c6BXs1bpV5rxeQI';


	public function index()
	{
		// akses key JWT (variabel / salah)
		$this->client->http_header($this->key_bearer);

		$data["tampil"] = json_decode($this->client->simple_get(APILAMPU, [$this->key_name => $this->key_value]));

		// jika token expired / salah
		if ($data["tampil"]->result == 0) {
			echo $data["tampil"]->error;
			// redirect("https://google.com");
		}
		// jika token valid
		else {
			$this->load->view('vw_lampu', $data);
		}
	}

	function setDelete()
	{
		$this->client->http_header($this->key_bearer);

		// buat variabel json
		$json = file_get_contents("php://input");
		$hasil = json_decode($json);


		$delete = json_decode($this->client->simple_delete(APILAMPU, array("kode" => $hasil->kodenya, $this->key_name => $this->key_value)));

		if ($delete->result == 0) {
			echo json_encode(array("statusnya" => $delete->error));
		} else {
			echo json_encode(array("statusnya" => $delete->status));
		}
	}

	function addLampu()
	{
		$this->load->view('en_lampu');
	}

	// buat fungsi untuk simpan data lampu
	function setSave()
	{
		$this->client->http_header($this->key_bearer);

		// baca nilai dari fetch
		$data = array(
			"kode" => $this->input->post("kodenya"),
			"nama" => $this->input->post("namanya"),
			"harga" => $this->input->post("harganya"),
			"tegangan" => $this->input->post("tegangannya"),
			"token" => $this->input->post("kodenya"),
			$this->key_name => $this->key_value
		);

		$save = json_decode($this->client->simple_post(APILAMPU, $data));

		if ($save->result == 0) {
			echo json_encode(array("statusnya" => $save->error));
		} else {
			echo json_encode(array("statusnya" => $save->status));
		}
	}

	// fungsi untuk update data
	function updateLampu()
	{
		$this->client->http_header($this->key_bearer);

		// ambil nilai kode
		$token = $this->uri->segment(3);

		$tampil = json_decode($this->client->simple_get(APILAMPU, array("kode" => $token, $this->key_name => $this->key_value)));

		if ($tampil->result == 0) {
			echo $tampil->error;
		} else {

			foreach ($tampil->lampu as $result) {
				// echo $result->nama_lampu."<br>";
				$data = array(
					"kode" => $result->kode_lampu,
					"nama" => $result->nama_lampu,
					"harga" => $result->harga_lampu,
					"tegangan" => $result->tegangan_lampu,
					"token" => $token,
				);
			}
			$this->load->view('up_lampu', $data);
		}
	}

	// buat fungsi untuk ubah data lampu
	function setUpdate()
	{
		$this->client->http_header($this->key_bearer);

		// baca nilai dari fetch
		$data = array(
			"kode" => $this->input->post("kodenya"),
			"nama" => $this->input->post("namanya"),
			"harga" => $this->input->post("harganya"),
			"tegangan" => $this->input->post("tegangannya"),
			"token" => $this->input->post("tokennya"),
			$this->key_name => $this->key_value
		);

		$update = json_decode($this->client->simple_put(APILAMPU, $data));

		// kirim hasil ke "up_lampu"
		if ($update->result == 0) {
			echo json_encode(array("statusnya" => $update->error));
		} else {
			echo json_encode(array("statusnya" => $update->status));
		}
	}
}
