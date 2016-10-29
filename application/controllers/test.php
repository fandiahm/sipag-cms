<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller  
{
	public function __construct() 
	{ 
		parent::__construct(); 

		$this->load->model('Model_messages');
		$this->load->model('Model_banner');
		$this->load->model('Model_content');
		$this->load->model('Model_section');
        $this->load->model('Model_setting');
        $this->load->model('Model_contact');
        $this->load->model('Model_footer');
		$this->load->helper(['url','html','form', 'text']);
	}
		
	public function index() 
	{
        $id = '1';

        $site_name              = $this->Model_setting->site_name();
        $site_title             = $this->Model_setting->site_title();
        $site_logo              = $this->Model_setting->site_logo();
        $meta_description       = $this->Model_setting->meta_description();
        $meta_keyword           = $this->Model_setting->meta_keyword();
        $theme                  = $this->Model_setting->get_theme();
        $use_tinymce            = $this->Model_setting->use_tinymce();
        $use_bgcolor            = $this->Model_setting->use_bgcolor();
        $use_bgimage            = $this->Model_setting->use_bgimage();
        $banner_display         = $this->Model_setting->banner_display();
        $banner_display_header  = $this->Model_setting->banner_display_header();
        $banner_display_caption = $this->Model_setting->banner_display_caption();
        

        $menu          = $this->Model_section->section_menu();
		$banner        = $this->Model_banner->all();
		$section       = $this->Model_section->section_priority();
		$content       = $this->Model_content->list_content();
        $contact       = $this->Model_contact->find($id)->row();
        $footer        = $this->Model_footer->find($id)->row();

		$number = 0; // looping number
        
        $length = count($menu->result());
        $last_number = $length + 1;

        $data['menu']                   = $menu;
		$data['banner_item']			= $banner;
		$data['content_list']	        = $content;
		$data['section']		        = $section;
        $data['contact']                = $contact;
        $data['footer_content']         = $footer;

		$data['number']			        = $number;
        $data['last_number']            = $last_number;
        $data['site_name']              = $site_name;
        $data['site_title']             = $site_title;
        $data['site_logo']              = $site_logo;
        $data['meta_description']       = $meta_description;
        $data['meta_keyword']           = $meta_keyword;
        $data['theme']                  = $theme;
        $data['use_bgcolor']            = $use_bgcolor;
        $data['use_bgimage']            = $use_bgimage;
        $data['use_tinymce']            = $use_tinymce;
        $data['banner_display']         = $banner_display;
        $data['banner_display_header']  = $banner_display_header;
        $data['banner_display_caption'] = $banner_display_caption;
        $data['navbar']                 = $this->navbar();
        $data['position']               = $this->navbar_position();

		$data['header']			= 'templates/header';
        $data['banner']         = 'templates/banner';
		$data['content_page']	= 'templates/content_devel';
		$data['footer']			= 'templates/footer';

        $data['sid']            = $this->sid();
        $data['column_1']       = 'templates/layout/1-column';
		
		$this->load->view('index', $data); 
	}

    public function navbar()
    {
        $navbar_inverse         = $this->Model_setting->navbar_inverse();
        $navbar_transparent     = $this->Model_setting->navbar_transparent();

        if(($navbar_inverse == '1') && ($navbar_transparent == '0'))
        {
            $navbar = 'navbar-inverse';
        }
        elseif(($navbar_inverse == '0') && ($navbar_transparent == '0'))
        {
            $navbar = 'navbar-default';
        }
        elseif($navbar_transparent == '1')
        {
            $navbar = '';
        }
        else
        {
            $navbar = 'navbar-default';
        }
        return $navbar;
    }

    public function navbar_position()
    {
        $navbar_pull_right      = $this->Model_setting->navbar_pull_right();
        if($navbar_pull_right == '1')
        {
            $position = 'navbar-right';
        }
        else
        {
            $position = '';
        }
        return $position;
    }

	public function ajax_send()
    {
        //$this->_validate(); 
        $data = array(
            'date'      => date('Y-m-d H:i:s'),
            'email'     => $this->input->post('inputEmail'),
            'name'      => $this->input->post('inputName'),
            'msg_text'  => $this->input->post('inputText'),
        );
 
        $insert = $this->Model_messages->save($data);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
    {
        $data = array();

        $data['error_string'] = array();
        $data['inputerror']   = array();
        $data['status']       = TRUE;
 
        if($this->input->post('inputEmail') == '')
        {
            $data['inputerror'][]   = 'inputEmail';
            $data['error_string'][] = 'Please enter your email';
            $data['status']         = FALSE;
        }
 
        if($data['status'] == FALSE)
        {
            echo json_encode($data); 
            exit();
        }
    }
	
} 