<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginController extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('LoginModel');
    }

    public function index()
    {
        $this->load->view('Login');
    }

    public function SignIn()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));

        $result = $this->LoginModel->LoginRequest($username, $password);

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
            redirect("DashboardController");
        } else {
            $this->session->set_flashdata('flashgagal', 'Username atau password salah!');
            redirect("LoginController");
        }
    }

    public function SignOut()
    {
        $this->session->sess_destroy();
        redirect(base_url('LoginController'));
    }
}
