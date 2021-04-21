<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories_model extends CI_Model
{
	private $tablename = "categories";

	public function __construct()
	{
		parent::__construct();
		$this->tablename = "categories";
		
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
	public function get_categories()
	{
		$result = $this->db->get($this->tablename);
		$result = $result->result_array();
		return $result;
	}
	public function get_category($cat_id = "")
	{
		$this->db->where("isdel",'0');
		$this->db->where("cat_id",$cat_id);
		$result = $this->db->get($this->tablename);
		$result = $result->row();
		return $result;
	}
	public function save_category($array = "")
	{
		$array['added_on'] = date("Y-m-d H:i:s");
        $array['isdel'] = '0';
		$array = array_merge($array,$this->addAdditionalData);
        $query = $this->db->insert('categories',$array);
        if($query){
        	return true;
        }else{
        	return fasle;
        }
	}	
	public function update_category($array = "")
	{
		$array = array_merge($array,$this->updateAdditionalData);
        $this->db->where('cat_id',$array['cat_id']);
        $query = $this->db->update('categories',$array);
        if($query){
        	return true;
        }else{
        	return fasle;
        }
	}
	public function delete_category($id)
	{
		$param['isdel'] = '1';
		$param = array_merge($param,$this->deleteAdditionalData);
		$this->db->where('cat_id',$id);
		return $this->db->update($this->tablename,$param);
	}
	public function restore_category($id)
	{
		$param['isdel'] = '0';
		$param = array_merge($param,$this->restoreAdditionalData);
		$this->db->where('cat_id',$id);
		return $this->db->update($this->tablename,$param);
	}
	public function cat_name_check($cat_name = "")
	{
        $this->db->where('cat_name',$cat_name);
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



