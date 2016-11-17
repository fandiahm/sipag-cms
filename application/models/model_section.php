<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_section extends CI_Model 
{
    
    var $table = 'section'; 
    var $column_order = array('section_name', 'section_layout', 'section_menu', 'title', null); 
    var $column_search = array('section_name', 'section_layout', 'section_menu', 'title'); 
    var $order = array('section_id' => 'asc');
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
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

    public function all() 
    {
        $result = $this->db->get('section');
        return $result;
    }

    public function section_priority() 
    {
        $this->db->select('*');
        $this->db->from('section');
        $this->db->order_by('section.priority');
        $result = $this->db->get();
        return $result;
    } 

    public function section_menu() 
    {
        $this->db->select('section_menu');
        $this->db->from('section');
        $this->db->order_by('section.priority');
        $this->db->where('display_menu', '1');
        $result = $this->db->get();
        return $result;
    }  

    public function find($id) 
    {
        $row = $this->db->where('section_id',$id)->limit(1)->get('section');
        return $row;
    }

    public function find_title($sid) 
    {
        $this->db->select('*');
        $this->db->from('section');
        $this->db->where('section_id',$sid);
        $result = $this->db->get();
        return $result;
    }

    public function section_id() 
    {
        $this->db->select('section_id', 'priority');
        $this->db->from('section');
        $result = $this->db->get();
        return $result;
    }

    public function create($data) 
    {
        try
        {
            $this->db->insert('section', $data);
            return true;
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function update($id, $data) 
    {
        try
        {
            $this->db->where('section_id',$id)->limit(1)->update('section', $data);
            return true;
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function update_priority($total_items, $items)
    {
        for($item = 0; $item < $total_items; $item++ )
        {

            $data = array(
                'section_id' => $items[$item],
                'priority' => $item+1
            );

            $this->db->where('section_id', $data['section_id']);
            $this->db->update('section', array('priority' => $data['priority']));
        }
    }

    public function delete($id) 
    {
        try 
        {
            $this->db->where('section_id',$id)->delete('section');
            return true;
        }
        catch(Exception $e) 
        {
            echo $e->getMessage();
        }
    }

    function isNameExist($section_name) 
    {
        $this->db->select('section_id');
        $this->db->where('section_name', $section_name);
        $query = $this->db->get('section');

        if ($query->num_rows() > 0) 
        {
            return true;
        } 
        else 
        {
            return false;
        }
    }

    function isMenuExist($section_menu) 
    {
        $this->db->select('section_id');
        $this->db->where('section_menu', $section_menu);
        $query = $this->db->get('section');

        if ($query->num_rows() > 0) {
            return true;
        } 
        else 
        {
            return false;
        }
    }

    public function count_section()
    {
        $this->db->from('section');
        return $this->db->count_all_results();
    }
    
}