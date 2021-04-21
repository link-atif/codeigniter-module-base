<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class WarehouseLoading extends MY_Controller 
{
    public function __construct() 
    {

        parent::__construct();
        $this->load->model('warehouseloading_model');
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
        $this->data['warehouse_containers_menu'] = 'opened'; 
        // $this->has_permission();

    }

    /*
     * 	Public Functions
     */
    public function index($filtertype = ""){
        // die;

        $this->data['title'] = "Warehouse Loading";
        $this->data['view'] = "warehouseloading/view";
        $this->data['success'] = $this->session->flashdata('success');
        $this->data['error'] = $this->session->flashdata('error');
        $this->data['sub'] = 'warehouseloading';
        $this->data['parent_menu'] = 'warehouseloading';
        $this->data['popups'] = array('warehouseloading/popup_teams');
        $this->data['warehouseloading'] = $this->warehouseloading_model->get_data();
        // debug($this->data['warehouseloading']); die;
        $this->load->view('layout/layout_admin', $this->data);
    }

    public function add()
    { 
        $this->data['success']  =   $this->session->flashdata('success');
        $this->data['error']    =   $this->session->flashdata('error');
        $userid = $user_id = $this->ion_auth->user()->row()->id;
        $this->data['title'] = "Add Warehouseloading";
        $this->data['view'] = "warehouseloading/add";
        $this->data['prevurl'] = $prevurl = $this->input->server('HTTP_REFERER', TRUE);
        $this->data['builty_numbers'] = $this->warehouseloading_model->get_builty_numbers();
        $this->data['cities'] = $this->warehouseloading_model->get_cities();
        if(isset($_POST) && !empty($_POST)){
            // debug($_POST); die;
            $data = $_POST;
            $data['added_by'] = $this->session->userdata('user_id');
            $data['added_on'] = date("Y-m-d h:i:s");
            $data['isdel'] = 0;
            // $this->form_validation->set_rules('delivery_type', 'delivery_type', 'trim|required');

            // if ($this->form_validation->run()){

                $this->warehouseloading_model->insert($data);
                redirect('addWarehouseLoading');
            //     $this->session->set_flashdata('success','Warehouse loading added successfully');
            // } else{
            //     $this->session->set_flashdata('error','Please put valid data in all required fields');
            // }
        }
        $this->data['devices']    =   $this->warehouseloading_model->get('devices',array("isdel"=>"0"));
        $this->data['countries']    =   $this->warehouseloading_model->get('countries',array("isdel"=>"0"));
        $this->data['users']    =   $this->warehouseloading_model->get('users',array("isdel"=>"0"));
        $this->data['success']  =   $this->session->flashdata('success');
        $this->data['error']    =   $this->session->flashdata('error');
        $this->load->view('layout/layout_admin', $this->data);
    }
    public function editWarehouseLoading($id)
    {
        $this->data['success']  =   $this->session->flashdata('success');
        $this->data['error']    =   $this->session->flashdata('error');
        $userid = $user_id = $this->ion_auth->user()->row()->id;
        $this->data['title'] = "Edit Warehouse Loading";
        $this->data['view'] = "warehouseloading/edit";
        $this->data['prevurl'] = $prevurl = $this->input->server('HTTP_REFERER', TRUE);
        $this->data['warehouseloading'] = $this->warehouseloading_model->get_data_by_id($id);
        
        if(isset($_POST) && !empty($_POST)){
            $data = $_POST;
            $data['added_by'] = $this->session->userdata('user_id');
            $data['added_on'] = date("Y-m-d h:i:s");
            $data['follow_up'] = date('Y-m-d',strtotime($data['follow_up']));
            // debug($data); die;
            $this->form_validation->set_rules('delivery_type', 'delivery_type', 'trim|required');

            if ($this->form_validation->run()){

                $this->dailyhistory_model->update($data,array("id"=>$id));
                $this->session->set_flashdata('success','DailyHistory added successfully');
            } else{
                $this->session->set_flashdata('error','Please put valid data in all required fields');
                $this->load->view('layout/layout_admin', $this->data);
            }
        }
        
        // debug($this->data['dailyhistory']); die;
        $this->data['success']  =   $this->session->flashdata('success');
        $this->data['error']    =   $this->session->flashdata('error');
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
    public function deleteWarehouseLoading(){

        $id = $_POST['record_id'];
        $this->warehouseloading_model->deleteWarehouseLoading($id);
        // echo 'success';
        redirect('viewWarehouseLoading');
    }
    public function restoreWarehouseLoading(){

        $id = $_POST['record_id'];
        $this->warehouseloading_model->restoreWarehouseLoading($id);
        echo 'success';
        redirect('viewWarehouseLoading');
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
    
}