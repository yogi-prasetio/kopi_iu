<?php

class TransaksiModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }
    
    public function GetTransaksiRequest()
    {
        $this->db->join('tbl_user', 'tbl_user.id_user=tbl_transaksi.id_user');
        // $this->db->join('tbl_transaksi_detail', 'tbl_transaksi_detail.id_transaksi=tbl_transaksi.id_transaksi');
        // $this->db->join('tbl_bom', 'tbl_bom.id_bom=tbl_transaksi_detail.id_bom');
        $this->db->order_by('nama_user', 'ASC');
        return $this->db->get('tbl_transaksi')->result();
    }
    public function FindTransaksiRequest($condition)
    {
        $this->db->join('tbl_user', 'tbl_user.id_user=tbl_transaksi.id_user');
        return $this->db->get_where('tbl_transaksi', $condition)->result();
    }
    public function FindDetailTransaksiRequest($condition)
    {
        $this->db->join('tbl_bom', 'tbl_bom.id_bom=tbl_transaksi_detail.id_bom');
        $this->db->join('tbl_transaksi', 'tbl_transaksi.id_transaksi=tbl_transaksi_detail.id_transaksi');
        return $this->db->get_where('tbl_transaksi_detail', $condition)->result();
    }
    public function AddTransaksiRequest($payload)
    {
        $this->db->insert('tbl_transaksi', $payload);
        return $this->db->insert_id();
    }

    public function AddTransaksiDetailRequest($payload)
    {
        return $this->db->insert('tbl_transaksi_detail', $payload);
    }
    public function UpdateTransaksiRequest($condition, $payload)
    {
        $this->db->where($condition);
        return $this->db->update('tbl_transaksi', $payload);
    }
    public function DeleteTransaksiRequest($condition)
    {
        $this->db->where($condition);
        return $this->db->delete('tbl_transaksi');
    }
    public function GetTransaksiCount()
    {
        return $this->db->get('tbl_transaksi')->num_rows();
    }

    public function GetTransaksiUSerCount($condition)
    {
        return $this->db->get_where('tbl_transaksi', $condition)->num_rows();
    }

    public function GetUserBilling($condition)
    {
        $this->db->select_sum('total_harga');
        return $this->db->get_where('tbl_transaksi', $condition)->result();
    }
}
