<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller 
{
	public function __construct() 
    {
        parent::__construct();

        if ($this->session->userdata('username') == "") 
        {
            redirect('admin/auth');
        }

        $this->load->model('Model_user');
        $this->load->helper(['url','html','form', 'text']);
        $this->load->database();
        $this->load->library(['form_validation','session']);
    }

    public function index()
    {
    	$base_url   = base_url();
        $title      = '<a href="'.$base_url.'admin/home">Dashboard</a>';

        $user = $this->Model_user->all();
    	$admin = $this->Model_user->get_admin();

		$data['admin']			= $admin;
		$data['user']			= $user;
		$data['header']			= 'admin/header';
		$data['menu']			= 'admin/menu';
		$data['content']		= 'admin/user';
		$data['title']			= $title;
		$data['sub_title']		= 'Users';
		$data['username'] 		= $this->session->userdata('username');

		$this->load->view('admin/home', $data); 
    }

    public function user_add()
    {
        $admin = $this->Model_user->get_admin();

        foreach ($admin->result() as $row) 
        { 
            if ($row->level == 0 OR $row->level == 1) 
            {
                // Allowed
            } 
            else 
            {
                $this->session->set_flashdata('message', 'Sorry, you have no access..');
                redirect('admin/user');
            }
        }

        $rules = [
            ['field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email|callback_isEmailExist'],
            ['field' => 'username', 'label' => 'Username', 'rules' => 'trim|required|callback_isUsernameExist'],
            ['field' => 'password', 'label' => 'Password', 'rules' => 'trim|required'],
            ['field' => 'repassword', 'label' => 'Retype Password', 'rules' => 'trim|required'],
            ['field' => 'name', 'label' => 'Name', 'rules' => 'trim|required'],
            ['field' => 'level', 'label' => 'Level', 'rules' => 'trim|required'],
            ['field' => 'status', 'label' => 'Status', 'rules' => 'trim|required']
        ];

        $this->form_validation->set_rules($rules);

        $base_url   = base_url();
        $title      = '<a href="'.$base_url.'admin/home">Dashboard</a>';
        $sub_title  = '<a href="'.$base_url.'admin/user">Users</a>';

        if ($this->form_validation->run() == FALSE)
        {
            $data['admin']          = $admin;
            $data['header']         = 'admin/header';
            $data['menu']           = 'admin/menu';
            $data['content']        = 'admin/user_add';
            $data['title']          = $title;
            $data['sub_title']      = $sub_title;
            $data['sub_title2']     = 'Add user';

            $this->load->view('admin/home', $data);
        } 
        else 
        {
            if(!empty($_FILES['userfile']['name'])) 
            {
                $config = [
                    'upload_path'   => './assets/uploads/profile/',
                    'allowed_types' => 'gif|jpg|png|jpeg',
                    'max_size'      => 1000,
                    'max_width'     => 0,
                    'max_height'    => 0
                ];

                $this->load->library('upload', $config);
                $this->upload->do_upload('userfile');
                $file = $this->upload->data();
                $data_image = 'assets/uploads/profile/' . $file['file_name'];
            }
            else
            {
                $data_image = '';
            }

            $data = [
                'email'         => set_value('email'),
                'username'      => set_value('username'),
                'password'      => md5($this->input->post('password')),
                'name'          => set_value('name'),
                'level'         => set_value('level'),
                'status'        => set_value('status'),
                'image'         => $data_image
            ];

            $this->Model_user->create($data);
            $this->session->set_flashdata('message', 'Successfully add new user..');
            redirect('admin/user');
        }
    }

    public function user_edit($id) 
    {
        $model  = $this->Model_user->find($id)->row();

        if(empty($model->user_id))
        {
            redirect('admin/error404');
        }

        $admin  = $this->Model_user->get_admin();
        $access = $this->Model_user->get_level();

        if($model)
        {
            $author_id  = $model->user_id;
            $level      = $model->level;
        }

        foreach ($admin->result() as $row) 
        { 
            if ($row->user_id == $author_id) 
            {
                // Allowed
            } 
            elseif ($row->level == 0) 
            {
                // Allowed
            } 
            elseif ($row->level == 1 && $level == 2) 
            {
                // Allowed
            } 
            elseif ($row->level == 1 && $level == 0) 
            {
                $this->session->set_flashdata('message', 'Sorry, you have no access..');
                redirect('admin/user');
            } 
            else 
            {
                $this->session->set_flashdata('message', 'Sorry, you have no access..');
                redirect('admin/user');
            }
        }

        /** 
         ** We have 2 unique fields with 2 rules : 
         ** 1. user_admin CAN ONLY post email or username which not exist in db
         ** 2. if user_admin post self email or username then allow it
         ** so the validation could be like this :
         ** note :  $this->form_validation->set_message are not working I still can't figure it out
        */

        $email_val = $model->email;
        $username_val = $model->username;

        if($this->input->post('email') != $email_val) 
        {
            $is_unique1 = '|is_unique[user.email]';
            $this->form_validation->set_message('is_unique[user.email]', 'Email %s has been registered');
        } 
        else 
        {
            $is_unique1 = '';
        }

        if($this->input->post('username') != $username_val) 
        {
            $is_unique2 = '|is_unique[user.username]';
            $this->form_validation->set_message('is_unique[user.username]', 'Username %s is already taken');
        } 
        else 
        {
            $is_unique2 = '';
        }

        $rules = [
            ['field' => 'email','label' => 'Email','rules' => 'trim|required'.$is_unique1],
            ['field' => 'username','label' => 'Username','rules' => 'trim|required'.$is_unique2],
            ['field' => 'name','label' => 'Name','rules' => 'trim|required'],
            ['field' => 'status','label' => 'Status','rules' => 'trim|required'],
            ['field' => 'level','label' => 'Level','rules' => 'trim|required'],
            ['field' => 'password','label' => 'Password','rules' => 'trim|required|callback_password_confirm']
        ];

        $this->form_validation->set_rules($rules);

        $base_url   = base_url();
        $title      = '<a href="'.$base_url.'admin/home">Dashboard</a>';
        $sub_title  = '<a href="'.$base_url.'admin/user">Users</a>';

        if ($this->form_validation->run() == FALSE)
        {
            $data['user']           = $model;
            $data['access']         = $access;
            $data['admin']          = $admin;
            $data['header']         = 'admin/header';
            $data['menu']           = 'admin/menu';
            $data['content']        = 'admin/user_edit';
            $data['title']          = $title;
            $data['sub_title']      = $sub_title;
            $data['sub_title2']     = 'Profile User';

            $this->load->view('admin/home', $data);
        } 
        else 
        {
            if(isset($_POST['checked'])) 
            {
                $data = array('image' => '');
                unlink($model->image);
            }

            if(!empty($_FILES['userfile']['name'])) 
            {
                $config =   [
                    'upload_path'   => './assets/uploads/profile/',
                    'allowed_types' => 'gif|jpg|png|jpeg',
                    'max_size'      => 1000,
                    'max_width'     => 0,
                    'max_height'    => 0
                ];

                if(file_exists($model->image) && ($model->image))
                {
                    unlink($model->image);
                }

                $this->load->library('upload', $config);
                $this->upload->do_upload('userfile');
                $file = $this->upload->data();
                $data['image'] = 'assets/uploads/profile/' . $file['file_name'];
            }

            $data['email']     = set_value('email');
            $data['username']  = set_value('username');
            $data['name']      = set_value('name');
            $data['level']     = set_value('level');
            $data['status']    = set_value('status');

            $this->Model_user->update($id,$data);
            $this->session->set_flashdata('message', 'User data has been updated..');
            redirect('admin/user/user_edit/' . $id);
        }
    }

    public function password($id) 
    {
        $model = $this->Model_user->find($id)->row();
        $admin = $this->Model_user->get_admin();

        if($model)
        {
            $author_id  = $model->user_id;
            $level      = $model->level;
            $user_id    = $model->user_id;
        }

        foreach ($admin->result() as $row) 
        { 
            if ($row->user_id == $author_id) 
            {
                // Allowed
            } 
            elseif ($row->level == 0) 
            {
                // Allowed
            } 
            elseif ($row->level == 1 && $level == 2) 
            {
                // Allowed
            } 
            elseif ($row->level == 0 && $model == 1) 
                // Allowed
            {
                $this->session->set_flashdata('message', 'Sorry, you have no access..');
                redirect('admin/user');
            } 
            else 
            {
                $this->session->set_flashdata('message', 'Sorry, you have no access..');
                redirect('admin/user');
            }
        }

        $rules = [
            ['field' => 'oldpassword', 'label' => 'Current Password', 'rules' => 'trim|required|callback_oldpassword_check'],
            ['field' => 'newpassword', 'label' => 'New Password', 'rules' => 'trim|required|matches[repassword]'],
            ['field' => 'repassword', 'label' => 'Confirm Password', 'rules' => 'trim|required']
        ];

        $this->form_validation->set_rules($rules);
        
        $base_url   = base_url();
        $title      = '<a href="' . $base_url . 'admin/home">Dashboard</a>';
        $sub_title  = '<a href="' . $base_url . 'admin/user">Users</a>';
        $sub_title2 = '<a href="' . $base_url . 'admin/user/user_edit/' . $user_id . '">Profile user</a>';

        if($this->form_validation->run() == FALSE)
        {
            $data['admin']           = $admin;
            $data['user']            = $model;
            $data['header']          = 'admin/header';
            $data['menu']            = 'admin/menu';
            $data['content']         = 'admin/password';
            $data['title']           = $title;
            $data['sub_title']       = $sub_title;
            $data['sub_title2']      = $sub_title2;
            $data['sub_title3']      = 'Update Password';

            $this->load->view('admin/home', $data);
        }
        else
        {
            $data = ['password' => md5($this->input->post('newpassword'))];

            $this->Model_user->update($id, $data);
            $this->session->set_flashdata('message', 'Please insert your new information..');
            redirect('admin/home/logout/');
        }
    }

    public function user_delete($id) 
    {
        $user = $this->Model_user->find($id)->row();

        if(file_exists($user->image) && $user->image)
        {
            unlink($user->image);
        }
        $this->Model_user->delete($id);
        $this->session->set_flashdata('message', 'User has been deleted..');
        redirect('admin/user'); 
    }

    function isEmailExist($email) 
    {
        $is_exist = $this->Model_user->isEmailExist($email);
        if ($is_exist) 
        {
            $this->form_validation->set_message('isEmailExist', 'Email address already registered.');    
            return false;
        } 
        else 
        {
            return true;
        }
    }

    function isUsernameExist($username) 
    {
        $is_exist = $this->Model_user->isUsernameExist($username);
        if ($is_exist) 
        {
            $this->form_validation->set_message('isUsernameExist', 'Username already exist.');    
            return false;
        } 
        else 
        {
            return true;
        }
    }

    function oldpassword_check($old_password)
    {
        $old_password_hash    = md5($old_password);
        $old_password_db_hash = $this->Model_user->checkOldPass($old_password_hash);

        if($old_password_hash != $old_password_db_hash) 
        {
            $this->form_validation->set_message('oldpassword_check', 'Old password does not match!');
            return FALSE;
        } 
        return TRUE;
    }

    function password_confirm($old_password)
    {
        $old_password_hash    = md5($old_password);
        $old_password_db_hash = $this->Model_user->checkOldPass($old_password_hash);

        if($old_password_hash != $old_password_db_hash) 
        {
            $this->form_validation->set_message('password_confirm', 'Wrong password!');
            return FALSE;
        } 
        return TRUE;
    }

}