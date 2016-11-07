<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Model_menu extends CI_Model 
{     
	var $table = 'menu_link';     
	var $column_order = array('menu_name', 'menu_url', 'menu_target', null);     
	var $column_search = array('header','caption'); 
    
	var $order = array('menu_id' => 'asc');  
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    public function all() 
    {
        $result = $this->db->get('menu_link');
        return $result;
    }

    public function menu_priority() 
    {
        $this->db->select('*');
        $this->db->from('menu_link');
        $this->db->order_by('menu_link.menu_priority');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function update_priority_data($data, $parent = '0')
    {
        $i = 1;
        foreach ($data as $d) {
            if (array_key_exists('children', $d)) {
                $this->update_priority_data($d['children'], $d['id']);
            }
            $update_array = array("menu_priority" => $i, "menu_parent" => $parent);
            $update = $this->db->where("menu_id", $d['id'])->update("menu_link", $update_array);
            $i++;
        }
        return $update;
    }

    private function _get_datatables_query()
    { 
        $this->db->from($this->table);
 
        $i = 0;
     
        foreach ($this->column_search as $item) 
        {
            if($_POST['search']['value']) 
            {
                 
                if($i===0) 
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order']))
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_menu()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('menu_id',$id);
        $query = $this->db->get();
 
        return $query->row();
    }
 
    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
 
    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
 
    public function delete_by_id($id)
    {
        $this->db->where('menu_id', $id);
        $this->db->delete($this->table);
    }
}