<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter ACL Class
 *
 * This class enables apply permissions to controllers, controller and models, as well as more fine tuned permissions '
 * at code level.
 *
 * @package     CodeIgniter
 * @subpackage  Models
 * @category    Models
 * @author      David Freerksen
 * @link        https://github.com/dfreerksen/ci-acl
 */
class Acl_model extends CI_Model 
{

	/**
	 * Get permissions from database
	 *
	 * @param   int $role
	 * @return  array
	 */
	 
	public function get_all_permissions_by_groupids($group_id)
	{
		$permissions	=	array();
		foreach($group_id as $role_row)
		{
			$this->db->select('p.*');
			$this->db->from('permissions p');
			$this->db->join('group_permissions rp', 'rp.permission_id = p.id');
			$this->db->where('rp.group_id', $role_row->id);
			$query =  $this->db->get();
			if(count($query->result_array()) > 0)
			{
				$permissions[] = $query->result_array();			
			}
		}
		return $permissions;
	}
	
	public function has_permission($controller,$action,$roles_ids)
	{

		$query = $this->db->select("p.controller as k")
		->from('permissions p')
		->where("p.controller", $controller)
		->where("p.action", $action)
		->where("p.availability", "permission_needed")
		->get();
	 	
		if(count($query->result_array())>0)
		{

			foreach($roles_ids as $role_row)
			{
				$query = $this->db->select("p.controller as k, p.action as action")
				->from('permissions p')
				->join('group_permissions rp', "rp.permission_id = p.id")
				->where("rp.group_id", $role_row['id'])
				->where("p.controller", $controller)
				->where("p.action", $action)
				->get();
				$query->result_array();
			
				if(count($query->result_array())>0)
				{
					// echo '<pre>'; print_r($query->result_array()); echo '</pre>'; die;
					return true;
				}
				else
				{
					return false;
				}
			}
		}
		else return false;
	}

	public function get_groups()
	{
		$this->db->select('*');
		$this->db->from('groups');
        $this->db->order_by('name', 'ASC');
		$result = $this->db->get()->result_array();
		return $result;
	}
	public function get_groupsbyid($id)
	{
		$this->db->select('*');
		$this->db->from('groups');
		$this->db->where('id',$id);
		$result = $this->db->get()->result_array();
		return $result;
	}
	public function get_groupsbyname($name)
	{
		$this->db->select('*');
		$this->db->from('groups');
		$this->db->where('name',$name);
		$result = $this->db->get()->first_row();
		return $result;
	}
	public function save_group($data){
		$this->db->insert('groups',$data);
		$inserted_id = $this->db->insert_id();
		return $inserted_id;
	}
	public function check_permissions($module,$controller,$action)
	{
		$this->db->select('*');
		$this->db->from('permissions');
		$this->db->where('controller',$controller);
		$this->db->where('action',$action);
		$this->db->where('module',$module);
		$query = $this->db->get();
		if($query->num_rows() >0)
		{ 
			return false;
		}
		else
		{
			return true;
		}
	}
	
	public function get_permission()
	{
		$this->db->select('*');
		$this->db->from('permissions');
		$this->db->where('availability','permission_needed');
		$result = $this->db->get()->result_array();
		return $result;
	}
	
	public function save_permission($data)
	{
		$this->db->insert('permissions',$data);
		$inserted_id = $this->db->insert_id();
		return $inserted_id;
	}


	public function check_group_permissions($data)
	{
		$this->db->select('*');
		$this->db->from('group_permissions');
		$this->db->where('group_id',$data['group_id']);
		$this->db->where('permission_id',$data['permission_id']);
		$query = $this->db->get();
		if($query->num_rows() >0)
		{ 
		$result = $this->db->get()->result_array();
		return $result;
			// return true;
		}
		else
		{
			return false;
		}
	}

