<?php

class User extends CI_Model
{

    function input_data($data)
    {
        //echo var_dump($data);
        $this->db->insert("projekpip_user", $data);
        // echo var_dump($data);
        return $this->db->insert_id();
    }

    function read()
    {
        $sql = "SELECT * FROM projekpip_user";
        return $this->db->query($sql);
    }

    function getByNim($nim)
    {
        return $this->db->where('nim', $nim)->get('projekpip_user')->row(); //echo $row->name;
    }

    function duplicateCheck($nim)
    {
        $q =  $this->db->select('nim')
            ->from('projekpip_user')
            ->where(array('nim' => $nim))->get();
        if ($q->num_rows() == 0) {
            return false;
        } else {
            return true;
        }
    }

    function logon($nim)
    {
        $q =  $this->db->select('github_name')
            ->from('projekpip_user')
            ->where(array('nim' => $nim))->get();

        return $q->result(); //check variable $modelmethod->github_name
    }

    function writeStatus($data)
    {
        return $this->db->replace('survei_informatika', $data);
    }

    function checkNim($query)
    {
        return $this->db->where('nim', $query)->get('survei_informatika');
        /*
        $this->db->select("*");
        $this->db->from("oprec2020");
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
