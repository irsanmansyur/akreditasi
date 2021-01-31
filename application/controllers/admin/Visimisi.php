<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Visimisi extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
        $this->load->model('m_crud');
    }


    public function index()
	{
		$data = [
			"userLogin" => $this->session->userdata('loginData'),
			"v_content" => 'member/visimisi/index',
			"title" 	=> "Visi Misi & Tujuan",
			"breadcrumb" => 'Visi Misi & Tujuan',
			"value"		=> $this->m_crud->getdata('tbl_profil_univ')->row(),
		];
		$this->load->view('layout',$data);
	}

	public function setting()
	{
		$data = [
			"userLogin" => $this->session->userdata('loginData'),
			"v_content" => 'member/visimisi/setting',
			"title" 	=> "Setting Visi Misi & Tujuan",
			"breadcrumb" => 'Visi Misi & Tujuan / Setting',
			"value"		=> $this->m_crud->getdata('tbl_profil_univ')->row(),
		];
		$post = $this->input->post();
		if(isset($post['submit'])){
			//var_dump($post); exit;
			$insertData = [
				'visi' => $post['visi'],
				'misi' => $post['misi'],
				'tujuan' => $post['tujuan'],
			];

			if($this->m_crud->update('tbl_profil_univ',$insertData)){
				$this->m_umum->generatePesan('Berhasil Mengubah Data','berhasil');
			}else{
				$this->m_umum->generatePesan('Gagal Mengubah Data','gagal');
			}
			redirect($_SERVER['HTTP_REFERER']);
		}

		$this->load->view('layout',$data);
	}

	function upload_image(){

		$upload_path = './uploads';
		$this->load->library('image_lib');
		if ($_FILES['image']['name'] <> "") {
			$ext  = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
			$foto = "FI".date("dmYHis").rand(100,999).".".$ext;

			$config['upload_path']   = $upload_path;
			$config['allowed_types'] = 'PNG|png|JPG|jpg|JPEG|jpeg';
			$config['file_name']     = $foto;
			$config['quality']= '50%';

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('image')){
				$error = 'error: '. $this->upload->display_errors();
				$dataArray ['results']['status_request'] = "Gagal";
				$dataArray ['results']['msg'] = "Foto Tidak Ada";
				echo json_encode($dataArray);
				die;
			}else{
				$data = $this->upload->data();
                //Compress Image
                $config['image_library']='gd2';
                $config['source_image']='./assets/images/'.$data['file_name'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= TRUE;
                $config['quality']= '60%';
                $config['width']= 800;
                $config['height']= 800;
                $config['new_image']= './assets/images/'.$data['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                echo base_url().'uploads/'.$data['file_name'];
                exit;
			}
		}
    }
 
    //Delete image summernote
    function delete_image(){
        $src = $this->input->post('src');
        $file_name = str_replace(base_url(), '', $src);
        if(unlink($file_name))
        {
            echo 'File Delete Successfully';
        }
    }
}
