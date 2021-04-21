<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staff_model extends CI_Model
{
	var $tablename			= "";
	public function __construct()
	{
		parent::__construct();
		$this->tablename 						=	"users";
		$this->users_groups 					=	"users_groups";
		$this->_users_details 					=	"users_details";
		$this->_users_attendance 				=	"users_attendance";
		$this->_customers 						=	"customers";
		$this->_setup_codes 				    	= "setup_codes";
		
		$this->_timesheet		                = 	"users_timesheet";
		
		$this->_users_licences_logs 			=	"users_licences_logs";
		$this->_licence_types 					=	"licence_types";
		$this->_users_licences 					=	"users_licences";
		$this->_users_customers_mapping 		=	"users_customers_mapping";
		$this->_adfs_permissions_request 		=	"adfs_permissions_request";
		$this->_users_approval_managers 		=	"users_approval_managers";
		$this->groups 							=	"groups";
		$this->_settings 						=	"settings";
		$this->_master_controllers 				=	"setup_permissions";
		$this->_favorites_link 					=	"user_favorites";
		$this->_service_regions 				=	"service_regions";
		$this->_users_payroll_settings 			=	"users_payroll_settings";
		$this->masters							=	'setup_codes';
		$this->countries						=	"countries";
		$this->_jobs							=	"jobs";
		$this->states							=	"states";
		$this->cities							=	"cities";
		$this->_users_emergency_contacts_details=	"users_emergency_contacts_details";
		
		$this->_setup_allowances 				=	"setup_allowances";
		$this->_users_allowances_mapping 		=	"users_allowances_mapping";
		$this->_users_payroll_settings	 	=	'users_payroll_settings';
		$this->_staff_additional_info			=	"staff_additional_info";
        $this->_mails							=	'mails';
		$this->_mails_contacts					=	'mails_contacts';
		$this->_mails_documents					=	'mails_documents';
		$this->users 							=	'users';
				
		$this->_office_assets					=	'office_assets';
		$this->_office_assets_manage_assets		=	'office_manage_assets';
		$this->_office							=	'office';
		$this->_setup_payroll_agreements	=	'setup_payroll_agreements';
		$this->_users_service_regions_mapping	=	'mapping_setup_codes';
		
		$this->_setup_master_sdm                =   'setup_master_sdm';
		$this->_mapping_allowances              =	'mapping_allowances';
		$this->_setup_allowances            = 	'setup_allowances';
		$this->_users_profiles 					= 	'users_profiles';
		$this->_users_profiles_details			= 	'users_profiles_details';
		$this->_users_profiles_locked_data		= 	'users_profiles_locked_data';
		
		$this->_documents 						= 	'documents';
		
		$this->_users_qualifications 			= 	'users_qualifications';
		$this->_notifications_templates 		= 	'notification_template';  
		$this->_users_notifications_settings	= 	'users_notifications_settings';
		
		$this->templates					= 	'templates';
		
		$logged_user_data						=	$this->ion_auth->user()->row();
		$this->logged_user_id                   = $logged_user_data->id;
	}


	


	public function get_user_timezone($id)
	{
		$this->db->select('timezone');
		$this->db->from($this->tablename);
		$this->db->where('id',$id);
		$query = $this->db->get();            
		$data = $query->row_array();            
		return $data['timezone'];
	}
	public function get_user_details($user_id)
	{
		$this->db->select('*');
		$this->db->from($this->_users_details);
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		return $query->row();
	}	
	
	public function get_details($user_id)
	{
		$this->db->select('*');
		$this->db->from($this->_users_details);
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		return $query->row();
	}
	
	// Get Manager list function
	public function get_manager_list()
	{
		$this->db->select('u.id, u.first_name, u.last_name');
		$this->db->from($this->tablename.' u');
		$this->db->where('u.id > ', 0);
		$this->db->where('u.is_manager =', 1);
		$this->db->group_by('u.id');
		$this->db->order_by('first_name','ASC');
		$query = $this->db->get();
		return $val = $query->result_array();
	}	

	public function get_user_data($user_id)
	{
		$this->db->select('*');
		$this->db->from($this->tablename);
		$this->db->where('id',$user_id);
		$query = $this->db->get();
		return $query->row_array();
	}
	public function get_users_data($user_id,$type='',$active = 1)
	{
		$this->db->select('a.*');
		$this->db->from($this->tablename .' a');
		$this->db->join($this->users_groups .' b','a.id = b.user_id','LEFT');
		if($type >0)
		{
			$this->db->where('b.group_id',3);
		}
		$this->db->where('a.id',$user_id);
		
		if($active!="")
		{
			$this->db->where('a.active',$active);
		}		
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	public function get_approval_managers($user_id)
	{
		$this->db->select('manager_id');
		$this->db->from($this->_users_approval_managers);
		$this->db->where('user_id', $user_id);
		$query	=	$this->db->get();
		$data	=	$query->result_array();
		
		$managers	=	array_column($data, 'manager_id');
		return $managers;
	}
	
	public function get_staff_users($user_id)
	{
		$this->db->select('u.id, u.first_name, u.last_name, u.email, m.name as department_name');
		$this->db->from($this->tablename.' u');
		$this->db->join($this->users_groups.' ug', 'u.id = ug.user_id');
		$this->db->join($this->masters.' m','m.id = u.departments', 'LEFT');
		$this->db->where('u.id != ', $user_id);
		$this->db->where_in('ug.group_id', array(1,3));
		$this->db->order_by('trim(u.first_name)','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function update_user_details($user_id, $user_details)
	{
		
		$this->db->select('*');
		$this->db->from($this->_users_details);
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		
		if($query->num_rows() > 0 )
		{
			$this->db->where('user_id', $user_id);
			return $this->db->update($this->_users_details, $user_details);
		}
		else
		{
			$user_details['user_id']	=	$user_id;
			return $this->db->insert($this->_users_details, $user_details);
		}
	}
	
	public function update_user_approval_managers($user_id, $approval_managers)
	{
		$this->db->where('user_id', $user_id);
		$this->db->delete($this->_users_approval_managers);
		$this->db->insert_batch($this->_users_approval_managers, $approval_managers);
	}
	
	public function get_countries()
	{
		$this->db->select('*');
		$this->db->from($this->countries);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_user_regions($id='')
	{
		$this->db->select("sa.*");
		$this->db->from($this->_users_service_regions_mapping .' uam');
		$this->db->join($this->masters.' sa','sa.id = uam.region_id', 'LEFT');
		if($id !='')
		$this->db->where('uam.reference_id',$id);
		$this->db->where('uam.type','staff');
		$this->db->where('uam.isdel',false);
		return $this->db->get()->result_array();

	}
	public function get_users($region = 0,$status='',$users = array(),$payroll_id = '',$frequency = '')
	{

		if($region == 0)
		{
		$group = array('1','3');
		$this->db->select('a.*');
		$this->db->from($this->tablename .' a');
		$this->db->join($this->users_groups .' b','a.id = b.user_id','LEFT');
		if($payroll_id != '' || $frequency != '')
		{
			$this->db->join($this->_users_payroll_settings.' as up','up.user_id = a.id','LEFT');
			if($payroll_id != '')
			{
				$this->db->where('up.payroll_agreement_id', $payroll_id);
			}
			if($frequency != '')
			{
				$this->db->where('up.pay_frequency',$frequency);        
			}
		}

		if(!empty($users))
		{
		$this->db->where_in('a.id',$users);	
		}
		if($status != '')
		{
		$this->db->where_in('a.active',$status);	
		}

		$this->db->where_in('b.group_id',$group);

		$this->db->order_by('a.first_name','ASC');

		$query = $this->db->get();
		return $query->result_array();
		}
		else
		{
		$res = $this->db->get_where($this->masters,array('id'=>$region,'type'=>'region','isdel'=>'0'));
		$res1 = $res->row_array();
		if($res1['parent_id']=='0')
		{
		$res_p = $this->db->get_where($this->masters,array('parent_id'=>$region,'type'=>'region','isdel'=>'0'));
		$res1_p = $res_p->result_array();
		if(!empty($res1_p))
		{
		$region_id = array();
		foreach ($res1_p as $kp) 
		{
			$region_id[] =$kp['id'];
		}
		array_push($region_id,$region);
		}
		else
		{
		$region_id = array($region);
		}

		}
		else
		{
		$region_id = array($region);	
		}
		$this->db->select('*');
		$this->db->from($this->_users_service_regions_mapping .' uam');
		$this->db->join($this->tablename.' u','uam.reference_id = u.id','left');
		if($payroll_id != '' || $frequency != '')
		{
			$this->db->join($this->_users_payroll_settings.' as up','up.user_id = u.id','LEFT');
			if($payroll_id != '')
			{
				$this->db->where('up.payroll_agreement_id', $payroll_id);
			}
			if($frequency != '')
			{
				$this->db->where('up.pay_frequency',$frequency);        
			}
		}
		$this->db->where_in('uam.region_id', $region_id);
		$this->db->where('uam.type', 'staff');
		$this->db->where('uam.isdel',false);
		if(!empty($users))
		{
		$this->db->where_in('uam.reference_id',$users);	
		}
		if($status != '')
		{
		$this->db->where('u.active',$status);		
		}
		$this->db->group_by('u.id');
		$this->db->order_by('u.first_name','ASC');
		$query = $this->db->get();
		return $query->result_array();
		}
		
	}	

	public function get_all_regions()
	{
		$this->db->select("sa.*");
		$this->db->from($this->masters .' sa');
		return $this->db->get()->result_array();

	}
	public function get_region_user_mapping($region,$payroll,$pay_frequency,$user_status,$type,$report_name='',$user=array())
	{
		if($region != ''){
			 $res = $this->db->get_where($this->masters,array('id'=>$region,'type'=>'region','isdel'=>'0'));
		   $val = $res->row_array();
		   if($val['parent_id'] == 0)
		   {
			   	$region1 =  $this->db->get_where($this->masters,array('parent_id'=>$region,'type'=>'region','isdel'=>'0'));
			   	$get = $region1->result_array();
				if(!empty($get))
				{
					$region_id = array();
					foreach ($get as $get) 
					{
						$region_id[] = $get['id'];
					}
					array_push($region_id,$region);	
				}
				else
				{
				 	$region_id = array($region);	
				}
			}
			else
			{
				$region_id= array($region);
		    }
			 $this->db->select('a.*,b.id as user_id,b.first_name,b.last_name,b.email as user_email,b.email,b.id,b.apply_overtime');
		     $this->db->from($this->_users_service_regions_mapping .' a');
		     $this->db->join($this->tablename .' b','a.reference_id = b.id');
		     $this->db->join($this->users_groups.' ug','ug.user_id = b.id', 'INNER');
		     if($payroll != '' || $pay_frequency != '')
			{
				$this->db->join($this->_users_payroll_settings.' us','us.user_id = b.id', 'LEFT');
	        	if($payroll != '')
				{
					$this->db->where('us.payroll_agreement_id', $payroll);
	        	}
	        	if($pay_frequency != '')
				{
					$this->db->where('us.pay_frequency',$pay_frequency);        
				}
			}
			
		     $this->db->where_in('a.region_id',$region_id);
		     if(!empty($user))
		     {
		     	$this->db->where_in('a.reference_id',$user);
		     }
		     $this->db->where('a.type',$type);
		     $this->db->where('a.isdel',false);
		     if($user_status != '')
			 {
		     	$this->db->where('b.active',$user_status);
		     }
		     $this->db->order_by('b.first_name','ASC');
		     if($report_name =='')
		     {
		      $this->db->where('ug.group_id',3);	
		     }
			 $this->db->group_by('b.id');
			 $query = $this->db->get()->result_array();
			 return $query;
		}
		else
		{
			 $this->db->select('b.id as user_id,b.first_name,b.last_name,b.email as user_email,b.email,b.id,b.apply_overtime');
		     $this->db->from($this->tablename .' b');
		     $this->db->join($this->users_groups.' ug','ug.user_id = b.id', 'INNER');
		    if($payroll != '' || $pay_frequency != '')
			{
				$this->db->join($this->_users_payroll_settings.' us','us.user_id = b.id', 'LEFT');
	        	if($payroll != '')
				{
					$this->db->where('us.payroll_agreement_id', $payroll);
	        	}
	        	if($pay_frequency != '')
				{
					$this->db->where('us.pay_frequency',$pay_frequency);        
				}
			}
		     if(!empty($user))
		     {
		     	$this->db->where_in('b.id',$user);
		     }
		     if($user_status != '')
			 {
		     	$this->db->where('b.active',$user_status);
		     }
		     $this->db->order_by('b.first_name','ASC');
		     if($report_name =='')
		     {
		      $this->db->where('ug.group_id',3);	
		     }
			 $this->db->group_by('b.id');
			 $query = $this->db->get()->result_array();
			 return $query;
		}
	}
	
	public function get_user_date_data($start_date,$user_id,$timezoneoffset)
	{
		$this->db->select('a.user_id,a.ts_id,a.job_id,a.asset_id,a.timesheet_type,a.start_location,a.end_location,a.work_performed,a.parts_info,DATE_FORMAT(CONVERT_TZ(a.start_time, "+00:00", "'.$timezoneoffset.'"),"%Y-%m-%d %H:%i:%s") AS start_time, DATE_FORMAT(CONVERT_TZ(a.end_time, "+00:00", "'.$timezoneoffset.'"),"%Y-%m-%d %H:%i:%s") AS end_time,a.timesheet_type,a.description,b.customerid,c.email,c.first_name,c.last_name,d.job_type');
        $this->db->from($this->_timesheet.' a');
        $this->db->join($this->_customers.' b', 'a.site_id = b.id', 'LEFT');
        $this->db->join($this->tablename.' c', 'a.user_id = c.id', 'LEFT');
        $this->db->join($this->_jobs.' d', 'a.job_id = d.job_id', 'LEFT');    
        $this->db->where('a.user_id', $user_id);
		$this->db->where('DATE_FORMAT(DATE_FORMAT(CONVERT_TZ(a.start_time, "+00:00", "'.$timezoneoffset.'"),"%Y-%m-%d %H:%i"), "%Y-%m-%d") =',$start_date);
		$this->db->where('DATE_FORMAT(a.end_time, "%Y-%m-%d") !=', '0000-00-00 00:00:00');
		$this->db->where('a.timesheet_type >','0');
		$this->db->where('a.isdel',false);

        $query = $this->db->get();

        // return $this->db->last_query();
        return $query->result_array();	
	}
	

	public function convert_to_utctime($datetime,$timezone='')
	{


		if($timezone == '')
		{
			$timezone	=	'Australia/Sydney';
		}

		$timezone2	=	'UTC';

		if(DateTime::createFromFormat('Y-m-d H:i:s', $datetime) === FALSE)
		{
			$datetime		=	$datetime.' 23:59:00';
		}
		
		$date = new DateTime($datetime, new DateTimeZone($timezone));
		$date->setTimezone(new DateTimeZone('UTC'));
		return $date->format('Y-m-d H:i:s');
	}
        
    public function get_all_users()
	{
		$this->db->select("u.id, u.first_name, u.last_name", FALSE);
		$this->db->from($this->users.' u');
		$this->db->where('u.id >', 0);
		$query 			= $this->db->get();
		return $query->result_array();
	}
    private function _check_region_filter($column, $table)
	{
        $delimiter = '|';
        if(isset($_POST['columns']))
		{
            $column = $_POST['columns'][$column];
            if($column['search']['value'] != '')
			{                
				$col_name = $column['data'];               
               
                if(strpos($column['search']['value'], "$delimiter") !== false)
				{                   
					$data_val = explode("$delimiter", $column['search']['value']);
					
					$li = 0; 
					foreach($data_val as $vl)
					{
						if($li==0)
						{
							$this->datatables->like($table.".".$col_name,$vl);
						} 
						else 
						{
							$this->datatables->or_like($table.".".$col_name,$vl);
						}
						
						$li++;
					}                    
                }
				else
				{
                    $this->datatables->like($table.".".$col_name,$column['search']['value']);
                }
            }
        }
    }
	
	
	
	public function profile_list($user_id)
	{
		$this->datatables->select("'view', up.id as id, up.title, up.license_inclusion,up.include_recent_projects,  DATE_FORMAT(up.added_on,'%d/%m/%Y %H:%i') as added_on, up.profile_locked", FALSE);
		
		$this->datatables->edit_column('view','$1','profile_action(id,'.$user_id.',profile_locked)');
		
		$this->datatables->from($this->_users_profiles.' up');		
	
		$this->datatables->where('up.user_id', $user_id);
		$this->datatables->where('up.isdel', 0);
		$this->db->order_by('id','desc');
		// echo $this->db->last_query();die();
		return $this->datatables->generate('json', 'ISO-8859-1');
	}
	
	
	
	
	public function get_profile_data($id)
	{		
		$this->db->select("*", FALSE);
        $this->db->from($this->_users_profiles.' up');
        $this->db->where('up.id', $id);
        $query = $this->db->get();
        return $data = $query->row_array();	
	}
	
	
	public function get_profile_detail_data($id,$type='', $type_not_equal_to='')
	{		
		$this->db->select("*", FALSE);
        $this->db->from($this->_users_profiles_details.' upd');
		
		if($type!="")
		{
			$this->db->where('upd.type', $type);
		}
		
		if($type_not_equal_to!="")
		{
			$this->db->where('upd.type!=', $type_not_equal_to);
		}
		
        $this->db->where('upd.profile_id', $id);
        $this->db->where('upd.isdel', 0);
        $query = $this->db->get();
        return $data = $query->result_array();	
	}
	
	
	public function get_lock_profile_detail_data($id,$type='')
	{		
		$this->db->select("*", FALSE);
        $this->db->from($this->_users_profiles_locked_data.' upd');
		
		if($type!="")
		{
			$this->db->where('upd.type', $type);
		}
		
        $this->db->where('upd.profile_id', $id);
        $this->db->where('upd.isdel', 0);
        $query = $this->db->get();
        return $data = $query->result_array();	
	}
	
	
	
	
}
