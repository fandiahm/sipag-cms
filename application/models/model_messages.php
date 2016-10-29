<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Model_messages extends CI_Model 
{     
	var $table          = 'messages';  
    var $column_order   = array(null, 'name', 'msg_text', 'date', null);    
    var $column_search  = array('name', 'email', 'msg_text', 'date');
    var $order          = array('msg_id' => 'asc');
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    public function all() {
        $result = $this->db->get('messages');
        return $result;
    }

    private function _get_datatables_query()
    { 
        $this->db->from($this->table);
 
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
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
        $this->db->where('msg_id',$id);
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
        $this->db->where('msg_id', $id);
        $this->db->delete($this->table);
    }

    public function delete_multiple($data, $field)
    {
        if ($data === false) 
        {
            return FALSE;
        }

        $this->db->where_in($field, $data);
        $this->db->delete($this->table);
    }

    public function count_unread()
    {
        $this->db->from('messages');
        $this->db->where('msg_read', '0');
        return $this->db->count_all_results();
    }
 
}