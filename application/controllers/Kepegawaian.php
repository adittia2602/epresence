<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kepegawaian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Basic_mods', 'modul');
        $this->load->model('Employee_mods', 'modsEmployee');
    }

    public function index()
    {
        $data['title'] = 'List Pegawai';
        $data['subtitle'] = 'List Data Pegawai';
        $data['bc'] = $this->modul->getBreadcrumb($data['title']);
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('name')])->row_array();
        
        $data['pegawai'] = $this->modsEmployee->getDataPegawai($data['user']['nip_pegawai']);

        $this->load->view('templates/header', $data); // untuk memanggil template header
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kepegawaian/listpegawai', $data);
        $this->load->view('templates/footer', $data);
    }

    public function absensi()
    {
        $data['title'] = 'Daftar Absensi';
        $data['bc'] = $this->modul->getBreadcrumb($data['title']);
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('name')])->row_array();
        
        $cod = $this->input->post('cod');   
        $data['cod'] = isset($cod) ? $cod : date("Y-m-d"); 
        $data['pegawai'] = $this->modsEmployee->getDataPegawai($data['user']['nip_pegawai']);


        $data['absensi'] = $this->modsEmployee->getAbsencePegawai($data['user']['nip_pegawai'],$data['cod']);

        $this->load->view('templates/header', $data); // untuk memanggil template header
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kepegawaian/absensi', $data);
        $this->load->view('templates/footer', $data);
    }
}
