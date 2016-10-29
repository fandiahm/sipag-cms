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