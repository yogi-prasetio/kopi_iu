<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PesananController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PesananModel');
        $this->load->model('BahanModel');
        $this->load->model('UserModel');
        $this->load->library('fpdf');
    }

    public function index()
    {
        $data['title'] = "Data Pesanan";
        $data['Pesanan'] = $this->PesananModel->GetPesananRequest();        

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('pesanan/Pesanan', $data);
        $this->load->view('template/footer');
    }

    public function Pesanan($id_supplier)
    {
        $data['title'] = "Data Pesanan";

        $condition = array('tbl_pesanan.id_supplier' => $id_supplier);
        $data['Pesanan'] = $this->PesananModel->FindPesananUserRequest($condition);

        $cond = array('keterangan' => 'Pemesanan', 'id_supplier' => $this->session->userdata('id_user'));
        $data['tindakan'] = count($this->PesananModel->FindPesananUserRequest($cond));

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('pesanan/PesananUser', $data);
        $this->load->view('template/footer');
    }

    public function AddPesanan()
    {
        $data['title'] = "Tambah Pesanan";
        $data['bahan'] = $this->BahanModel->GetBahanRequest();

        $condition = array('role' => 'Supplier');
        $data['user'] = $this->UserModel->GetSupplierRequest($condition);

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('pesanan/AddPesanan', $data);
        $this->load->view('template/footer');
    }

    public function DetailPesanan($id_pesanan)
    {
        $data['title'] = "Detail Pesanan";
        $condition = array('tbl_pesanan_detail.id_pesanan' => $id_pesanan);
        $data['pesanan'] = $this->PesananModel->GetDetailPesananRequest($condition);

        $cond = array('keterangan' => 'Pemesanan', 'id_supplier' => $this->session->userdata('id_user'));
        $data['tindakan'] = count($this->PesananModel->FindPesananUserRequest($cond));

        $kondisi = array('keterangan' => 'Disetujui Supplier');
        $data['jml_tindakan'] = count($this->PesananModel->FindPesananUserRequest($kondisi));

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('pesanan/DetailPesanan', $data);
        $this->load->view('template/footer');
    }

    public function Insert()
    {
        $id_supplier = $this->input->post('id_supplier');
        $id_bahan = $this->input->post('id_bahan');
        $jumlah_bahan = $this->input->post('jumlah_bahan');
        $total_biaya = $this->input->post('total_biaya');
        $tanggal = $this->input->post('tanggal');

        $total = 0;
        foreach($total_biaya as $data){
            $total += $data;
        }

        $payload = array(
            'id_supplier' => $id_supplier,
            'total_biaya' => $total,
            'tgl_pesanan' => $tanggal,
            'keterangan' => 'Pemesanan',
            'status' => 0,
        );

        $result = $this->PesananModel->AddPesananRequest($payload);

        for($i=0; $i < count($id_bahan); $i++){
            $payload_detail = array(
                'id_pesanan' => $result,
                'id_bahan' => $id_bahan[$i],
                'jml_bahan' => $jumlah_bahan[$i],
                'jml_harga' => $total_biaya[$i],
            );            
            $this->PesananModel->AddDetailPesananRequest($payload_detail);
        }

        if($result){
            $this->session->set_flashdata('flashdata','Data Pesanan berhasil ditambahkan!');
            redirect('PesananController');
        } else {
            $this->session->set_flashdata('flashgagal', 'Data Pesanan gagal ditambahkan!');
        }
    }

    public function DaftarTindakan(){
        $data['title'] = "Daftar Tindakan";
        $condition = array("keterangan" => "Disetujui Supplier");
        $data['Pesanan'] = $this->PesananModel->FindPesananRequest($condition);
        $data['jml_tindakan'] = count($data['Pesanan']);

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('pesanan/Tindakan', $data);
        $this->load->view('template/footer');
    }

    public function BahanIn($id_pesanan){
        $pesanan = array("tbl_pesanan_detail.id_pesanan" => $id_pesanan);
        $bahan = $this->PesananModel->GetDetailPesananRequest($pesanan);

        // echo $bahan[0]->id_bahan." ".$bahan[0]->stok;
        // die();

        $payload = array(
            'tgl_penerimaan' => date('Y-m-d H:i:s'),
            'keterangan' => 'Diterima', 
            'status' => 1
        );
        $cond = array("id_pesanan" => $id_pesanan);
        $result = $this->PesananModel->UpdatePesananRequest($cond, $payload);

        for($i=0; $i<count($bahan); $i++){
            $condition = array("id_bahan" => $bahan[$i]->id_bahan);
            $data_bahan = $this->BahanModel->FindBahanRequest($condition);
            // echo $data_bahan[0]->persediaan;
            // echo $bahan[$i]->jml_bahan;
            // die();
            $data = array(
                "persediaan" => $data_bahan[0]->persediaan + $bahan[$i]->jml_bahan,
                "stok" => $data_bahan[0]->stok + $bahan[$i]->jml_bahan,
                "keterangan" => "Masuk",
            );
            $this->BahanModel->UpdateBahanRequest($condition, $data);
        }

        if($result){    
            $this->session->set_flashdata('flashdata','Data Bahan telah diterima!');
            redirect('PesananController/DaftarTindakan');
        } else {
            $this->session->set_flashdata('flashgagal', 'Data Bahan gagal diterima!');
        }

    }

    public function Accept($id_pesanan){
        $condition = array('id_pesanan' => $id_pesanan);
        $payload = array('keterangan' => 'Disetujui Supplier');
        $result = $this->PesananModel->UpdatePesananRequest($condition, $payload);

        if($result){    
            $this->session->set_flashdata('flashdata','Data Pesanan berhasil disetujui!');
            redirect('PesananController/Pesanan/'.$_SESSION["id_user"]);
        } else {
            $this->session->set_flashdata('flashgagal', 'Terdapat kesalahan');
        }
    }

    public function Reject($id_pesanan){
        $condition = array('id_pesanan' => $id_pesanan);
        $payload = array('keterangan' => 'Ditolak Supplier', 'status' => 0);
        $result = $this->PesananModel->UpdatePesananRequest($condition, $payload);

        if($result){    
            $this->session->set_flashdata('flashdata','Data Pesanan telah ditolak!');
            redirect('PesananController/Pesanan/'.$_SESSION["id_user"]);
        } else {
            $this->session->set_flashdata('flashgagal', 'Terdapat kesalahan');
        }   
    }

    public function AcceptAll(){
        $condition = array('keterangan' => 'Pemesanan', 'id_supplier' => $this->session->userdata('id_user'));
        $payload = array('keterangan' => 'Disetujui Supplier');
        $result = $this->PesananModel->UpdatePesananRequest($condition, $payload);

        if($result){    
            $this->session->set_flashdata('flashdata','Data Pesanan berhasil disetujui semua!');
            redirect('PesananController/Pesanan/'.$_SESSION["id_user"]);
        } else {
            $this->session->set_flashdata('flashgagal', 'Terdapat kesalahan');
        }
    }

    public function RejectAll(){
        $condition = array('keterangan' => 'Pemesanan', 'id_supplier' => $this->session->userdata('id_user'));
        $payload = array('keterangan' => 'Ditolak Supplier', 'status' => 0);
        $result = $this->PesananModel->UpdatePesananRequest($condition, $payload);

        if($result){    
            $this->session->set_flashdata('flashdata','Data Pesanan telah ditolak semua!');
            redirect('PesananController/Pesanan/'.$_SESSION["id_user"]);
        } else {
            $this->session->set_flashdata('flashgagal', 'Terdapat kesalahan');
        }   
    }

    public function CetakPesanan()
    {
        $pesanan = $this->PesananModel->GetDetailPesanan();

        #setting judul laporan dan header tabel
        $judul = "DATA PESANAN BAHAN BAKU";
        $subjudul = "KOPI.IU";
        $header = array(
            array("label"=>"NO", "length"=>7, "align"=>"C"),
            array("label"=>"NAMA BAHAN", "length"=>30, "align"=>"C"),
            array("label"=>"JUMLAH", "length"=>25, "align"=>"C"),
            array("label"=>"BIAYA", "length"=>25, "align"=>"C"),
            array("label"=>"TGL PESAN", "length"=>35, "align"=>"C"),
            array("label"=>"TGL TERIMA", "length"=>35, "align"=>"C"),
            array("label"=>"KETERANGAN", "length"=>40, "align"=>"C")
        );

        $pdf = new FPDF();
        $pdf->SetTitle('Data Pesanan Bahan Baku', TRUE);
        $pdf->SetMargins(7, 20, 7);
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
        $pdf->SetFont('Arial','B','9');
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
        foreach ($pesanan as $row) {
            $pdf->Cell($header[$i]['length'], 8, $no++, 1,'0', $kolom['align'], $fill);
            $pdf->Cell($header[$i+1]['length'], 8, $row->nama_bahan,1,'0', 'L', $fill);
            $pdf->Cell($header[$i+2]['length'], 8, number_format($row->jml_bahan,0,',','.').' '.$row->satuan,1,'0', $kolom['align'], $fill);
            $pdf->Cell($header[$i+3]['length'], 8, number_format($row->jml_harga,0,',','.'),1,'0', $kolom['align'], $fill);
            $pdf->Cell($header[$i+4]['length'], 8, $row->tgl_pesanan,1,'0', $kolom['align'], $fill);
            $pdf->Cell($header[$i+5]['length'], 8, $row->tgl_penerimaan,1,'0', $kolom['align'], $fill);
            $pdf->Cell($header[$i+6]['length'], 8, $row->keterangan,1,'0', $kolom['align'], $fill);
            $fill = !$fill;
            $pdf->Ln();
        }
        date_default_timezone_set('Asia/Jakarta');
        $pdf->SetFont('Arial','I','10');
        $pdf->Cell(0, 7, "*) Dicetak pada ".date('H:i:s d-m-Y '), '0', 2, 'L');

        #output file PDF
        $pdf->Output('I', 'Data Pesanan Bahan Baku.pdf');        
    }

    public function CetakFaktur($id_pesanan){
        $condition = array("tbl_pesanan_detail.id_pesanan" => $id_pesanan);
        $pesanan = $this->PesananModel->GetDetailPesananRequest($condition);
        $jumlah_item = count($pesanan);

        // var_dump($pesanan);
        // die();
        #setting judul laporan dan header tabel
        $judul = "Invoice ".$pesanan[0]->nama_user;
        $subjudul = "KOPI.IU";
        $header = array(
            array("label"=>"NO", "length"=>10, "align"=>"C"),
            array("label"=>"NAMA PRODUK", "length"=>50, "align"=>"C"),
            array("label"=>"JUMLAH", "length"=>30, "align"=>"C"),
            array("label"=>"SATUAN", "length"=>25, "align"=>"C"),
            array("label"=>"HARGA", "length"=>30, "align"=>"C"),
            array("label"=>"TOTAL HARGA", "length"=>45, "align"=>"C")
        );

        $pdf = new FPDF();
        $pdf->SetTitle('Data Faktur Pembelian', TRUE);
        $pdf->SetMargins(10,20,10);
        $pdf->AddPage('P','A4', 0);
        $pdf->Cell(15);
        $pdf->SetFont('Arial','B','16');
        $pdf->SetTextColor(71, 89, 107);
        $pdf->Text(10,15,$pesanan[0]->nama_user);
        $pdf->Ln();

        // $pdf->multicell(120, 5, '   ' . $actividad, 0, 'l', true);
        // $x = $pdf->GetX();
        // $y = $pdf->GetY();
        // $pdf->SetXY($x + 120, $y);
        // $pdf->Cell(70, -5, '   ' . $claseActividad, '', 0, 'l', true);

        date_default_timezone_set('Asia/Jakarta');
        $tanggal = new DateTime($pesanan[0]->tgl_pesanan);
        $tgl_pesanan = $tanggal->format("H:i:s d-m-Y");

        $pdf->SetFont('Arial','','12');
        $pdf->SetTextColor(0);
        $pdf->MultiCell(85,7," Pemesan : \n KOPI I.U",1,'L');

        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->SetXY($x + 135, $y);
        $pdf->SetFont('Arial','B','12');
        $pdf->Cell(75,-20," FAKTUR : ",0,'L');
        $pdf->SetXY($x + 110, $y);
        $pdf->SetFont('Arial','','12');
        $pdf->Cell(85,5," No Faktur      : ".$id_pesanan,0,"L");
        $pdf->SetXY($x + 110, $y);
        $pdf->Cell(85,15," Tanggal         : ".$tgl_pesanan,0,"L"); 
        $pdf->SetXY($x + 110, $y);
        $pdf->Cell(85,25," Pembayaran : Cash",0,"L");
        $pdf->SetXY($x + 110, $y);
        $pdf->Cell(85,35," Jumlah Item  : ".$jumlah_item,0,'L');

        $pdf->Ln(5);
        $pdf->SetFont('Arial','','12');
        $pdf->MultiCell(85,5,"\n Alamat : \n Jl. Ir. H. Juanda No.201, Purwawinangun, \n Kec. Kuningan, Kabupaten Kuningan, \n Jawa Barat\n ",1,'L');

        $pdf->Ln(5);
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
        $no=0;
        $total=0;
        for($i=0; $i<count($pesanan); $i++) {
            $pdf->Cell($header[$no]['length'], 15, 1+$i, 1,'0', $kolom['align'], $fill);
            $pdf->Cell($header[$no+1]['length'], 15, $pesanan[$i]->nama_bahan,1,'0', 'L', $fill);
            $pdf->Cell($header[$no+2]['length'], 15, number_format($pesanan[$i]->jml_bahan,0,',','.'),1,'0', $kolom['align'], $fill);
            $pdf->Cell($header[$no+3]['length'], 15, $pesanan[$i]->satuan,1,'0', $kolom['align'], $fill);
            $pdf->Cell($header[$no+4]['length'], 15, "Rp. ".number_format($pesanan[$i]->harga,0,',','.'),1,'0', $kolom['align'], $fill);
            $pdf->Cell($header[$no+5]['length'], 15, "Rp. ".number_format($pesanan[$i]->jml_harga,0,',','.'),1,'0', $kolom['align'], $fill);
            $pdf->Ln();
        }
        $pdf->Cell(10,85,"",1);
        $pdf->Cell(50,85,"",1);
        $pdf->Cell(30,85,"",1);
        $pdf->Cell(25,85,"",1);
        $pdf->Cell(30,85,"",1);
        $pdf->Cell(45,85,"",1);
        $pdf->Ln();

        $pdf->SetFont('Arial','B','10');
        $yy=$pdf->GetY();
        $pdf->SetXY($x + 115, $yy);
        $pdf->SetFillColor(71, 89, 107);
        $pdf->SetTextColor(255);
        $pdf->Cell(30, 15, "TOTAL",1,'0', 'C',true);
        $pdf->SetTextColor(0);        
        $pdf->Cell(45, 15, 'Rp. '.number_format($pesanan[0]->total_biaya,0,',','.'),1,'0', 'C',false);
        $pdf->Ln();

        date_default_timezone_set('Asia/Jakarta');
        $pdf->SetFont('Arial','I','10');
        $pdf->Cell(0, 7, "*) Dicetak pada ".date('H:i:s d-m-Y '), '0', 2, 'L');

        #output file PDF
        $pdf->Output('I', 'Invoice '.$pesanan[0]->nama_user.'.pdf');
    }
}
