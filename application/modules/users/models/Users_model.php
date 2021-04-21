<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class users_model extends CI_Model
{
	var $tablename			= "";
	
	public function __construct()
	{
		parent::__construct();
		
		$this->tablename 							= "users";
		$this->users_groups 						= "users_groups";
		$this->groups 								= "groups";
	}
	public function active_user_account($user_id){

		$param['active'] = '1';
		$this->db->where('id',$user_id);
		$query = $this->db->update('users',$param);
		return $query;
	}
	public function deactive_user_account($user_id){

		$param['active'] = '0';
		$this->db->where('id',$user_id);
		$query = $this->db->update('users',$param);
		return $query;
	}
	public function update_user_status($id)
	{
		$this->db->where('id', $id);
		$this->db->update($this->tablename, array('active' => '0'));
		return;
	}
	public function update_user_profile($id,$data){
		$this->db->where('id',$id);
		return $this->db->update('users',$data);
	}
	public function update_user($id, $data)
	{
		$data = $this->db->where('id', $id)->update($this->tablename, $data);
	}
	public function update_user_type($id, $data)
	{
		$this->db->where('user_id', $id)->delete('users_groups');
		$params['user_id'] = $id;
		foreach ($data['group_id'] as $key => $value) {
			$params['group_id'] = $value;
			$this->db->insert('users_groups',$params);
		}
	}
	public function get_data($id)
	{
		$query 	=  $this->db->select('*')->from('users')->where('id', $id)->get()->row_array();
		return $query;
	}
	public function get_groups_data($id)
	{
		$query 	=  $this->db->select('group_id')->from('users_groups')->where('user_id',$id)->get()->result_array();
		return $query;
	}
	public function get_users_groups()
	{
		$query 	=  $this->db->select('*')->from('groups')->get()->result_array();
		return $query;
	}
	public function get_user_data($id){
		$this->db->select("u.*", FALSE);            
		$this->db->from($this->tablename.' u');
		//$this->db->join($this->users_groups.' ug','ug.user_id = u.id','INNER');
		//$this->db->join($this->_users_details.' ud','ud.user_id = u.id','left');
		//$this->db->join($this->tablename.' u1','u1.id = ud.managerid','left');
		$this->db->order_by('u.id','DESC');
		$this->db->where('u.id',$id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function delete_user_groups($user_id){
		$this->db->where('group_id','5');
		$this->db->where('user_id',$user_id);
		$qry = $this->db->delete('users_groups');
		return $qry;
	}
	public function insert_user_groups($user_id){
		$params['group_id'] = '5';
		$params['user_id'] = $user_id;
		$qry = $this->db->insert('users_groups',$params);
		return $qry;
	}
	public function update_user_groups($user_id){
		$params['group_id'] = '5';
		$this->db->where('group_id','5');
		$this->db->where('user_id',$user_id);
		$qry = $this->db->update('users_groups',$params);
		return $qry;
	}
	public function get_user_groups($user_id){
		$this->db->where('group_id','5');
		$this->db->where('user_id',$user_id);
		$qry_result = $this->db->get('users_groups')->result();
		return $qry_result;
	}
}



