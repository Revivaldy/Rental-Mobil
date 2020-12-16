<?php

class Harian_model extends CI_Model
{
    public function getHarian($id = null)
    {
        if ($id === null){
            return $this->db->get('tb_mobil_harian')->result_array();
        } else {
            return $this->db->get_where('tb_mobil_harian', ['id' => $id])->result_array();
        }
        
    }

    public function deleteHarian($id)
    {
        $this->db->delete('tb_mobil_harian', ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function createHarian($data)
    {
        $this->db->insert('tb_mobil_harian', $data);
        return $this->db->affected_rows();
    }

    public function updateHarian($data, $id)
    {
        $this->db->update('tb_mobil_harian', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
}