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
        
        $cod_awal = $this->input->post('cod_awal');   
        $cod_akhir = $this->input->post('cod_akhir');   
        $data['cod_akhir'] = isset($cod_akhir) ? $cod_akhir : date("Y-m-d"); 
        $data['cod_awal'] = isset($cod_awal) ? $cod_awal : date("Y-m-d"); 
        $data['absensi'] = $this->modsEmployee->getAbsencePegawai($data['user']['nip_pegawai'],$data['cod_awal'],$data['cod_akhir']);

        $this->load->view('templates/header', $data); // untuk memanggil template header
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kepegawaian/absensi', $data);
        $this->load->view('templates/footer', $data);
    }
}
