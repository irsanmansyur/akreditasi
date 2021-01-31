<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_umum');
		$this->load->model('m_crud');
	}



	public function view()
	{
		$data = [
			"userLogin" => $this->session->userdata('loginData'),
			"v_content" => 'member/mahasiswa/view',
			"title" 	=> "Mahasiswa",
			"breadcrumb" => 'Mahasiswa',
			"listData"	 => $this->m_crud->getjoiningdata(['tbl_mahasiswa', 'tbl_prodi', 'tbl_subjenjang', 'tbl_jenjang', 'tbl_fakultas'])->result(),
		];
		$this->load->view('layout', $data);
	}

	public function views()
	{
		$data = [
			"userLogin" => $this->session->userdata('loginData'),
			"v_content" => 'member/mahasiswa/views',
			"title" 	=> "Mahasiswa",
			"breadcrumb" => 'Mahasiswa',
			"listData"	 => $this->m_crud->getjoiningdata(['tbl_mahasiswa', 'tbl_prodi', 'tbl_subjenjang', 'tbl_jenjang', 'tbl_fakultas'])->result(),
		];
		$this->load->view('layout', $data);
	}

	public function skpi()
	{
		$data = [
			"userLogin" => $this->session->userdata('loginData'),
			"v_content" => 'member/mahasiswa/skpi',
			"title" 	=> "Prestasi Mahasiswa",
			"breadcrumb" => 'Mahasiswa / Prestasi',
			"listData"	 => $this->m_crud->getjoiningdata(['tbl_mahasiswa', 'tbl_prodi', 'tbl_subjenjang', 'tbl_jenjang', 'tbl_fakultas'])->result(),
		];
		$this->load->view('layout', $data);
	}

	public function prestasi()
	{
		$data = [
			"userLogin" => $this->session->userdata('loginData'),
			"v_content" => 'member/mahasiswa/prestasi',
			"title" 	=> "Prestasi Mahasiswa",
			"breadcrumb" => 'Mahasiswa / Prestasi',
			"listData"	 => $this->m_crud->getjoiningdata($data = ['tbl_mahasiswa', 'tbl_prodi', 'tbl_subjenjang', 'tbl_jenjang', 'tbl_fakultas'])->result(),
		];
		$this->load->view('layout', $data);
	}

	public function studi()
	{
		$data = [
			"userLogin" => $this->session->userdata('loginData'),
			"v_content" => 'member/mahasiswa/studi',
			"title" 	=> "Masa Studi dan IPK Lulusan",
			"breadcrumb" => 'Mahasiswa / Masa Studi dan IPK Lulusan',
			//"listData"	 => $this->m_crud->getjoiningdata($data = ['tbl_mahasiswa', 'tbl_prodi', 'tbl_subjenjang', 'tbl_jenjang', 'tbl_fakultas'])->result(),
		];
		$this->load->view('layout', $data);
	}

	public function lulusan($var = null)
	{
		$data = [
			"userLogin" => $this->session->userdata('loginData'),
			"v_content" => 'member/mahasiswa/lulusan',
			"title" 	=> "Masa Studi dan IPK Lulusan",
			"breadcrumb" => 'Mahasiswa / Masa Studi dan IPK Lulusan',
			//"listData"	 => $this->m_crud->getjoiningdata($data = ['tbl_mahasiswa', 'tbl_prodi', 'tbl_subjenjang', 'tbl_jenjang', 'tbl_fakultas'])->result(),
		];
		$this->load->view('layout', $data);
	}

	public function layanan($var = null)
	{
		$data = [
			"userLogin" => $this->session->userdata('loginData'),
			"v_content" => 'member/mahasiswa/layanan',
			"title" 	=> "Layanan Kepada Mahasiswa",
			"breadcrumb" => 'Mahasiswa / Layanan Kepada Mahasiswa',
			//"listData"	 => $this->m_crud->getjoiningdata($data = ['tbl_mahasiswa', 'tbl_prodi', 'tbl_subjenjang', 'tbl_jenjang', 'tbl_fakultas'])->result(),
		];
		$this->load->view('layout', $data);
	}


	public function index()
	{
		$data = [
			"userLogin" => $this->session->userdata('loginData'),
			"v_content" => 'member/mahasiswa/index',
			"title" 	=> "Mahasiswa",
			"breadcrumb" => 'Mahasiswa',
			"listData"	 => $this->m_crud->getjoiningdata($data = ['tbl_mahasiswa', 'tbl_prodi', 'tbl_subjenjang', 'tbl_jenjang', 'tbl_fakultas'])->result(),
		];
		$this->load->view('layout', $data);
	}

	public function add()
	{
		$post = $this->input->post();
		if (isset($post['submit'])) {
			$insert = [
				'id_prodi' => $post['id_prodi'],
				'nama' => $post['nama'],
				'nim' => $post['nim'],
				'status_kelulusan' => $post['status_kelulusan'],
			];
			$insert = $this->m_crud->insert('tbl_mahasiswa', $insert);
			if ($insert) {
				$this->m_umum->generatePesan('Berhasil Mengubah Data', 'berhasil');
			} else {
				$this->m_umum->generatePesan('Gagal Mengubah Data', 'gagal');
			}
			redirect('admin/mahasiswa/add');
		}
		$data = [
			"userLogin" => $this->session->userdata('loginData'),
			"v_content" => 'member/mahasiswa/add',
			"title" 	=> "Tambah Data Mahasiswa",
			"breadcrumb" => 'Mahasiswa / Add Data',
			"prodi"		=> $this->m_crud->getdata('tbl_prodi')->result(),
		];
		$this->load->view('layout', $data);
	}


	public function hapus($id)
	{
		if ($this->m_crud->delete('tbl_mahasiswa', $id)) {
			$this->m_umum->generatePesan('Berhasil Menghapus Data', 'berhasil');
		} else {
			$this->m_umum->generatePesan('Gagal Menghapus Data', 'gagal');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
}
