<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller  
{
    public function __construct() 
    { 
        parent::__construct(); 

        $this->load->database();

        if(empty($this->db->database))
        {
            redirect('install/');
        }

        $this->load->model('Model_messages');
        $this->load->model('Model_banner');
        $this->load->model('Model_content');
        $this->load->model('Model_section');
        $this->load->model('Model_setting');
        $this->load->model('Model_contact');
        $this->load->model('Model_footer');
        $this->load->model('Model_menu');
        $this->load->helper(['url','html','form', 'text']);
    }
        
    public function index() 
    {
        $id = '1';

        $site_name              = $this->Model_setting->site_name();
        $site_title             = $this->Model_setting->site_title();
        $site_logo              = $this->Model_setting->site_logo();
        $display_navbar         = $this->Model_setting->display_navbar();
        $display_logo           = $this->Model_setting->display_logo();
        $meta_description       = $this->Model_setting->meta_description();
        $meta_keyword           = $this->Model_setting->meta_keyword();
        $theme                  = $this->Model_setting->get_theme();
        $use_tinymce            = $this->Model_setting->use_tinymce();
        $use_bgcolor            = $this->Model_setting->use_bgcolor();
        $use_bgimage            = $this->Model_setting->use_bgimage();
        $banner_display         = $this->Model_setting->banner_display();
        $banner_display_header  = $this->Model_setting->banner_display_header();
        $banner_display_caption = $this->Model_setting->banner_display_caption();
        $banner_display_button  = $this->Model_setting->banner_display_button();
        $contact_display        = $this->Model_setting->display_contact();
        $footer_display         = $this->Model_setting->display_footer();
        $scrolltime             = $this->Model_setting->scrolltime();
        $scrolloffset           = $this->Model_setting->scrolloffset();

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
        $data['menu_link']              = $this->Model_menu->menu_priority();
        $data['li']                     = $this->generate_menu_link($data['menu_link']);
        $data['banner_item']            = $banner;
        $data['content_list']           = $content;
        $data['section']                = $section;
        $data['contact']                = $contact;
        $data['footer_content']         = $footer;

        $data['number']                 = $number;
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
        $data['banner_display_button']  = $banner_display_button;
        $data['contact_display']        = $contact_display;
        $data['footer_display']         = $footer_display;
        $data['banner_nav']             = $this->banner_navigation();
        $data['banner_autoplay']        = $this->banner_autoplay();
        $data['banner_transition']      = $this->banner_animation();
        $data['display_navbar']         = $display_navbar;
        $data['display_logo']           = $display_logo;
        $data['navbar']                 = $this->navbar();
        $data['position']               = $this->navbar_position();
        $data['scrolltime']             = $scrolltime;
        $data['scrolloffset']           = $scrolloffset;

        $data['header']         = 'templates/header';
        $data['banner']         = 'templates/banner';
        $data['content']        = 'templates/content';
        $data['footer']         = 'templates/footer';
        
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
        $navbar_pull_right  = $this->Model_setting->navbar_pull_right();
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

    public function banner_navigation()
    {
        $banner_nav_button = $this->Model_setting->banner_nav_button();
        if($banner_nav_button == '1')
        {
            $banner_nav = 'true';
        }
        else
        {
            $banner_nav = 'false';
        }
        return $banner_nav;
    }

    public function banner_autoplay()
    {
        $banner_autoplay = $this->Model_setting->banner_autoplay();
        if($banner_autoplay == '1')
        {
            $banner_autoplay = 'true';
        }
        else
        {
            $banner_autoplay = 'false';
        }
        return $banner_autoplay;
    }

    public function banner_animation()
    {
        $banner_animation = $this->Model_setting->banner_animation();
        if($banner_animation == '2')
        {
            $banner_transition = '"fade"';
        }
        elseif($banner_animation == '3')
        {
            $banner_transition = '"backSlide"';
        }
        elseif($banner_animation == '4')
        {
            $banner_transition = '"goDown"';
        }    
        elseif($banner_animation == '5')
        {
            $banner_transition = '"fadeUp"';
        } 
        else
        {
            $banner_transition = 'false';
        }
        return $banner_transition;
    }

    public function generate_menu_link($menu_link, $parent = '0')
    {
        $li = "";
        $p1 = array_filter($menu_link, function($a)use($parent){ return $a['menu_parent'] == $parent; });

        foreach ($p1 as $p)
        {
            $li_class   = "";
            $ul_class   = "dropdown-menu";
            $toggle     = "<a href='".$p['menu_url']."' target='".$p['menu_target']."'>".$p['menu_name']."</a>";
            $menu_name  = "";
            $p2 = array_filter($menu_link, function($a)use($p){ return $a['menu_parent'] == $p['menu_id']; });

            if($p2)
            {
                $menu_name  = $this->generate_menu_link($menu_link,$p['menu_id']);
                $li_class   = "dropdown";
                $ul_class   = "nav navbar-nav navbar-right";
                $toggle     = '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$p['menu_name'].' <span class="caret"></span></a>'.$menu_name.'';
            }

            $li .= "<li class='".$li_class."' id='".$p['menu_id']."'>".$toggle."</li>";
        }

        $ul = '<ul class="'.$ul_class.'">'.$li.'</ul>';

        return $ul;
    }

    public function ajax_send()
    {
        //$this->_validate(); 
        $data = array(
            'date'      => date('Y-m-d H:i:s'),
            'email'     => $this->input->post('inputEmail'),
            'name'      => $this->input->post('inputName'),
            'msg_text'  => $this->input->post('inputText'),
            'msg_read'  => '0'
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