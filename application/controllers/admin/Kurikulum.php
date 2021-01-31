<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kurikulum extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_umum');
    }


    public function view()
    {
        $data['userLogin']     = $this->session->userdata('loginData');
        $data['breadcrumb'] = "Kurikulum";
        $data['title'] = "Kurikulum";
        $data['v_content']     = 'member/kurikulum/view';
        $this->load->view('layout', $data);
    }
}
