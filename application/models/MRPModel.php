<?php

class MRPModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }

    public function GetMRPRequest()
    {
        $this->db->join("tbl_bahan", "tbl_mrp.id_bahan=tbl_bahan.id_bahan");
        return $this->db->get('tbl_mrp')->result();
    }
    public function FindMRPRequest($condition)
    {
        return $this->db->get_where('tbl_mrp', $condition);
    }
    public function AddMRPRequest($payload)
    {
        return $this->db->insert('tbl_mrp', $payload);
    }

    public function UpdateMRPRequest($payload, $condition)
    {
        $this->db->where($condition);
        return $this->db->update('tbl_mrp', $payload);
    }

    public function DeleteMRPRequest($condition)
    {
        $this->db->where($condition);
        return $this->db->delete('tbl_mrp');
    }
}
