<?php

class M_login extends CI_Model {

    function checkLogin($username,$password){
        $this->db->select('*');
        $this->db->from('tbl_user u');
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get();
        if($query->num_rows()>0){
			$querycheck = $query->row();
			$dataArr = array(
				'UserID'    	=> $querycheck->user_id,
				'Username'  	=> $querycheck->username,
				'nama' 		=> $querycheck->nama,
			);
			$this->session->set_userdata('loginData',$dataArr);
            return true;
        }else{ 
            return false;
        }
	}
	
}
