<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Branches_model extends CI_Model
{
	private $tablename = "branches";

	public function __construct()
	{
		parent::__construct();
		$this->tablename = "branches";
		
		$this->restoreAdditionalData = array(
			'restore_on' => date("Y-m-d H:i:s"), 
			'restore_by_user_id' => $this->session->userdata('user_id'), 
			'restore_by_ip_address' => $this->config->item('ip_address'), 
		);
		$this->deleteAdditionalData = array(
			'deleted_on' => date("Y-m-d H:i:s"), 
			'deleted_by_user_id' => $this->session->userdata('user_id'), 
			'deleted_by_ip_address' => $this->config->item('ip_address'), 
		);
		$this->updateAdditionalData = array(
			'updated_on' => date("Y-m-d H:i:s"), 
			'updated_by_user_id' => $this->session->userdata('user_id'), 
			'update_by_ip_address' => $this->config->item('ip_address'), 
		);
		$this->addAdditionalData = array(
			'added_on' => date("Y-m-d H:i:s"), 
			'added_by_user_id' => $this->session->userdata('user_id'), 
			'added_by_ip_address' => $this->config->item('ip_address'), 
		);
	}
	public function get_branches()
	{
		$this->db->where("parent_id",'0');
		$this->db->order_by("branch_id",'desc');
		$result = $this->db->get($this->tablename);
		$result = $result->result_array();
		return $result;
	}
	public function get_sub_branches()
	{	
		$this->db->select('b.branch_name,b.parent_id,b.branch_id,b.branch_detail,b.added_on,b.isdel');
		$this->db->where("parent_id !=",'0');
		$this->db->order_by("branch_id",'desc');
		$result = $this->db->get($this->tablename.' b');
		$result = $result->result_array();
		$new_array = array();
		foreach ($result as $key => $value) {
	
			$branch_name = $value['branch_name'];
			$parent_id = $value['parent_id'];
			$parent_branch_data = $this->get_branch($parent_id);
			$new_array[$key]['branch_id'] = $value['branch_id'];
			$new_array[$key]['branch_name'] = $branch_name;
			$new_array[$key]['parent_id'] = $parent_id;
			$new_array[$key]['branch_detail'] = $value['branch_detail'];
			$new_array[$key]['added_on'] = $value['added_on'];
			$new_array[$key]['isdel'] = $value['isdel'];
			$new_array[$key]['branch_warehouse_id'] = $parent_branch_data->branch_warehouse_id;
			$new_array[$key]['branch_country_id'] = $parent_branch_data->branch_country_id;
		}
		return $new_array;
	}
	public function get_branch($branch_id = "")
	{
		$this->db->where("isdel",'0');
		$this->db->where("branch_id",$branch_id);
		$result = $this->db->get($this->tablename);
		$result = $result->row();
		return $result;
	}
	public function save_branch($array = "")
	{
		$array['branch_detail'] =$array['editor2'];
		unset($array['editor2']);
        $array['isdel'] = '0';
		$array = array_merge($array,$this->addAdditionalData);
        $query = $this->db->insert($this->tablename,$array);
        if($query){
        	return true;
        }else{
        	return fasle;
        }
	}	
	public function update_branch($array = "")
	{
		$array = array_merge($array,$this->updateAdditionalData);
        $this->db->where('branch_id',$array['branch_id']);
        $query = $this->db->update($this->tablename,$array);
        if($query){
        	return true;
        }else{
        	return fasle;
        }
	}
	public function delete_branch($id)
	{
		$param['isdel'] = '1';
		$param = array_merge($param,$this->deleteAdditionalData);
		$this->db->where('branch_id',$id);
		return $this->db->update($this->tablename,$param);
	}
	public function restore_branch($id)
	{
		$param['isdel'] = '0';
		$param = array_merge($param,$this->restoreAdditionalData);
		$this->db->where('branch_id',$id);
		return $this->db->update($this->tablename,$param);
	}
	public function branch_name_check($cat_name = "")
	{
        $this->db->where('branch_name',$cat_name);
        $this->db->where('isdel','0');
        $query = $this->db->get($this->tablename);
		$query = $query->num_rows();
        if($query > 0){
        	return TRUE;
        }else{
        	return FALSE;
        }
	}
}



