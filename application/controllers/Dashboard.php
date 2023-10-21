<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->model('TransaksiModel');
        $this->load->model('BOMModel');
        $this->load->model('BahanModel');
        $this->load->model('PesananModel');
    }

    public function index()
    {
        $role = $this->session->userdata('role');
        $data['title'] = 'Dashboard';

        //SUpplier
        $condition = array("keterangan" => "Pemesanan", "id_supplier" => $this->session->userdata('id_user'));
        $data['Pesanan'] = $this->PesananModel->FindPesananRequest($condition);
        $data['tindakan'] = count($data['Pesanan']);

        //Gudang
        $cond = array("keterangan" => "Disetujui Supplier");
        $pesanan = $this->PesananModel->FindPesananRequest($cond);
        $data['jml_tindakan'] = count($pesanan);

        $cond = array("id_supplier" => $this->session->userdata("id_user"));
        $data['pesanan_supplier'] = count($this->PesananModel->FindPesananRequest($cond));

        $kondisi = array("id_supplier" => $this->session->userdata("id_user"));
        $data['jml_bahan'] = $this->BahanModel->GetBahanSupplierCount($kondisi);

        $data['users'] = $this->UserModel->GetUserCount();
        $data['transaksi'] = $this->TransaksiModel->GetTransaksiCount();
        $data['bom'] = $this->BOMModel->GetBOMCount();
        $data['bahan'] = $this->BahanModel->GetBahanCount();

        //CUSTOMER
        $user_condition = array("id_user" => $this->session->userdata('id_user'));
        $data['transaksi_user'] = $this->TransaksiModel->GetTransaksiUserCount($user_condition);
        $data['billing'] = $this->TransaksiModel->GetUserBilling($user_condition)[0]->total_harga;

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('Dashboard', $data);
        $this->load->view('template/footer');
    }
}
