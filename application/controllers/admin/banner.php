<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner extends CI_Controller 
{

	public function __construct() 
    {
        parent::__construct();
        
        if ($this->session->userdata('username') == "") 
        {
            redirect('admin/auth');
        }

        $this->load->model('Model_banner');
        $this->load->model('Model_user');
        $this->load->helper(['url', 'html', 'form', 'file']);
        $this->load->database();
        $this->load->library(['form_validation', 'session']);
    }

    public function index()
    {
    	$base_url = base_url();
        $title    = "<a href='".$base_url."admin/home'>Dashboard</a>";

    	$admin = $this->Model_user->get_admin();

		$data['admin']     = $admin;
		$data['header']	   = 'admin/header';
		$data['menu']      = 'admin/menu';
		$data['content']   = 'admin/banner';
		$data['title']     = $title;
		$data['sub_title'] = 'Banner';
		$data['username']  = $this->session->userdata('username');

		$this->load->view('admin/home', $data); 
    }

    public function banner_list()
    {
 
        $list = $this->Model_banner->get_datatables();
        $data = array();
        $no   = $_POST['start'];

        foreach ($list as $banner) 
        {
            $no++;
            $row   = array();
            $row[] = $banner->header;
            $row[] = $banner->caption;

            if($banner->image)
            {
                $row[] = '<a class="banner" onclick="colorbox()" href="' . base_url($banner->image) . '" title="'.$banner->header.'" data-rel="colorbox">
                            <img src="' . base_url($banner->image) . '" class="img-responsive img-table"/>
                        </a>';
            }
            else{
                $row[] = '(No image)';
            }

            $row[] = '
                    <div class="action-buttons">
                        <a class="text-green" href="javascript:void(0)" onclick="edit_banner('."'".$banner->banner_id."'".')" title="Update">
                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                        </a>

                        <a class="text-red" href="javascript:void(0)"  onclick="delete_banner('."'".$banner->banner_id."'".')" title="Delete">
                            <i class="ace-icon fa fa-trash-o bigger-130"></i>
                        </a>
                    </div>';
            
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Model_banner->count_all(),
            "recordsFiltered" => $this->Model_banner->count_filtered(),
            "data" => $data,
        );

        echo json_encode($output);
    }
 
    public function banner_edit($id)
    {
        $data = $this->Model_banner->get_by_id($id);
        echo json_encode($data);
    }
 
    public function banner_add()
    {
 
        if(!empty($_FILES['image']['name']))
        {
            $config =   [
                'upload_path'   => './assets/uploads/banner/',
                'allowed_types' => 'gif|jpg|png|jpeg',
                'max_size'      => 1000,
                'max_width'     => 0,
                'max_height'    => 0
            ];

            $this->load->library('upload', $config);
            $this->upload->do_upload('image');
            $file = $this->upload->data();
            $data_image = 'assets/uploads/banner/' . $file['file_name'];
        }
        else
        {
            $data_image = '';
        }

        $data = array(
            'header'    => $this->input->post('header'),
            'caption'   => $this->input->post('caption'),
            'image'     => $data_image
        );
 
        $insert = $this->Model_banner->save($data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function banner_update()
    {
        $data = array(
            'header' => $this->input->post('header'),
            'caption' => $this->input->post('caption'),
        );
 
        if($this->input->post('remove_image'))
        {
            if(file_exists($this->input->post('remove_image')) && $this->input->post('remove_image'))
            {
                unlink($this->input->post('remove_image'));
            }

            $data['image'] = '';
        }
 
        if(!empty($_FILES['image']['name']))
        {
            $config =   [
                'upload_path'   => './assets/uploads/banner/',
                'allowed_types' => 'gif|jpg|png|jpeg',
                'max_size'      => 1000,
                'max_width'     => 0,
                'max_height'    => 0
            ];

            $this->load->library('upload', $config);
            $this->upload->do_upload('image');
            $file = $this->upload->data();
            $data_image = 'assets/uploads/banner/' . $file['file_name'];

            $banner = $this->Model_banner->get_by_id($this->input->post('id'));

            if(file_exists($banner->image) && $banner->image)
            {
                unlink($banner->image);
            }
 
            $data['image'] = $data_image;
        }
 
        $this->Model_banner->update(array('banner_id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function banner_delete($id)
    {
        $banner = $this->Model_banner->get_by_id($id);

        if(file_exists($banner->image) && $banner->image)
        {
            unlink($banner->image);
        }
         
        $this->Model_banner->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

}