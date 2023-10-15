<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');;
        $this->load->library('fpdf');;
    }

    public function index()
    {
        $data['title'] = "Data User";
        $data['User'] = $this->UserModel->GetUserRequest();

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('user/User', $data);
        $this->load->view('template/footer');
    }

    public function AddUser()
    {
        $data['title'] = "Tambah User";

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('user/AddUser', $data);
        $this->load->view('template/footer');
    }

    public function UpdateUser($id_user)
    {
        $data['title'] = "Edit User";

        $condition = array('id_user' => $id_user);
        $data['User'] = $this->UserModel->FindUserRequest($condition);

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('user/UpdateUser', $data);
        $this->load->view('template/footer');
    }

    public function Insert()
    {
        $name = $this->input->post('nama_user');
        $no_hp = $this->input->post('no_hp');
        $alamat = $this->input->post('alamat');
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $role = $this->input->post('role');
        
        $payload= array(
            'nama_user' => $name,
            'no_hp' => $no_hp,
            'alamat' => $alamat,
            'username' => $username,
            'password' => $password,
            'role' => $role
        );

        $condition = array('username' => $username);        
        $check_user = $this->UserModel->FindUserRequest($condition);
        if($check_user){
            $this->session->set_flashdata('flashgagal','Username sudah terdaftar!');
            redirect('UserController/AddUser');
        } else {
            $result = $this->UserModel->AddUserRequest($payload);
            if($result){    
                $this->session->set_flashdata('flashdata','Data User berhasil ditambahkan!');
                redirect('UserController');
            } else {
                $this->session->set_flashdata('flashgagal','Data User gagal ditambahkan!');
            }
        }

    }

    public function Update()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('nama_user');
        $no_hp = $this->input->post('no_hp');
        $alamat = $this->input->post('alamat');
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $role = $this->input->post('role');

        $payload= array(
            'nama_user' => $name,
            'no_hp' => $no_hp,
            'alamat' => $alamat,
            'username' => $username,
            'password' => $password,
            'role' => $role
        );
        $condition = array('id_user'=> $id);

        $result = $this->UserModel->UpdateUserRequest($condition, $payload);
        if($result){    
            $this->session->set_flashdata('flashdata','Data User berhasil diperbarui!');
            redirect('UserController');
        } else {
            $this->session->set_flashdata('flashgagal','Data User gagal diperbarui!');
        }
    }

    public function DeleteUser()
    {
        $id = $this->uri->segment(3);
        $payload = array('id_user' => $id);

        $result = $this->UserModel->DeleteUserRequest($payload);
        if($result){    
            $this->session->set_flashdata('flashdata','Data User berhasil dihapus!');
            redirect('UserController');
        } else {
            $this->session->set_flashdata('flashgagal','Data User gagal dihapus!');
        }
    }

    public function CetakUser()
    {
        $User = $this->UserModel->GetUserRequest();

        #setting judul laporan dan header tabel
        $judul = "DATA USER";
        $subjudul = "KOPI IU";
        $header = array(
            array("label"=>"NO", "length"=>20, "align"=>"C"),
            array("label"=>"NAMA USER", "length"=>80, "align"=>"C"),
            array("label"=>"KETERANGAN", "length"=>60, "align"=>"C"),
        );

        $pdf = new FPDF();
        $pdf->SetTitle('Data User', TRUE);
        $pdf->SetMargins(20, 20, 20);
        $pdf->AddPage('P','A4', 0);

        #tampilkan judul laporan
        $pdf->Image(base_url('assets/img/kopi_iu.png'), 100, 10, 10,10);
        $pdf->Ln(5);
        $pdf->SetFont('Arial','B','16');
        $pdf->Cell(0,3, $judul, '0', 2, 'C');
        $pdf->Ln();
        $pdf->Cell(0,5, $subjudul, '0', 1, 'C');
        $pdf->Ln(10);

        #buat header tabel
        $pdf->SetFont('Arial','B','12');
        $pdf->SetFillColor(71, 89, 107);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(128);
        foreach ($header as $kolom) {
            $pdf->Cell($kolom['length'], 10, $kolom['label'], 1, '0', $kolom['align'], true);
        }
        $pdf->Ln();

        #tampilkan data tabelnya
        $pdf->SetFillColor(231,237,242);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');

        $fill=false;
        $no=1;
        $i=0;
        foreach ($User as $row) {
            $pdf->Cell($header[$i]['length'], 8, $no++, 1,'0', $kolom['align'], $fill);
            $pdf->Cell($header[$i+1]['length'], 8, $row->nama_user,1,'0', 'L', $fill);
            $pdf->Cell($header[$i+2]['length'], 8, $row->role,1,'0', $kolom['align'], $fill);;
            $fill = !$fill;
            $pdf->Ln();
        }
        date_default_timezone_set('Asia/Jakarta');
        $pdf->SetFont('Arial','I','10');
        $pdf->Cell(0, 7, "*) Dicetak pada ".date('H:i:s d-m-Y '), '0', 2, 'L');

        #output file PDF
        $pdf->Output('I', 'Data User.pdf');        
    }
}
