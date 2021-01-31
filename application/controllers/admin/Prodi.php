<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Prodi extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('m_umum');
    $this->load->model('m_crud');
    $this->load->model('m_prodi');
    $this->load->library("form_validation");
  }


  public function index()
  {
    $data = [
      "userLogin" => $this->session->userdata('loginData'),
      "v_content" => 'member/prodi/index',
      "title"   => "Prodi",
      "breadcrumb" => 'Prodi',
      "prodies"   => $this->db->from("tbl_prodi")->join('tbl_jenjang', "tbl_prodi.id_subjenjang=tbl_jenjang.jenjang_id")->join('tbl_akreditasi', "tbl_akreditasi.akreditasi_id=tbl_prodi.id_akreditasi")->join('tbl_fakultas', "tbl_fakultas.fakultas_id=tbl_prodi.id_fakultas")->get()->result(),
    ];
    $this->load->view('layout', $data);
  }

  public function add()
  {
    $this->form_validation->set_rules("id_subjenjang", "Jenjang", "required");
    $this->form_validation->set_rules("fakultas", "fakultas", "required");
    $this->form_validation->set_rules("prodi_nama", "Nama Prodi", "required");
    $this->form_validation->set_rules("no_sk", "No SK", "required");
    $this->form_validation->set_rules("tahun_sk", "Tahun SK", "required");
    $this->form_validation->set_rules("daluarsa", "Daluarsa", "required");
    $this->form_validation->set_rules("id_akreditasi", "Akreditasi", "required");

    if ($this->form_validation->run()) {
      $post = $this->input->post();
      $insert = [
        'id_subjenjang' => $post['id_subjenjang'],
        'id_fakultas'   => $post['fakultas'],
        'prodi_nama'   => $post['prodi_nama'],
        'tahun_sk'   => $post['tahun_sk'],
        'no_sk'     => $post['no_sk'],
        "sertifikat" => $this->upload(),
        'daluarsa'     => $post['daluarsa'],
        'id_akreditasi' => $post['id_akreditasi'],
      ];
      $insert = $this->db->insert('tbl_prodi', $insert);
      if ($insert) {
        $this->m_umum->generatePesan('Berhasil Menambah Data', 'berhasil');
      } else {
        $this->m_umum->generatePesan('Gagal MEnambah Data', 'gagal');
        return redirect('admin/prodi/add');
      }
      return redirect('admin/prodi');
    }
    $data = [
      "userLogin" => $this->session->userdata('loginData'),
      "v_content" => 'member/prodi/add',
      "title"   => "Tambah Data Prodi",
      "breadcrumb" => 'Prodi/Add Data',
      "jenjang"    => $this->m_crud->getdata('tbl_jenjang')->result(),
      "fakultas"    => $this->m_crud->getdata('tbl_fakultas')->result(),
      "akreditasi"  => $this->m_crud->getdata('tbl_akreditasi')->result(),
    ];
    $this->load->view('layout', $data);
  }
  public function edit($id)
  {
    $prodi = $this->db->get_where("tbl_prodi", ["prodi_id" => $id])->row();
    $this->form_validation->set_rules("id_subjenjang", "Jenjang", "required");
    $this->form_validation->set_rules("fakultas", "fakultas", "required");
    $this->form_validation->set_rules("prodi_nama", "Nama Prodi", "required");
    $this->form_validation->set_rules("no_sk", "No SK", "required");
    $this->form_validation->set_rules("tahun_sk", "Tahun SK", "required");
    $this->form_validation->set_rules("daluarsa", "Daluarsa", "required");
    $this->form_validation->set_rules("id_akreditasi", "Akreditasi", "required");
    if ($this->form_validation->run()) {
      $post = $this->input->post();
      $insert = [
        'id_subjenjang' => $post['id_subjenjang'],
        'id_fakultas'   => $post['fakultas'],
        'prodi_nama'   => $post['prodi_nama'],
        'tahun_sk'   => $post['tahun_sk'],
        'no_sk'     => $post['no_sk'],
        "sertifikat" => $this->upload($prodi->sertifikat),
        'daluarsa'     => $post['daluarsa'],
        'id_akreditasi' => $post['id_akreditasi'],
      ];
      if ($_FILES['sertifikat']['name'] && $insert["sertifikat"] == $prodi->sertifikat) {
        return redirect('admin/prodi/edit/' . $id);
      }
      $update = $this->db->where("prodi_id", $id)->update('tbl_prodi', $insert);
      if ($update) {
        $this->session->set_flashdata("success", "Berhasil Mengubah Data");
        $this->m_umum->generatePesan('Berhasil Mengubah Data', 'berhasil');
      } else {
        $this->session->set_flashdata("danger", "gagal Mengubah Data");
        $this->m_umum->generatePesan('Gagal Mengubah Data', 'gagal');
        return redirect('admin/prodi/edit/' . $id);
      }
      return redirect('admin/prodi');
    }
    $data = [
      "userLogin" => $this->session->userdata('loginData'),
      "v_content" => 'member/prodi/edit',
      "title"   => "Edit Data Prodi",
      "breadcrumb" => 'Prodi/Edit Data',
      "prodi" => $prodi,
      "jenjang"    => $this->m_crud->getdata('tbl_jenjang')->result(),
      "fakultas"    => $this->m_crud->getdata('tbl_fakultas')->result(),
      "akreditasi"  => $this->m_crud->getdata('tbl_akreditasi')->result(),
    ];
    $this->load->view('layout', $data);
  }
  private function upload($filename = '')
  {
    if ($_FILES['sertifikat']['name']) {
      $config['allowed_types'] = 'pdf';
      $config['max_size']      = '2048';
      $config['upload_path'] = './uploads/sertifikat/';
      $this->load->library('upload', $config);

      if ($this->upload->do_upload('sertifikat')) {
        if (is_file(FCPATH . 'uploads/sertifikat/' . $filename) && $filename != 'default.jpg')
          unlink(FCPATH . 'uploads/sertifikat/' . $filename);
        $filename = $this->upload->data('file_name');
      } else {
        echo $err = $this->upload->display_errors();
        $this->session->set_flashdata("sertifikat_error", "<div class='text-danger'>{$err}</div>");
      }
    }
    return $filename;
  }

  public function delete($id)
  {
    if ($this->db->where("prodi_id", $id)->delete('tbl_prodi')) {
      $this->m_umum->generatePesan('Berhasil Menghapus Data', 'berhasil');
    } else {
      $this->m_umum->generatePesan('Gagal Menghapus Data', 'gagal');
    }
    redirect($_SERVER['HTTP_REFERER']);
  }

  public function breakdown_prodi($id_sub_jenjang, $id_akreditasi)
  {
    $listing  = $this->m_prodi->listing($id_sub_jenjang, $id_akreditasi);

    $data = array(
      'title'    => "List Prodi",
      'v_content' => 'member/prodi/listing',
      'listing'  => $listing,
      "breadcrumb" => 'Prodi',
      "value"    => $this->m_crud->getdata('tbl_prodi')->row(),
    );


    $table    = 'tbl_prodi';
    $maungapain = $this->uri->segment(4);
    $baiklah   = $this->uri->segment(5);

    if ($maungapain == "hapus") {
      $hapus = $this->m_crud->hapusprodi($table, $baiklah);
      if ($hapus) {
        $this->m_umum->generatePesan('Berhasil Menghapus Data', 'berhasil');
      } else {
        $this->m_umum->generatePesan('Gagal Menghapus Data', 'gagal');
      }
      redirect('admin/akreditasi');
    } else if ($maungapain == "edit") {
      $data = [
        "userLogin"   => $this->session->userdata('loginData'),
        "v_content"   => 'member/prodi/edit',
        "title"     => "Edit Data Prodi",
        "breadcrumb"   => 'Prodi/Edit Data',
        "prodi"      => $this->m_crud->getdata('tbl_prodi')->result(),
        "jenjang"    => $this->m_crud->getdata('tbl_jenjang')->result(),
        "subjenjang"  => $this->m_crud->getdata('tbl_subjenjang')->result(),
        "fakultas"    => $this->m_crud->getdata('tbl_fakultas')->result(),
        "akreditasi"  => $this->m_crud->getdata('tbl_akreditasi')->result(),
        "pilihan"    => $this->db->query("SELECT * FROM tbl_prodi, tbl_jenjang, tbl_subjenjang, tbl_fakultas, tbl_akreditasi
                          WHERE tbl_prodi.id_fakultas = tbl_fakultas.fakultas_id
                          AND tbl_prodi.id_subjenjang = tbl_jenjang.jenjang_id
                          AND tbl_prodi.id_akreditasi = tbl_akreditasi.akreditasi_id
                          AND prodi_id = $baiklah")->row(),
      ];
      $this->load->view('layout', $data);

      // ====================================================================================================
      //  INI UNTUK EDIT DATA BESERTA EDIT/SERTIFIKAT/UPLOAD SERTIFIKAT =====================================
      // ====================================================================================================
    } else if ($maungapain == "editan") {
      // Ambil variable postingan dari form add
      $id_subjenjang  = addslashes($this->input->post('id_subjenjang'));
      $id_fakultas  = addslashes($this->input->post('id_fakultas'));
      $prodi_nama    = addslashes($this->input->post('prodi_nama'));
      $no_sk      = addslashes($this->input->post('no_sk'));
      $daluarsa    = addslashes($this->input->post('daluarsa'));
      $sertifikat    = addslashes($this->input->post('sertifikat'));
      $id_akreditasi  = addslashes($this->input->post('id_akreditasi'));

      //upload config 
      $namafilea          = date("Ymd-Hms-", time()) . $_FILES["sertifikat"]['name'];
      $config['file_name']     = $namafilea;
      $config['upload_path']     = './uploads/sertifikat'; // Ini lokasi file tempat diisimpan ( jgn lupa buat manual folder 'sertifikat' dalam folder uploads, kalo ga ada folder ini dia bakalan eror)
      $config['allowed_types']   = 'gif|jpg|jpeg|png|bmp|rtf|pdf|doc|docx|xls|xlsx';
      $config['max_size']      = '90000';
      $config['max_width']      = '9000';
      $config['max_height']     = '9000';
      $this->load->library('upload', $config);

      if ($this->upload->do_upload('sertifikat')) {  // Jika user klik upload file
        $up_data     = $this->upload->data();  // Perintah upload file
        $this->db->query("UPDATE $table SET id_subjenjang 	= '$id_subjenjang', 
													id_fakultas 	= '$id_fakultas', 
													prodi_nama 		= '$prodi_nama', 
													no_sk 			= '$no_sk', 
													daluarsa 		= '$daluarsa', 
													sertifikat 		= '" . $up_data['file_name'] . "',
													id_akreditasi 	= '$id_akreditasi'  
													WHERE prodi_id 	= $baiklah");
        redirect('admin/akreditasi');
      } else {
        $this->db->query("UPDATE $table SET id_subjenjang 	= '$id_subjenjang', 
													id_fakultas 	= '$id_fakultas', 
													prodi_nama 		= '$prodi_nama', 
													no_sk 			= '$no_sk', 
													daluarsa 		= '$daluarsa', 
													sertifikat 		= '" . $up_data['file_name'] . "',
													id_akreditasi 	= '$id_akreditasi'  
													WHERE prodi_id 	= $baiklah");
        redirect('admin/akreditasi');
      }
      // ====================================================================================================
      //  SAMPAI DISINI UNTUK EDIT DATA BESERTA EDIT/SERTIFIKAT/UPLOAD SERTIFIKAT ===========================
      // ====================================================================================================		
    } else {

      $this->load->view('layout', $data);
    }
  }
}
