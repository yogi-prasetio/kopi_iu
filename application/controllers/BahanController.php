<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BahanController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('BahanModel');
        $this->load->model('UserModel');
        $this->load->model('PesananModel');
        $this->load->library('fpdf');
    }

    public function index()
    {
        $data['title'] = "Data Bahan Baku";
        $data['bahan'] = $this->BahanModel->GetBahanRequest();

        $condition = array("keterangan" => "Disetujui Supplier");
        $data['Pesanan'] = $this->PesananModel->FindPesananRequest($condition);
        $data['jml_tindakan'] = count($data['Pesanan']);

        $bahan = '';
        for($i=0; $i<count($data['bahan']); $i++){
            if($data['bahan'][$i]->stok <= 1000){
                $bahan .= $data['bahan'][$i]->nama_bahan.", ";
            }
        }

        $bahan_warning = substr($bahan, 0, -2) . '.';
        $data['bahan_warning'] = $bahan_warning;

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('bahan/Bahan', $data);
        $this->load->view('template/footer');
    }

    public function AddBahan()
    {
        $data['title'] = "Tambah Bahan Baku";
        $condition = array("role" => "Supplier");
        $data['supplier'] = $this->UserModel->GetSupplierRequest($condition);

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('bahan/AddBahan', $data);
        $this->load->view('template/footer');
    }

    public function UpdateBahan($id_bahan)
    {
        $data['title'] = "Edit Bahan Baku";
        $condition = array("keterangan" => "Disetujui Supplier");
        $data['Pesanan'] = $this->PesananModel->FindPesananRequest($condition);
        $data['jml_tindakan'] = count($data['Pesanan']);

        $condition = array('id_bahan' => $id_bahan);
        $data['bahan'] = $this->BahanModel->FindBahanRequest($condition);
        $cond = array("role" => "Supplier");
        $data['supplier'] = $this->UserModel->GetSupplierRequest($cond);

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('bahan/UpdateBahan', $data);
        $this->load->view('template/footer');
    }

    public function Insert()
    {
        $supplier = $this->input->post('supplier');
        $name = $this->input->post('name');
        $jumlah = $this->input->post('jumlah');
        $satuan = $this->input->post('satuan');
        $harga = $this->input->post('harga');
        $lead_time = $this->input->post('lead_time');

        $payload= array(
            'id_supplier' => $supplier,
            'nama_bahan' => $name,
            'stok' => $jumlah,
            'satuan' => $satuan,
            'harga' => $harga,
            'LT' => $lead_time
        );

        $result = $this->BahanModel->AddBahanRequest($payload);
        if($result){    
            $this->session->set_flashdata('flashdata','Data Bahan berhasil ditambahkan!');
            redirect('BahanController');
        } else {
            $this->session->set_flashdata('flashgagal', 'Data Bahan gagal ditambahkan!');
        }
    }

    public function Update()
    {
        $id = $this->input->post('id');
        $supplier = $this->input->post('supplier');
        $name = $this->input->post('name');
        $jumlah = $this->input->post('jumlah');
        $satuan = $this->input->post('satuan');
        $harga = $this->input->post('harga');
        $lead_time = $this->input->post('lead_time');

        $role = $this->session->userdata('role');

        $payload= array(
            'id_supplier' => $supplier,
            'nama_bahan' => $name,
            'stok' => $jumlah,
            'satuan' => $satuan,
            'harga' => $harga,
            'keterangan' => 'Diperbarui '.$role,
            'LT' => $lead_time
        );

        $condition = array('id_bahan' => $id);
        $result = $this->BahanModel->UpdateBahanRequest($condition, $payload);
        if($result){    
            $this->session->set_flashdata('flashdata','Data Bahan berhasil diperbarui!');
            redirect('BahanController');
        } else {
            $this->session->set_flashdata('flashgagal', 'Data Bahan gagal diperbarui!');
        }
    }

    public function DeleteBahan()
    {
        $id = $this->uri->segment(3);
        $payload = array('id_bahan' => $id);

        $result = $this->BahanModel->DeleteBahanRequest($payload);
        if($result){    
            $this->session->set_flashdata('flashdata','Data Bahan berhasil dihapus!');
            redirect('BahanController');
        } else {
            $this->session->set_flashdata('flashgagal', 'Data Bahan gagal dihapus!');
        }
    }

    public function CetakBahan()
    {
        $bahan = $this->BahanModel->GetBahanRequest();

        #setting judul laporan dan header tabel
        $judul = "DATA BAHAN BAKU";
        $subjudul = "KOPI.IU";
        $header = array(
            array("label"=>"NO", "length"=>10, "align"=>"C"),
            array("label"=>"NAMA BAHAN", "length"=>50, "align"=>"C"),
            array("label"=>"STOK", "length"=>30, "align"=>"C"),
            array("label"=>"SATUAN", "length"=>30, "align"=>"C"),
            array("label"=>"HARGA", "length"=>30, "align"=>"C")
        );

        $pdf = new FPDF();
        $pdf->SetTitle('Data Bahan Baku', TRUE);
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
        foreach ($bahan as $row) {
            $pdf->Cell($header[$i]['length'], 8, $no++, 1,'0', $kolom['align'], $fill);
            $pdf->Cell($header[$i+1]['length'], 8, ' '.$row->nama_bahan,1,'0', 'L', $fill);
            $pdf->Cell($header[$i+2]['length'], 8, number_format($row->stok,0,',','.').' ',1,'0', 'R', $fill);
            $pdf->Cell($header[$i+3]['length'], 8, $row->satuan,1,'0', $kolom['align'], $fill);
            $pdf->Cell($header[$i+4]['length'], 8, " Rp. ".number_format($row->harga,0,',','.'),1,'0', 'L', $fill);
            $fill = !$fill;
            $pdf->Ln();
        }
        date_default_timezone_set('Asia/Jakarta');
        $pdf->SetFont('Arial','I','10');
        $pdf->Cell(0, 7, "*) Dicetak pada ".date('H:i:s d-m-Y '), '0', 2, 'L');

        #output file PDF
        $pdf->Output('I', 'Data Bahan Baku.pdf');        
    }
}
