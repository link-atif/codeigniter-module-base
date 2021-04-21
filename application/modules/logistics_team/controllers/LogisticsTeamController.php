<?php
class LogisticsTeamController extends MY_Controller 
{
    public function __construct() 
    {

        parent::__construct();
        $this->load->model('logistics_team_model');
        $this->load->dbutil();
        $this->load->helper('download');
        $this->load->helper('common_helper');
        $this->load->helper('language');
        $this->load->helper('datatables');
        $this->load->library('form_validation');
        $this->load->library('datatables');
        $this->load->helper('datatables_helper');
        $this->load->helper(array('form', 'url', 'string', 'file', 'download'));
        $this->data['main_menu'] = 'users';
        $this->lang->load('users');

        if (!$this->ion_auth->logged_in()) 
        {
            redirect(site_url('home/logout'), 'refresh');
        }
        $logged_user_data 		= $this->ion_auth->user()->row();
        $this->logged_user_id 	= $logged_user_data->user_id;
        $user_group = $this->session->userdata('user_group'); 

        // For Opening Side Menu
        $this->data['logistics_team_menu'] = 'opened'; 
        // $this->has_permission();

    }

    /*
     * 	Public Functions for Users
     */
    public function index($filtertype = ""){

        $this->data['title'] = "KSL Logistics Operation Team";
        $this->data['view'] = "logistics_team/viewLogisticsTeam";
        $this->data['success'] = $this->session->flashdata('success');
        $this->data['error'] = $this->session->flashdata('error');
        $this->data['sub'] = 'KSL Logistics Operation Team';
        $this->data['parent_menu'] = 'KSL Logistics Operation Team';
        $this->data['popups'] = array('damageandbuiltyissues/popup_teams');
        $this->data['logistics_team'] = $this->logistics_team_model->get_data();
        // debug($this->data['dailyhistory']); die;
        $this->load->view('layout/layout_admin', $this->data);
    }
    
    public function addLogisticsTeam()
    {

        $this->data['success']  =   $this->session->flashdata('success');
        $this->data['error']    =   $this->session->flashdata('error');
        $userid = $user_id = $this->ion_auth->user()->row()->id;
        $this->data['title'] = "Add Logistics Team";
        $this->data['view'] = "logistics_team/addLogisticsTeam";
        $this->data['prevurl'] = $prevurl = $this->input->server('HTTP_REFERER', TRUE);

        if(isset($_POST) && !empty($_POST)){
            // debug($_POST); die;

            $data = $_POST;
            $data['added_by'] = $this->session->userdata('user_id');
            $data['added_on'] = date("Y-m-d h:i:s");
            $data['isdel'] = 0;
            
            $this->logistics_team_model->insert($data);
            redirect('logistics_team/LogisticsTeamController/addLogisticsTeam');

        }
        $this->data['success']  =   $this->session->flashdata('success');
        $this->data['error']    =   $this->session->flashdata('error');
        $this->load->view('layout/layout_admin', $this->data);
    }
    public function editLogisticsTeam($id = ""){

        $logistics_team_id = $id;
        $this->data['title'] = "Edit Logistics Team";
        $this->data['view'] = "logistics_team/editLogisticsTeam";
        // $user_group = $this->session->userdata('user_group');

        if(isset($_POST) && !empty($_POST))
        {
            
            $data = $_POST;
            $this->logistics_team_model->updateLogisticsTeam($data,$logistics_team_id);   
            redirect('logistics_team/LogisticsTeamController/index');
        }   
        
        $this->data['editlogisticsteam'] = $this->logistics_team_model->editLogisticsTeam($logistics_team_id);
        $this->load->view('layout/layout_admin', $this->data);
    }
    public function viewUserDetail($id) {

        $this->data['success'] = $this->session->flashdata('success');
        $this->data['error'] = $this->session->flashdata('error');
        $this->data['title'] = "View User";
        $this->data['view'] = "users/userDetail";

        $this->data['user'] = $this->users_model->get_user_data($id);

        $this->data['user_data']    = $this->ion_auth->user($id)->row();
        $this->data['user_group_id'] = $this->session->userdata('user_group');
        $this->data['user_id'] = $id;        
        $this->load->view('layout/layout_admin', $this->data);
    }
    public function deleteLogisticsTeam(){
        $id = $_POST['record_id'];
        $this->logistics_team_model->deleteLogisticsTeam($id);
        redirect('logistics_team/LogisticsTeamController/index');
        
    }
    public function restoreLogisticsTeam(){

        $id = $_POST['record_id'];
        $this->logistics_team_model->restoreLogisticsTeam($id);
        redirect('logistics_team/LogisticsTeamController/index');
        // $param['isdel'] = '0';
        // $this->db->where('id',$id);
        // $this->db->update('daily_hoistory',$param);
        // echo 'success';
    }
    private function has_permission(){

        $controller = $this->data['controller'];
        $action = $this->data['action'];
        $role_ids_array = $this->data['role_ids_array'];

        if($this->acl_model->has_permission($controller,$action,$role_ids_array) !== TRUE){
            $this->session->set_flashdata('error','Not Authorized!');
            redirect('/dashboard');
        }
    }
    public function get_profile_info($id){
        $data   =   $this->users_model->get_data($id);
        $groups   =   $this->users_model->get_groups_data($id);
        $respons = array_merge($data,$groups);
        $groups_data[0]   =   $this->users_model->get_users_groups();
        $response = array_merge($respons,$groups_data);
        echo json_encode($response);
    }
}