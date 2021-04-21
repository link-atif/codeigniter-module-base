<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class WarehouseLoading_model extends CI_Model
{
	var $tablename			= "";
	
	public function __construct()
	{
		parent::__construct();		
		$this->tablename 	= "warehouse_loading";
	}
	public function update_user_status($id)
	{
		$this->db->where('id', $id);
		$this->db->update($this->tablename, array('active' => '0'));
		return;
	}
	public function update($data,$cond)
	{
		$this->db->where($cond);
		$this->db->update($this->tablename, $data);
		return;
	}
	public function update_user($id, $data)
	{
		$data = $this->db->where('id', $id)->update($this->tablename, $data);
	}
	public function get_data_by_id($id)
	{
		$query 	=  $this->db->select('*')->from($this->tablename)->where('id', $id)->get()->row_array();
		return $query;
	}
	public function get_data()
	{
		$query 	=  $this->db->get($this->tablename)->result_array();	
		return $query;
	}
	public function get($tablename,$cond = "")
	{
		$query 	=  $this->db->get_where($tablename,$cond)->result_array();
		return $query;
	}
	public function get_single($tablename,$cond = "")
	{
		$query 	=  $this->db->get_where($tablename,$cond)->row_array();
		return $query;
	}

	public function get_builty_numbers()
	{
		$query 	=  $this->db->get('orders')->result_array();
		return $query;
	}
	public function get_cities()
	{
		$query 	=  $this->db->get('cities')->result_array();
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

	public function deleteWarehouseLoading($id){
		$param['isdel'] = '1';
        $this->db->where('id',$id);
        $this->db->update($this->tablename,$param);
        
		return $qry;
	}
	public function restoreWarehouseLoading($id){
		$param['isdel'] = 0;
		$this->db->where('id',$id);
        $this->db->update($this->tablename,$param);
	}

	public function insert($params){
		
		$qry = $this->db->insert($this->tablename,$params);
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



