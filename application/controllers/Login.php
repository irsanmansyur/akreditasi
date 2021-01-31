<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_login');
    }
	
	public function index()
	{
        /*if(!empty($this->session->userdata('loginData'))){
            redirect('admin/dashboard');
        }*/

        $data['project_name'] = "y";
        $data['established'] = "2019";

        $this->load->view('login',$data);
	}
		
	public function doLogin() {
        $dataPost = $this->input->post();
        //var_dump($dataPost); exit;
        $login = $this->m_login->checkLogin($dataPost['username'], md5($dataPost['password']));
        if ($login) {
            redirect('admin/dashboard');  
        }else{
            $this->session->set_flashdata('GagalLogin', 'Ya');
            redirect('login');
        }
    }


    function log(){
        $this->session->unset_userdata('loginData');
        redirect('login');
    }
       
}
