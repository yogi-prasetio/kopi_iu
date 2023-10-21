<?php

class PengeluaranModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }

    public function GetPengeluaranRequest()
    {
        $this->db->join('tbl_transaksi', 'tbl_transaksi.id_transaksi=tbl_pengeluaran.id_transaksi');
        $this->db->join('tbl_bahan', 'tbl_bahan.id_bahan=tbl_pengeluaran.id_bahan');
        $this->db->order_by('tgl_pengeluaran', 'ASC');
        return $this->db->get('tbl_pengeluaran')->result();
    }
    public function AddPengeluaranRequest($payload)
    {
        return $this->db->insert('tbl_pengeluaran', $payload);
    }
    public function FindPengeluaranRequest($condition)
    {
        $this->db->join('tbl_bahan', 'tbl_bahan.id_bahan=tbl_pengeluaran.id_bahan');
        return $this->db->get_where('tbl_pengeluaran', $condition)->result();
    }
    public function GetPengeluaran()
    {
        $now = date("2023-09");
        $interval = new DateInterval('P1Y1M');
        $old = (new DateTime)->sub($interval)->format('Y-m');
        // echo "$old to $now";
        $this->db->select("`tbl_pengeluaran`.`id_bahan`, `nama_bahan`, `satuan`, `LT`, `tgl_pengeluaran`");
        $this->db->select("SUM(`tbl_pengeluaran`.`jumlah_bahan`) AS jumlah");

        $this->db->from("`tbl_bahan`");

        $this->db->join("tbl_pengeluaran", "`tbl_bahan`.`id_bahan`=`tbl_pengeluaran`.`id_bahan`");
        $this->db->where("DATE_FORMAT(tgl_pengeluaran, '%Y-%m') BETWEEN '".$old."' AND '".$now."'");
        $this->db->group_by("nama_bahan");
        // $query = "SELECT `tbl_pengeluaran`.`id_bahan`, `nama_bahan`, `satuan`, `LT`, SUM(`tbl_pengeluaran`.`jumlah_bahan`) AS 'jumlah' FROM `tbl_bahan` JOIN `tbl_pengeluaran` ON `tbl_bahan`.`id_bahan`=`tbl_pengeluaran`.`id_bahan` WHERE (mid(`tgl_pengeluaran`, 1,7) BETWEEN ".$old." AND ".$now.") GROUP BY `nama_bahan`";
                    // return $query;
        // return $this->db->query($query)->result();
        return $this->db->get()->result();
    }

    public function GetPengeluaranTerakhir($id_bahan)
    {
        $now = date("Y-m");
        $interval = new DateInterval('P1M');
        $old = (new DateTime)->sub($interval)->format('Y-m');
        $this->db->select("`tbl_pengeluaran`.`id_bahan`, `nama_bahan`, `satuan`, `LT`, `tgl_pengeluaran`");
        $this->db->select("SUM(`tbl_pengeluaran`.`jumlah_bahan`) AS jumlah");

        $this->db->from("`tbl_bahan`");

        $this->db->join("tbl_pengeluaran", "`tbl_bahan`.`id_bahan`=`tbl_pengeluaran`.`id_bahan`");
        $this->db->where("DATE_FORMAT(tgl_pengeluaran, '%Y-%m') BETWEEN '".$old."' AND '".$now."' AND `tbl_bahan`.`id_bahan`='".$id_bahan."'");
        $this->db->group_by("nama_bahan");

        return $this->db->get()->result();
    }
}