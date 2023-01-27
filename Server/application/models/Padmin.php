<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Padmin extends CI_Model {

	// buat method untuk tampil data
    function get_data()
    {
        //mengambil hanya nik
        //$this->db->select("nik")

        $this->db->select("id_admin AS id_admin,
        nik AS nik_admin,
        nama_admin AS nama_admin,
        jenis_kelamin AS jns_klmn,
        jabatan AS jabatan_admin,
        tanggal_masuk AS tgl_msk,
        status AS status_admin,
        photo AS photo_admin,
        ");

        $this->db->from("data_admin");
        $this->db->order_by("nik","ASC");

        $query = $this->db->get()->result();
        return $query;

    }
    
    // buat fungsi untuk simpan data
    function save_data($nik,$nama_admin,$jenis_kelamin,$jabatan,$tanggal_masuk,$status,$photo,$token)
    {
       // cek apakah nik ada/tidak
       $this->db->select("nik");
       $this->db->from("data_admin");
       $this->db->where("TO_BASE64(nik) = '$token'");
       //eksekusi query
       $query = $this->db->get()->result();
       //jika nik ditemukan
       if(count($query) == 0)
       {
         // isi nilai untuk masing2 field
         $data = array(
            "nik" => $nik,
            "nama_admin" => $nama_admin,
            "jenis_kelamin" => $jenis_kelamin,
            "jabatan" => $jabatan,
            "tanggal_masuk" => $tanggal_masuk,
            "status" => $status,
            "photo" => $photo,
         );
         // simpan data
         $this->db->insert("data_admin",$data);
         $hasil= 0;

       }
      // jika nik ditemukan
      else
      {
        $hasil = 1;
      }
      return $hasil;
    }

    
    
}

