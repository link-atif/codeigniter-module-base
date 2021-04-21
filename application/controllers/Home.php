<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url', 'string'));
		$this->load->database();
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->lang->load('auth');
		$this->load->helper('language');
	}

	public function index(){

		$this->data['error'] = ($this->session->flashdata('error')) ? $this->session->flashdata('error') : '';
		$this->load->view('layout/layout_login', $this->data); 	
	}
	public function login(){

		if($_POST){  
			$identity = $this->input->post("username");
			$password = $this->input->post("password");
		
			$remember = 'on';
			if (strlen($identity) > 0 && strlen($password) > 0) 
			{
			
				if($this->ion_auth->login($identity,$password)) 
				{
					$user = $this->ion_auth->user()->row();
					$branch_id = $this->db->get_where('user_access',array('user_id'=>$user->id))->row_array()['branch_id'];
					$branch_name = $this->db->get_where('branches',array('branch_id'=>$branch_id))->row_array()['branch_name'];
					$user_group	=	$this->ion_auth->get_users_groups()->row()->id;
					$this->session->set_userdata('user_group', $user_group);
					$this->session->set_userdata('user_id', $user->id);
					$this->session->set_userdata('user_name', $user->first_name);
					$this->session->set_userdata('branch_name', $branch_name);
					// $this->ion_auth->user_online_status();
					$this->ion_auth->remember_user($user->id);
					$_SESSION['user_email'] = $identity;
					if($remember == 'on')
					{
						$this->ion_auth->remember_user($user->id);
						$this->input->set_cookie("cp_username",$identity,'604800');
					}
					else
					{
						delete_cookie("cp_username");
					}
					$this->session->set_flashdata(
						'uname',
						$user->first_name
					);
					$user_group	=	$this->ion_auth->get_users_groups()->result();

					foreach ($user_group as $row){
						$login_user_group[] = $row->id;
					}
					$this->session->set_userdata('user_group', $login_user_group);

					$_SESSION['SITE_HEADER_ADMIN'] = global_constants("SITE_HEADER_ADMIN");
					$_SESSION['LOGIN_PAGE_BRAND_LOGO']= global_constants('LOGIN_PAGE_BRAND_LOGO');
					$_SESSION['SITE_TITLE'] = global_constants("SITE_TITLE"); 
					if($user_group == '3' || $user_group == '4' || $user_group == '5'){
						redirect('dashboard','refresh');
						die;
					}
					
					redirect('dashboard','refresh');
					die();
				}
				else 
				{
					$this->session->set_flashdata(
						'message1',
						'Invalid Username or Password'
					);
					redirect('/');
				}
			} else {
				$this->session->set_flashdata(
					'error',
					'Username & Password are required'
				);
				redirect('/');
			}
		}
		redirect('/');
	}
	public function update_isread() {
	
		$user_group = $this->session->userdata('user_group');
		if(in_array('1', $user_group)){

			$this->db->where('is_admin_check','1');	
		    $params['is_admin_check'] = '0';
		    
		}else{
			$user_id = $this->session->userdata('user_id');
			$this->db->where('user_id',$user_id);
		}
		$params['is_read'] = '1';
		$res = $this->db->update('event_logs',$params);
	}
}