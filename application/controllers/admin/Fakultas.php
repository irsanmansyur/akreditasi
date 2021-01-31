<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Fakultas extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('m_umum');
    $this->load->model('m_crud');
    $this->load->library("form_validation");
  }


  public function index()
  {
    $data = [
      "userLogin" => $this->session->userdata('loginData'),
      "v_content" => 'member/fakultas/index',
      "title"   => "Fakultas",
      "breadcrumb" => 'Fakultas',
      "listData"    => $this->m_crud->getdata('tbl_fakultas')->result(),
    ];
    $this->load->view('layout', $data);
  }

  public function add()
  {
    $post = $this->input->post();
    if (isset($post['submit'])) {
      $insert['fakultas_nama'] = $post['fakultas'];
      $insert = $this->m_crud->insert('tbl_fakultas', $insert);
      if ($insert) {
        $this->m_umum->generatePesan('Berhasil Mengubah Data', 'berhasil');
      } else {
        $this->m_umum->generatePesan('Gagal Mengubah Data', 'gagal');
      }
      redirect('admin/fakultas/add');
    }
    $data = [
      "userLogin" => $this->session->userdata('loginData'),
      "v_content" => 'member/fakultas/add',
      "title"   => "Tambah Data Fakultas",
      "breadcrumb" => 'Fakultas/Add Data',
    ];
    $this->load->view('layout', $data);
  }
  public function edit($id)
  {
    $fakultas = $this->db->get_where("tbl_fakultas", ["fakultas_id" => $id])->row();
    $this->form_validation->set_rules("fakultas", "Nama Fakultas", "required");

    if ($this->form_validation->run()) {
      $post = $this->input->post();
      $insert['fakultas_nama'] = $post['fakultas'];
      $insert = $this->db->where("fakultas_id", $id)->update('tbl_fakultas', $insert);
      if ($insert) {
        $this->session->set_flashdata("success", "Berhasil Mengubah Data");
      } else {
        $this->session->set_flashdata("danger", "Gagal Mengubah Data");
      }
      redirect('admin/fakultas');
    }
    $data = [
      "userLogin" => $this->session->userdata('loginData'),
      "v_content" => 'member/fakultas/edit',
      "title"   => "Edit Data Fakultas",
      "fakultas" => $fakultas,
      "breadcrumb" => 'Fakultas/Edit Data',
    ];
    $this->load->view('layout', $data);
  }

  public function hapus($id)
  {
    if ($this->db->where("id_fakultas", $id)->get("tbl_prodi")->row()) {
      $this->session->set_flashdata("danger", "Mohon Maaf Ada Tabel Prodi yang bersangkutan, Fakultas Gagal Di hapus");
      return $this->output->set_content_type('application/json')
        ->set_output(json_encode([
          'status' => false,
          "message" => "Masih Ada data prodi"
        ]));
    } else {
      if ($this->m_crud->delete('tbl_fakultas', $id)) {
        $this->m_umum->generatePesan('Berhasil Menghapus Data', 'berhasil');
        return $this->output->set_content_type('application/json')
          ->set_output(json_encode([
            'status' => true,
            "message" => "Sukses menghapus fakultas"
          ]));
      } else {
        $this->m_umum->generatePesan('Gagal Menghapus Data', 'gagal');
        return $this->output->set_content_type('application/json')
          ->set_output(json_encode([
            'status' => false,
            "message" => "Gagal menghapus fakultas"
          ]));
      }
    }

    redirect($_SERVER['HTTP_REFERER']);
  }
}
