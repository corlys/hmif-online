<?php

class Post extends CI_Model
{

    function __construct()
    {
        $this->table = 'projekpip_post';
    }

    function input_data($data)
    {
        //echo var_dump($data);
        $this->db->insert("projekpip_post", $data);
        // echo var_dump($data);
        return $this->db->insert_id();
    }

    function getPosts($limit, $start, $keywords = null)
    {
        if ($keywords) {
            $this->db->like('nama_repo', $keywords);
            // $this->db->or_like('description', $keywords);
        }
        $this->db->limit($limit, $start);
        $return = $this->db->get('projekpip_post')->result_array();
        return $return;
    }

    function test()
    {
        $this->db->like('nama_repo', 'skt2020');
        // $this->db->or_like('description', 'skt2020');
        $this->db->limit(8, 0);
        return $this->db->get('projekpip_post')->result_array();
    }

    function countSearch($keyword)
    {
        $this->db->like('nama_repo', $keyword);
        $this->db->or_like('description', $keyword);
        $this->db->from('projekpip_post');
        return $this->db->count_all_results();
    }

    function countAllPosts()
    {
        return $this->db->get('projekpip_post')->num_rows();
    }

    function read()
    {
        $sql = "SELECT * FROM projekpip_post";
        return $this->db->query($sql);
    }

    function getById($id)
    {
        return $this->db->where('id', $id)->get('projekpip_post')->row();
    }

    function duplicateCheck($nim)
    {
        $q =  $this->db->select('nim')
            ->from('projekpip_post')
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
    function getRows($params = array())
    {
        $this->db->select('*');
        $this->db->from($this->table);

        if (array_key_exists("where", $params)) {
            foreach ($params['where'] as $key => $val) {
                $this->db->where($key, $val);
            }
        }

        if (array_key_exists("search", $params)) {
            // Filter data by searched keywords 
            if (!empty($params['search']['keywords'])) {
                $this->db->like('nama_repo', $params['search']['keywords']);
            }
        }

        // Sort data by ascending or desceding order 
        if (!empty($params['search']['sortBy'])) {
            $this->db->order_by('nama_repo', $params['search']['sortBy']);
        } else {
            $this->db->order_by('id', 'desc');
        }

        if (array_key_exists("returnType", $params) && $params['returnType'] == 'count') {
            $result = $this->db->count_all_results();
        } else {
            if (array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')) {
                if (!empty($params['id'])) {
                    $this->db->where('id', $params['id']);
                }
                $query = $this->db->get();
                $result = $query->row_array();
            } else {
                $this->db->order_by('id', 'desc');
                if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                    $this->db->limit($params['limit'], $params['start']);
                } elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                    $this->db->limit($params['limit']);
                }

                $query = $this->db->get();
                $result = ($query->num_rows() > 0) ? $query->result_array() : FALSE;
            }
        }

        // Return fetched data 
        return $result;
    }
}
