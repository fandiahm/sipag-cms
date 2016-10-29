<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller 
{
	
	public function __construct() 
	{
		parent::__construct();

		$this->load->database();

        if(empty($this->db->database))
        {
            redirect('install/');
        }

		if ($this->session->userdata('username') == "") 
		{
			redirect('admin/auth');
		}

		$this->load->model('Model_user');
		$this->load->model('Model_section');
		$this->load->model('Model_content');
		$this->load->model('Model_theme');
		$this->load->model('Model_messages');
		$this->load->helper('text');
	}

	public function index() 
	{
		$admin = $this->Model_user->get_admin();

		$total_section 	= $this->Model_section->count_section();
		$total_content 	= $this->Model_content->count_content();
		$total_theme 	= $this->Model_theme->count_theme();
		$total_unread	= $this->Model_messages->count_unread();		

		$data['admin']			= $admin;
		$data['total_section']	= $total_section;
		$data['total_content']	= $total_content;
		$data['total_theme']	= $total_theme;
		$data['total_unread']	= $total_unread;
		$data['header']			= 'admin/header';
		$data['menu']			= 'admin/menu';
		$data['content']		= 'admin/dashboard';
		$data['title']			= 'Master';
		$data['sub_title']		= 'Dashboard';
		$data['username'] 		= $this->session->userdata('username');

		$this->load->view('admin/home', $data); 
	}

	public function logout() 
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('level');
		
		session_destroy();
		redirect('admin/auth'); 
	}
}