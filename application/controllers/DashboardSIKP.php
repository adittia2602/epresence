<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardSIKP extends CI_Controller
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
        $data['title'] = 'Dashboard';
        $data['bc'] = $this->modul->getBreadcrumb($data['title']);
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('name')])->row_array();
        
        switch ( $data['user']['role_id'] ) {
            case 4 :
                    $data['step1'] = 'd-none';
                    $data['step2'] = 'd-block';  
                    $data['umi'] = $this->ws->fetchData('GET','report/bav',''); 
                    break;

            case 5 : 
                    $data['step1'] = 'd-block';
                    $data['step2'] = 'd-none'; 
                    $formdata = [
                        'penyalur' => 'PEGADAIAN',
                        'kodelama' => '0200',
                        'kodebaru' => '012'
                    ];
                    $data['profil'] = $this->ws->fetchData('POST','profilpenyalur',$formdata);
                    ini_set('max_execution_time', 500);
                    break;

            case 6 : //PNM; 
                    break; 
        }
        ini_set('max_execution_time', 500);

        $this->load->view('templates/header', $data); // untuk memanggil template header
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dashboardSIKP/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function penyaluran()
    {
        $data['title'] = 'Penyaluran';
        $data['subtitle'] = 'Silahkan Pilih Penyalur';
        $data['bc'] = $this->modul->getBreadcrumb($data['title']);
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('name')])->row_array();

        $data['penyalur'] = $this->ws->fetchData('GET','penyalur','');

        $this->form_validation->set_rules('penyalur', 'Penyalur', 'required');

        if ($this->form_validation->run() == false) {
            $data['showlist'] = 'd-block';
            $data['showprofil'] = 'd-none';
        } else {
            $data['showlist'] = 'd-none';
            $data['showprofil'] = 'd-block';
            $idpenyalur = $this->input->post('penyalur');
            $penyalurs = $data['penyalur'];

            foreach ( $penyalurs as $p ){
                if ($p['KODEBARU'] ===  $idpenyalur){
                    $penyalur = $p['PENYALUR'];
                    $kodelama = $p['KODELAMA'];
                    $kodebaru = $idpenyalur;
                    break;
                }
                else { continue; }
            }

            $formdata = [
                'penyalur' => $penyalur,
                'kodelama' => $kodelama,
                'kodebaru' => $kodebaru
            ];
            $data['profil'] = $this->ws->fetchData('POST','profilpenyalur',$formdata);
            $data['umi'] = $this->ws->fetchData('GET','report/penyaluran','');
            ini_set('max_execution_time', 300);
        }
        
        $this->load->view('templates/header', $data); // untuk memanggil template header
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dashboardSIKP/penyaluran', $data);
        $this->load->view('templates/footer');
    }

    public function pencarian()
    {
        $data['title'] = 'Pencarian';
        $data['subtitle'] = 'Silahkan input NIK Debitur UMi';
        $data['bc'] = $this->modul->getBreadcrumb($data['title']);
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('name')])->row_array();
        $data['show'] = 'd-none';

        $this->form_validation->set_rules('nik', 'NIK', 'required|min_length[16]|max_length[16]');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data); // untuk memanggil template header
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('dashboardSIKP/pencarian', $data);
            $this->load->view('templates/footer');
        } else {
            $nik = $this->input->post('nik');
            redirect('dashboardSIKP/debiturinfo/'.$nik);
        }
    }

    public function debiturinfo($nik)
    {
        $data['title'] = 'Debitur';
        $data['subtitle'] = 'Silahkan input NIK Debitur UMi';
        $data['bc'] = $this->modul->getBreadcrumb($data['title']);
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('name')])->row_array();
        $data['show'] = 'd-block';
        $data['showTable'] = 'd-block';
        $data['showStatus'] = 'd-none';

        $user = $this->whoAmI();
        $nikdebtor = $this->ws->fetchData('GET','nik/'.$nik,'');


        // NIK tidak ada di UMi
        if( is_null($nikdebtor['NIK']) ){
            $data['found'] = 0; 
            $data['keterangan'] = 'Maaf, data NIK yang anda input tidak ditemukan dalam database pembiayaan Ultra Mikro';
        }
        else {
            // Check apakah data NIK kepunyaan user login 
            if ( $user === $nikdebtor['PENYALUR'] ){
                
                $data['found'] = 1; 
                
                // NIK mempunyai history pembiayaan di penyalur user    
                if( empty($nikdebtor['STATUS']) ){
                    $data['debtor'] = $this->ws->fetchData('GET','debitur/'.$nik,'');
                }
                else {
                    $data['debtor'] = $nikdebtor;
                    $data['showTable'] = 'd-none';
                    $data['showStatus'] = 'd-block';
                }

            }
            else {
                $data['found'] = 0; 
                $data['keterangan'] = 'Maaf, data NIK yang anda input mempunyai pembiayaan di Penyalur lain';
            }

        }

        $this->load->view('templates/header', $data); // untuk memanggil template header
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dashboardSIKP/pencarian', $data);
        $this->load->view('templates/footer');
    }

    public function whoAmI()
    {
        $user = $this->db->get_where('user', ['username' => $this->session->userdata('name')])->row_array();

        switch ( $user['role_id'] ) {
            case 4 :
                    $penyalur = 'BAV';
                    break;
            case 5 : 
                    $penyalur = 'PEGADAIAN';
                    break;
            case 6 : 
                    $penyalur = 'PNM';
                    break; 
        }

        return $penyalur;
    }
}
