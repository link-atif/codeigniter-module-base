<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Permissions extends MY_Controller{
	public $data;
	function __construct()
	{
		parent::__construct();
		$this->load->model('acl_model');
		$this->load->library('form_validation');
		// error_reporting(0);
		
		if($this->input->get('error'))
		{
			$this->data['error'] =  $this->input->get('error');
		}
		if($this->input->get('success'))
		{
			$this->data['success'] =  $this->input->get('success');
		}
		// For Opening Side Menu
        $this->data['permission_menu'] = 'opened';
	}

	public function  index()
	{	
		$this->data['groups'] = $this->acl_model->get_all_groups();
		$this->data['view']="permissions/groups";
		$this->load->view('layout/layout_admin', $this->data);
	}	
	


	public function  index1()
	{	
		$this->data['view']="permissions/index1";
		$this->load->view('layout/layout_admin', $this->data);
	}
	
	public function  users(){
		$this->data['users'] = $this->acl_model->get_all_users();
		$this->data['groups'] = $this->acl_model->get_all_groups();
		$this->data['view']="permissions/users";
		$this->load->view('layout/layout_admin', $this->data);
	}
	
 	function update_usergroup()
	{
		$this->acl_model->update_user_group($this->input->post());
		redirect(base_url()."permissions/users?success=Group updated successfully");
	}
	
	public function add_permission_function()
	{
		if($this->input->post())
		{
			$this->_add_permissions_functions($_REQUEST);
		}
	}	
	
	public function  get_permisson_data(){	
		$id = $_POST['id'];
		 $result = $this->acl_model->get_permisson_data($id);
		
		if ($result) {
            echo json_encode($result);
        } else {
            echo false;
        }
		
		
	}
	
	public function update_permission_function()
	{
		if($this->input->post())
		{
			$this->_update_permission_function($_REQUEST);
		}
	}
	/** To populate permission table */
	public function hidden_permissions()
	{
		$data = array();
		// $this->load->library('controllerlist');
		
		foreach(glob(APPPATH . 'modules/*') as $dir)
		{
			$extension_name = pathinfo($dir, PATHINFO_EXTENSION);
			
			if(is_dir($dir))
			{
				// Get name of directory
				$dirname = basename($dir, EXT);
				// Loop through the subdirectory
				$this->load->model('permissions/acl_model');
				foreach(glob(APPPATH."modules/" . $dirname.'/controllers/*') as $controller)
				{
					// print_r($controller);
					// echo '<br>';
					
					$results=$this->acl_model->get_methods($controller);
					// echo 'Methods';
					// echo '<br>';
					// echo '<pre>';
					// print_r($results);
					// echo '</pre>';

								
					// echo $controller; echo ' : <pre> '; print_r($results); echo '</pre>'; //die; 
					$aUserMethods = array();
					// Get the name of the subdir
					$controllername = basename($controller, EXT);
					$aUserMethods = $results;
					// $this->setControllerMethods($dirname,$controllername, $aUserMethods);	
					
					foreach($results as $aUserMethods)
					{
						$data = array(
							'controller' 	=> $controllername,
							'action' 		=> $aUserMethods,
							'name' 			=> $aUserMethods,
							'module'		=> $dirname
						);
						// echo 'Data to insert';
						// echo '<br>';
						// echo '<pre>';
						// print_r($results);
						// echo '</pre>';
						// echo '<br>';

						// break;				

						$check_role = $this->acl_model->check_permissions($data['module'],$data['controller'],$data['action']);
						if($check_role)
						{
							$this->acl_model->save_permission($data);
						}
					}
				}
			}
		}
		
		/* $view_role['all_roles_permissions'] = $this->controllerlist->getControllers();
		foreach ($view_role['all_roles_permissions'] as $modellist => $controllerlist) {
			foreach ($controllerlist as $controllers => $methodlist_array) {
				foreach ($methodlist_array as  $methodlist) {
					if($controllers !="Controller_functions" && $methodlist !="get_methods"){
						$data = array(
							'controller' 	=> $controllers,
							'action' 		=> $methodlist,
							'name' 			=> $methodlist,
							'module'		=> $modellist
						);
					}
					$check_role = $this->acl_model->check_permissions($data['module'],$data['controller'],$data['action']);
					if($check_role){
						$this->acl_model->save_permission($data);
					}
				}
			}
		} */
	}

	public function hidden_permission_check($module,$controller_name)
	{

	$controller = APPPATH."modules/" . $module.'/controllers/'.$controller_name.'.php'; 

	$results = $this->acl_model->get_methods($controller);

	$aUserMethods = array();	
	$controllername = basename($controller, EXT);
	$aUserMethods = $results;

		foreach($results as $aUserMethods)
		{
							$data = array(
								'controller' 	=> $controllername,
								'action' 		=> $aUserMethods,
								'name' 			=> $aUserMethods,
								'module'		=> $module
							);
		$check_role = $this->acl_model->check_permissions($data['module'],$data['controller'],$data['action']);
			if($check_role)
			{
				$this->acl_model->save_permission($data);
		 
			}
		}
	}
	
	public function add_groups()
	{
		if($this->input->post())
		{
			$this->_add_groups($_REQUEST);
		}
	}
	
	public function delete_group($id)
	{
		$row = $this->acl_model->unlink_group($id);
		if($row)
		{
			redirect(base_url()."permissions/index?success=Group deleted successfully");
		}
		else
		{
			redirect(base_url()."permissions/index?error=some error");
		}
	}
	
	public function update_group()
	{
		if($this->input->post())
		{			
			$this->_update_group($_REQUEST);
		}
	}
	
	public function group_base_permissions()
	{
		$this->data['groups'] = $this->acl_model->permissioned_groups();
		$this->data['permissions'] = $this->acl_model->get_all_permissions(); 
		$this->data['group_permissions'] = $this->acl_model->get_groups_permissions_ids($this->input->get('group_id'));
		$this->data['view']="permissions/group_base_permissions";
		$this->load->view('layout/layout_admin', $this->data);
	}
	
	public function group_base_permissions_new()
	{
		$this->data['groups'] = $this->acl_model->permissioned_groups();
		$this->data['permissions'] = $this->acl_model->get_all_permissions(); 
		$this->data['group_permissions'] = $this->acl_model->get_groups_permissions_ids($this->input->get('group_id'));
		$this->data['view']="permissions/group_base_permissions_new";
		$this->load->view('layout/layout_admin', $this->data);
	}	
	
	public function group_basepermissions(){
		$this->data['groups'] = $this->acl_model->permissioned_groups();
		$this->data['permissions'] = $this->acl_model->get_all_permissions(); 
		$this->data['group_permissions'] = $this->acl_model->get_groups_permissions_ids($this->input->get('group_id'));
		$this->data['view']="permissions/group_basepermissions";
		$this->load->view('layout/layout_admin', $this->data);
	}
	
	public function set_group_permissions()
	{
		if($this->input->post('groups'))
		{
			$data = array();
			$data['group_id'] = $this->input->post('groups');
			if($this->input->post('permissions'))
			{
				$data['permission_id'] = $this->input->post('permissions');
			}
			if($this->acl_model->set_groups_permissions($data))
			{
				redirect(base_url()."permissions/group_base_permissions?group_id=".$data['group_id']."&success=Group Updated Successfully");
			}
			else
			{
				redirect(base_url()."permissions/group_base_permissions?error=Some error");
			}
		}else{
			redirect(base_url()."permissions/group_base_permissions?error=Some error");
		}
	}
	
	private function _add_permissions_functions($save_data)
	{
		$rules = array(
			array(
				'field'   => 'module',
				'label'   => 'Module',
				'rules'   => 'trim|required'
			),
			array(
				'field'   => 'controller',
				'label'   => 'Controller',
				'rules'   => 'trim|required'
			),
			array(
				'field'   => 'function',
				'label'   => 'Function',
				'rules'   => 'trim|required'
			),
			array(
				'field'   => 'name',
				'label'   => 'Name',
				'rules'   => 'trim|required'
			)
		);
		$this->form_validation->set_error_delimiters('','');
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run())
		{
			$data = array(
							"module" 				=> $save_data['module'],
							"controller"			=> $save_data['controller'],
							"action"				=> $save_data['function'],
							"name"					=> $save_data['name'],
							"description"			=> $save_data['description'],
							"availability"			=> $save_data['permission_status']							
						);
			if($save_data['parent_id'])
			{
				$data['parent_id'] = $save_data['parent_id'];
			}
			$id = $this->acl_model->add_permission($data);
			if($id)
			{
				redirect(base_url()."permissions/group_base_permissions?success=permissions added successfully");
			}
			else
			{
				redirect(base_url()."permissions/group_base_permissions?error=permissions not added");
			}
		}		
	}
	
	private function _update_permission_function($save_data){
		
		
		$rules = array(
			array(
				'field'   => 'module',
				'label'   => 'Module',
				'rules'   => 'trim|required'
			),
			array(
				'field'   => 'controller',
				'label'   => 'Controller',
				'rules'   => 'trim|required'
			),
			array(
				'field'   => 'function',
				'label'   => 'Function',
				'rules'   => 'trim|required'
			),
			array(
				'field'   => 'name',
				'label'   => 'Name',
				'rules'   => 'trim|required'
			)
		);
		$this->form_validation->set_error_delimiters('','');
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run())
		{
			$data = array(
							"module" 				=> $save_data['module'],
							"controller"			=> $save_data['controller'],
							"action"				=> $save_data['function'],
							"name"					=> $save_data['name'],
							"description"			=> $save_data['description'],
							"availability"			=> $save_data['permission_status']							
						);
			if($save_data['parent_id'])
			{
				$data['parent_id'] = $save_data['parent_id'];
			}
			if($save_data['permission_id'])
			{
				$data['id'] = $save_data['permission_id'];
			}
			$id = $this->acl_model->update_permission($data);
			if($id)
			{
				redirect(base_url()."permissions/group_basepermissions?group_id=".$save_data['group_id']);
			}
			else
			{
				redirect(base_url()."permissions/group_basepermissions?error=permissions not updated");
			}
		}		
	}
	
	private function _add_groups($save_data)
	{
		$rules = array(
			array(
				'field'   => 'name',
				'label'   => 'Name',
				'rules'   => 'trim|required'
			),
			array(
				'field'   => 'description',
				'label'   => 'Description',
				'rules'   => 'trim|required'
			)
		);
		//"created_by"		=> $this->ion_auth->user()->row()->id,
		//"updated_by"		=> $this->ion_auth->user()->row()->id,
		$this->form_validation->set_error_delimiters('','');
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run())
		{
			$data = array(
						"name" 				=> $save_data['name'],
						"description"		=> $save_data['description'],
						"check_permission"	=> $save_data['check_permission'],
						"redirect"			=> $save_data['redirect'],	
						"isdel"				=> '0'
					);
			$id = $this->acl_model->add_groups($data);
			if($id)
			{
				redirect(base_url()."permissions/index?success=Group added successfully");
			}
			else
			{
				redirect(base_url()."permissions/index?error=some errors");
			}
		}		
	}
	
	private  function _update_group($save_data)
	{
		if($save_data['check_permission'] == "")
		{
			$save_data['check_permission'] = "off";
		}
		$rules = array(
			array(
				'field'   => 'name',
				'label'   => 'Name',
				'rules'   => 'trim|required'
			),
			array(
				'field'   => 'description',
				'label'   => 'Description',
				'rules'   => 'trim|required'
			)
		);
		//"created_by"		=> $this->ion_auth->user()->row()->id,
		//"updated_by"		=> $this->ion_auth->user()->row()->id,
		$this->form_validation->set_error_delimiters('','');
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run())
		{
			$data = array(
						"name" 				=> $save_data['name'],
						"description"		=> $save_data['description'],
						"check_permission"	=> $save_data['check_permission'],
						"redirect" 			=> $save_data['redirect']
					);
			if($this->acl_model->update_group($save_data['group_id'],$data))
			{
				redirect(base_url()."permissions/index?success=Group updated successfully");
			}
			else
			{
				redirect(base_url()."permissions/index?error=some error");
			}
		}		
	}
}

