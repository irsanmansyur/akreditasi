<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_prodi extends CI_Model {
public function __construct()
{
	parent::__construct();
	$this->load->database();
}

public function listing($id_sub_jenjang,$id_akreditasi){
	$this->db->select('tbl_prodi.*,tbl_subjenjang.subjenjang_nama,tbl_fakultas.fakultas_nama');
	$this->db->from('tbl_prodi');
	$this->db->join('tbl_subjenjang', 'tbl_subjenjang.subjenjang_id = tbl_prodi.id_subjenjang', 'LEFT');
	$this->db->join('tbl_fakultas', 'tbl_fakultas.fakultas_id = tbl_prodi.id_fakultas', 'LEFT');
	$this->db->where('tbl_prodi.id_subjenjang', $id_sub_jenjang);
	$this->db->where('tbl_prodi.id_akreditasi', $id_akreditasi);
	$this->db->order_by('daluarsa', 'desc');
	$query = $this->db->get();
	return $query->result();
}	








}

/* End of file M_prodi.php */
/* Location: ./application/models/M_prodi.php */