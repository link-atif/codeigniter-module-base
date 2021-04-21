<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class orders_model extends CI_Model
{
	var $tablename			= "";
	
	public function __construct()
	{
		parent::__construct();
		
		$this->tablename 							= "orders";
		$this->orders_groups 						= "orders_groups";
		$this->groups 								= "groups";
	}
	public function insert($table_name,$data)
	{
		$this->db->insert($table_name, $data);
		$num_inserts = $this->db->affected_rows();
		if (intval($num_inserts) > 0) {
			$data = array('status' => 'success', 'insert_id' => $this->db->insert_id());
		} else {
			$data = array('status' => 'error', 'last_query' => $this->db->last_query());
		}
		return $data;
	}
	public function get_shipment_modes()
	{
		$result 	=  $this->db->select('*')->from('shipment_modes')->get()->result_array();
		return $result;
	}
	public function update_user_status($id)
	{
		$this->db->where('id', $id);
		$this->db->update($this->tablename, array('active' => '0'));
		return;
	}
	public function update_user_profile($id,$data){
		$this->db->where('id',$id);
		return $this->db->update('orders',$data);
	}
	public function update_user($id, $data)
	{
		$data = $this->db->where('id', $id)->update($this->tablename, $data);
	}
	public function update_user_type($id, $data)
	{
		$this->db->where('user_id', $id)->delete('orders_groups');
		$params['user_id'] = $id;
		foreach ($data['group_id'] as $key => $value) {
			$params['group_id'] = $value;
			$this->db->insert('orders_groups',$params);
		}
	}
	public function get_data($id)
	{
		$query 	=  $this->db->select('*')->from('orders')->where('id', $id)->get()->row_array();
		return $query;
	}
	public function get_orders_groups()
	{
		$query 	=  $this->db->select('*')->from('groups')->get()->result_array();
		return $query;
	}
	public function get_all_orders(){
		/*$this->db->select("*");            
		$this->db->from($this->tablename);
		$this->db->order_by('order_id','DESC');*/
		$query = $this->db->query("SELECT orders.*, (SELECT shipment_type FROM shipment_modes WHERE id = shipment_mode ) as shipment_mode_text FROM `orders` ORDER BY `order_id` DESC");
		return $query->result_array();
	}

	public function deleteOrder($order_id){
		$this->db->set('isdel','1');
		$this->db->where('order_id',$order_id);
		$qry = $this->db->update('orders');
		return $qry;
	}
	public function insert_user_groups($user_id){
		$params['group_id'] = '5';
		$params['user_id'] = $user_id;
		$qry = $this->db->insert('orders_groups',$params);
		return $qry;
	}
	public function update_user_groups($user_id){
		$params['group_id'] = '5';
		$this->db->where('group_id','5');
		$this->db->where('user_id',$user_id);
		$qry = $this->db->update('orders_groups',$params);
		return $qry;
	}
	public function get_user_groups($user_id){
		$this->db->where('group_id','5');
		$this->db->where('user_id',$user_id);
		$qry_result = $this->db->get('orders_groups')->result();
		return $qry_result;
	}
}



