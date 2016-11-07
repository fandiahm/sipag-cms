<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends CI_Controller 
{
    public function __construct() 
    {
        parent::__construct();

        if ($this->session->userdata('username') == "") 
        {
            redirect('admin/auth');
        }

        $this->load->model('Model_setting');
        $this->load->model('Model_section');
        $this->load->model('Model_menu');
        $this->load->model('Model_user');
        $this->load->helper(['url','html','form', 'file']);
        $this->load->database();
        $this->load->library(['form_validation','session']);
    }

    public function index()
    {

        $base_url   = base_url();
        $title      = '<a href="'.$base_url.'admin/home">Dashboard</a>';

        $admin     = $this->Model_user->get_admin();
        $section   = $this->Model_section->section_priority();

        $site_name          = $this->Model_setting->site_name();
        $site_title         = $this->Model_setting->site_title();
        $site_logo          = $this->Model_setting->site_logo();
        $meta_description   = $this->Model_setting->meta_description();
        $meta_keyword       = $this->Model_setting->meta_keyword();
        $scrolltime         = $this->Model_setting->scrolltime();
        $scrolloffset       = $this->Model_setting->scrolloffset();

        $data['admin']              = $admin;
        $data['section']            = $section;
        $data['menu_list']          = $this->Model_menu->menu_priority();
        $data['li']                 = $this->generate_list($data['menu_list']);
        $data['site_name']          = $site_name;
        $data['site_title']         = $site_title;
        $data['site_logo']          = $site_logo;
        $data['meta_description']   = $meta_description;
        $data['meta_keyword']       = $meta_keyword;
        $data['scrolltime']         = $scrolltime . ' ms';
        $data['scrolloffset']       = $scrolloffset . ' px';
        $data['header']             = 'admin/header';
        $data['menu']               = 'admin/menu';
        $data['content']            = 'admin/setting';
        $data['title']              = $title;
        $data['sub_title']          = 'Setting';
        $data['username']           = $this->session->userdata('username');

        $this->load->view('admin/home', $data); 
    }

    public function get_id($id)
    {
        $data = $this->Model_setting->get_by_id($id);
        echo json_encode($data);
    }

    public function update()
    {

        if(isset($_POST['banner_display'])) 
        {
            $data['banner_display'] = '1';
        } 
        elseif(!isset($_POST['banner_display'])) 
        {
            $data['banner_display'] = '0';
        }

        if(isset($_POST['banner_display_header'])) 
        {
            $data['banner_display_header'] = '1';
        } 
        elseif(!isset($_POST['banner_display_header'])) 
        {
            $data['banner_display_header'] = '0';
        }

        if(isset($_POST['banner_display_caption'])) 
        {
            $data['banner_display_caption'] = '1';
        } 
        elseif(!isset($_POST['banner_display_caption'])) 
        {
            $data['banner_display_caption'] = '0';
        }

        if(isset($_POST['banner_display_button'])) 
        {
            $data['banner_display_button'] = '1';
        } 
        elseif(!isset($_POST['banner_display_button'])) 
        {
            $data['banner_display_button'] = '0';
        }

        if(isset($_POST['banner_nav_button'])) 
        {
            $data['banner_nav_button'] = '1';
        } 
        elseif(!isset($_POST['banner_nav_button'])) 
        {
            $data['banner_nav_button'] = '0';
        }

        if(isset($_POST['banner_autoplay'])) 
        {
            $data['banner_autoplay'] = '1';
        } 
        elseif(!isset($_POST['banner_autoplay'])) 
        {
            $data['banner_autoplay'] = '0';
        }

        if(isset($_POST['banner_animation'])) 
        {
            $data['banner_animation'] = $_POST['banner_animation'];
        } 
        elseif(!isset($_POST['banner_animation'])) 
        {
            $data['banner_animation'] = '1';
        }

        if(isset($_POST['section_title_tinymce'])) {
            $data['section_title_tinymce'] = '1';
        } 
        elseif(!isset($_POST['section_title_tinymce'])) 
        {
            $data['section_title_tinymce'] = '0';
        }

        if(isset($_POST['section_bgcolor'])) 
        {
            $data['section_bgcolor'] = '1';
        } 
        elseif(!isset($_POST['section_bgcolor'])) 
        {
            $data['section_bgcolor'] = '0';
        }

        if(isset($_POST['section_bgimage'])) 
        {
            $data['section_bgimage'] = '1';
        } 
        elseif(!isset($_POST['section_bgimage'])) 
        {
            $data['section_bgimage'] = '0';
        }

        if(isset($_POST['section_advanced_option'])) 
        {
            $data['section_advanced_option'] = '1';
        } 
        elseif(!isset($_POST['section_advanced_option'])) 
        {
            $data['section_advanced_option'] = '0';
        }

        if(isset($_POST['display_contact'])) 
        {
            $data['display_contact'] = '1';
        } 
        elseif(!isset($_POST['display_contact'])) 
        {
            $data['display_contact'] = '0';
        }

        if(isset($_POST['display_footer'])) 
        {
            $data['display_footer'] = '1';
        } 
        elseif(!isset($_POST['display_footer'])) 
        {
            $data['display_footer'] = '0';
        }

        if(isset($_POST['navbar_inverse'])) 
        {
            $data['navbar_inverse'] = '1';
        } 
        elseif(!isset($_POST['navbar_inverse'])) 
        {
            $data['navbar_inverse'] = '0';
        }

        if(isset($_POST['navbar_transparent'])) 
        {
            $data['navbar_transparent'] = '1';
        } 
        elseif(!isset($_POST['navbar_transparent'])) 
        {
            $data['navbar_transparent'] = '0';
        }

        if(isset($_POST['navbar_pull_right'])) 
        {
            $data['navbar_pull_right'] = '1';
        } 
        elseif(!isset($_POST['navbar_pull_right'])) 
        {
            $data['navbar_pull_right'] = '0';
        }

        if(isset($_POST['display_logo'])) 
        {
            $data['display_logo'] = '1';
        } 
        elseif(!isset($_POST['display_logo'])) 
        {
            $data['display_logo'] = '0';
        }

        if(isset($_POST['display_navbar'])) 
        {
            $data['display_navbar'] = '1';
        } 
        elseif(!isset($_POST['display_navbar'])) 
        {
            $data['display_navbar'] = '0';
        }
        
        $this->Model_setting->update(array('setting_id' => $this->input->post('setting_id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function update_section()
    {
        $items = $this->input->post('item');
        $total_items = count($this->input->post('item'));

        $this->Model_section->update_priority($total_items, $items);
        echo json_encode(array("status" => TRUE));
    }

    public function generate_list($menu_list, $parent = '0')
    {
        $li = "";
        $p1 = array_filter($menu_list, function($a)use($parent){ return $a['menu_parent'] == $parent; });

        foreach ($p1 as $p)
        {
            $menu_name = "";
            $p2 = array_filter($menu_list, function($a)use($p){ return $a['menu_parent'] == $p['menu_id']; });

            if($p2)
            {
                $menu_name = $this->generate_list($menu_list,$p['menu_id']);
            }

            $li .= "<li class='dd-item' data-id='".$p['menu_id']."'><div class='dd-handle'>".$p['menu_name']."</div>".$menu_name."</li>";
        }

        $ol = "<ol class='dd-list'>".$li."</ol>";

        return $ol;
    }

    public function update_menu_priority()
    {
        $data = $this->input->post('list');
        if (count($data)) {
            $update = $this->Model_menu->update_priority_data($data);
            if ($update) {
                $result['status'] = "success";
            } else {
                $result['status'] = "error";
            }
        } else {
            $result['status'] = "error";
        }
        echo json_encode($result);
    }

    public function update_site_name()
    {
        $id = $_POST['pk'];
        $site_name = $_POST['value'];
        $data['site_name'] = $site_name;

        $this->Model_setting->update(array('setting_id' => $id), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function update_site_title()
    {
        $id = $_POST['pk'];
        $site_title = $_POST['value'];
        $data['site_title'] = $site_title;

        $this->Model_setting->update(array('setting_id' => $id), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function update_meta_description()
    {
        $id = $_POST['pk'];
        $meta_description = $_POST['value'];
        $data['meta_description'] = $meta_description;

        $this->Model_setting->update(array('setting_id' => $id), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function update_meta_keyword()
    {
        $id = $_POST['pk'];
        $meta_keyword = $_POST['value'];
        $data['meta_keyword'] = $meta_keyword;

        $this->Model_setting->update(array('setting_id' => $id), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function update_scrolltime()
    {
        $id = $_POST['pk'];
        $scrolltime = $_POST['value'];
        $data['scroll_time'] = $scrolltime;

        $this->Model_setting->update(array('setting_id' => $id), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function update_scrolloffset()
    {
        $id = $_POST['pk'];
        $scrolloffset = $_POST['value'];
        $data['scroll_offset'] = $scrolloffset;

        $this->Model_setting->update(array('setting_id' => $id), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function update_logo()
    {
        $id = '1';

        if(!empty($_FILES['avatar']['name']))
        {
            $config =   [
                'upload_path'   => './assets/uploads/logo/',
                'allowed_types' => 'gif|jpg|png|jpeg',
                'max_size'      => 1000,
                'max_width'     => 0,
                'max_height'    => 0
            ];

            $this->load->library('upload', $config);
            $this->upload->do_upload('avatar');
            $file = $this->upload->data();

            $site_logo  = $this->Model_setting->site_logo();

            if(file_exists($site_logo) && $site_logo)
            {
                unlink($site_logo);
            }

            $data_image = 'assets/uploads/logo/' . $file['file_name'];
        }
        else
        {
            $data_image = '';
        }

        $data = array(
            'site_logo'     => $data_image
        );

        $this->Model_setting->update(array('setting_id' => $id), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function update_smtp()
    {
        $this->load->library('encrypt');
        
        $key  = 'Z7m2j6W50LIvnZ9261tez77rOy423su0';
        $pass = $this->input->post('pass_smtp');

        $encrypt_pass = $this->encrypt->encode($pass, $key);

        $data = array(
            'name_smtp'     => $this->input->post('name_smtp'),
            'email_smtp'    => $this->input->post('email_smtp'),
            'pass_smtp'     => $encrypt_pass,
        );

        $this->Model_setting->update(array('setting_id' => $this->input->post('setting_id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function flush_cache()
    {
        $this->output->delete_cache();
        echo json_encode(array("status" => TRUE));
    }

}