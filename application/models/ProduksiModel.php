<?php

class ProduksiModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }

    public function GetProduksiRequest()
    {
        $this->db->join('tbl_bom', 'tbl_bom.id_bom=tbl_produksi.id_bom');
        $this->db->order_by('nama_bom', 'ASC');
        return $this->db->get('tbl_produksi')->result();
    }
    public function FindProduksiRequest($condition)
    {
        $this->db->limit(1);
        return $this->db->get_where('tbl_produksi', $condition)->result();
    }
    public function AddProduksiRequest($payload)
    {
        $this->db->insert('tbl_produksi', $payload);
        return $this->db->insert_id();
    }

    public function AddProduksiDetailRequest($payload)
    {
        return $this->db->insert('tbl_produksi_detail', $payload);
    }
    public function UpdateProduksiRequest($condition, $payload)
    {
        $this->db->where($condition);
        return $this->db->update('tbl_produksi', $payload);
    }
    public function DeleteProduksiRequest($condition)
    {
        $this->db->where($condition);
        return $this->db->delete('tbl_produksi');
    }
    public function GetProduksiCount()
    {
        return $this->db->get('tbl_produksi')->num_rows();
    }    
}
