<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_contact extends CI_Model 
{
    
    var $table = 'contact'; 
    
    public function all() 
    {
        $result = $this->db->get('contact');
        return $result;
    }

    public function find($id) 
    {
        $row = $this->db->where('contact_id',$id)->limit(1)->get('contact');
        return $row;
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('contact_id',$id);
        $query = $this->db->get();
        return $query->row();
    }
 
    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows(); 
    }

}