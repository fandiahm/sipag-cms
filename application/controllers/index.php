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
        $content_list  = $this->Model_content->list_content();
        $contact       = $this->Model_contact->find($id)->row();
        $footer        = $this->Model_footer->find($id)->row();

        $number = 0; // looping number
        
        $length = count($menu->result());
        $last_number = $length + 1;

        $data['menu']                   = $menu;
        $data['menu_link']              = $this->Model_menu->menu_priority();
        $data['li']                     = $this->generate_menu_link($data['menu_link']);
        $data['banner_item']            = $banner;
        $data['content_list']           = $content_list;
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
        $data['layout']         = 'templates/content';
        $data['footer']         = 'templates/footer';

        /*
        ** I try to avoid many conditional IF inside view
        ** so I try to loop and also store conditional IF here
        ** it's not final yet eventhough it's working
        */

        $i = 0;
        if($section->num_rows() > 0)
        {
            foreach($section->result() as $section)
            {
                $sid = $section->section_id;
                $section_name = $section->section_name;
                $section_layout = $section->section_layout;

                $auto_height = $section->auto_height;
                if($auto_height == '1')
                { 
                    $class_section =  "section-auto"; 
                } 
                else 
                { 
                    $class_section = "section-normal"; 
                }

                $layout = $section->section_layout;
                if(($layout == '31') OR ($layout == '32') OR ($layout == '33'))
                { 
                    $class_gallery_section      = "section-gallery"; 
                    $class_gallery_container    = "container-gallery";
                    $class_gallery_row          = "row-gallery";
                }
                else
                {
                    $class_gallery_section      = "";
                    $class_gallery_container    = "";
                    $class_gallery_row          = "";
                }

                if($section->display_menu == '1')
                { 
                    $number++; 
                    $data_scroll_index =  'data-scroll-index="'.$number.'"'; 
                }
                else
                {
                    $data_scroll_index = '';
                }

                $section_bgimage = $section->bgimage;
                if(!empty($section_bgimage) && ($use_bgimage == '1'))
                {
                    $bgimage = 'background-image:url('.base_url().''.$section_bgimage.'); background-size:cover';
                } 
                else
                {
                    $bgimage = '';
                }

                $section_bgcolor = $section->bgcolor;
                if(!empty($section_bgcolor) && ($use_bgcolor == '1'))
                {
                    $bgcolor = 'background-color:'.$section_bgcolor.'';
                }
                else
                {
                    $bgcolor = '';
                }

                $section_va = $section->vertical_align;
                if($section_va == '1')
                {
                    $class_va_section = "vertical-section";
                }
                else
                {
                    $class_va_section = "";
                }

                $data['section'][$i]['sid'] = $sid;
                $data['section'][$i]['section_name'] = $section_name;
                $data['section'][$i]['section_layout'] = $section_layout;

                $data['section'][$i]['class_section'] = $class_section;
                $data['section'][$i]['class_gallery_section'] = $class_gallery_section;
                $data['section'][$i]['class_gallery_container'] = $class_gallery_container;
                $data['section'][$i]['class_gallery_row'] = $class_gallery_row;

                $data['section'][$i]['data_scroll_index'] = $data_scroll_index;
                $data['section'][$i]['bgimage'] = $bgimage;
                $data['section'][$i]['bgcolor'] = $bgcolor;
                $data['section'][$i]['class_va_section'] = $class_va_section; 

                $find_title = $this->Model_section->find_title($sid);
                if($find_title->num_rows() > 0) 
                {
                    foreach($find_title->result() as $row)
                    {
                        $section_id = $row->section_id;  
                        $display_title = $row->display_title;
                        $animation_repeat = $row->title_animation_repeat;
                        $animate = $row->title_animation;
                        $title = htmlspecialchars_decode($row->title);

                        if($animation_repeat == '1')
                        {
                            $wow = 'wow';
                        }
                        else
                        {
                            $wow = 'wow_static';
                        }

                        $data['section'][$i]['display_title_section'] = $display_title;
                        $data['section'][$i]['wow'] = $wow;
                        $data['section'][$i]['animate'] = $animate;
                        $data['section'][$i]['section_title'] = $title;
                    }   
                }
                else
                {
                    $data['section'][$i]['display_title_section'] = '';
                    $data['section'][$i]['wow'] = '';
                    $data['section'][$i]['animate'] = '';
                    $data['section'][$i]['section_title'] = '';
                }
                

                $i++;
            }
        }
        else
        {
            $data['section'][$i]['sid'] = '';
            $data['section'][$i]['section_name'] = '';
            $data['section'][$i]['section_layout'] = '';

            $data['section'][$i]['class_section'] = '';
            $data['section'][$i]['class_gallery_section'] = '';
            $data['section'][$i]['class_gallery_container'] = '';
            $data['section'][$i]['class_gallery_row'] = '';

            $data['section'][$i]['data_scroll_index'] = '';
            $data['section'][$i]['bgimage'] = '';
            $data['section'][$i]['bgcolor'] = '';
            $data['section'][$i]['class_va_container'] = ''; 
        }

        if($content_list->num_rows() > 0) 
        {
            foreach($content_list->result() as $content)
            {
                $section_id = $content->section_id;
                $animation_repeat = $content->animation_repeat;
                $content_animate = $content->animate;
                $display_title_content = $content->display_title_content;
                $content_image = $content->content_image;
                $content_title = $content->content_title;
                $content_text = htmlspecialchars_decode($content->content_text);

                if($animation_repeat == '1')
                {
                    $wow_class = 'wow';
                }
                else
                {
                    $wow_class = 'wow_static';
                }

                $data['content'][$i]['section_id'] = $section_id;
                $data['content'][$i]['wow'] = $wow_class; 
                $data['content'][$i]['animate'] = $content_animate;
                $data['content'][$i]['display_title_content'] = $display_title_content;
                $data['content'][$i]['content_title'] = $content_title;
                $data['content'][$i]['content_image'] = $content_image;
                $data['content'][$i]['content_text'] = $content_text;

                $i++;
            }
        }
        else
        {
            $data['content'][$i]['section_id'] = '';
            $data['content'][$i]['wow'] = ''; 
            $data['content'][$i]['animate'] = '';
            $data['content'][$i]['display_title_content'] = '';
            $data['content'][$i]['content_title'] = '';
            $data['content'][$i]['content_image'] = '';
            $data['content'][$i]['content_text'] = '';
        }

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
            $ul_class   = "";
            $toggle     = "<a href='".$p['menu_url']."' target='".$p['menu_target']."'>".$p['menu_name']."</a>";
            $menu_name  = "";
            $p2 = array_filter($menu_link, function($a)use($p){ return $a['menu_parent'] == $p['menu_id']; });

            if($p2)
            {
                $menu_name  = $this->generate_menu_link($menu_link,$p['menu_id']);
                $li_class   = "dropdown";
                $ul_class   = "dropdown-menu";
                $toggle     = '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$p['menu_name'].' <span class="caret"></span></a><ul class="dropdown-menu">'.$menu_name.'</ul>';
            }

            $li .= "<li class='".$li_class."' id='".$p['menu_id']."'>".$toggle."</li>";
        }

        $ul = $li;

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