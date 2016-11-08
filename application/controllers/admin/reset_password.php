<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reset_password extends CI_Controller 
{
	public function __construct() 
	{ 
		parent::__construct(); 
		$this->load->model('Model_user');
		$this->load->model('Model_setting');
		$this->load->helper(['url','html','form', 'text', 'date']);
	}

	public function index() 
	{
		$this->load->view('admin/reset_password');
	}

	public function user($id)
	{
		$sess = $this->Model_user->find_tmp_link($id)->row();

        $email 	= $sess->email;

        if(empty($email))
        {
        	redirect('error404');
        }

        $update = $this->Model_user->find_tmp_join($email)->row();

        $id_update 	= $update->id;
        $user_id	= $update->user_id;
        $username	= $update->username;

        $rules = [
            ['field' => 'newpassword', 'label' => 'New Password', 'rules' => 'trim|required|matches[repassword]'],
            ['field' => 'repassword', 'label' => 'Confirm Password', 'rules' => 'trim|required']
        ];

        $this->form_validation->set_rules($rules);

        if($this->form_validation->run() == FALSE)
        {
        	$data['id']			= $id_update;
        	$data['username'] 	= $username;
            $this->load->view('admin/reset_pass_form', $data);
        }
        else
        {
            $data = ['password' => md5($this->input->post('newpassword'))];

            $this->Model_user->update($user_id, $data);
            $this->Model_user->delete_tmp_link();
            $this->session->set_flashdata('messages', 'Reset password is success..');
            redirect('admin/auth');
        }
	}

	public function send_link()
	{
		$rules = [
            ['field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email|callback_isEmailExist']
        ];

        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('admin/reset_password');
        } 
        else
        {
        	$this->load->library('encrypt');

        	$id = '1';
	        $setting = $this->Model_setting->find($id)->row();

	        $sender     = $setting->name_smtp;
	        $pass       = $setting->pass_smtp; 
	        $from_email = $setting->email_smtp;

	        if(empty(($pass) OR ($from_email))) 
	        {
	            $this->session->set_flashdata('error', 'Email SMTP is not configure yet. Please contact developer of this site.');
        		$this->load->view('admin/reset_password');
	        }
	        else
	        {
	        	$email = $this->input->post('email');
	        	
				$model = $this->Model_user->find_by_email($email);

				$this->load->dbforge();
            	$this->dbforge->add_field(array(
		            'id' => array(
		               'type' => 'varchar',
		               'constraint' => '100',
		            ),
		            'email' => array(
		               'type' => 'varchar',
		               'constraint' => '50',
		            ),
		            'create_time' => array(
		                'type' => 'DATETIME'
		            ),
		            'link' => array(
		                'type' => 'text'
		            )
		        ));
		        $this->dbforge->add_key('id', TRUE);
		        $this->dbforge->add_key('email');
		        $this->dbforge->create_table('tmp_link', TRUE);

            	$this->load->helper('string');
            	$rand_string = random_string('alnum', 8);

            	$link = base_url().'admin/reset_password/user/'.$rand_string;

            	$data = [
            		'id' => $rand_string,
            		'email' => $email,
            		'create_time' => date("Y-m-d H:i:s"),
            		'link' => $link
            	];

            	$this->Model_user->insert_tmp_link($data);

            	$key          = 'Z7m2j6W50LIvnZ9261tez77rOy423su0';
            	$pass_decrypt = $this->encrypt->decode($pass, $key);

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
	            $this->email->subject('Reset password');
	            $this->email->message('You have requested the new password, Please follow this link to reset your password: '. $link);  
	            if($this->email->send()) 
	            {
	            	$this->session->set_flashdata('messages', 'Link reset password already sent to your email.');
        			redirect('admin/auth');
	            }
	            else
	            {
	            	$this->session->set_flashdata('error', 'Please check your connection and try again. ');
	            	$this->load->view('admin/reset_password');
	            }
	        }
        }
	}

	function isEmailExist($email) 
    {
        $is_exist = $this->Model_user->isEmailExist($email);
        if ($is_exist) 
        {  
            return true;
        } 
        else 
        {
        	$this->form_validation->set_message('isEmailExist', 'Email address is not registered.');
            return false;
        }
    }
}