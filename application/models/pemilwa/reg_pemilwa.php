<?php

class Reg_pemilwa extends CI_Model
{

    function input_data($data)
    {
        $this->db->insert("registrar_pemilwa", $data);
        return $this->db->insert_id();
    }

    function read()
    {
        $sql = "SELECT * FROM registrar_pemilwa";
        return $this->db->query($sql);
    }

    function getById($id)
    {
        return $this->db->where('id', $id)->get('registrar_pemilwa')->row();
    }

    function duplicateCheck($nim)
    {
        $q =  $this->db->select('nim')
            ->from('registrar_pemilwa')
            ->where(array('nim' => $nim))->get();
        if ($q->num_rows() == 0) {
            return false;
        } else {
            return true;
        }
    }

    function writeStatus($data)
    {
        return $this->db->replace('registrar_pemilwa', $data);
    }

    function checkNim($query)
    {
        return $this->db->where('nim', $query)->get('registrar_pemilwa');
        /*
        $this->db->select("*");
        $this->db->from("pemilwa");
        if($query != '')
        {
            $this->db->like('id', $query);
            $this->db->or_like('nama_lengkap', $query);
            $this->db->or_like('nim', $query);
        }
        $this->db->order_by('id', 'DESC');
        return $this->db->get();*/
    }
}
