<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Madmin extends CI_Model {

    function get_data($id)
    {
        $this->db->select("*");
        $this->db->from("data_admin");
        if(empty($id)) $this->db->order_by("nama_admin", "ASC");
        else $this->db->where("id_admin = '$id'");
        return $this->db->get()->result();
    }

    function get_data_admin()
    {
        $this->db->select("*");
        $this->db->from("data_admin");
        $this->db->where("jabatan = 'Admin'");
        $this->db->order_by("nama_admin", "ASC");
        return $this->db->get()->result();
    }
    

    function save_data($data)
    {
      return $this->db->insert("data_admin", $data);
    }

    function update_data($data, $id)
    {
        $where = array(
            'id_admin' => $id
        );
        return $this->db->update("data_admin", $data, $where);
    }

    function delete_data($id)
    {
        $where = array(
            'id_admin' => $id
        );

        $this->db->where($where);
        return $this->db->delete("data_admin");
    }

    function get_login($data)
    {
        $this->db->select("*");
        $this->db->from("data_admin");
        $this->db->where($data);
        $data = $this->db->get()->result();
        $login = sizeof($data);
        return array('login' => $login, 'hak_akses' => $data[0]->hak_akses, 'nama_admin' => $data[0]->nama_admin, 'photo' => $data[0]->photo, 'nik' => $data[0]->nik, 'id_admin' => $data[0]->id_admin);
    }
}

