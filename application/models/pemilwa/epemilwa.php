<?php

class Epemilwa extends CI_Model
{

    function input_data($data)
    {
        //echo var_dump($data);
        $this->db->insert("epemilwa", $data);
        // echo var_dump($data);
        return $this->db->insert_id();
    }

    function read()
    {
        $sql = "SELECT * FROM epemilwa";
        return $this->db->query($sql);
    }

    function getById($id)
    {
        return $this->db->where('id', $id)->get('epemilwa')->row();
    }

    function udahPilih($cry)
    {
        $kue = $this->db->select('pilih')->from('epemilwa')->where(array('nim' => $cry))->get()->result();
        // print_r($kue[0]->pilih); kalau pakai ->result() setelah ->get()
        if ($kue[0]->pilih == 0) {
            return false;
        } elseif ($kue[0]->pilih == 1) {
            return true;
        }
    }

    function qCount($nim)
    {
        $query = $this->db->select('keuze')->from('epemilwa')->where(array('nim' => $nim))->get();
        return $query->num_rows();
    }

    function pote($pilih)
    {
        $nim = $this->session->userdata('cry');
        $data = array(
            "pilih" => 1,
            "keuze" => $pilih
        );

        $this->db->where('nim', $nim);
        $this->db->update('epemilwa', $data);

        return true;
    }

    function duplicateCheck($nim)
    {
        $q =  $this->db->select('nim')
            ->from('epemilwa')
            ->where(array('nim' => $nim))->get();
        if ($q->num_rows() == 0) {
            return false;
        } else {
            return true;
        }
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
