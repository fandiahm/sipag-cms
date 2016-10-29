<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller 
{
	
	public function __construct() 
	{
		parent::__construct();

		if ($this->session->userdata('username') == "") 
		{
			redirect('admin/auth');
		}

		$this->load->model('Model_user');
		$this->load->model('Model_contact');
		$this->load->helper('text');
	}

	public function index() 
	{
		$id = '1';

		$admin 	 = $this->Model_user->get_admin();
		$contact = $this->Model_contact->get_by_id($id);

		$data['admin']			= $admin;
		$data['contact']		= $contact;
		$data['header']			= 'admin/header';
		$data['menu']			= 'admin/menu';
		$data['content']		= 'admin/contact';
		$data['title']			= 'Master';
		$data['sub_title']		= 'Contact & Footer';
		$data['username'] 		= $this->session->userdata('username');

		$this->load->view('admin/home', $data); 
	}

	public function get_id($id)
    {
        $data = $this->Model_contact->get_by_id($id);
        echo json_encode($data);
    }

    public function update()
    {
    	$data = array(
            'contact_layout'      => $this->input->post('contact_layout'),
            'contact_title'    	  => $this->input->post('contact_title'),
            'contact_bgcolor'     => $this->input->post('contact_bgcolor'),
            'contact_content'     => $this->input->post('contact_content'),
        );

        if($this->input->post('remove_image'))
        {
            if(file_exists($this->input->post('remove_image')) && $this->input->post('remove_image'))
            {
                unlink($this->input->post('remove_image'));
            }

            $data['contact_bgimage'] = '';
        }
 
        $image = $_FILES['contact_bgimage']['name'];

        if(!empty($image))
        {
            $config =   [
                'upload_path'   => './assets/uploads/contact/',
                'allowed_types' => 'gif|jpg|png|jpeg',
                'max_size'      => 1000,
                'max_width'     => 0,
                'max_height'    => 0
            ];

            $this->load->library('upload', $config);
            $this->upload->do_upload('contact_bgimage');
            $file = $this->upload->data();
            $data_image = 'assets/uploads/contact/' . $file['file_name'];

            $contact = $this->Model_contact->get_by_id($this->input->post('contact_id'));

            if(file_exists($contact->contact_bgimage) && $contact->contact_bgimage)
            {
                unlink($contact->contact_bgimage);
            }
 
            $data['contact_bgimage'] = $data_image;
        }

        $this->Model_contact->update(array('contact_id' => $this->input->post('contact_id')), $data);
        echo json_encode(array("status" => TRUE));
    }

}