<?php

class M_crud extends CI_Model {

    function getdata($table)
    {
        return $this->db->get($table);
	}

	function getdatabyid($table,$id)
    {
    	$this->db->where(str_replace('tbl_', '', $table).'_id',$id);
        return $this->db->get($table);
	}

	function insert($table,$data)
	{
		return $this->db->insert($table,$data);
	}

	function update($table,$data,$where='')
	{
		if(!empty($where)){
			$this->db->where($where[0],$where[1]);
		}
		return $this->db->update($table,$data);
	}

	function getjoindata($table1,$table2,$index)
	{
		$this->db->join($table2,$index.'_id = id_'.$index);
		return $this->db->get($table1);
	}

	function getjoiningdata($table)
	{
		//var_dump($table); exit;
		foreach ($table as $key => $value) {
			if($table[0] == $value) continue;
			$this->db->join($value, str_replace('tbl_', '', $value).'_id = id_'.str_replace('tbl_', '', $value));
		}
		
		return $this->db->get($table[0]);
	}

	function getjoin3data($table1,$table2,$table3,$index,$index2)
	{
		$this->db->join($table2,$index.'_id = id_'.$index);
		$this->db->join($table3,$index2.'_id = id_'.$index2);
		return $this->db->get($table1);
	}

	function getjoin4data($table1,$table2,$table3,$table4,$index,$index2,$index3)
	{
		$this->db->join($table2,$index.'_id = id_'.$index);
		$this->db->join($table3,$index2.'_id = id_'.$index2);
		$this->db->join($table4,$index3.'_id = id_'.$index3);
		return $this->db->get($table1);
	}

	public function delete($table,$id)
	{
		$this->db->where(str_replace('tbl_', '', $table).'_id',$id);
		return $this->db->delete($table);
	}
}
