<?php

class PesananModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }

    public function GetPesananRequest()
    {
        $this->db->join('tbl_user', 'tbl_pesanan.id_supplier=tbl_user.id_user');
        return $this->db->get('tbl_pesanan')->result();
    }
    public function FindPesananRequest($condition)
    {
        return $this->db->get_where('tbl_pesanan', $condition)->result();
    }
    public function FindPesananUserRequest($condition)
    {
        $this->db->join('tbl_user', 'tbl_pesanan.id_supplier=tbl_user.id_user');
        return $this->db->get_where('tbl_pesanan', $condition)->result();
    }
    public function AddPesananRequest($payload)
    {
        $this->db->insert('tbl_pesanan', $payload);
        return $this->db->insert_id();
    }
    public function UpdatePesananRequest($condition, $payload)
    {
        $this->db->where($condition);
        return $this->db->update('tbl_pesanan', $payload);
    }
    public function DeletePesananRequest($condition)
    {
        $this->db->where($condition);
        return $this->db->delete('tbl_pesanan');
    }
    public function GetPesananCount()
    {
        return $this->db->get('tbl_pesanan')->num_rows();
    }

    //Pesanan Detail
    public function GetDetailPesananRequest($condition)
    {
        $this->db->join('tbl_bahan', 'tbl_pesanan_detail.id_bahan=tbl_bahan.id_bahan');
        $this->db->join('tbl_pesanan', 'tbl_pesanan.id_pesanan=tbl_pesanan_detail.id_pesanan');
        $this->db->join('tbl_user', 'tbl_pesanan.id_supplier=tbl_user.id_user');
        return $this->db->get_where('tbl_pesanan_detail', $condition)->result();
    }
    public function AddDetailPesananRequest($payload)
    {
        return $this->db->insert('tbl_pesanan_detail', $payload);
    }

}
