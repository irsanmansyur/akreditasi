<?php

class M_user extends CI_Model {

    function getAll(){
        return $this->db->get('tbl_user')->result();
	}

	function insert($data){
		if($this->db->insert('tbl_user',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
}
