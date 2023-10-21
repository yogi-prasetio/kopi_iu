<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Authentication');
        $this->load->model('UserModel');
    }

    public function index()
    {
        $this->load->view('SignIn');
    }

    public function SignIn()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));

        $result = $this->Authentication->SignInRequest($username, $password);

        if ($result) {
            $session_data = array(
                'id_user' => $result->id_user,
                'nama_user' => $result->nama_user,
                'username' => $result->username,
                'password' => $result->password,
                'role' => $result->role,
                'status' => TRUE
            );
            $this->session->set_userdata($session_data);
            redirect("Dashboard");
        } else {
            $this->session->set_flashdata('flashgagal', 'Username atau password salah!');
            redirect("Auth");
        }
    }

    public function SignUp()
    {
        $this->load->view('SignUp');
    }

    public function Register()
    {
        $name = $this->input->post('fullname');
        $no_hp = $this->input->post('phoneNumber');
        $alamat = $this->input->post('address');
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        
        $payload= array(
            'nama_user' => $name,
            'no_hp' => $no_hp,
            'alamat' => $alamat,
            'username' => $username,
            'password' => $password,
            'role' => 'Customer'
        );

        $condition = array('username' => $username);        
        $check_user = $this->UserModel->FindUserRequest($condition);
        if($check_user){
            $this->session->set_flashdata('flashgagal','Username sudah terdaftar!');
            redirect('Auth/SignUp');
        } else {
            $result = $this->UserModel->AddUserRequest($payload);
            if($result){ 
                $this->session->set_flashdata('flashdata','Registrasi berhasil!');
                redirect('Auth/SignIn');
            } else {
                $this->session->set_flashdata('flashgagal','Registrasi gagal!');
                redirect('Auth/SignUp');
            }
        }

    }

    public function SignOut()
    {
        $this->session->sess_destroy();
        redirect(base_url('Auth'));
    }
}
