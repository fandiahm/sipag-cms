<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends CI_Controller 
{
    
    public function __construct() 
    {
        parent::__construct();
        
        if ($this->session->userdata('username') == "") 
        {
            redirect('admin/auth');
        }

        $this->load->model('Model_content');
        $this->load->model('Model_section');
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

        $admin         = $this->Model_user->get_admin();
        $data['admin']          = $admin;
        $data['header']         = 'admin/header';
        $data['menu']           = 'admin/menu';
        $data['content']        = 'admin/content';
        $data['title']          = $title;
        $data['sub_title']      = 'Content';
        $data['username']       = $this->session->userdata('username');

        $this->load->view('admin/home', $data); 
    }

    public function get_allcontent()
    {

        $model_content = $this->Model_content->get_datatables_allcontent();
        $data = array();

        foreach ($model_content as $content) 
        {
            $content_id       = $content->content_id;
            $section_name     = $content->section_name;
            $content_title    = $content->content_title;
            $content_image    = $content->content_image;
            $content_animate  = $content->animate;
            $content_text     = $content->content_text;
            $content_text     = character_limiter($content_text, 100);

            $row   = array();
            $row[] = $section_name;
            $row[] = $content_title;

            if($content_image)
            {
                $row[] = '<a onclick="colorbox('."'". base_url($content_image) ."'".')" href="javascript:void(0)" title="'.$content_title.'" data-rel="colorbox">
                            <img src="' . base_url($content_image) . '" class="img-responsive img-table"/>
                        </a>';            }
            else{
                $row[] = '(No image)';
            }

            if($content_text)
            {
                $row[] = strip_tags(htmlspecialchars_decode($content_text));
            }
            else
            {
                $row[] = '(Empty)';
            }

            $row[] = $content_animate;
            $row[] = '
                    <div class="action-buttons">
                        <a class="text-green" href="'.site_url('admin/content/edit/' . $content_id) .'">
                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                        </a>

                        <a class="text-red" href="javascript:void(0)" onclick="delete_content(' . $content_id . ')">
                            <i class="ace-icon fa fa-trash-o bigger-130"></i>
                        </a>
                    </div>';
            
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Model_content->count_allcontent(),
            "recordsFiltered" => $this->Model_content->count_filtered_allcontent(),
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function add()
    {
        $rules = [
            ['field' => 'section_id','label' => 'Section name','rules' => 'trim|required'],
            ['field' => 'content_title','label' => 'Title','rules' => 'trim|required']
        ];

        $this->form_validation->set_rules($rules);

        $admin      = $this->Model_user->get_admin();
        $section    = $this->Model_section->all();

        $base_url   = base_url();
        $title      = '<a href="'.$base_url.'admin/home">Dashboard</a>';
        $sub_title  = '<a href="'.$base_url.'admin/content">Content</a>';

        if ($this->form_validation->run() == FALSE)
        {
            $data['admin']          = $admin;
            $data['section']        = $section;
            $data['header']         = 'admin/header';
            $data['menu']           = 'admin/menu';
            $data['content']        = 'admin/content_add';
            $data['title']          = $title;
            $data['sub_title']      = $sub_title;
            $data['sub_title2']     = 'Add content';

            $this->load->view('admin/home', $data);
        } 
        else 
        {
            if(!empty($_FILES['userfile']['name'])) 
            {
                $config = [
                    'upload_path'   => './assets/uploads/content/',
                    'allowed_types' => 'gif|jpg|png|jpeg',
                    'max_size'      => 1000,
                    'max_width'     => 0,
                    'max_height'    => 0
                ];

                $this->load->library('upload', $config);
                $this->upload->do_upload('userfile');
                $file = $this->upload->data();
                $data_image = 'assets/uploads/content/' . $file['file_name'];
            }
            else
            {
                $data_image = '';
            }

            if(isset($_POST['display_title_content'])) 
            {
                $dt_value = '1';
            }
            elseif(!isset($_POST['display_title_content'])) 
            {
                $dt_value = '0';
            }

            if(isset($_POST['animation_repeat'])) 
            {
                $ar_value = '1';
            }
            elseif(!isset($_POST['animation_repeat'])) 
            {
                $ar_value = '0';
            }
            
            $data = [
                'section_id'            => set_value('section_id'),
                'content_image'         => $data_image,
                'content_title'         => set_value('content_title'),
                'content_text'          => set_value('content_text'),
                'animate'               => set_value('content_animate'),
                'display_title_content' => $dt_value,
                'animation_repeat'      => $ar_value
            ];

            $this->Model_content->create($data);
            $this->session->set_flashdata('message', 'New content has been added..');
            redirect('admin/content');   
        }
    }

    public function edit($id) 
    {
        $model = $this->Model_content->find_join($id)->row();

        if(empty($model->content_id))
        {
            redirect('admin/error404');
        }

        $rules = [
            ['field' => 'section_id','label' => 'Section name', 'rules' => 'trim|required'],
            ['field' => 'content_title', 'label' => 'Title', 'rules' => 'trim|required']
        ];

        $this->form_validation->set_rules($rules);

        $section    = $this->Model_section->all();
        $admin      = $this->Model_user->get_admin();

        $sn_val = $model->content_title;

        $base_url   = base_url();
        $title      = '<a href="'.$base_url.'admin/home">Dashboard</a>';
        $sub_title  = '<a href="'.$base_url.'admin/content">Content</a>';

        if ($this->form_validation->run() == FALSE)
        {
            $data['content_list']   = $model;
            $data['section']        = $section;
            $data['admin']          = $admin;
            $data['header']         = 'admin/header';
            $data['menu']           = 'admin/menu';
            $data['content']        = 'admin/content_edit';
            $data['title']          = $title;
            $data['sub_title']      = $sub_title;
            $data['sub_title2']     = 'Update';

            $this->load->view('admin/home', $data);
        } 
        else 
        {
            if(isset($_POST['checked'])) 
            {
                $data = array('content_image' => '');
                unlink($model->content_image);
            }

            if(!empty($_FILES['userfile']['name'])) 
            {
                $config =   [
                    'upload_path'   => './assets/uploads/content/',
                    'allowed_types' => 'gif|jpg|png|jpeg',
                    'max_size'      => 1000,
                    'max_width'     => 0,
                    'max_height'    => 0
                ];

                $this->load->library('upload', $config);
                $this->upload->do_upload('userfile');
                $file = $this->upload->data();
                $data['content_image'] = 'assets/uploads/content/' . $file['file_name'];
            }

            if(isset($_POST['display_title_content'])) 
            {
                $dt_value = '1';
            }
            elseif(!isset($_POST['display_title_content'])) 
            {
                $dt_value = '0';
            }

            if(isset($_POST['animation_repeat'])) 
            {
                $ar_value = '1';
            }
            elseif(!isset($_POST['animation_repeat'])) 
            {
                $ar_value = '0';
            }

            $data['section_id']             = set_value('section_id');
            $data['content_title']          = set_value('content_title');
            $data['content_text']           = set_value('content_text');
            $data['animate']                = set_value('content_animate');
            $data['display_title_content']  = $dt_value;
            $data['animation_repeat']       = $ar_value;

            $this->Model_content->update($id,$data);
            $this->session->set_flashdata("message", "Content '" . $sn_val . "' has been updated..");
            redirect('admin/content');            
        }
    }

    public function delete_content($id)
    {
        $content = $this->Model_content->get_by_id($id);

        if(file_exists($content->content_image) && $content->content_image)
        {
            unlink($content->content_image);
        }
         
        $this->Model_content->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

}