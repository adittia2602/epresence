<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Basic_mods', 'modul');
        $this->load->model('Employee_mods', 'modsEmployee');
    }

    public function absensi() 
    {
        $data['title'] = 'Absensi';
        $data['bc'] = $this->modul->getBreadcrumb($data['title']);
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('name')])->row_array();
        
        $data['pegawai'] = $this->modsEmployee->getUserData($data['user']['nip_pegawai']);
        $data['absensi'] = $this->modsEmployee->getLaporan($data['user']['nip_pegawai']);
        
        $this->load->view('templates/header', $data); // untuk memanggil template header
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/absensi', $data);
        $this->load->view('templates/footer', $data);
    }

    public function list() 
    {
        $data['title'] = 'List Laporan';
        $data['bc'] = $this->modul->getBreadcrumb($data['title']);
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('name')])->row_array();
        
        $data['pegawai'] = $this->modsEmployee->getUserData($data['user']['nip_pegawai']);
        $data['laporan'] = $this->modsEmployee->getLaporan($data['user']['nip_pegawai']);

        $this->load->view('templates/header', $data); // untuk memanggil template header
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/list', $data);
        $this->load->view('templates/footer', $data);
    }

    public function input() 
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('name')])->row_array();
        $data['pegawai'] = $this->modsEmployee->getUserData($data['user']['nip_pegawai']);

        $this->form_validation->set_rules('kondisi', 'kondisi', 'required');
        $this->form_validation->set_rules('uraiankegiatan', 'uraiankegiatan', 'required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Input Laporan';
            $data['bc'] = $this->modul->getBreadcrumb($data['title']);
            

            $this->load->view('templates/header', $data); // untuk memanggil template header
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('laporan/input', $data);
            $this->load->view('templates/footer', $data);
        }
        else {
            $data = [
                'user_id' => $data['user']['id'],
                'nip_pegawai' => $data['pegawai']['nip_pegawai'],
                'kehadiran' => 'Hadir',
                'status_laporan' => '1',
                'clockin' => date('Y-m-d H:i:s'),
                'judul_kegiatan' => $this->input->post('judul'),
                'uraian_kegiatan' => $this->input->post('uraiankegiatan'),
                'kondisi_kesehatan' => $this->input->post('kondisi'),
                'uraian_kondisi_kesehatan' => $this->input->post('uraiankondisi'),
            ];

            if ($this->modsEmployee->inputLaporan($data)){
                $this->session->set_flashdata('message',
                    '<div class="alert alert-success alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            Kegiatan WHF berhasil di input!
                        </div>
                    </div>');
            } else {
                $this->session->set_flashdata('message',
                    '<div class="alert alert-danger alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            Kegiatan WFH gagal di input!
                        </div>
                    </div>');
            }
            redirect('laporan/list');
        }
    }

    public function approval()
    {
        $data['title'] = 'Approval Laporan';
        $data['bc'] = $this->modul->getBreadcrumb($data['title']);
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('name')])->row_array();
        
        $data['pegawai'] = $this->modsEmployee->getUserData($data['user']['nip_pegawai']);
        $data['laporan'] = $this->modsEmployee->getLaporanPegawai($data['user']['nip_pegawai']);

        $this->load->view('templates/header', $data); // untuk memanggil template header
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/approval', $data);
        $this->load->view('templates/footer', $data);
    }

    public function approveLaporan($idLaporan,$nipapproval)
    {   
        if(isset($_POST['approve'])) { 
            $status = 2;
        }
        else if(isset($_POST['reject'])) { 
            $status = 0;
        }

        $data = [
            'status_laporan' => $status,
            'approval_by' => $nipapproval,
            'approval_ts' => date('Y-m-d H:i:s')
        ];
        
        if ($this->modsEmployee->updateLaporan($idLaporan,$data)) {
            $this->session->set_flashdata('message',
            '<div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    Laporan Approved!
                </div>
            </div>');

        } else {
            $this->session->set_flashdata('message',
            '<div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                    <?= $this->db->_error_message(); ?>
                </div>
            </div>');
        }
        redirect('laporan/approval');
        
    }
    
}
