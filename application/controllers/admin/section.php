<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Section extends CI_Controller 
{
    public function __construct() 
    {
        parent::__construct();

        if ($this->session->userdata('username') == "") 
        {
            redirect('admin/auth');
        }

        $this->load->model('Model_section');
        $this->load->model('Model_content');
        $this->load->model('Model_setting');
        $this->load->model('Model_user');
        $this->load->helper(['url','html','form','file','text']);
        $this->load->database();
        $this->load->library(['form_validation','session']);
    }

    public function index()
    {
        $base_url   = base_url();
        $title      = '<a href="'.$base_url.'admin/home">Dashboard</a>';

        $admin      = $this->Model_user->get_admin();

        $data['admin']          = $admin;
        $data['header']         = 'admin/header';
        $data['menu']           = 'admin/menu';
        $data['content']        = 'admin/section';
        $data['title']          = $title;
        $data['sub_title']      = 'Section';
        $data['username']       = $this->session->userdata('username');

        $this->load->view('admin/home', $data); 
    }

    public function get_section()
    {

        $model_section = $this->Model_section->get_datatables();
        $data = array();

        foreach ($model_section as $section) 
        {
            $section_id     = $section->section_id;
            $section_name   = $section->section_name;
            $section_name   = character_limiter($section_name, 20);
            $section_menu   = $section->section_menu;
            $section_menu   = character_limiter($section_menu, 20);
            $section_title  = $section->title;
            $section_layout = $section->section_layout;

            if($section_layout == '1')
            {
                $layout = '1 column';
            }
            elseif($section_layout == '2')
            {
                $layout = '2 column';
            }
            elseif($section_layout == '3')
            {
                $layout = '3 column';
            }
            elseif($section_layout == '4')
            {
                $layout = '4 column';
            }
            elseif($section_layout == '5')
            {
                $layout = '5 column';
            }
            elseif($section_layout == '6')
            {
                $layout = '6 column';
            }
            elseif($section_layout == '7')
            {
                $layout = 'Slider content';
            }
            elseif($section_layout == '21')
            {
                $layout = 'Left image column';
            }
            elseif($section_layout == '22')
            {
                $layout = 'Right image column';
            }
            elseif($section_layout == '31')
            {
                $layout = 'Gallery 2 column';
            }
            elseif($section_layout == '32')
            {
                $layout = 'Gallery 3 column';
            }
            elseif($section_layout == '33')
            {
                $layout = 'Gallery 4 column';
            }
            else
            {
                $layout = 'Undefined column';
            }

            $row   = array();
            $row[] = $section_name;
            $row[] = $layout;
            $row[] = $section_menu;
            $row[] = strip_tags(htmlspecialchars_decode($section_title));
            $row[] = '
                    <div class="action-buttons">
                        <a href="'.site_url('admin/section/content/' . $section_id) .'">
                            <span class="text-blue">
                                <i class="icon fa fa-search-plus"></i>
                            </span>
                        </a>

                        <a class="text-green" href="'.site_url('admin/section/edit/' . $section_id) .'">
                            <i class="icon fa fa-pencil"></i>
                        </a>

                        <a class="text-red" href="javascript:void(0)" onclick="delete_section(' . $section_id . ')">
                            <i class="icon fa fa-trash-o"></i>
                        </a>
                    </div>';
            
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Model_section->count_all(),
            "recordsFiltered" => $this->Model_section->count_filtered(),
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function content($sid)
    {
        $model = $this->Model_section->find($sid)->row();

        if(empty($model->section_id))
        {
            redirect('admin/error404');
        }

        $base_url   = base_url();
        $title      = '<a href="'.$base_url.'admin/home">Dashboard</a>';
        $sub_title  = '<a href="'.$base_url.'admin/section">Section</a>';

        $admin           = $this->Model_user->get_admin();
        $content_list    = $this->Model_content->content_by_section($sid); 

        $data['admin']          = $admin;
        $data['content_list']   = $content_list;
        $data['header']         = 'admin/header';
        $data['menu']           = 'admin/menu';
        $data['content']        = 'admin/content_by_section';
        $data['title']          = $title;
        $data['sub_title']      = $sub_title;
        $data['sub_title2']     = 'Content';
        $data['username']       = $this->session->userdata('username');

        $this->load->view('admin/home', $data); 
    }

    public function add()
    {
        $rules = [
            ['field' => 'section_name', 'label' => 'Section name', 'rules' => 'trim|required|callback_isNameExist'],
            ['field' => 'section_menu', 'label' => 'Menu name', 'rules' => 'trim|required|callback_isMenuExist'],
            ['field' => 'section_layout', 'label' => 'Section layout', 'rules' => 'trim|required']
        ];

        $this->form_validation->set_rules($rules);

        $admin       = $this->Model_user->get_admin();

        $use_tinymce        = $this->Model_setting->use_tinymce();
        $use_bgcolor        = $this->Model_setting->use_bgcolor();
        $use_bgimage        = $this->Model_setting->use_bgimage();
        $use_advopt         = $this->Model_setting->use_advanced_option();

        $base_url  = base_url();
        $title     = '<a href="'.$base_url.'admin/home">Dashboard</a>';
        $sub_title = '<a href="'.$base_url.'admin/section">Section</a>';

        if ($this->form_validation->run() == FALSE)
        {
            $data['admin']          = $admin;
            $data['use_tinymce']    = $use_tinymce;
            $data['use_bgcolor']    = $use_bgcolor;
            $data['use_bgimage']    = $use_bgimage;
            $data['use_advopt']     = $use_advopt;
            $data['header']         = 'admin/header';
            $data['menu']           = 'admin/menu';
            $data['content']        = 'admin/section_add';
            $data['title']          = $title;
            $data['sub_title']      = $sub_title;
            $data['sub_title2']     = 'Add section';

            $this->load->view('admin/home', $data);
        } 
        else 
        {
            
            if(!empty($_FILES['userfile']['name'])) 
            {
                $config = [
                    'upload_path'   => './assets/uploads/section/',
                    'allowed_types' => 'gif|jpg|png|jpeg',
                    'max_size'      => 1000,
                    'max_width'     => 0,
                    'max_height'    => 0
                ];

                $this->load->library('upload', $config);
                $this->upload->do_upload('userfile');
                $file = $this->upload->data();
                $data_image = 'assets/uploads/section/' . $file['file_name'];
            } else {
                $data_image = '';
            }

            if(isset($_POST['auto_height'])) 
            {
                $ah_value = '1';
            }
            elseif(!isset($_POST['auto_height'])) 
            {
                $ah_value = '0';
            }

            if(isset($_POST['vertical_align'])) 
            {
                $va_value = '1';
            }
            elseif(!isset($_POST['vertical_align'])) 
            {
                $va_value = '0';
            }

            if(isset($_POST['display_title'])) 
            {
                $dt_value = '1';
            }
            elseif(!isset($_POST['display_title'])) 
            {
                $dt_value = '0';
            }

            if(isset($_POST['display_menu'])) 
            {
                $dm_value = '1';
            }
            elseif(!isset($_POST['display_menu'])) 
            {
                $dm_value = '0';
            }

            if(isset($_POST['title_animation_repeat'])) 
            {
                $tar_value = '1';
            }
            elseif(!isset($_POST['title_animation_repeat'])) 
            {
                $tar_value = '0';
            }
            
            $data = [
                'section_layout'            => set_value('section_layout'),
                'section_name'              => set_value('section_name'),
                'section_menu'              => set_value('section_menu'),
                'title'                     => set_value('title'),
                'bgcolor'                   => set_value('bgcolor'),
                'bgimage'                   => $data_image,
                'title_animation'           => set_value('title_animation'),
                'auto_height'               => $ah_value,
                'vertical_align'            => $va_value,
                'display_title'             => $dt_value,
                'display_menu'              => $dm_value,
                'title_animation_repeat'    => $tar_value
            ];

            $this->Model_section->create($data);
            $this->session->set_flashdata('message', 'New section has been added..');
            redirect('admin/section');    
        }
    }

    public function edit($id)
    {
        $model = $this->Model_section->find($id)->row();

        if(empty($model->section_id))
        {
            redirect('admin/error404');
        }

        $sn_val = $model->section_name;

        if($this->input->post('section_name') != $sn_val) 
        {
            $is_unique1 = '|is_unique[section.section_name]';
            $this->form_validation->set_message('is_unique[section.section_name]', 'Section %s is already taken');
        } 
        else 
        {
            $is_unique1 = '';
        }

        $sm_val = $model->section_menu;

        if($this->input->post('section_menu') != $sm_val) 
        {
            $is_unique2 = '|is_unique[section.section_menu]';
            $this->form_validation->set_message('is_unique[section.section_menu]', 'Menu %s is already taken');
        } 
        else 
        {
            $is_unique2 = '';
        }

        $rules = [
            ['field' => 'section_name', 'label' => 'Section name', 'rules' => 'trim|required'.$is_unique1],
            ['field' => 'section_menu', 'label' => 'Menu name', 'rules' => 'trim|required'.$is_unique2],
            ['field' => 'section_layout', 'label' => 'Section layout', 'rules' => 'trim|required']
        ];

        $this->form_validation->set_rules($rules);

        $admin       = $this->Model_user->get_admin();

        $use_tinymce = $this->Model_setting->use_tinymce();
        $use_bgcolor = $this->Model_setting->use_bgcolor();
        $use_bgimage = $this->Model_setting->use_bgimage();
        $use_advopt  = $this->Model_setting->use_advanced_option();

        $base_url   = base_url();
        $title      = '<a href="'.$base_url.'admin/home">Dashboard</a>';
        $sub_title  = '<a href="'.$base_url.'admin/section">Section</a>';

        if ($this->form_validation->run() == FALSE)
        {
            $data['section']        = $model;
            $data['use_tinymce']    = $use_tinymce;
            $data['use_bgcolor']    = $use_bgcolor;
            $data['use_bgimage']    = $use_bgimage;
            $data['use_advopt']     = $use_advopt;
            $data['admin']          = $admin;
            $data['header']         = 'admin/header';
            $data['menu']           = 'admin/menu';
            $data['content']        = 'admin/section_edit';
            $data['title']          = $title;
            $data['sub_title']      = $sub_title;
            $data['sub_title2']     = 'Update';

            $this->load->view('admin/home', $data);
        } 
        else 
        {
            if(isset($_POST['checked'])) 
            {
                $data = array('bgimage' => '');
                unlink($model->bgimage);
            }

            if(!empty($_FILES['userfile']['name'])) 
            {
                $config =   [
                    'upload_path'   => './assets/uploads/section/',
                    'allowed_types' => 'gif|jpg|png|jpeg',
                    'max_size'      => 1000,
                    'max_width'     => 0,
                    'max_height'    => 0
                ];

                $this->load->library('upload', $config);
                $this->upload->do_upload('userfile');
                $file = $this->upload->data();
                $data['bgimage'] = 'assets/uploads/section/' . $file['file_name'];
            }

            if(isset($_POST['auto_height'])) 
            {
                $ah_value = '1';
            }
            elseif(!isset($_POST['auto_height'])) 
            {
                $ah_value = '0';
            }

            if(isset($_POST['vertical_align'])) 
            {
                $va_value = '1';
            }
            elseif(!isset($_POST['vertical_align'])) 
            {
                $va_value = '0';
            }

            if(isset($_POST['display_title'])) 
            {
                $dt_value = '1';
            }
            elseif(!isset($_POST['display_title'])) 
            {
                $dt_value = '0';
            }

            if(isset($_POST['display_menu'])) 
            {
                $dm_value = '1';
            }
            elseif(!isset($_POST['display_menu'])) 
            {
                $dm_value = '0';
            }

            if(isset($_POST['title_animation_repeat'])) 
            {
                $tar_value = '1';
            }
            elseif(!isset($_POST['title_animation_repeat'])) 
            {
                $tar_value = '0';
            }

            $data['section_layout']         = set_value('section_layout');
            $data['section_name']           = set_value('section_name');
            $data['section_menu']           = set_value('section_menu');
            $data['title']                  = set_value('title');
            $data['bgcolor']                = set_value('bgcolor');
            $data['title_animation']        = set_value('title_animation');
            $data['auto_height']            = $ah_value;
            $data['vertical_align']         = $va_value;
            $data['display_title']          = $dt_value;
            $data['display_menu']           = $dm_value;
            $data['title_animation_repeat'] = $tar_value;
             
            $this->Model_section->update($id,$data);
            $this->session->set_flashdata("message", "Section '" . $sn_val . "' has been updated..");
            redirect('admin/section');            
        }
    }

    public function delete($id) 
    {
        $section = $this->Model_section->find($id)->row();

        if(file_exists($section->bgimage) && $section->bgimage)
        {
            unlink($section->bgimage);
        }

        $this->Model_section->delete($id);
        $this->Model_content->delete_all($id);
        echo json_encode(array("status" => TRUE));
    }

    function isNameExist($section_name) 
    {
        $is_exist = $this->Model_section->isNameExist($section_name);

        if ($is_exist) 
        {
            $this->form_validation->set_message('isNameExist', 'Section name is already exist.');    
            return false;
        } 
        else 
        {
            return true;
        }
    }

    function isMenuExist($section_menu) 
    {
        $is_exist = $this->Model_section->isMenuExist($section_menu);

        if ($is_exist) 
        {
            $this->form_validation->set_message('isMenuExist', 'Section menu is already exist.');    
            return false;
        } 
        else 
        {
            return true;
        }
    }

    function validate_name() 
    {
        $section_name = $this->input->post('section_name');
        $is_exist = $this->Model_section->isNameExist($section_name);

        if ($is_exist) 
        {
            echo json_encode(false);
        } 
        else 
        {
            echo json_encode(true);
        }
    }

    function validate_menu() 
    {
        $section_menu = $this->input->post('section_menu');
        $is_exist = $this->Model_section->isMenuExist($section_menu);

        if ($is_exist) 
        {
            echo json_encode(false);
        } 
        else 
        {
            echo json_encode(true);
        }
    }

    /*
    ** Below is code for content_by_section with ajax feature
    ** Why doesn't make it full ajax?
    */

    public function get_content($id)
    {

        $model = $this->Model_content->get_datatables($id);
        $data = array();

        foreach ($model as $content_list) 
        {
            $content_text = $content_list->content_text;
            $content_text = character_limiter($content_text, 100);

            $row   = array();
            $row[] = $content_list->section_name;
            $row[] = $content_list->content_title;

            if($content_list->content_image)
            {
                $row[] = '<a onclick="colorbox('."'". base_url($content_list->content_image) ."'".')" href="javascript:void(0)" title="'.$content_list->content_title.'" data-rel="colorbox">
                            <img src="' . base_url($content_list->content_image) . '" class="img-responsive img-table"/>
                        </a>';
            }
            else
            {
                $row[] = '(No image)';
            }

            $row[] = strip_tags(htmlspecialchars_decode($content_text));
            $row[] = $content_list->animate;
            $row[] = '
                    <div class="action-buttons">
                        <a class="text-green" href="javascript:void(0)" onclick="edit_content('."'".$content_list->content_id."'".')" title="Update">
                            <i class="icon fa fa-pencil"></i>
                        </a>

                        <a class="text-red" href="javascript:void(0)" onclick="delete_content('."'".$content_list->content_id."'".')" title="Delete">
                            <i class="icon fa fa-trash-o"></i>
                        </a>
                    </div>';
            
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Model_content->count_all($id),
            "recordsFiltered" => $this->Model_content->count_filtered($id),
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function ajax_edit($id)
    {
        $data = $this->Model_content->get_by_id($id);
        echo json_encode($data);
    }
 
    public function ajax_add()
    {
        $this->_validate(); 

        if(!empty($_FILES['image']['name'])) 
        {
            $config =   [
                'upload_path'   => './assets/uploads/content/',
                'allowed_types' => 'gif|jpg|png|jpeg',
                'max_size'      => 1000,
                'max_width'     => 0,
                'max_height'    => 0
            ];

            $this->load->library('upload', $config);
            $this->upload->do_upload('image');
            $file = $this->upload->data();
            $data_image = 'assets/uploads/content/' . $file['file_name'];
        }
        else
        {
            $data_image = '';
        }

        $data = array(
            'section_id'    => $this->input->post('id'),
            'content_title' => $this->input->post('content_title'),
            'content_image' => $data_image,
            'content_text'  => $this->input->post('content_text'),
            'animate'       => $this->input->post('content_animate'),
            'display_title_content' => '1',
            'animation_repeat'      => '0',
        );
 
        $insert = $this->Model_content->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update()
    {
        $this->_validate();
        $data = array(
            'section_id'    => $this->input->post('id'),
            'content_title' => $this->input->post('content_title'),
            'content_text'  => $this->input->post('content_text'),
            'animate'       => $this->input->post('content_animate'),
        );
 
        if($this->input->post('remove_image'))
        {
            if(file_exists($this->input->post('remove_image')) && $this->input->post('remove_image'))
            {
                unlink($this->input->post('remove_image'));
            }

            $data['content_image'] = '';
        }

        if(!empty($_FILES['image']['name']))
        {
            $config =   [
                'upload_path'   => './assets/uploads/content/',
                'allowed_types' => 'gif|jpg|png|jpeg',
                'max_size'      => 1000,
                'max_width'     => 0,
                'max_height'    => 0
            ];

            $this->load->library('upload', $config);
            $this->upload->do_upload('image');
            $file = $this->upload->data();
            $data_image = 'assets/uploads/content/' . $file['file_name'];

            $content_list = $this->Model_content->get_by_id($this->input->post('cid'));

            if(file_exists($content_list->content_image) && $content_list->content_image)
            {
                unlink($content_list->content_image);
            }
 
            $data['content_image'] = $data_image;
        }
 
        $this->Model_content->update_ajax(array('content_id' => $this->input->post('cid')), $data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_delete($id)
    {
        $content_list = $this->Model_content->get_by_id($id);

        if(file_exists($content_list->content_image) && $content_list->content_image)
        {
            unlink($content_list->content_image);
        }
         
        $this->Model_content->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
 
    private function _validate()
    {
        $data = array();

        $data['error_string'] = array();
        $data['inputerror']   = array();
        $data['status']       = TRUE;
 
        if($this->input->post('content_title') == '')
        {
            $data['inputerror'][]   = 'content_title';
            $data['error_string'][] = 'Title is required';
            $data['status']         = FALSE;
        }
 
        if($data['status'] == FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

}