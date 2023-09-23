<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->model('ProduksiModel');
        $this->load->model('BOMModel');
        $this->load->model('BahanModel');
        $this->load->model('PesananModel');
    }

    public function index()
    {
        $role = $this->session->userdata('role');
        $data['title'] = 'Dashboard';
        $condition = array("keterangan" => "Diterima Supplier");
        $data['Pesanan'] = $this->PesananModel->FindPesananRequest($condition);
        $data['jml_tindakan'] = count($data['Pesanan']);

        $cond = array("id_supplier" => $this->session->userdata("id_user"));
        $data['pesanan_supplier'] = count($this->PesananModel->FindPesananRequest($cond));

        $kondisi = array("id_supplier" => $this->session->userdata("id_user"));
        $data['jml_bahan'] = $this->BahanModel->GetBahanSupplierCount($kondisi);

        $data['users'] = $this->UserModel->GetUserCount();
        $data['produksi'] = $this->ProduksiModel->GetProduksiCount();
        $data['bom'] = $this->BOMModel->GetBOMCount();
        $data['bahan'] = $this->BahanModel->GetBahanCount();

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('Dashboard');
        $this->load->view('template/footer');
    }
}
