<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends CI_Controller 
{

    public function __construct() 
    {
        parent::__construct();
        
        if ($this->session->userdata('username') == "") 
        {
            redirect('admin/auth');
        }

        $this->load->model('Model_menu');
        $this->load->model('Model_user');
        $this->load->helper(['url', 'html', 'form']);
        $this->load->database();
        $this->load->library(['form_validation', 'session']);
    }

    public function index()
    {
        $base_url = base_url();
        $title    = "<a href='".$base_url."admin/home'>Dashboard</a>";

        $admin = $this->Model_user->get_admin();

        $data['admin']     = $admin;
        $data['header']    = 'admin/header';
        $data['menu']      = 'admin/menu';
        $data['content']   = 'admin/menu_link';
        $data['title']     = $title;
        $data['sub_title'] = 'Menu';
        $data['username']  = $this->session->userdata('username');

        $this->load->view('admin/home', $data); 
    }

    public function menu_list()
    {
 
        $list = $this->Model_menu->get_menu();
        $data = array();
        $no   = $_POST['start'];

        foreach ($list as $menu) 
        {
            $no++;
            $row   = array();
            $row[] = $menu->menu_name;
            $row[] = $menu->menu_url;
            $row[] = $menu->menu_target;

            $row[] = '
                    <div class="action-buttons">
                        <a class="text-green" href="javascript:void(0)" onclick="edit_menu('."'".$menu->menu_id."'".')" title="Update">
                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                        </a>

                        <a class="text-red" href="javascript:void(0)"  onclick="delete_menu('."'".$menu->menu_id."'".')" title="Delete">
                            <i class="ace-icon fa fa-trash-o bigger-130"></i>
                        </a>
                    </div>';
            
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Model_menu->count_all(),
            "recordsFiltered" => $this->Model_menu->count_filtered(),
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function menu_edit($id)
    {
        $data = $this->Model_menu->get_by_id($id);
        echo json_encode($data);
    }

    public function menu_add()
    {

        $data = array(
            'menu_name'     => $this->input->post('menu_name'),
            'menu_url'      => $this->input->post('menu_url'),
            'menu_target'   => $this->input->post('menu_target')
        );
 
        $insert = $this->Model_menu->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function menu_update()
    {
        $data = array(
            'menu_name'     => $this->input->post('menu_name'),
            'menu_url'      => $this->input->post('menu_url'),
            'menu_target'   => $this->input->post('menu_target')
        );
 
        $this->Model_menu->update(array('menu_id' => $this->input->post('menu_id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function menu_delete($id)
    {
        $menu = $this->Model_menu->get_by_id($id);
         
        $this->Model_menu->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

}