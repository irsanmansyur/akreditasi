<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Jenjang extends CI_Controller
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
      "v_content" => 'member/jenjang/index',
      "title"   => "Jenjang",
      "breadcrumb" => 'Jenjang',
      "listData"    => $this->m_crud->getdata('tbl_jenjang')->result(),
    ];
    $this->load->view('layout', $data);
  }

  public function add()
  {
    $post = $this->input->post();
    if (isset($post['submit'])) {
      $insert['jenjang_nama'] = $post['jenjang'];
      $insert = $this->m_crud->insert('tbl_jenjang', $insert);
      if ($insert) {
        $this->m_umum->generatePesan('Berhasil Mengubah Data', 'berhasil');
      } else {
        $this->m_umum->generatePesan('Gagal Mengubah Data', 'gagal');
      }
      redirect('admin/jenjang/add');
    }
    $data = [
      "userLogin" => $this->session->userdata('loginData'),
      "v_content" => 'member/jenjang/add',
      "title"   => "Tambah Data Jenjang",
      "breadcrumb" => 'Jenjang/Add Data',
    ];
    $this->load->view('layout', $data);
  }
  public function edit($id)
  {
    $jenjang = $this->db->get_where("tbl_jenjang", ['jenjang_id' => $id])->row();

    $this->load->library("form_validation");
    $this->form_validation->set_rules("jenjang", "Nama Jenjang", "required");
    if ($this->form_validation->run()) {
      $post = $this->input->post();
      $insert['jenjang_nama'] = $post['jenjang'];
      $insert = $this->db->where("jenjang_id", $id)->update('tbl_jenjang', $insert);
      if ($insert) {
        $this->m_umum->generatePesan('Berhasil Mengubah Data', 'berhasil');
      } else {
        $this->m_umum->generatePesan('Gagal Mengubah Data', 'gagal');
      }
      redirect('admin/jenjang');
    }
    $data = [
      "userLogin" => $this->session->userdata('loginData'),
      "v_content" => 'member/jenjang/edit',
      "title"   => "Edit Data Jenjang",
      "jenjang" => $jenjang,
      "breadcrumb" => 'Jenjang/Edit Data',
    ];
    $this->load->view('layout', $data);
  }

  public function hapus($id)
  {
    if ($this->m_crud->delete('tbl_jenjang', $id)) {
      $this->m_umum->generatePesan('Berhasil Menghapus Data', 'berhasil');
    } else {
      $this->m_umum->generatePesan('Gagal Menghapus Data', 'gagal');
    }
    redirect($_SERVER['HTTP_REFERER']);
  }


  public function sub()
  {
    $data = [
      "userLogin"   => $this->session->userdata('loginData'),
      "v_content"   => 'member/jenjang/sub',
      "title"     => "Sub Jenjang",
      "breadcrumb"   => 'Jenjang/Sub',
      "listData"    => $this->m_crud->getjoindata('tbl_jenjang', 'tbl_subjenjang', 'jenjang')->result(),
    ];
    $this->load->view('layout', $data);
  }


  public function add_sub()
  {
    $post = $this->input->post();
    if (isset($post['submit'])) {
      $insert = [
        'id_jenjang' => $post['id_jenjang'],
        'subjenjang_nama' => $post['subjenjang']
      ];
      $insert = $this->m_crud->insert('tbl_subjenjang', $insert);
      if ($insert) {
        $this->m_umum->generatePesan('Berhasil Mengubah Data', 'berhasil');
      } else {
        $this->m_umum->generatePesan('Gagal Mengubah Data', 'gagal');
      }
      redirect('admin/jenjang/add_sub');
    }
    $data = [
      "userLogin" => $this->session->userdata('loginData'),
      "v_content" => 'member/jenjang/add_sub',
      "title"   => "Tambah Data Sub Jenjang",
      "breadcrumb" => 'Sub Jenjang/Add Data',
      "listData"    => $this->m_crud->getdata('tbl_jenjang')->result()
    ];
    $this->load->view('layout', $data);
  }

  public function hapus_sub($id)
  {
    if ($this->m_crud->delete('tbl_subjenjang', $id)) {
      $this->m_umum->generatePesan('Berhasil Menghapus Data', 'berhasil');
    } else {
      $this->m_umum->generatePesan('Gagal Menghapus Data', 'gagal');
    }
    redirect($_SERVER['HTTP_REFERER']);
  }
}
