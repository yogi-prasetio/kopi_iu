<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MRPController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('MRPModel');
        $this->load->model('BahanModel');
        $this->load->model('PengeluaranModel');
        $this->load->library('fpdf');
    }

    public function index()
    {
        $data['title'] = "MRP";
        $data['bahan'] = $this->BahanModel->GetBahanRequest();
        $data['pengeluaran'] = $this->PengeluaranModel->GetPengeluaran();
        $data['mrp'] = $this->MRPModel->GetMRPRequest();

        // var_dump($data['mrp']);
        // die();
        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('mrp/PerhitunganMRP', $data);
        $this->load->view('template/footer');
    }

    public function ShowProcess(){
        $id_bahan = $this->input->post("id_bahan");
        $nama_bahan = $this->input->post("nama_bahan");
        $jumlah_pakai = $this->input->post("jumlah");

        $condition = array("id_bahan" => $id_bahan);
        $bahan = $this->BahanModel->FindBahanRequest($condition);

        //Cek MRP Sudah Ada Atau Belum
        $kondisi = array("id_bahan" => $id_bahan);
        $check = $this->MRPModel->FindMRPRequest($kondisi);       

        $jumlah_biaya = $bahan[0]->persediaan*$bahan[0]->harga;
        $pesan = 0.1 * $jumlah_biaya;
        $transport = 0.015 * $jumlah_biaya;
        $bongkar = 0.0125 * $jumlah_biaya;

        $S = $pesan + $transport + $bongkar;
        $D = $jumlah_pakai;
        $H = (0.1 * $bahan[0]->harga);
        $DH = $D*$H;

        $POQ = sqrt((2 * $S) / ($D * $H));

        $kuantitas = round($POQ) * 12;

        $result = array(
            "D" => $D,
            "S" => $S,
            "H" => $H,
            "persen" => "0.1",
            "c" => $bahan[0]->harga,
        );    

    //add the header here
        header('Content-Type: application/json');
        echo json_encode( $result );
    }

    public function Proses(){
        $id_bahan = $this->input->post("id_bahan");
        $nama_bahan = $this->input->post("nama_bahan");
        $jumlah_pakai = $this->input->post("jumlah");
        $lead_time = $this->input->post("lead_time");

        $condition = array("id_bahan" => $id_bahan);
        $bahan = $this->BahanModel->FindBahanRequest($condition);

        //Cek MRP Sudah Ada Atau Belum
        $kondisi = array("id_bahan" => $id_bahan);
        $check = $this->MRPModel->FindMRPRequest($kondisi);       

        $jumlah_biaya = $bahan[0]->persediaan*$bahan[0]->harga;
        $pesan = 0.1 * $jumlah_biaya;
        $transport = 0.015 * $jumlah_biaya;
        $bongkar = 0.0125 * $jumlah_biaya;

        $S = $pesan + $transport + $bongkar;
        $D = $jumlah_pakai;
        $H = (0.1 * $bahan[0]->harga);
        $DH = $D*$H;

        $POQ = sqrt((2 * $S) / ($D * $H));

        $kuantitas = round($POQ) * 12;
        $frequensi = $D / $kuantitas;

        if($check->num_rows() > 0) {
            $cond = array("id_bahan" => $id_bahan);
            $payload = array(                
                "poq" => $POQ,
                "frequensi" => $frequensi,
            );

            $result = $this->MRPModel->UpdateMRPRequest($payload, $cond);
        } else {
            $payload = array(
                "id_bahan" => $id_bahan,
                "poq" => $POQ,
                "frequensi" => $frequensi,
            );

            $result = $this->MRPModel->AddMRPRequest($payload);
        }

        if($result){    
            $this->session->set_flashdata('flashdata','Berhasil!');
            redirect('MRPController');
        } else {
            $this->session->set_flashdata('flashgagal', 'Gagal!');
        }
    }

    public function CetakMRP()
    {
        $mrp = $this->MRPModel->GetMRPRequest();

        #setting judul laporan dan header tabel
        $judul = "DATA MATERIAL REQUIREMENT PLANNING (MRP)";
        $sub = "METODE PERIOD ORDER QUANTITY (POQ)";
        $subjudul = "KOPI.IU";
        $header = array(
            array("label"=>"NO", "length"=>10, "align"=>"C"),
            array("label"=>"NAMA BAHAN", "length"=>55, "align"=>"C"),
            array("label"=>"POQ", "length"=>45, "align"=>"C"),
            array("label"=>"FREQUENSI ", "length"=>55, "align"=>"C")
        );

        $pdf = new FPDF();
        $pdf->SetTitle('Data Hasil MRP POQ', TRUE);
        $pdf->SetMargins(20, 20, 20);
        $pdf->AddPage('P','A4', 0);

        #tampilkan judul laporan
        $pdf->Image(base_url('assets/img/kopi_iu.png'), 100, 10, 10,10);
        $pdf->Ln(5);
        $pdf->SetFont('Arial','B','14');
        $pdf->Cell(0,3, $judul, '0', 2, 'C');
        $pdf->Ln();
        $pdf->Cell(0,3, $sub, '0', 2, 'C');
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
        foreach ($mrp as $row) {
            $pdf->Cell($header[$i]['length'], 8, $no++, 1,'0', $kolom['align'], $fill);
            $pdf->Cell($header[$i+1]['length'], 8, $row->nama_bahan,1,'0', 'L', $fill);
            $pdf->Cell($header[$i+2]['length'], 8, $row->poq,1,'0', 'L', $fill);
            if($row->satuan == "ml") { $satuan = 'Liter'; } elseif ($row->satuan == "gram") { $satuan = 'Kg'; }
            $pdf->Cell($header[$i+3]['length'], 8, round($row->frequensi/1000)." ".$satuan ,1,'0', $kolom['align'], $fill);
            $fill = !$fill;
            $pdf->Ln();
        }
        date_default_timezone_set('Asia/Jakarta');
        $pdf->SetFont('Arial','I','10');
        $pdf->Cell(0, 7, "*) Dicetak pada ".date('H:i:s d-m-Y '), '0', 2, 'L');

        #output file PDF
        $pdf->Output('I', 'Data Pengeluaran Bahan Baku.pdf');        
    }
}

