<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages extends CI_Controller 
{

	public function __construct() 
    {
        parent::__construct();
        
        if ($this->session->userdata('username') == "") 
        {
            redirect('admin/auth');
        }

        $this->load->model('Model_messages');
        $this->load->model('Model_messages_sent');
        $this->load->model('Model_setting');
        $this->load->model('Model_user');
        $this->load->helper(['url', 'html', 'form', 'text', 'file', 'date']);
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
		$data['content']   = 'admin/messages';
		$data['title']     = $title;
		$data['sub_title'] = 'Messages';
		$data['username']  = $this->session->userdata('username');

		$this->load->view('admin/home', $data); 
    }

    public function msg_list()
    {
 
        $list = $this->Model_messages->get_datatables();
        $data = array();
        $no   = $_POST['start'];

        foreach ($list as $msg) 
        {
            $msg_name = $msg->name;
            if(empty($msg_name)) 
            { 
                $msg_name = $msg->email;
            }

            $current    = time();
            $date       = strtotime($msg->date);
            $units      = 1;
            $msg_date   = timespan($date, $current, $units) . ' ago';

            $msg_text = $msg->msg_text;
            $msg_text = character_limiter($msg_text, 50);

            $no++;
            $row   = array();
            $row[] = '<input type="checkbox" class="inbox" name="inbox[]" value="' . $msg->msg_id . '"/>';
            $row[] = $msg_name;
            $row[] = $msg_text;
            $row[] = $msg_date;

            $row[] = '
                    <div class="action-buttons">
                        <a class="text-blue" href="javascript:void(0)" onclick="open_msg('."'".$msg->msg_id."'".')" title="Open">
                            <i class="ace-icon fa fa-search bigger-130"></i>
                        </a>

                        <a class="text-green" href="javascript:void(0)" onclick="reply('."'".$msg->msg_id."'".')" title="Reply">
                            <i class="ace-icon fa fa-mail-forward bigger-130"></i>
                        </a>

                        <a class="text-red" href="javascript:void(0)"  onclick="delete_inbox('."'".$msg->msg_id."'".')" title="Delete">
                            <i class="ace-icon fa fa-trash-o bigger-130"></i>
                        </a>
                    </div>';
            
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Model_messages->count_all(),
            "recordsFiltered" => $this->Model_messages->count_filtered(),
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function delete_inbox($id)
    {
        $this->Model_messages->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    public function delete_multiple_inbox()
    {
        $data = $this->input->post('id');
        $this->Model_messages->delete_multiple($data, 'msg_id');
        echo json_encode(array("status" => TRUE));
    }

    public function get_msg($id) 
    {
        $data = $this->Model_messages->get_by_id($id);
        echo json_encode($data);
    }

    public function send_msg()
    {
        $this->load->library('encrypt');
        $this->_validate(); 

        /*
        ** based on codeigniter email sent 
        ** we need to recieve data from user email because we sent email by smtp_host
        ** 
        */
        
        $id = '1';
        $setting = $this->Model_setting->find($id)->row();

        $sender     = $setting->name_smtp;
        $pass       = $setting->pass_smtp; 
        $from_email = $setting->email_smtp;

        if(empty(($sender) OR ($pass) OR ($from_email))) 
        {
            echo json_encode(array("status" => FALSE));
        }
        else 
        {
            $key          = 'Z7m2j6W50LIvnZ9261tez77rOy423su0';
            $pass_decrypt = $this->encrypt->decode($pass, $key);

            $email      = $this->input->post('email');
            $subject    = $this->input->post('subject');
            $msg        = $this->input->post('msg_text');
            

            //configure email settings
            $config['protocol']     = 'smtp';
            $config['smtp_host']    = 'ssl://smtp.gmail.com';
            $config['smtp_port']    = '465';
            $config['smtp_user']    = $from_email;
            $config['smtp_pass']    = $pass_decrypt;
            $config['mailtype']     = 'html';
            $config['charset']      = 'iso-8859-1';
            $config['wordwrap']     = TRUE;
            $config['newline']      = "\r\n"; //use double quotes
            $this->load->library('email', $config);
            $this->email->initialize($config);    

            $this->email->from($from_email, $sender);
            $this->email->to($email);  
            $this->email->subject($subject);
            $this->email->message($msg);  
            if($this->email->send()) 
            {
                $data = array(
                    'msg_id'        => $this->input->post('id'),
                    'send_to'       => $this->input->post('email'),
                    'subject_send'  => $this->input->post('subject'),
                    'msg_send'      => $this->input->post('msg_text'),
                    'date_send'     => date('Y-m-d H:i:s'),
                );
         
                $insert = $this->Model_messages_sent->save_sent($data);
                echo json_encode(array("status" => TRUE));
            } 
            else 
            {
                echo json_encode(array("status" => FALSE));
            }
        }

    }

    private function _validate()
    {
        $data = array();

        $data['error_string'] = array();
        $data['inputerror']   = array();
        $data['status']       = TRUE;
 
        if($this->input->post('email') == '')
        {
            $data['inputerror'][]   = 'email';
            $data['error_string'][] = 'Please insert email.';
            $data['status']         = FALSE;
        }
 
        if($data['status'] == FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    public function read_msg($id)
    {
        $msg = $this->Model_messages->get_by_id($id);
        if($msg->msg_read == '0')
        {
            $data['msg_read'] = '1';
            $this->Model_messages->update(array('msg_id' => $id), $data);
            echo json_encode(array("status" => TRUE));
        }
    }

    /*
    ** Message sent table
    */

    public function msg_sent()
    {
 
        $sent = $this->Model_messages_sent->get_datatables();
        $data  = array();
        $no    = $_POST['start'];

        foreach ($sent as $msg_) 
        {
            $sent_to        = $msg_->send_to;           
            $subject_send   = $msg_->subject_send;
            $subject_send   = character_limiter($subject_send, 20);
            $text_msg       = $msg_->msg_send;
            $text_msg       = character_limiter($text_msg, 50);

            $current    = time();
            $date       = strtotime($msg_->date_send);
            $units      = 1;
            $msg_date   = timespan($date, $current, $units) . ' ago';

            $no++;
            $row   = array();
            $row[] = '<input type="checkbox" class="sent" name="sent[]" value="' . $msg_->msg_sent_id . '" />';
            $row[] = $sent_to;
            $row[] = $subject_send;
            $row[] = $text_msg;
            $row[] = $msg_date;

            $row[] = '
                    <div class="action-buttons">
                        <a class="text-blue" href="javascript:void(0)" onclick="open_sent('."'".$msg_->msg_sent_id."'".')" title="Open">
                            <i class="ace-icon fa fa-search bigger-130"></i>
                        </a>
                        <a class="text-red" href="javascript:void(0)" onclick="delete_sent('."'".$msg_->msg_sent_id."'".')" title="Delete">
                            <i class="ace-icon fa fa-trash-o bigger-130"></i>
                        </a>
                    </div>';
            
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Model_messages_sent->count_all(),
            "recordsFiltered" => $this->Model_messages_sent->count_filtered(),
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function delete_sent($id)
    {
        $this->Model_messages_sent->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    public function delete_multiple_sent()
    {
        $data = $this->input->post('id');
        $this->Model_messages_sent->delete_multiple($data, 'msg_sent_id');
        echo json_encode(array("status" => TRUE));
    }

    public function get_sent($id) 
    {
        $sent = $this->Model_messages_sent->get_by_ids($id);
        if(empty($sent)){
            $data1 = $this->Model_messages_sent->get_by_sent($id);
            echo json_encode($data1);
        }
        else
        {
            $data2 = $this->Model_messages_sent->get_by_ids($id);
            echo json_encode($data2);
        }
        
    }

}