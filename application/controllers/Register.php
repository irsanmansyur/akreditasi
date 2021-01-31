<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_login');
        $this->load->model('m_umum');
    }

    public function index(){
    	echo "OK";
    	$data['userLogin'] 	= $this->session->userdata('loginData');
		$this->load->view('member/Register',$data);
    }

    public function doRegister(){
    	$post = $this->input->post();
    	$data = array(
    		'username' => $post['username'],
    		'password' => md5($post['password']),
    		'nama'	   => $post['nama']
    	);

    	if($this->db->insert('tbl_user',$data)){
    		$this->m_umum->generatePesan('Pendaftaran Berhasil','berhasil');
    		redirect('login');
    	}else{
    		$this->m_umum->generatePesan('Pendaftaran Gagal!','gagal');
    		redirect('register');
    	}
    }
}