	public function get_group_permission_byid($id)
	{
		$this->db->select('*');
		$this->db->from('group_permissions');
		$this->db->where('group_id',$id);
		$result = $this->db->get()->result_array();
		return $result;
	}
	public function save_group_permission($role_id,$permission_id)
	{
		$data = array('group_id' => $role_id, 'permission_id' => $permission_id);
		$this->db->insert('group_permissions',$data);
		$inserted_id = $this->db->insert_id();
		return $inserted_id;
	}

	public function update_group_permission($roleid,$data)
	{
        $this->db->where('id', $id);
		$return =  $this->db->update('group_permissions', $data);
		return $return;
	}

	public function update_group($id,$data)
	{
		$this->db->where('id', $id);
		$return =  $this->db->update('groups', $data);
		return $return;
	}

	public function clean_group_permission($rid)
	{
		$this->db->select('*');
		$this->db->from('group_permissions');
		$this->db->where('group_id',$rid); 
		$query = $this->db->get();
		if($query->num_rows() >0)
		{
			$this->db->where('group_id',$rid); 
			$this->db->delete('group_permissions'); 
			return true;
		}
		else
		{
			return false;
		}
	}
	public function delete_group_list_row($id)
	{
		$this->db->select('*');
		$this->db->from('groups');
		$this->db->where('id',$id);
		$query = $this->db->get();
		if($query->num_rows() >0)
		{
			$this->db->where('id',$id);
			$this->db->delete('groups'); 
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function add_groups($data)
	{
		$this->db->insert('groups', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	
	function get_all_groups()
	{
		$this->db->select('*');		
		$this->db->from('groups');
		$this->db->where('isdel',0);
		$this->db->order_by('id','DESC');
		$query= $this->db->get();
		if($query->num_rows()>0)
		{
			$rows = $query->result_array();
			return $rows;
		}
		return false;
	}
	
	function set_groups_permissions($data)
	{
		$this->db->where("group_id",$data['group_id']);
		$this->db->delete("group_permissions");
		$data_arr = array();
        foreach($data['permission_id'] as $value)
		{
            $data_arr[] = array("group_id"=>$data['group_id'],"permission_id"=>$value);
        }
        $this->db->insert_batch("group_permissions",$data_arr);
        return true;
	}
	
	function get_groups_permissions_ids($id)
	{
		$this->db->select('distinct(permission_id)');
		$this->db->where("group_id",$id);
		$this->db->from('group_permissions');
		$query =$this->db->get();
		if($query->num_rows()>0)
		{
			$rows = $query->result_array();
			$new_array = array();
			foreach($rows as $row)
			{
				$new_array[] = $row['permission_id'];
			}
			return $new_array;
		}
	}
	
	function get_all_permissions()
	{
		$this->db->select("distinct(module) as module_name");
		$this->db->from("permissions");
		$query=$this->db->get();
		if($query->num_rows()>0)
		{
			$rows = $query->result_array();
			return $rows;
		}
		return false;
	}
	
	function get_all_controllers($module)
	{
		$this->db->select("distinct(controller) as controllers");
		$this->db->where('module',$module);
		$this->db->from("permissions");
		$query=$this->db->get();
		if($query->num_rows()>0)
		{
			$rows = $query->result_array();
			return $rows;
		}
		return false;
			
	}
	
	function get_all_functions($controller,$module)
	{
		$this->db->select("*");
		$this->db->where("parent_id",0);
		$this->db->where('controller',$controller);
		$this->db->where('module',$module);
		$this->db->from("permissions");
		$query=$this->db->get();
		if($query->num_rows()>0)
		{
			$rows = $query->result_array();
			return $rows;
		}
		return false;
			
	}
	
	function get_all_subchilds($id)
	{
		$this->db->where('parent_id',$id);
		$query=$this->db->get('permissions');
		if($query->num_rows()>0)
		{
			$rows = $query->result_array();
			return $rows;
		}
		return false;
	}
	
	function add_permission($save_array)
	{
		$this->db->insert('permissions', $save_array);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}	
	
	function update_permission($save_array)
	{
		// echo "<pre>"; print_r($save_array); die;
		$this->db->where('id',$save_array['id']);
		$this->db->update('permissions',$save_array);
		return true;
		
	}
	
	public function get_permisson_data($id) 
	{
        $this->db->select('*');
        $this->db->from('permissions');
        $this->db->where('id', $id);

        $query = $this->db->get();
        return $query->row_array();
    }
	
	
	function unlink_group($id)
	{
		$data = array("isdel"=>1);
		$this->db->where('id',$id);
		$this->db->update('groups',$data);
		return true;
	}
	
	function get_all_users()
	{
        $this->db->order_by('id','DESC');
		$query= $this->db->get('users');
		if($query->num_rows()>0)
		{
			$rows = $query->result_array();
			return $rows;
		}
		return false;
	}
	
	function get_group_by_user_id($user_id)
	{
		$this->db->select("groups.name,groups.id");
		$this->db->where("users_groups.user_id",$user_id);
		$this->db->join("groups","groups.id=users_groups.group_id");
		$query=$this->db->get('users_groups');
		if($query->num_rows()>0)
		{
			$rows = $query->result_array();
			$names = "";
			$ids = "";
			foreach($rows as $r)
			{
				if($names=='')
				{
					$names=$r['name'];
					$ids=$r['id'];
				}
				else
				{
					$names.=", ".$r['name'];
					$ids.=','.$r['id'];
				}
			}
			return array("ids"=>$ids,"names"=>$names);
		}
		return false;
	}
	
	function update_user_group($data)
	{
		$this->db->where('user_id',$data['user_id']); 
		$this->db->delete('users_groups'); 		
		$user_id = $data['user_id'];
		
		foreach($data['groups'] as $r)
		{
			$d = array("user_id"=>$user_id,"group_id"=>$r);
			$this->db->insert('users_groups',$d);
		}
	}
	
	public function get_group_permission($id)
	{
		$this->db->select('p.*');
		$this->db->from('permissions p');
		$this->db->join('group_permissions rp', "rp.permission_id = p.id");
		$this->db->where("rp.group_id", $id);
		$result = $this->db->get()->result();
		return $result;
	}
	
	function permissioned_groups()
	{
		$this->db->select('*');		
		$this->db->from('groups');
		$this->db->where('check_permission', 'on');
                $this->db->where('isdel',0);
                $this->db->order_by('id','DESC');
		$query= $this->db->get();
		if($query->num_rows()>0)
		{
			$rows = $query->result_array();
			return $rows;
		}
		return false;
	}
	
	public function get_methods($controller)
	{

		// Get the name of the subdir
		
		$this->CI = get_instance();
		
		//$controller = str_replace(dirname(__DIR__),"",$_REQUEST['controllerName']);
		
		//echo $controller = dirname(__DIR__).$_REQUEST['controllerName'];//'"\modules\Library\controllers\Library.php";
		
		// $controller = $_REQUEST['controllerName'];
		//$controller = dirname(__DIR__)."\modules\Library\controllers\Library.php";
		$controllername = basename($controller, EXT);
		
		// Load the controller file in memory if it's not load already
		if(!class_exists($controllername))
		{
			$this->CI->load->file($controller);
		}
		$aMethods		=	get_class_methods($controllername);	

		// echo $controllername; echo ' : <pre> '; print_r($aMethods); echo '</pre> <br />';
		
		$aUserMethods 	=	array();
		$other_methods	=	array('loadpage', 'access_error', 'post_request', 'send_mail', 'convert_number', 'get_instance', '__construct',  'convert_double_to_time', );
		
		foreach($aMethods as $method)
		{
			if(!in_array($method, $other_methods))
			{
				$aUserMethods[]	=	$method;
			}
		}
		return $aUserMethods;

	}
	
}
