<?php if(!defined('BASEPATH')) exit('No direct script acceess allowed');

class Mlogin extends CI_Model{

	// buat method untuk tampil data
    function aksi_login($token)
    {        
        $this->db->select("
        user_id,
        key,
        level,
        username,
		password,
        ");
        $this->db->from("tb_auth");

        // jika token terisi
        if(!empty($token))
        {
            $this->db->where("TO_BASE64(user_id) = '$token' OR TO_BASE64(username) = '$token' OR TO_BASE64(password) = '$token'");
        }

        $this->db->order_by("username","DESC");        
        
        $query = $this->db->get()->result();
        return $query;        
    }


}