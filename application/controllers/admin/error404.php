<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error404 extends CI_Controller 
{
	
	public function __construct() 
	{
		parent::__construct();

		if ($this->session->userdata('username') == "") 
		{
			redirect('admin/auth');
		}

		$this->load->model('Model_user');
		$this->load->helper('text');
	}

	public function index() 
	{
		$admin = $this->Model_user->get_admin();	

		$data['admin']			= $admin;
		$data['header']			= 'admin/header';
		$data['menu']			= 'admin/menu';
		$data['content']		= 'errors/error404';
		$data['title']			= 'Master';
		$data['sub_title']		= '404 Error Page';
		$data['username'] 		= $this->session->userdata('username');

		$this->load->view('admin/home', $data); 
	}

}