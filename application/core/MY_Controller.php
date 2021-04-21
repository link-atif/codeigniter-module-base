<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Karachi");
		$this->load->model('permissions/acl_model');
		
		if(!$this->ion_auth->logged_in())
		{
			$this->session->set_flashdata( 'error', 'Session expired' );
			redirect('/', 'refresh');
		}	
		$user_row_data			=	$this->ion_auth->user()->row();
		$group_id	=	$this->ion_auth->get_users_groups()->row()->id;

		$this->data['controller'] = $this->router->fetch_class();
		$this->data['action'] = $this->router->fetch_method();
		$role_ids = $this->session->userdata('user_group');

		$role_ids_array = array();
		foreach ($role_ids as $k => $rd) {
			$role_ids_array[$k]['id'] = $rd;
		}
		$this->data['role_ids_array'] = $role_ids_array;
		if($group_id != 1 || $group_id != 4 || $group_id != 5)
		{
			if($user_row_data->active != 1)
			{
				$this->session->set_flashdata( 'error', 'Session expired' );
				redirect('/', 'refresh');
			}	
		}
		$this->data['user_id']	=	$user_id	=	$user_row_data->id;
		$this->data['group_id']	=	$group_id;
		$this->logged_user_id = $this->data['user_id'];
		$this->data['show_scheduler']		=	1;
		$this->data['show_timesheet']		=	1;
		$this->data['user_company'] 	 	=	$user_row_data->company;
		$this->data['ecsgroup']				=	$group_id;
		$this->data['lgroup']				=	$group_id;	
		$this->data['isadmin']	=	$this->ion_auth->is_admin()? 1 : 0;
		$this->data['user_group']			=	$group_id;
		//Current Page Info
		$this->data['current_module']		= $current_module = $this->router->fetch_module();
		$this->data['current_class']		= $current_class =	$this->router->fetch_class();
		$this->data['current_method']		= $current_method =	$this->router->fetch_method();
		$this->data['datatable_id_prefix']	= $current_module.'_'.$current_class.'_'.$current_method.'_';	

	}
	
	public function loadpage()
	{
		$user_row_data	=	$this->ion_auth->user()->row();
		if(isset($user_row_data->id))
		{
			$this->data['permission'] = $permission = $this->users_model->user_details($user_row_data->id);
		}
		else
		{
			$this->data['permission'] = $permission ='';
		}
		
		$this->data['logged_in_user'] = $user_row_data->first_name;
		$user_id = $user_row_data->id;
		$this->data['client_admin_user'] 	= $this->users_model->user_details($user_id);
		$this->data['user_company'] 	 	= $user_row_data->company;
			
		$this->data['ecsgroup'] = $this->ion_auth->get_users_groups()->row()->id;
		$this->data['userid']   = $this->ion_auth->get_user_id();
		//Load $the_user in all views
		$this->data['uniq_id'] = $sep = sha1(date('r', time()));
		$path = site_url(). 'assets/img/email/tech-logo.png';
		$this->load->vars($this->data);
	}
	
	public function access_error(){
		
		$this->data['heading']  = "Access Forbidden";
		$this->data['view']  	= "errors/access_error";
			
		$this->load->view('layout/layout_admin',$this->data);
	}

}
