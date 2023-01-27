<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MLampu extends CI_Model {

    function get_data($id)
    {
        $this->db->select("*");
        $this->db->from("tb_lampu");
        if(empty($id)) $this->db->order_by("nama_lampu", "ASC");
        else $this->db->where("id_lampu = '$id'");
        return $this->db->get()->result();
    }

    function save_data($data)
    {
      return $this->db->insert("tb_lampu", $data);
    }

    function update_data($id, $data)
    {
      $where = array(
        'id_lampu' => $id
      );
      return $this->db->update("tb_lampu", $data, $where);
    }

    function delete_data($id)
    {
      $where = array(
        'id_lampu' => $id
      );
    $this->db->where($where);
      return $this->db->delete("tb_lampu");
    }
}

