<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bios extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Basic_mods', 'modul');
        $this->load->model('WS_mods', 'ws');
    }

    public function index()
    {
        $data['title'] = 'BIOS';
        $data['bc'] = $this->modul->getBreadcrumb($data['title']);
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('name')])->row_array();

        $data['kodeakunpdpt'] = $this->ws->fetchData('GET','bios/referensi/01','');
        $data['kodeakunblj']  = $this->ws->fetchData('GET','bios/referensi/02','');
        $data['kodebank']     = $this->ws->fetchData('GET','bios/referensi/04','');

        $data['saldo']       = $this->ws->fetchData('GET','bios/list/saldo','');
        $data['pendapatan']  = $this->ws->fetchData('GET','bios/list/transaksi/01','');
        $data['belanja']     = $this->ws->fetchData('GET','bios/list/transaksi/02','');

        $this->load->view('templates/header', $data); // untuk memanggil template header
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('bios/index', $data);
        $this->load->view('templates/footer'); // untuk memanggil template footer
    }

    public function addSaldo()
    {
        $formdata = [
            'kodebank' => $this->input->post('kodebank'),
            'tgltransaksi' => $this->input->post('tgltransaksi'),
            'koderekening' => $this->input->post('koderekening'),
            'norekening' => $this->input->post('norekening'),
            'saldo' => $this->input->post('saldo')
        ];
        $addSaldo = $this->ws->fetchData('POST','bios/add/saldo',$formdata);
        ini_set('max_execution_time', 300);
        
        if ($addSaldo){
            $this->session->set_flashdata('message',
                '<div class="alert alert-success alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        Data Saldo berhasil ditambah
                    </div>
                </div>');
        } 
        else {
            $this->session->set_flashdata('message',
                '<div class="alert alert-danger alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        Terjadi kesalahan penginputan saldo! 
                    </div>
                </div>');
        } 
        
        redirect('bios');
    }

    public function addPendapatan()
    {
        $formdata = [
            'kodetransaksi' => '01',
            'tgltransaksi' => $this->input->post('tgltransaksi'),
            'kodeakun' => $this->input->post('kodeakun'),
            'jumlah' => $this->input->post('jumlah')
        ];
        $addTRX = $this->ws->fetchData('POST','bios/add/transaksi',$formdata);
        ini_set('max_execution_time', 300);
        
        if ($addTRX){
            $this->session->set_flashdata('message',
                '<div class="alert alert-success alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        Data Pendapatan berhasil ditambah
                    </div>
                </div>');
        } 
        else {
            $this->session->set_flashdata('message',
                '<div class="alert alert-danger alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        Terjadi kesalahan penginputan Pendapatan! 
                    </div>
                </div>');
        } 
        
        redirect('bios');
    }

    public function addBelanja()
    {
        $formdata = [
            'kodetransaksi' => '02',
            'tgltransaksi' => $this->input->post('tgltransaksi'),
            'kodeakun' => $this->input->post('kodeakun'),
            'jumlah' => $this->input->post('jumlah')
        ];
        $addTRX = $this->ws->fetchData('POST','bios/add/transaksi',$formdata);
        ini_set('max_execution_time', 300);
        
        if ($addTRX){
            $this->session->set_flashdata('message',
                '<div class="alert alert-success alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        Data Belanja berhasil ditambah
                    </div>
                </div>');
        } 
        else {
            $this->session->set_flashdata('message',
                '<div class="alert alert-danger alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        Terjadi kesalahan penginputan belanja! 
                    </div>
                </div>');
        } 
        
        redirect('bios');
    }

}
