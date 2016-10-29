<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Footer extends CI_Controller 
{
	
	public function __construct() 
	{
		parent::__construct();

		if ($this->session->userdata('username') == "") 
		{
			redirect('admin/auth');
		}

		$this->load->model('Model_user');
		$this->load->model('Model_footer');
		$this->load->helper('text');
	}

	public function index() 
	{
		$id = '1';

		$admin 	 = $this->Model_user->get_admin();
		$footer = $this->Model_footer->get_by_id($id);

		$data['admin']			= $admin;
		$data['footer']		    = $footer;
		$data['header']			= 'admin/header';
		$data['menu']			= 'admin/menu';
		$data['content']		= 'admin/footer';
		$data['title']			= 'Master';
		$data['sub_title']		= 'Footer';
		$data['username'] 		= $this->session->userdata('username');

		$this->load->view('admin/home', $data); 
	}

	public function get_id($id)
    {
        $data = $this->Model_footer->get_by_id($id);
        echo json_encode($data);
    }

    public function update()
    {
    	$data = array(
            'footer_content'      => $this->input->post('footer_content'),
            'footer_color'    	  => $this->input->post('footer_color')
        );

        $this->Model_footer->update(array('footer_id' => $this->input->post('footer_id')), $data);
        echo json_encode(array("status" => TRUE));
    }

}