<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BOMController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('BOMModel');
        $this->load->model('BahanModel');
        $this->load->library('fpdf');
    }

    public function index()
    {
        $data['title'] = "Data BOM";
        $data['BOM'] = $this->BOMModel->GetBOMRequest();

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('bom/BOM', $data);
        $this->load->view('template/footer');
    }

    public function AddBOM()
    {
        $data['title'] = "Tambah BOM";
        $data['bahan'] = $this->BahanModel->GetBahanRequest();

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('bom/AddBOM', $data);
        $this->load->view('template/footer');
    }

    public function DetailBOM($id_bom)
    {
        $data['title'] = "Detail BOM";

        $condition = array('id_bom' => $id_bom);
        $data['BOM'] = $this->BOMModel->FindBOMDetailRequest($condition);
        $bom = $this->BOMModel->FindBOMRequest($condition);

        $data['nama_bom'] = $bom[0]->nama_bom;

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('bom/BOMDetail', $data);
        $this->load->view('template/footer');
    }

    public function UpdateBOM($id_bom)
    {
        $data['title'] = "Edit BOM";

        $condition = array('id_bom' => $id_bom);

        $data['bom'] = $this->BOMModel->FindBOMRequest($condition);
        $data['bom_detail'] = $this->BOMModel->FindBOMDetailRequest($condition);
        $data['bahan'] = $this->BahanModel->GetBahanRequest();

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('bom/UpdateBOM', $data);
        $this->load->view('template/footer');
    }

    public function Insert()
    {
        $name = $this->input->post('nama_bom');
        $harga = $this->input->post('harga');
        $deskripsi = $this->input->post('deskripsi');
        $id_bahan = $this->input->post('id_bahan');
        $jumlah_bahan = $this->input->post('jumlah_bahan');
        
        $payload= array(
            'nama_bom' => $name,
            'harga' => $harga,
            'deskripsi' => $deskripsi,
        );

        $result = $this->BOMModel->AddBOMRequest($payload);

        for($i=0; $i < count($id_bahan); $i++){
            $payload_detail = array(
                'id_bom' => $result,
                'id_bahan' => $id_bahan[$i],
                'jumlah' => $jumlah_bahan[$i],
            );
            $this->BOMModel->AddBOMDetailRequest($payload_detail);
        }

        if($result){    
            $this->session->set_flashdata('flashdata','Data BOM berhasil ditambahkan!');
            redirect('BOMController');
        } else {
            $this->session->set_flashdata('flashgagal', 'Data BOM gagal ditambahkan!');
        }
    }

    public function Update()
    {
        $id = $this->input->post('id_bom');
        $name = $this->input->post('nama_bom');
        $harga = $this->input->post('harga');
        $deskripsi = $this->input->post('deskripsi');
        $id_bahan = $this->input->post('id_bahan');
        $jumlah_bahan = $this->input->post('jumlah_bahan');

        $payload= array(
            'nama_bom' => $name,
            'harga' => $harga,
            'deskripsi' => $deskripsi,
        );

        $condition = array('id_bom' => $id);
        $result = $this->BOMModel->UpdateBOMRequest($condition, $payload);

        $cond = array('tbl_bom_detail.id_bom' => $id);
        $this->BOMModel->DeleteBOMDetailRequest($cond);
        for($i=0; $i < count($id_bahan); $i++){
            $payload_detail = array(
                'id_bom' => $id,
                'id_bahan' => $id_bahan[$i],
                'jumlah' => $jumlah_bahan[$i],
            );
            // var_dump($detail);
            // die();
            // if($detail){
            //     $this->BOMModel->UpdateBOMDetailRequest($cond, $payload_detail);
            // } else {
            $this->BOMModel->AddBOMDetailRequest($payload_detail);
            // }
            // unset($cond);
        }

        if($result){    
            $this->session->set_flashdata('flashdata','Data BOM berhasil diperbarui!');
            redirect('BOMController');
        } else {
            $this->session->set_flashdata('flashgagal', 'Data BOM gagal diperbarui!');
        }
    }

    public function DeleteBOM()
    {
        $id = $this->uri->segment(3);
        $payload = array('id_bom' => $id);

        $result = $this->BOMModel->DeleteBOMRequest($payload);
        if($result){    
            $this->session->set_flashdata('flashdata','Data BOM berhasil dihapus!');
            redirect('BOMController');
        } else {
            $this->session->set_flashdata('flashgagal', 'Data BOM gagal dihapus!');
        }

    }

    public function CetakBOM()
    {
        $bom = $this->BOMModel->GetBOMRequest();

        #setting judul laporan dan header tabel
        $judul = "DATA PRODUK";
        $subjudul = "KOPI.IU";
        $header = array(
            array("label"=>"NO", "length"=>10, "align"=>"C"),
            array("label"=>"NAMA PRODUK", "length"=>50, "align"=>"C"),
            array("label"=>"HARGA", "length"=>35, "align"=>"C"),
            array("label"=>"DESKRIPSI", "length"=>65, "align"=>"C")
        );

        $pdf = new FPDF();
        $pdf->SetTitle('Data Produk', TRUE);
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
        foreach ($bom as $row) {
            $pdf->Cell($header[$i]['length'], 8, $no++, 1,'0', $kolom['align'], $fill);
            $pdf->Cell($header[$i+1]['length'], 8, $row->nama_bom,1,'0', 'L', $fill);
            $pdf->Cell($header[$i+2]['length'], 8, "Rp. ".number_format($row->harga,0,',','.'),1,'0', $kolom['align'], $fill);
            $pdf->MultiCell($header[$i+3]['length'], 8, $row->deskripsi,1,'0', $kolom['align'], $fill);
            $fill = !$fill;
            $pdf->Ln();
        }
        date_default_timezone_set('Asia/Jakarta');
        $pdf->SetFont('Arial','I','10');
        $pdf->Cell(0, 7, "*) Dicetak pada ".date('H:i:s d-m-Y '), '0', 2, 'L');

        #output file PDF
        $pdf->Output('I', 'Data Produk.pdf');        
    }
}
