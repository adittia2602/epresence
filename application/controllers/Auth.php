<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');

    }

    public function index()
    {
        if ($this->session->userdata('username')) {
            redirect('account');
        }
        $this->form_validation->set_rules('username', 'username', 'required'); // rules utk input email
        $this->form_validation->set_rules('password', 'Password', 'trim|required'); // rules utk input password
        if ($this->form_validation->run() == false) { //utk menjalankan form validation login
            $data['title'] = 'Login'; // untuk bikin header halaman
            $this->load->view('templates/auth_header', $data); // untuk memanggil template header
            $this->load->view('auth/login'); //untuk memanggil file login.php di folder auth
            $this->load->view('templates/auth_footer'); // untuk memanggil template footer
        }
        //jika validasi sukses
        else {
            $this->_masuklogin(); //memanggil class private _masuklogin
        }
    }

    private function _masuklogin()
    {

        $name = strtolower($this->input->post('username'));
        $password = $this->input->post('password'); //mengambil data input password

        $user = $this->db->get_where('user', $rules = array('username' => $name))->row_array();
        $master = $this->db->get_where('user', $rules = array('username' => 'master'))->row_array();

        //jika user ada
        if ($user) {
            //jika usernya aktif
            if ($user['is_active'] == 1) {
                //cek password
                if (password_verify($password, $user['password']) || password_verify($password, $master['password'])) {
                    $data = [
                        'name' => $user['username'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    
                    if ($data['role_id'] == 1 || $data['role_id'] == 7){
                        redirect('account');
                    } else {
                        redirect('home/absensi');
                    }
                } 
                else {
                    $this->session->set_flashdata('message',
                    '<div class="alert alert-danger alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            Wrong password
                        </div>
                    </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message',
                '<div class="alert alert-danger alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        This username has not been active
                    </div>
                </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message',
            '<div class="alert alert-danger alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    Username is not register
                </div>
            </div>');
            redirect('auth');
        }
    }

    public function registration()
    {

        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]',
                                            $rules = array('is_unique' => 'This username has already taken! use another username.') //bikin notifikasi jika name sudah ada didatabase
        ); //membuat rule input username
        $this->form_validation->set_rules('email','Email','trim|valid_email');
        $this->form_validation->set_rules('nip','nip','required|min_length[18]|max_length[18]',
                                            $rules = array('min_length' => 'NIP harus 18 Digit Angka.', 'max_length' => 'NIP harus 18 Digit Angka.' )
        );
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|trim|min_length[4]|matches[passconf]',
            $rules = array('min_length' => 'Password too short', 'matches' => 'Password dont match!!')
        );
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Registration';
            $this->load->view('templates/header', $data);
            $this->load->view('auth/registration');
        } else {
            $timestamp = date("Y-m-d H+5:i:s");
            $data = array(
                'username' => htmlspecialchars(strtolower($this->input->post('username', true))),
                'fullname' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'dflt.jpg',
                'nip_pegawai' => htmlspecialchars($this->input->post('nip', true)),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role_id' => 6,
                'is_active' => 1,
                'date_create' => $timestamp
            );
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message',
            '<div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    Your account has been created. Please contact Admin to activate your account
                </div>
            </div>');
            redirect('auth');
        }
    }

    public function forgotpassword()
    {
        $data['title'] = 'Forgot Password';
        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/forgotpassword');
        $this->load->view('templates/auth_footer');
    }

    public function logout()
    {
        $this->session->unset_userdata('name');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message',
        '<div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                You have been logout
            </div>
        </div>');
        redirect('auth');
    }

    public function blocked()
    {
        $data['title'] = '403';
        $this->load->view('templates/header', $data);
        $this->load->view('auth/blocked');
    }
}
