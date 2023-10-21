

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TransaksiController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('TransaksiModel');
        $this->load->model('PengeluaranModel');
        $this->load->model('BahanModel');
        $this->load->model('BOMModel');
        $this->load->library('fpdf');
    }

    public function index()
    {
        $data['title'] = "Data Transaksi";
        $data['Transaksi'] = $this->TransaksiModel->GetTransaksiRequest();        

        // var_dump($data['Transaksi']);
        // die();
        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('transaksi/Transaksi', $data);
        $this->load->view('template/footer');
    }    

    //FRO CUSTOMER ACCESS
    public function Order($id_user)
    {
        $data['title'] = "Data Pesanan";
        $condition = array('tbl_transaksi.id_user' => $id_user);
        $data['pesanan'] = $this->TransaksiModel->FindTransaksiRequest($condition);

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('customer/Pesanan', $data);
        $this->load->view('template/footer');
    }

    public function Add()
    {
        $data['title'] = "Pesan";
        $data['BOM'] = $this->BOMModel->GetBOMRequest();

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('transaksi/AddTransaksi', $data);
        $this->load->view('template/footer');
    }

    public function Detail($id_transaksi)
    {
        $data['title'] = "Detail Pesanan";

        $condition = array('tbl_transaksi_detail.id_transaksi' => $id_transaksi);

        $data['Transaksi'] = $this->TransaksiModel->FindDetailTransaksiRequest($condition);

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('customer/DetailPesanan', $data);
        $this->load->view('template/footer');
    }


    //FOR ADMIN ACCESS
    public function AddTransaksi()
    {
        $data['title'] = "Tambah Transaksi";
        $data['BOM'] = $this->BOMModel->GetBOMRequest();

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('transaksi/AddTransaksi', $data);
        $this->load->view('template/footer');
    }

    public function DetailTransaksi($id_transaksi)
    {
        $data['title'] = "Detail Transaksi";

        $condition = array('tbl_transaksi_detail.id_transaksi' => $id_transaksi);

        $data['Transaksi'] = $this->TransaksiModel->FindDetailTransaksiRequest($condition);

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('transaksi/DetailTransaksi', $data);
        $this->load->view('template/footer');
    }

    public function Insert()
    {
        $id_bom = $this->input->post('id_produk');
        $quantity = $this->input->post('quantity');
        $jumlah_harga = $this->input->post('jumlah_harga');
        $tanggal = $this->input->post('tanggal');

        $total_harga = 0;
        $jumlah_produk = 0;
        for($i=0; $i<count($quantity); $i++) {        
            $jumlah_produk += intval($quantity[$i]);
        }

        for($i=0; $i<count($jumlah_harga); $i++) {
            $total_harga += intval($jumlah_harga[$i]);
        }
        
        $payload = array(
            'id_user' => $this->session->userdata('id_user'),
            'jumlah_produk' => $jumlah_produk,
            'total_harga' => $total_harga,
            'tgl_transaksi' => $tanggal
        );

        // var_dump($payload);
        // echo "<br><br>";
        $result = $this->TransaksiModel->AddTransaksiRequest($payload);

        for($i=0; $i<count($id_bom); $i++) {
            $payload_detail = array(
                'id_transaksi' => $result,
                'id_bom' => $id_bom[$i],
                'quantity' => $quantity[$i],
                'jumlah_harga' => $jumlah_harga[$i]
            );

            // var_dump($payload_detail);
            // echo "<br><br>";
            $this->TransaksiModel->AddTransaksiDetailRequest($payload_detail);

            $condition = array('id_bom' => $id_bom[$i]);
            $bahan = $this->BOMModel->FindBOMDetailRequest($condition);

            for($j=0; $j<count($bahan); $j++) {
                $payload_keluar = array(
                    'id_transaksi' => $result,
                    'id_bahan' => $bahan[$j]->id_bahan,
                    'jumlah_bahan' => $quantity[$i] * $bahan[$j]->jumlah,
                    'tgl_pengeluaran' => $tanggal
                );
                $this->PengeluaranModel->AddPengeluaranRequest($payload_keluar);
            }
        }

        // die();

        if($result){
            $id_user = $this->session->userdata('id_user');
            if($this->session->userdata('role') == 'Admin'){
                $this->session->set_flashdata('flashdata','Data Transaksi berhasil ditambahkan!');
                redirect('TransaksiController');
            } else {
                $this->session->set_flashdata('flashdata','Pesanan berhasil!');
                redirect('TransaksiController/Order/'.$id_user.'');
            }
        } else {
            $this->session->set_flashdata('flashgagal','Data Transaksi berhasil ditambahkan!');
        }
    }

    public function CetakTransaksi()
    {
        $Transaksi = $this->TransaksiModel->GetTransaksiRequest();

        #setting judul laporan dan header tabel
        $judul = "DATA TRANSAKSI";
        $subjudul = "KOPI IU";
        $header = array(
            array("label"=>"NO", "length"=>10, "align"=>"C"),
            array("label"=>"NAMA PRODUK", "length"=>50, "align"=>"C"),
            array("label"=>"JUMLAH", "length"=>35, "align"=>"C"),
            array("label"=>"TOTAL HARGA", "length"=>40, "align"=>"C"),
            array("label"=>"TGL TRANSAKSI", "length"=>40, "align"=>"C")
        );

        $pdf = new FPDF();
        $pdf->SetTitle('Data Transaksi', TRUE);
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
        foreach ($Transaksi as $row) {
            $pdf->Cell($header[$i]['length'], 8, $no++, 1,'0', $kolom['align'], $fill);
            $pdf->Cell($header[$i+1]['length'], 8, $row->nama_user,1,'0', 'L', $fill);
            $pdf->Cell($header[$i+2]['length'], 8, $row->jumlah_produk,1,'0', $kolom['align'], $fill);
            $pdf->Cell($header[$i+3]['length'], 8, "Rp. ".number_format($row->total_harga,0,',','.'),1,'0', $kolom['align'], $fill);
            $pdf->Cell($header[$i+4]['length'], 8, $row->tgl_transaksi,1,'0', $kolom['align'], $fill);
            $fill = !$fill;
            $pdf->Ln();
        }
        date_default_timezone_set('Asia/Jakarta');
        $pdf->SetFont('Arial','I','10');
        $pdf->Cell(0, 7, "*) Dicetak pada ".date('H:i:s d-m-Y '), '0', 2, 'L');

        #output file PDF
        $pdf->Output('I', 'Data Transaksi.pdf');        
    }

    public function CetakPengeluaran()
    {
        $keluar = $this->TransaksiModel->GetPengeluaranRequest();

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

    public function Cetak()
    {
        $Transaksi = $this->TransaksiModel->GetTransaksiRequest();

        #setting judul laporan dan header tabel
        $judul = "DATA Transaksi";
        $subjudul = "KOPI IU";
        $header = array(
            array("label"=>"NO", "length"=>10, "align"=>"C"),
            array("label"=>"NAMA PRODUK", "length"=>50, "align"=>"C"),
            array("label"=>"JUMLAH", "length"=>45, "align"=>"C"),
            array("label"=>"WAKTU", "length"=>35, "align"=>"C")
        );

        $pdf = new FPDF();
        $pdf->SetTitle('Data Transaksi', TRUE);
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
        foreach ($Transaksi as $row) {
            $pdf->Cell($header[$i]['length'], 8, $no++, 1,'0', $kolom['align'], $fill);
            $pdf->Cell($header[$i+1]['length'], 8, $row->nama_bom,1,'0', 'L', $fill);
            $pdf->Cell($header[$i+2]['length'], 8, $row->jumlah_transaksi,1,'0', $kolom['align'], $fill);
            $pdf->Cell($header[$i+3]['length'], 8, $row->tgl_transaksi,1,'0', $kolom['align'], $fill);
            $fill = !$fill;
            $pdf->Ln();
        }
        date_default_timezone_set('Asia/Jakarta');
        $pdf->SetFont('Arial','I','10');
        $pdf->Cell(0, 7, "*) Dicetak pada ".date('H:i:s d-m-Y '), '0', 2, 'L');

        #output file PDF
        $pdf->Output('I', 'Data Transaksi.pdf');        
    }
}
