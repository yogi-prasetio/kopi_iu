<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProduksiController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('ProduksiModel');
        $this->load->model('BahanModel');
        $this->load->model('BOMModel');
        $this->load->library('fpdf');
    }

    public function index()
    {
        $data['title'] = "Data Produksi";
        $data['Produksi'] = $this->ProduksiModel->GetProduksiRequest();

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('produksi/Produksi', $data);
        $this->load->view('template/footer');
    }

    public function AddProduksi()
    {
        $data['title'] = "Tambah Produksi";
        $data['BOM'] = $this->BOMModel->GetBOMRequest();

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('produksi/AddProduksi', $data);
        $this->load->view('template/footer');
    }

    public function DetailProduksi($id_produksi)
    {
        $data['title'] = "Detail Produksi";

        $condition = array('id_produksi' => $id_produksi);

        $data['Pengeluaran'] = $this->ProduksiModel->FindPengeluaranRequest($condition);

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('produksi/DetailProduksi', $data);
        $this->load->view('template/footer');
    }

    public function Pengeluaran()
    {
        $data['title'] = "Data Pegeluaran";

        $data['Pengeluaran'] = $this->ProduksiModel->GetPengeluaranRequest();

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('produksi/Pengeluaran', $data);
        $this->load->view('template/footer');
    }

    public function Insert()
    {
        $id_bom = $this->input->post('produk_name');
        $jumlah = $this->input->post('jumlah');
        $tanggal = $this->input->post('tanggal');
        
        $payload = array(
            'id_bom' => $id_bom,
            'jumlah_produksi' => $jumlah,
            'tgl_produksi' => $tanggal
        );

        $condition = array('id_bom' => $id_bom);

        $bahan = $this->BOMModel->FindBOMDetailRequest($condition);
        // var_dump($bahan);
        // die();
        $result = $this->ProduksiModel->AddProduksiRequest($payload);



        for($i=0; $i<count($bahan); $i++) {
            $payload_keluar = array(
                'id_produksi' => $result,
                'id_bahan' => $bahan[$i]->id_bahan,
                'jumlah_bahan' => $jumlah * $bahan[$i]->jumlah,
                'tgl_pengeluaran' => $tanggal
            );
            // var_dump($payload_keluar);
            $this->ProduksiModel->AddPengeluaranRequest($payload_keluar);
        }
        // die();

        if($result){    
            $this->session->set_flashdata('success','Data Produksi berhasil ditambahkan!');
            redirect('ProduksiController');
        } else {
            echo "Gagal!";   
        }
    }

    public function Update()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $jumlah = $this->input->post('jumlah');
        $satuan = $this->input->post('satuan');
        $lead_time = $this->input->post('lead_time');

        $payload= array(
            'nama_Produksi' => $name,
            'jumlah' => $jumlah,
            'satuan' => $satuan,
            'LT' => $lead_time
        );

        $condition = array('id_Produksi' => $id);
        $result = $this->ProduksiModel->UpdateProduksiRequest($condition, $payload);
        if($result){    
            $this->session->set_flashdata('success','Data Produksi berhasil diperbarui!');
            redirect('ProduksiController');
        } else {
            echo "Gagal!";   
        }
    }

    public function DeleteProduksi()
    {
        $id = $this->uri->segment(3);
        $payload = array('id_Produksi' => $id);

        $result = $this->ProduksiModel->DeleteProduksiRequest($payload);
        if($result){    
            $this->session->set_flashdata('success','Data Produksi berhasil dihapus!');
            redirect('ProduksiController');
        } else {
            echo "Gagal!";   
        }

    }

    public function CetakProduksi()
    {
        $produksi = $this->ProduksiModel->GetProduksiRequest();

        #setting judul laporan dan header tabel
        $judul = "DATA PRODUKSI";
        $subjudul = "KOPI IU";
        $header = array(
            array("label"=>"NO", "length"=>10, "align"=>"C"),
            array("label"=>"NAMA PRODUK", "length"=>50, "align"=>"C"),
            array("label"=>"JUMLAH", "length"=>45, "align"=>"C"),
            array("label"=>"WAKTU", "length"=>35, "align"=>"C")
        );

        $pdf = new FPDF();
        $pdf->SetTitle('Data Produksi', TRUE);
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
        $pdf->SetFont('Arial','B','10');
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
        foreach ($produksi as $row) {
            $pdf->Cell($header[$i]['length'], 8, $no++, 1,'0', $kolom['align'], $fill);
            $pdf->Cell($header[$i+1]['length'], 8, $row->nama_bom,1,'0', 'L', $fill);
            $pdf->Cell($header[$i+2]['length'], 8, $row->jumlah_produksi,1,'0', $kolom['align'], $fill);
            $pdf->Cell($header[$i+3]['length'], 8, $row->tgl_produksi,1,'0', $kolom['align'], $fill);
            $fill = !$fill;
            $pdf->Ln();
        }
        date_default_timezone_set('Asia/Jakarta');
        $pdf->SetFont('Arial','I','10');
        $pdf->Cell(0, 7, "*) Dicetak pada ".date('H:i:s d-m-Y '), '0', 2, 'L');

        #output file PDF
        $pdf->Output('I', 'Data Produksi.pdf');        
    }

    public function CetakPengeluaran()
    {
        $keluar = $this->ProduksiModel->GetPengeluaranRequest();

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
