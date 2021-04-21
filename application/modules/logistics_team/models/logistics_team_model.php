<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logistics_Team_model extends CI_Model
{
	var $tablename	= "";
	
	public function __construct()
	{
		parent::__construct();		
		$this->tablename 	= "logistics_team";
	}
	// public function update_user_status($id)
	// {
	// 	$this->db->where('id', $id);
	// 	$this->db->update($this->tablename, array('active' => '0'));
	// 	return;
	// }
	// public function update_user($id, $data)
	// {
	// 	$data = $this->db->where('id', $id)->update($this->tablename, $data);
	// }
	// public function get_data_by_id($id)
	// {
	// 	$query 	=  $this->db->select('*')->from('users')->where('id', $id)->get()->row_array();
	// 	return $query;
	// }
	public function get_data()
	{
		// $query 	=  $this->db->select('*')->from($this->tablename)->get()->result_array();
		$query 	=  $this->db->select('*')->from($this->tablename)->get()->result_array();
		return $query;
	}
	

	public function deleteLogisticsTeam($logistics_team_id){
		// $this->db->where('group_id','5');
		
		$data['isdel'] = 1;
		$this->db->where('id',$logistics_team_id);
		$qry = $this->db->update($this->tablename,$data);
		return $qry;
	}
	public function restoreLogisticsTeam($logistics_team_id){
		// $this->db->where('group_id','5');
		// echo "hello";die;
		$data['isdel'] = 0;
		$this->db->where('id',$logistics_team_id);
		$qry = $this->db->update($this->tablename,$data);
		return $qry;
	}

	public function editLogisticsTeam($logistics_team_id){
		
		$query = $this->db->get_where($this->tablename,array('id'=>$logistics_team_id));
		return $query->row();
	}

	public function updateLogisticsTeam($data,$logistics_team_id){
		
		$query = $this->db->where('id',$logistics_team_id);
		$query = $this->db->update($this->tablename,$data);
	}
	public function insert($params){
		// $params['isdel'] = 0;
		$qry = $this->db->insert($this->tablename,$params);
		return $qry;
	}
	// public function update_user_groups($user_id){
	// 	$params['group_id'] = '5';
	// 	$this->db->where('group_id','5');
	// 	$this->db->where('user_id',$user_id);
	// 	$qry = $this->db->update('users_groups',$params);
	// 	return $qry;
	// }
	// public function get_user_groups($user_id){
	// 	$this->db->where('group_id','5');
	// 	$this->db->where('user_id',$user_id);
	// 	$qry_result = $this->db->get('users_groups')->result();
	// 	return $qry_result;
	// }
}



