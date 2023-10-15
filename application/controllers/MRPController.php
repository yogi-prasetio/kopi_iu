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

        // var_dump($data['mrp']);
        // die();
        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('mrp/PerhitunganMRP', $data);
        $this->load->view('template/footer');
    }

    public function Proses(){
        $id_bahan = $this->input->post("id_bahan");
        $nama_bahan = $this->input->post("nama_bahan");
        $jumlah_pakai = $this->input->post("jumlah");
        $tanggal = $this->input->post("tanggal");
        $lead_time = $this->input->post("lead_time");

        $condition = array("id_bahan" => $id_bahan);
        $bahan = $this->BahanModel->FindBahanRequest($condition);
        // $pengeluaran_terakhir = $this->ProduksiModel->GetPengeluaranTerakhir($id_bahan)[0]->jumlah;

        // echo $pengeluaran_terakhir."<br><br>";
        // $demand = $jumlah_pakai/12;
        $jumlah_biaya = $bahan[0]->persediaan*$bahan[0]->harga;
        // $biaya_pesan = $jumlah_biaya*0.1;
        // $biaya_penyimpanan = $jumlah_pakai * (0.05 * $bahan[0]->harga);

        // echo "Harga Beli ".$jumlah_biaya."<br><br>";
        // //PERHITUNGAN POQ
        // $poq = sqrt((2 * $biaya_pesan) / (($demand) * $biaya_penyimpanan));
        // $eoq = sqrt(($pengeluaran_terakhir * $demand * $biaya_pesan)/$biaya_penyimpanan);
        
        //POQ DIAN        
        // $demand = $jumlah_pakai/12;
        // $jumlah_biaya = 350000*$bahan[0]->harga;
        // $biaya_pesan = 2 * ($jumlah_biaya*0.1);
        // $biaya_penyimpanan = 350000*(0.05 * $bahan[0]->harga);
        $pesan = 0.1 * $jumlah_biaya;
        $transport = 0.015 * $jumlah_biaya;
        $bongkar = 0.0125 * $jumlah_biaya;

        echo $id_bahan." ".$jumlah_pakai."<br>";

        $S = $pesan + $transport + $bongkar;
        $D = $jumlah_pakai;
        $H = (0.1 * $bahan[0]->harga);
        $DH = $D*$H;
        // $dh = $demand * (350000 * (0.05 * $bahan[0]->harga));
        // echo "DH = ".$dh."<br>";
        // echo "2S = ".($biaya_pesan)."<br>";

        $POQ = sqrt((2 * $S) / ($D * $H));

        // $po = $biaya_pesan/$dh;
        // echo "Belum Akar ".$po."<br><br>";

        // $poq_tmp = sqrt($biaya_pesan/$dh);
        // echo "Jumlah Biaya = ".$jumlah_biaya."<br><br>";
        // $kuantitas = 12 * $poq;
        // $frequensi = 350000/$kuantitas;
        echo "Biaya Pesan : ".$S." <br>Demand : ".$D." <br>Biaya Penyimpanan : $H <br> DH: $DH";

        // echo "<br> POQ = akar(".($biaya_pesan)." / ".$dh.")";

        // $exp = sprintf('%e', $poq_tmp);
        // echo "<br><br>Hasil EOQ ".$eoq;

        // $poq = round(substr($exp, 0,4));
        // $eoq = sqrt(($biaya_pesan * $demand) / $biaya_penyimpanan);
        echo "<br><br>POQ ".$POQ;
        // echo "<br><br>Hasil POQ ".$poq;
        // echo "<br><br>EOQ ".$eoq;

        $kuantitas = round($POQ) * 12;
        $frequensi = $D / $kuantitas;
        echo "<br>Freq: $frequensi";
        // die();

        echo "<br><br>Frequensi ".$frequensi;
        $payload = array(
            "id_bahan" => $id_bahan,
            "poq" => $POQ,
            "frequensi" => $frequensi,
        );

        // die();
        $result = $this->MRPModel->AddMRPRequest($payload);

        if($result){    
            $this->session->set_flashdata('flashdata','Berhasil!');
            redirect('MRPController');
        } else {
            $this->session->set_flashdata('flashgagal', 'Gagal!');
        }
    }
}
