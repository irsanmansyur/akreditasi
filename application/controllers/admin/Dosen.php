<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dosen extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_umum');
        $this->load->model('m_crud');
    }


    public function dosen_tetap()
    {
        $data['userLogin']     = $this->session->userdata('loginData');
        $data['breadcrumb'] = "Dosen / Dosen Tetap Institusi";
        $data['title'] = "Dosen Tetap Institusi";
        $data['v_content']     = 'member/dosen/dosen_tetap';
        $this->load->view('layout', $data);
    }

    public function dosen_tidak_tetap()
    {
        $data['userLogin']     = $this->session->userdata('loginData');
        $data['breadcrumb'] = "Dosen / Dosen Tidak Tetap Institusi";
        $data['title'] = "Dosen Tidak Tetap Institusi";
        $data['v_content']     = 'member/dosen/dosen_tidak_tetap';
        $this->load->view('layout', $data);
    }

    public function peningkatan_dosen()
    {
        $data['userLogin']     = $this->session->userdata('loginData');
        $data['breadcrumb'] = "Dosen / Peningkatan Dosen";
        $data['title'] = "Peningkatan Dosen";
        $data['v_content']     = 'member/dosen/peningkatan_dosen';
        $this->load->view('layout', $data);
    }

    public function tenaga_kependidikan()
    {
        $data['userLogin']     = $this->session->userdata('loginData');
        $data['breadcrumb'] = "Tenaga Kependidikan";
        $data['title'] = "Tenaga Kependidikan";
        $data['v_content']     = 'member/dosen/tenaga_kependidikan';
        $this->load->view('layout', $data);
    }

    public function index()
    {
        $data = [
            "userLogin"         => $this->session->userdata('loginData'),
            "v_content"         => 'member/dosen/index',
            "title"             => "Dosen",
            "breadcrumb"        => 'Dosen',
            "listData"          => $this->m_crud->getjoiningdata($data = ['tbl_dosen', 'tbl_prodi', 'tbl_fakultas'])->result(),
        ];
        $this->load->view('layout', $data);
    }
}
