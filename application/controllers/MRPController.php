<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MRPController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('MRPModel');
        $this->load->model('BahanModel');
        $this->load->model('ProduksiModel');
    }

    public function index()
    {
        $data['title'] = "MRP";
        $data['bahan'] = $this->BahanModel->GetBahanRequest();
        $data['pengeluaran'] = $this->ProduksiModel->GetPengeluaran();
        $data['mrp'] = $this->MRPModel->GetMRPRequest();

        // var_dump($data['pengeluaran']);
        // die();
        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('mrp/PerhitunganMRP', $data);
        $this->load->view('template/footer');
    }

    public function Proses(){
        $id_bahan = $this->input->post("bahan");
        $nama_bahan = $this->input->post("nama_bahan");
        $jumlah = $this->input->post("jumlah");
        $tanggal = $this->input->post("tanggal");
        $lead_time = $this->input->post("lead_time");

        $condition = array("id_bahan" => $id_bahan);
        $bahan = $this->BahanModel->FindBahanRequest($condition);
        $pengeluaran_terakhir = $this->ProduksiModel->GetPengeluaranTerakhir($id_bahan)[0]->jumlah;

        echo $pengeluaran_terakhir."<br><br>";
        $demand = $jumlah/12;
        $jumlah_biaya = $jumlah*$bahan[0]->harga;
        $biaya_pesan = $jumlah_biaya*0.1;
        $biaya_penyimpanan = $jumlah * ($bahan[0]->harga*0.05);

        echo "Harga Beli ".$jumlah_biaya."<br><br>";
        //PERHITUNGAN POQ
        // $poq = sqrt((2 * $biaya_pesan) / (($demand) * $biaya_penyimpanan));
        $eoq = sqrt(($pengeluaran_terakhir * $demand * $biaya_pesan)/$biaya_penyimpanan);
        echo "Biaya Pesan : ".$biaya_pesan." <br>Demand : ".$demand." <br>Biaya Penyimpanan : ".$biaya_penyimpanan;

        $poq = $jumlah/$eoq;

        echo "<br><br>Hasil EOQ ".$eoq;
        echo "<br><br>Hasil POQ ".$poq;

        // $payload = array(
        //     "id_bahan" => $id_bahan,
        //     "bulan" => $tanggal,
        //     "POREL" => $poq,
        // );

        // $result = $this->MRPModel->AddMRPRequest($payload);

        // if($result){    
        //     $this->session->set_flashdata('flashdata','Berhasil!');
        //     redirect('MRPController');
        // } else {
        //     $this->session->set_flashdata('flashgagal', 'Gagal!');
        // }
    }
}
