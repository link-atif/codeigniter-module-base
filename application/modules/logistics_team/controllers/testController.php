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

        $this->data['title'] = "Damage And Builty Issues";
        $this->data['view'] = "damageandrongbuiltyissues/viewDamageAndBuiltyIssues";
        $this->data['success'] = $this->session->flashdata('success');
        $this->data['error'] = $this->session->flashdata('error');
        $this->data['sub'] = 'Damage And Builty Issues';
        $this->data['parent_menu'] = 'Damage And Builty Issues';
        $this->data['popups'] = array('damageandbuiltyissues/popup_teams');
        $this->data['damage_and_builty_issues'] = $this->damageandrongbuiltyissue_model->get_data();
        // debug($this->data['dailyhistory']); die;
        $this->load->view('layout/layout_admin', $this->data);
    }
    public function test(){
        echo 'yes';die();
    }
    public function addLogisticsTeam()
    {
        echo "string";die;
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
            // echo "<pre>";
            // print_r($data);
            // $this->form_validation->set_rules('email', 'email', 'required');

            // if ($this->form_validation->run()){
                // echo "done";die;
                $this->damageandrongbuiltyissue_model->insert($data);
                // redirect('/view_damage_and_builty_issues');
                // $this->session->set_flashdata('success','DailyReport added successfully');
            // } else{
                // $this->session->set_flashdata('error','Please put valid data in all required fields');
            // }
        }
        $this->data['success']  =   $this->session->flashdata('success');
        $this->data['error']    =   $this->session->flashdata('error');
        $this->load->view('layout/layout_admin', $this->data);
    }
    public function editDamageAndBuiltyIssue($id = ""){

        $damage_issue_id = $id;
        $this->data['title'] = "Edit Damage And Builty Issue";
        $this->data['view'] = "damageandrongbuiltyissues/editDamageAndBuiltyIssues";
        // $user_group = $this->session->userdata('user_group');

        if(isset($_POST) && !empty($_POST))
        {
            
            $data = $_POST;
            $this->damageandrongbuiltyissue_model->updateDamageAndBuiltyIssue($data,$damage_issue_id);   
            redirect('damageandrongbuiltyissues/index');
        }   
        
        $this->data['editdamageandbuiltyissue'] = $this->damageandrongbuiltyissue_model->editDamageAndBuiltyIssue($damage_issue_id);
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
    public function deleteDamageAndBuiltyIssue(){
        $id = $_POST['record_id'];
        $this->damageandrongbuiltyissue_model->deleteDamageAndBuiltyIssue($id);
        redirect('/view_damage_and_builty_issues');
        
    }
    public function restoreDamageAndBuiltyIssue(){

        $id = $_POST['record_id'];
        $this->damageandrongbuiltyissue_model->restoreDamageAndBuiltyIssue($id);
        redirect('/view_damage_and_builty_issues');
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