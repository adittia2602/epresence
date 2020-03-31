<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('WS_mods', 'ws');
    }
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('name')])->row_array();
        ini_set('max_execution_time', 300);

        // TABLE
        $data['overview'] = $this->ws->fetchData('GET','overview','');
        $data['umiallpartner'] = $this->ws->fetchData('GET','report/penyaluran/allpartner','');
        $data['umilkbb'] = $this->ws->fetchData('GET','report/penyaluran/lkbb','');


        // LOAD VIEW
        $this->load->view('templates/header', $data); // untuk memanggil template header
        $this->load->view('templates/dash_topbar', $data);
        $this->load->view('dashboard/index', $data);

    }
}
