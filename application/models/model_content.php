<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_content extends CI_Model 
{    
    var $table = 'content';
    var $column_search = array('section_name', 'content_title', 'content_text', 'animate');
    var $column_order = array('section_name', 'content_title', 'content_image', 'content_text', 'animate', null);
    var $order = array('content_id' => 'asc');

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_allcontent()
    { 
        $this->db->select('content_id', 'section_id', 'section_name', 'content_title', 'content_image', 'content_text', 'animate');
        $this->db->from('content');
        $this->db->join('section', 'content.section_id = section.section_id');
 
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

    function get_datatables_allcontent()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered_allcontent()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_allcontent()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
	
	public function all() 
    {
		$result = $this->db->get('content');
      	return $result;
	}

    public function list_content() 
    {
        $this->db->select('*');
        $this->db->from('content');
        $this->db->join('section', 'content.section_id = section.section_id', 'inner');
        $result = $this->db->get();
        return $result;
   }

    public function create($data) 
    {
        try
        {
            $this->db->insert('content', $data);
            return true;
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
   }

    public function find_join($id) 
    {
        $this->db->select('*');
        $this->db->from('section');
        $this->db->join('content', 'section.section_id = content.section_id', 'inner'); 
        $this->db->where('content.content_id', $id);
        $result = $this->db->get();
        return $result;
    }

    public function find_by_section($id) 
    {
        $row = $this->db->where('section_id',$id)->get('content');
        return $row;
    }

    public function update($id, $data) 
    {
        try
        {
            $this->db->where('content_id',$id)->limit(1)->update('content', $data);
            return true;
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function content_by_section($sid) 
    { 
        $this->db->select('*');
        $this->db->from('section');
        $this->db->join('content', 'section.section_id = content.section_id', 'inner'); 
        $this->db->where('section.section_id', $sid);
        $result = $this->db->get();
        return $result;
    } 

 	public function delete($id) 
    {
 		try 
        {
         	$this->db->where('content_id',$id)->delete('content');
         	return true;
      	}
      	catch(Exception $e) 
        {
        	echo $e->getMessage();
      	}
 	}

    public function delete_all($id) 
    {
        try 
        {
            $this->db->where('section_id',$id)->delete('content');
            return true;
        }
        catch(Exception $e) 
        {
            echo $e->getMessage();
        }
    }

    /*
    ** Below is code for 'content-by-section' with ajax feature
    ** Why doesn't make it full ajax?
    */

    private function _get_datatables_query() 
    {
        $column = array('section_name', 'content_title', 'content_image', 'content_text', 'animate', NULL);
        
        $this->db->select('*');
        $this->db->from('section');
        $this->db->join('content', 'section.section_id = content.section_id');

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
                {
                    $this->db->group_end(); //close bracket
                }
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

    function get_datatables($id)
    {  

        $this->_get_datatables_query();
        $this->db->where('section.section_id', $id);
        $query = $this->db->get();
        return $query->result(); 
    }

    function count_filtered($id){
        $this->_get_datatables_query();
        $this->db->where('section.section_id', $id);
        $query = $this->db->get();
        return $query->num_rows();  
    }

    public function count_all($id){
        $this->db->from('section');
        $this->db->join('content', 'section.section_id = content.section_id');
        $this->db->where('section.section_id', $id);
        return $this->db->count_all_results();  
    }

    public function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('content');
        $this->db->join('section', 'content.section_id = section.section_id');
        $this->db->where('content.content_id',$id);
        $query = $this->db->get();
        return $query->row();
    }
 
    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update_ajax($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('content_id', $id);
        $this->db->delete($this->table);
    }

    public function count_content()
    {
        $this->db->from('content');
        return $this->db->count_all_results();
    }
	
}