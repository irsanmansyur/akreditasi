<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dokumen extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_umum');
        $this->load->model('m_crud');
    }


    public function penelitian()
    {
        $data = [
            "userLogin" => $this->session->userdata('loginData'),
            "v_content" => 'member/dokumen/penelitian',
            "title"     => "Penelitian Dosen Tetap",
            "breadcrumb" => 'Penelitian Dosen Tetap'
        ];
        $this->load->view('layout', $data);
    }

    public function artikel()
    {
        $data = [
            "userLogin" => $this->session->userdata('loginData'),
            "v_content" => 'member/dokumen/artikel',
            "title"     => "Karya Dosen Tetap",
            "breadcrumb" => 'Karya Dosen Tetap'
        ];
        $this->load->view('layout', $data);
    }

    public function sitasi()
    {
        $data = [
            "userLogin" => $this->session->userdata('loginData'),
            "v_content" => 'member/dokumen/sitasi',
            "title"     => "Sitasi",
            "breadcrumb" => 'Sitasi'
        ];
        $this->load->view('layout', $data);
    }

    public function haki()
    {
        $data = [
            "userLogin" => $this->session->userdata('loginData'),
            "v_content" => 'member/dokumen/haki',
            "title"     => "Koleksi Penghargaan",
            "breadcrumb" => 'Koleksi Penghargaan'
        ];
        $this->load->view('layout', $data);
    }

    public function abdimas()
    {
        $data = [
            "userLogin" => $this->session->userdata('loginData'),
            "v_content" => 'member/dokumen/abdimas',
            "title"     => "Kegiatan Pengabdian Kepada Masyarakat",
            "breadcrumb" => 'Kegiatan Pengabdian Kepada Masyarakat'
        ];
        $this->load->view('layout', $data);
    }

    public function dalam_negri()
    {
        $data = [
            "userLogin" => $this->session->userdata('loginData'),
            "v_content" => 'member/dokumen/dalam_negri',
            "title"     => "Kerjasama Dalam Negri",
            "breadcrumb" => 'Kerjasama Dalam Negri'
        ];
        $this->load->view('layout', $data);
    }

    public function luar_negri()
    {
        $data = [
            "userLogin" => $this->session->userdata('loginData'),
            "v_content" => 'member/dokumen/abdimas',
            "title"     => "Kerjasama Luar Negri",
            "breadcrumb" => 'Kerjasama Luar Negri'
        ];
        $this->load->view('layout', $data);
    }
}
