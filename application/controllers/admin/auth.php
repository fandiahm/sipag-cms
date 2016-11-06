<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller 
{

	public function index() 
	{
		if ($this->session->userdata('username') != "") 
        {
            redirect('admin/home');
        }
        else
        {
        	$this->load->view('admin/login');
        }
	}

	public function login() 
	{
		if ($this->session->userdata('username') != "") 
        {
            redirect('admin/home');
        }
        else
        {
        	$this->load->view('admin/login');
        }
	}

	public function check_login() 
	{
		$data = array(
			'username' => $this->input->post('username', TRUE),
			'password' => md5($this->input->post('password', TRUE))
		);

		$this->load->model('model_login');
		$res = $this->model_login->check_user($data);
		
		if ($res->num_rows() == 1) 
		{
			foreach ($res->result() as $sess) 
			{
				$sess_data['logged_in'] = 'Logged in';
				$sess_data['username'] 	= $sess->username;
				$sess_data['level'] 	= $sess->level;
				$sess_data['status'] 	= $sess->status;
				
				$this->session->sess_expiration = '1800'; //30 Minutes
				$this->session->set_userdata($sess_data);
			}

			if ($this->session->userdata('level') == '0') 
			{
				redirect('admin/home');
			} 
			elseif ($this->session->userdata('level') == '1') 
			{
				redirect('admin/home');
			} 
			elseif (($this->session->userdata('status') == '1') && ($this->session->userdata('level') == '2')) 
			{
				redirect('admin/home');
			} 
			elseif (($this->session->userdata('status') == '2') && ($this->session->userdata('level') == '2')) 
			{
				$this->session->set_flashdata('info', 'Sorry, your account is not active. Please contact the administrator.');
				redirect('admin/auth');
			}
		} 
		else 
		{
			$this->session->set_flashdata('info', 'Sorry, wrong username or password');
			redirect('admin/auth');
		}
	}

}