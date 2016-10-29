<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Theme extends CI_Controller 
{
	
	public function __construct() 
	{
		parent::__construct();

		if ($this->session->userdata('username') == "") 
		{
			redirect('admin/auth');
		}

		$this->load->model('Model_user');
		$this->load->model('Model_theme');
		$this->load->model('Model_setting');
		$this->load->helper('text', 'form', 'url', 'file');
		$this->load->library(['form_validation', 'session']);
		$this->load->database();
	}

	public function index() 
	{
		$admin 	 = $this->Model_user->get_admin();
		$theme 	 = $this->Model_theme->all();
		$setting = $this->Model_setting->get_theme();

		$base_url = base_url();
        $title    = "<a href='".$base_url."admin/home'>Dashboard</a>";

		$data['admin']			= $admin;
		$data['theme']			= $theme;
		$data['setting']		= $setting;
		$data['header']			= 'admin/header';
		$data['menu']			= 'admin/menu';
		$data['content']		= 'admin/theme';
		$data['title']			= $title;
		$data['sub_title']		= 'Themes';
		$data['username'] 		= $this->session->userdata('username');

		$this->load->view('admin/home', $data); 
	}

	public function configuration() 
	{
		$admin = $this->Model_user->get_admin();

		$base_url  = base_url();
        $title     = "<a href='".$base_url."admin/home'>Dashboard</a>";
        $sub_title = "<a href='".$base_url."admin/theme'>Theme</a>";

		$data['admin']			= $admin;
		$data['header']			= 'admin/header';
		$data['menu']			= 'admin/menu';
		$data['content']		= 'admin/theme_configuration';
		$data['title']			= $title;
		$data['sub_title']		= $sub_title;
		$data['sub_title2']		= 'Configuration';
		$data['username'] 		= $this->session->userdata('username');

		$this->load->view('admin/home', $data); 
	}

	public function activated($id)
	{	
		$data_theme = $this->Model_theme->get_by_id($id);
		$selected_theme = $data_theme->theme_style;

 		$setting_id		= '1';

 		$data['site_theme'] = $selected_theme;
 
        $this->Model_setting->save_theme(array('setting_id' => $setting_id), $data);
        echo json_encode(array("status" => TRUE));
	}

	public function theme_list()
    {
        $list = $this->Model_theme->get_datatables();
        $data = array();
        $no   = $_POST['start'];

        foreach ($list as $theme) 
        {
            $no++;
            $row   = array();
            $row[] = $theme->theme_name;
            $row[] = $theme->theme_style;

            if($theme->theme_thumbnail)
            {
                $row[] = '<a class="theme-colorbox" onclick="colorbox()" href="' . base_url($theme->theme_thumbnail) . '" title="'.$theme->theme_name.'" data-rel="colorbox">
                            <img src="' . base_url($theme->theme_thumbnail) . '" class="img-responsive img-table"/>
                        </a>';
            }
            else{
                $row[] = '(No thumbnail)';
            }

            $row[] = '
                    <div class="action-buttons">
                        <a class="text-green" href="javascript:void(0)" onclick="edit_theme('."'".$theme->theme_id."'".')" title="Update">
                            <i class="icon fa fa-pencil"></i>
                        </a>

                        <a class="text-red" href="javascript:void(0)"  onclick="delete_theme('."'".$theme->theme_id."'".')" title="Delete">
                            <i class="icon fa fa-trash-o"></i>
                        </a>
                    </div>';
            
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Model_theme->count_all(),
            "recordsFiltered" => $this->Model_theme->count_filtered(),
            "data" => $data,
        );

        echo json_encode($output);
    }

	public function theme_edit($id)
	{
		$data = $this->Model_theme->get_by_id($id);
		echo json_encode($data);
	}

	public function theme_add()
    {
    	$folder_theme = strtolower($this->input->post('theme_name'));
    	$theme_name   = strtolower($this->input->post('theme_name'));

    	$css_file 		= $_FILES['theme_file']['name'];      
     	$thumbnail_file = $_FILES['theme_thumbnail']['name']; 
 
        if(($css_file !== "") && ($thumbnail_file !== ""))
        {
        	if (!is_dir('theme'))
		    {
		        mkdir('./theme', 0777, true);
		    }

		    $dir_exist = true; 
		    if (!is_dir('theme/' . $folder_theme))
		    {
		        mkdir('./theme/' . $folder_theme, 0777, true);
		        $dir_exist = false; 
		    }
		    else{

		    }

        	$config = array();
        	$config['upload_path']		= './theme/' . $folder_theme;
        	$config['log_threshold'] 	= 1;
        	$config['allowed_types']	= 'css';
        	$config['max-size']			= '8000';

            $this->load->library('upload', $config, 'cssupload');
            $this->cssupload->initialize($config);
    		$file_css = $this->cssupload->do_upload('theme_file');

    		$config = array();
    		$config['upload_path']		= './theme/' . $folder_theme;
        	$config['allowed_types']	= 'gif|jpg|png|jpeg';
        	$config['max-size']			= '1000';
        	$config['max_width']		= '0';
        	$config['max_height']		= '0';

        	$this->load->library('upload', $config, 'imageupload');
            $this->imageupload->initialize($config);
    		$file_thumbnail = $this->imageupload->do_upload('theme_thumbnail');

    		if ($file_css && $file_thumbnail) 
    		{
    			$css = $this->cssupload->data();
    			$data_css = 'theme/' . $folder_theme . '/' . $css['file_name'];

    			$thumbnail =  $this->imageupload->data();
    			$data_thumbnail = 'theme/' . $folder_theme . '/' . $thumbnail['file_name'];
    		}
    		else
    		{
    			echo json_encode(array("status" => FALSE));
    		}
        }

        $data = array(
            'theme_name'    	=> $theme_name,
            'theme_style'   	=> $data_css,
            'theme_thumbnail'   => $data_thumbnail,
        );
 
        $insert = $this->Model_theme->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function theme_update()
    {
 		$theme = $this->Model_theme->get_by_id($this->input->post('id'));
 		$theme_name = $this->input->post('theme_name_hidden');

 		$data = array(
            'theme_name'    => $this->input->post('theme_name_hidden'),
        );

        $css_file = $_FILES['update_file']['name'];
        $thumbnail_file = $_FILES['update_thumbnail']['name'];

 		if(($css_file !== "") && ($thumbnail_file == "")) 
 		{
	        $config =   [
	            'upload_path'   => './theme/' . $theme_name . '/',
	            'allowed_types' => 'css',
	            'max_size'      => 8000,
	        ];

	        $this->load->library('upload', $config);
	        $this->upload->do_upload('update_file');
	        $file = $this->upload->data();
	        $edit_css = 'theme/' . $theme_name . '/' . $file['file_name'];

	        if(file_exists($theme->theme_style) && $theme->theme_style)
	        {
	            unlink($theme->theme_style);
	        }
	 
	        $data['theme_style'] = $edit_css;
 		}
 		elseif(($thumbnail_file !== "") && ($css_file == "")) 
 		{
	        $config =   [
	            'upload_path'   => './theme/' . $theme_name . '/',
	            'allowed_types' => 'gif|jpg|png|jpeg',
	            'max_size'      => 1000,
	            'max_width'     => 0,
	            'max_height'    => 0
	        ];

	        $this->load->library('upload', $config);
	        $this->upload->do_upload('update_thumbnail');
	        $file = $this->upload->data();
	        $edit_thumbnail = 'theme/' . $theme_name . '/' . $file['file_name'];

	        if(file_exists($theme->theme_thumbnail) && $theme->theme_thumbnail)
	        {
	            unlink($theme->theme_thumbnail);
	        }
	 
	        $data['theme_thumbnail'] = $edit_thumbnail;
 		}
        elseif(($css_file !== "") && ($thumbnail_file !== ""))
        {
            $config = array();
            $config['upload_path']      = './theme/' . $theme_name;
            $config['log_threshold']    = 1;
            $config['allowed_types']    = 'css';
            $config['max-size']         = '8000';

            $this->load->library('upload', $config, 'cssupload');
            $this->cssupload->initialize($config);
            $file_css = $this->cssupload->do_upload('update_file');

            $config = array();
            $config['upload_path']      = './theme/' . $theme_name;
            $config['allowed_types']    = 'gif|jpg|png|jpeg';
            $config['max-size']         = '1000';
            $config['max_width']        = '0';
            $config['max_height']       = '0';

            $this->load->library('upload', $config, 'imageupload');
            $this->imageupload->initialize($config);
            $file_thumbnail = $this->imageupload->do_upload('update_thumbnail');

            if ($file_css && $file_thumbnail) 
            {
                $css = $this->cssupload->data();
                $data_css = 'theme/' . $theme_name . '/' . $css['file_name'];

                if(file_exists($theme->theme_style) && $theme->theme_style)
                {
                    unlink($theme->theme_style);
                }
                $data['theme_style'] = $data_css;

                $thumbnail =  $this->imageupload->data();
                $data_thumbnail = 'theme/' . $theme_name . '/' . $thumbnail['file_name'];

                if(file_exists($theme->theme_thumbnail) && $theme->theme_thumbnail)
                {
                    unlink($theme->theme_thumbnail);
                }
                $data['theme_thumbnail'] = $data_thumbnail;
            }
            else
            {
                echo json_encode(array("status" => FALSE));
            }
        }
        else
        {
            echo json_encode(array("status" => UNDEFINED));
        }
 
        $this->Model_theme->update(array('theme_id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function delete_theme($id)
    {
        $theme = $this->Model_theme->get_by_id($id);
        $folder_name = $theme->theme_name;

        $path = './theme/'.$folder_name;
        
        delete_files($path);
        rmdir($path);

        $this->Model_theme->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
        
    }

    public function isThemeExist()
    {
        $theme_name = $this->input->post('theme_name');
        $is_exist = $this->Model_theme->theme_exist($theme_name);

        if ($is_exist) 
        {
            echo json_encode(false);
        } 
        else 
        {
            echo json_encode(true);
        }
    } 

}