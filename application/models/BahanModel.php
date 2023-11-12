<?php

class BahanModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }

    public function GetBahanRequest()
    {
        $this->db->join('tbl_user', 'tbl_bahan.id_supplier=tbl_user.id_user');
        $this->db->order_by('nama_bahan', 'ASC');
        return $this->db->get('tbl_bahan')->result();
    }
    public function FindBahanRequest($condition)
    {
        $this->db->limit(1);
        $this->db->join('tbl_user', 'tbl_bahan.id_supplier=tbl_user.id_user');
        return $this->db->get_where('tbl_bahan', $condition)->result();
    }
    public function AddBahanRequest($payload)
    {
        return $this->db->insert('tbl_bahan', $payload);
    }
    public function UpdateBahanRequest($condition, $payload)
    {
        $this->db->where($condition);
        return $this->db->update('tbl_bahan', $payload);
    }
    public function DeleteBahanRequest($condition)
    {
        $this->db->where($condition);
        return $this->db->delete('tbl_bahan');
    }
    public function GetBahanCount()
    {
        return $this->db->get('tbl_bahan')->num_rows();
    }
    public function GetBahanSupplierCount($condition)
    {
        return $this->db->get_where('tbl_bahan', $condition)->num_rows();
    }
    public function GetTotalBeliBahan($condition)
    {
        $this->db->sum("beli");
        return $this->db->get_where('tbl_bahan', $condition)->result();
    }
}
