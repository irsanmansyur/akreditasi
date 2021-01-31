<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Akreditasi extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_umum');
		$this->load->model('m_crud');
	}


	public function index()
	{
		$data = [
			"userLogin" => $this->session->userdata('loginData'),
			"v_content" => 'member/akreditasi/index',
			"title" 	=> "Akreditasi",
			"breadcrumb" => 'Akreditasi',
			"listData"		=> $this->m_crud->getdata('tbl_akreditasi')->result(),
			"listJenjang"	=> $this->m_crud->getdata('tbl_jenjang')->result(),
			"subjenjang"	=> $this->m_crud->getdata('tbl_subjenjang')->result(),
			"listProdi"		=> $this->m_crud->getdata('tbl_prodi')->result(),
		];
		$this->load->view('layout', $data);
	}

	public function dokumen()
	{
		$data = [
			"userLogin" => $this->session->userdata('loginData'),
			"v_content" => 'member/akreditasi/dokumen',
			"title" 	=> "Dokumen Akreditasi",
			"breadcrumb" => 'Akreditasi / Dokumen',
			"listData"	=> $this->m_crud->getdata('tbl_dokumen_akreditasi')->result(),
		];
		$this->load->view('layout', $data);
	}

	public function setting()
	{
		$post = $this->input->post();
		if (isset($post['submit'])) {
			foreach ($post['judul'] as $key => $value) {
				$insert[] = [
					"judul" => $value,
					"isi"	=> $post['isi'][$key]
				];
			}
			$this->db->truncate('tbl_dokumen_akreditasi');
			$this->db->insert_batch('tbl_dokumen_akreditasi', $insert);
		}
		$data = [
			"userLogin" => $this->session->userdata('loginData'),
			"v_content" => 'member/akreditasi/setting',
			"title" 	=> "Setting Dokumen Akreditasi",
			"breadcrumb" => 'Akreditasi / Dokumen / Setting',
			"listData"	=> $this->m_crud->getdata('tbl_dokumen_akreditasi')->result(),
		];
		$this->load->view('layout', $data);
	}
}
