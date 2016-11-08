<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_user extends CI_Model 
{
    
    public function all() 
    {
        $result = $this->db->get('user');
        return $result;
    }

    public function get_admin() 
    {
        $uid = $this->session->userdata('username');
        $result = $this->db->where('username', $uid)->get('user');
        return $result;
    }

    public function get_username() 
    {
        $result = $this->db->where('username')->get('user');
        return $result;
    }

    public function get_level() 
    {
        $uid = $this->session->userdata('username');
        $this->db->select('level');
        $this->db->from('user');
        $this->db->where('username', $uid);
        return $this->db->get()->row()->level;
    }

    public function find($id) 
    {
        $row = $this->db->where('user_id',$id)->limit(1)->get('user');
        return $row;
    }

    public function find_by_email($email) 
    {
        $row = $this->db->where('email',$email)->limit(1)->get('user');
        return $row;
    }

    public function create($data) 
    {
        try
        {
            $this->db->insert('user', $data);
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
            $this->db->where('user_id',$id)->limit(1)->update('user', $data);
            return true;
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function delete($id) 
    {
        try 
        {
            $this->db->where('user_id',$id)->delete('user');
            return true;
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    public function view($id) 
    {
        try 
        {
            $row = $this->db->where('user_id',$id)->get('user');
            return $row;
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    public function insert_tmp_link($data) 
    {
        try
        {
            $this->db->insert('tmp_link', $data);
            return true;
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function find_tmp_link($id)
    {
        $row = $this->db->where('id',$id)->limit(1)->get('tmp_link');
        return $row;
    }

    public function find_tmp_join($email)
    {
        $this->db->select('*');
        $this->db->from('tmp_link');
        $this->db->join('user', 'tmp_link.email = user.email', 'inner'); 
        $this->db->where('user.email', $email);
        $result = $this->db->get();
        return $result;
    }

    public function update_tmp_link($id, $data)
    {
        $this->db->update('user', $data);
        $this->db->join('tmp_link', 'user.email = tmp_link.email', 'inner'); 
        $this->db->where('tmp_link.id', $id);
        return true;
    }

    public function delete_tmp_link()
    {
        $this->db->query("DELETE FROM tmp_link WHERE `create_time` < (NOW() - INTERVAL 20 SECOND)");
    }

    function isEmailExist($email) 
    {
      
        $this->db->select('user_id');
        $this->db->where('email', $email);
        $query = $this->db->get('user');

        if ($query->num_rows() > 0) 
        {
            return true;
        } 
        else 
        {
            return false;
        }
    }

    function isUsernameExist($username) 
    {
        $this->db->select('user_id');
        $this->db->where('username', $username);
        $query = $this->db->get('user');

        if ($query->num_rows() > 0) 
        {
            return true;
        } 
        else 
        {
            return false;
        }
    }

    function checkOldPass($old_password) 
    {
        $this->db->where('username', $this->session->userdata('username'));
        $this->db->where('password', $old_password);
        $query = $this->db->get('user');
      
        if($query->num_rows() > 0) 
        {
            return true;
        }
        else 
        {
            return false;
        }
   }
    
}
