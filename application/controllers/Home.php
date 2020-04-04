<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
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
        $data['subtitle'] = 'Data Absen';
        $data['bc'] = $this->modul->getBreadcrumb($data['title']);
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('name')])->row_array();
        $data['pegawai'] = $this->modsEmployee->getUserData($data['user']['nip_pegawai']);
        $data['absensi'] = $this->modsEmployee->getUserAbsence($data['user']['nip_pegawai']);
        
        // set jam pulang format 24jam
        $time_clockout = 17;
        $hour_now = date("H");

        $absensi = $data['absensi'];
        $data['todayabsen'] = 0; 
        $data['todayabsen'] = ($absensi[0]['tgl'] == date('Y-m-d')) ? 1:0 ;
        $link = base_url("home/clockout/".$data['user']['nip_pegawai']);
        
        $data['col_list'] = '8';
        if ( $absensi[0]['tgl'] == date('Y-m-d') && $absensi[0]['kehadiran'] === 'Hadir' && !empty($absensi[0]['clockout']) || 
        $absensi[0]['tgl'] == date('Y-m-d') && $absensi[0]['kehadiran'] == 'Izin' || $absensi[0]['tgl'] == date('Y-m-d') && $absensi[0]['kehadiran'] == 'Cuti' )
        {
            $data['col_list'] = '12';
        }
        
        // Box Clock OUT: kalo sudah absen hari ini & dia clock in & jam > 17:00 & belum clockout
        $data['box_clockout'] = '';
        if ( isset($absensi[0]['kehadiran']) && $absensi[0]['tgl'] == date('Y-m-d') && $absensi[0]['kehadiran'] == 'Hadir' 
            && empty($absensi[0]['clockout']) && $hour_now >= $time_clockout )
        {
            $data['box_clockout'] = '
            <div class="col-md-4 ">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <form method="POST" action="'.$link.'")">
                                    <button type="submit" class="btn btn-danger btn-lg btn-block mt-3">
                                        Clock Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        } 

        // Box Notif  : kalo sudah absen & jam < 17:00 & dia clock in 
        $data['box_notif'] = '';
        if ( isset($absensi[0]['kehadiran']) && $absensi[0]['tgl'] == date('Y-m-d') && $hour_now < $time_clockout && $absensi[0]['kehadiran'] == 'Hadir')
        {
            $data['box_notif'] = '
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <p class="text-center" style="color: red;">
                                    Anda sudah melakukan <br/>
                                    <b>Clock IN</b> hari ini. <br/> <br/> 
                                    Silahkan lakukan <b>Clock OUT pada pukul '. $time_clockout.':00 </b>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        } 

        $this->load->view('templates/header', $data); // untuk memanggil template header
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('home/absensi', $data);
        $this->load->view('templates/footer', $data);
    }

    public function absenhadir($userid, $nip)
    {
        $data = [
            'id' => time(),
            'user_id' => $userid,
            'nip_pegawai' => $nip,
            'clockin' => date('Y-m-d H:i:s'),
            'kehadiran' => 'Hadir',
            'keterangan' => 'Hadir',
            'kondisi_kesehatan' => $this->input->post('kondisi'),
            'uraian_kondisi_kesehatan' => $this->input->post('uraiankondisi'),
        ];
        
        if ($this->modsEmployee->clockIn($data)) {
            $this->session->set_flashdata('message',
            '<div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    Absen berhasil!
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
        redirect('home/absensi');
    }

    public function absenijin($userid, $nip)
    {
        $data = [
            'id' => time(),
            'user_id' => $userid,
            'nip_pegawai' => $nip,
            'kehadiran' => $this->input->post('kehadiran'),
            'keterangan' => $this->input->post('keterangan'),
            'kondisi_kesehatan' => '-',
            'uraian_kondisi_kesehatan' => $this->input->post('keterangan'),
        ];
        
        if ($this->modsEmployee->clockIn($data)) {
            $this->session->set_flashdata('message',
            '<div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    Absen berhasil!
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
        redirect('home/absensi');
    }

    public function clockout($nip)
    {
        $data = [
            'clockout' => date('Y-m-d H:i:s'),
        ];
        if ($this->modsEmployee->clockOut($nip, $data)) {
            $this->session->set_flashdata('message',
            '<div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    Absen berhasil!
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
        redirect('home/absensi');
    }
}
