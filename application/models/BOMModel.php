<?php

class BOMModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }

    public function GetBOMRequest()
    {
        $this->db->order_by('nama_bom', 'ASC');
        return $this->db->get('tbl_bom')->result();
    }
    public function FindBOMRequest($condition)
    {
        return $this->db->get_where('tbl_bom', $condition)->result();
    }
    public function AddBOMRequest($payload)
    {
        $this->db->insert('tbl_bom', $payload);
        return $this->db->insert_id();
    }
    public function UpdateBOMRequest($condition, $payload)
    {
        $this->db->where($condition);
        $this->db->update('tbl_bom', $payload);
        return $condition['id_bom'];
    }
    public function DeleteBOMRequest($condition)
    {
        $this->db->where($condition);
        $this->db->delete('tbl_bom_detail');
        $this->db->where($condition);
        return $this->db->delete('tbl_bom');
    }
    public function GetBOMCount()
    {
        return $this->db->get('tbl_bom')->num_rows();
    }

    //BOM Detail
    public function FindBOMDetailRequest($condition)
    {
        $this->db->join('tbl_bahan', 'tbl_bahan.id_bahan=tbl_bom_detail.id_bahan');
        return $this->db->get_where('tbl_bom_detail', $condition)->result();
    }    

    public function AddBOMDetailRequest($payload)
    {
        return $this->db->insert('tbl_bom_detail', $payload);
    }

    public function DeleteBOMDetailRequest($condition)
    {
        $this->db->where($condition);
        return $this->db->delete('tbl_bom_detail');
    }
}
