<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PengeluaranController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('PengeluaranModel');
        $this->load->model('BahanModel');
        $this->load->model('BOMModel');
        $this->load->library('fpdf');
    }

    public function index()
    {
        $data['title'] = "Data Pengeluaran";

        $data['Pengeluaran'] = $this->PengeluaranModel->GetPengeluaranRequest();

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('pengeluaran/Pengeluaran', $data);
        $this->load->view('template/footer');
    }

    public function CetakPengeluaran()
    {
        $keluar = $this->PengeluaranModel->GetPengeluaranRequest();

        #setting judul laporan dan header tabel
        $judul = "DATA PENGELUARAN BAHAN BAKU";
        $subjudul = "KOPI IU";
        $header = array(
            array("label"=>"NO", "length"=>10, "align"=>"C"),
            array("label"=>"NAMA BAHAN", "length"=>50, "align"=>"C"),
            array("label"=>"JUMLAH", "length"=>45, "align"=>"C"),
            array("label"=>"TANGGAL ", "length"=>55, "align"=>"C")
        );

        $pdf = new FPDF();
        $pdf->SetTitle('Data Pengaluaran Bahan Baku', TRUE);
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
        foreach ($keluar as $row) {
            $pdf->Cell($header[$i]['length'], 8, $no++, 1,'0', $kolom['align'], $fill);
            $pdf->Cell($header[$i+1]['length'], 8, $row->nama_bahan,1,'0', 'L', $fill);
            $pdf->Cell($header[$i+2]['length'], 8, "  ".$row->jumlah_bahan." ".$row->satuan,1,'0', 'L', $fill);
            $pdf->Cell($header[$i+3]['length'], 8, $row->tgl_pengeluaran,1,'0', $kolom['align'], $fill);
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
