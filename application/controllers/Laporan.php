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

    public function list() 
    {
        $data['title'] = 'List Laporan';
        $data['bc'] = $this->modul->getBreadcrumb($data['title']);
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('name')])->row_array();
        
        $data['pegawai'] = $this->modsEmployee->getUserData($data['user']['nip_pegawai']);
        $data['laporan'] = $this->modsEmployee->getUserLaporan($data['user']['nip_pegawai']);

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

        $this->form_validation->set_rules('judul', 'judul Kegiatan', 'required');
        $this->form_validation->set_rules('uraiankegiatan', 'uraian Kegiatan', 'required');

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
            // set default status , approval colomn for dirut 
            if ($data['pegawai']['level'] == 1){
                $status = '2';
                $approvalby = $data['user']['nip_pegawai'];
                $approvalts = date('Y-m-d H:i:s');
            } else {
                $status = '1';
                $approvalby = '';
                $approvalts = '';
            }

            // handling file attachment
            if (!empty($_FILES['file_attach'])) {
                $config['upload_path']   = FCPATH . '/upload/laporan/';
                $config['allowed_types'] = '*';
                $config['max_size']      = '2048';
                $config['remove_spaces'] = 'true';

                $this->load->library('upload', $config);
                
                if (!$this->upload->do_upload('file_attach') && $_FILES['file_attach']['error'] != 4) {
                    $this->session->set_flashdata('message',
                    '<div class="alert alert-danger alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            '.$this->upload->display_errors().'
                        </div>
                        
                    </div>');
                    redirect('laporan/input');
                }
                else {
                   $data['file_attach'] = $this->upload->data('file_name');
                    $this->upload->initialize($config);
                }
            }

            // set data, insert laporan to DB
            $data = [
                'user_id' => $data['user']['id'],
                'nip_pegawai' => $data['pegawai']['nip_pegawai'],
                'kehadiran' => 'Hadir',
                'reg_ts' => date('Y-m-d H:i:s'),
                'judul_kegiatan' => $this->input->post('judul'),
                'uraian_kegiatan' => $this->input->post('uraiankegiatan'),
                'status_laporan' => $status,
                'approval_by' => $approvalby,
                'approval_ts' => $approvalts,
                'file_upload' => $data['file_attach']

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
        } 
        else {
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

    public function deleteLaporan($idLaporan)
    {
        $laporan = $this->db->get_where('emp_laporan', ['id' => $idLaporan])->row_array();
        if ($this->modsEmployee->deleteLaporan($idLaporan)) {
            $this->session->set_flashdata('message',
            '<div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    Laporan: '.$laporan['judul_kegiatan'].' berhasil di Hapus
                </div>
            </div>');

            unlink(FCPATH . 'upload/laporan/'.$laporan['file_upload']);
        } 
        else {
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
        redirect('laporan/list');
    }

    public function download($id) 
    {   
        $this->load->helper('download');
        $fileinfo = $this->modsEmployee->getFileLaporan($id);
        $file = FCPATH . '/upload/laporan/'.$fileinfo['file_upload'];
        force_download($file, NULL);
    }
    
}
