<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dana extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_umum');
        $this->load->model('m_crud');
    }


    public function penerimaan()
    {
        $data = [
            "userLogin" => $this->session->userdata('loginData'),
            "v_content" => 'member/dana/penerimaan',
            "title"     => "Dana",
            "breadcrumb" => 'Dana',
        ];
        $this->load->view('layout', $data);
    }

    public function penggunaan()
    {
        $data = [
            "userLogin" => $this->session->userdata('loginData'),
            "v_content" => 'member/dana/penggunaan',
            "title"     => "Dana",
            "breadcrumb" => 'Dana',
        ];
        $this->load->view('layout', $data);
    }

    public function penelitian()
    {
        $data = [
            "userLogin" => $this->session->userdata('loginData'),
            "v_content" => 'member/dana/penelitian',
            "title"     => "Dana",
            "breadcrumb" => 'Dana',
        ];
        $this->load->view('layout', $data);
    }

    public function pkm()
    {
        $data = [
            "userLogin" => $this->session->userdata('loginData'),
            "v_content" => 'member/dana/pkm',
            "title"     => "Dana",
            "breadcrumb" => 'Dana',
        ];
        $this->load->view('layout', $data);
    }

    public function aksesibilitas()
    {
        $data = [
            "userLogin" => $this->session->userdata('loginData'),
            "v_content" => 'member/dana/aksesibilitas',
            "title"     => "Dana",
            "breadcrumb" => 'Dana',
        ];
        $this->load->view('layout', $data);
    }

    public function lahan()
    {
        $data = [
            "userLogin" => $this->session->userdata('loginData'),
            "v_content" => 'member/dana/lahan',
            "title"     => "Dana",
            "breadcrumb" => 'Dana',
        ];
        $this->load->view('layout', $data);
    }
}
