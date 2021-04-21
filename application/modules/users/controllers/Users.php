<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends MY_Controller 
{
    public function __construct() 
    {

        parent::__construct();
        $this->load->model('users_model');
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
        $this->data['users_menu'] = 'opened'; 
        $this->has_permission();
            
    }

    /*
     * 	Public Functions for Users
     */
    public function index($filtertype = ""){

        $this->data['title'] = "Users";
        $this->data['view'] = "users/index";
        $this->data['ajax_url'] = site_url('users/ecs_staff_list');
        $this->data['tab_ajax_url'] = site_url('users/tab_ecs_staff_list/'.$filtertype);
        $this->data['success'] = $this->session->flashdata('success');
        $this->data['error'] = $this->session->flashdata('error');
        $this->data['sub'] = 'users';
        $this->data['parent_menu'] = 'Users';
        $this->data['popups'] = array('users/popup_users');
        $this->load->view('layout/layout_admin', $this->data);
    }
    public function viewUser(){
        $this->db->where('isdel','0');
        $this->db->order_by('id','desc');
        $this->data['users'] = $this->db->get('users');
        $this->data['view'] = "users/viewUser";
        $this->load->view('layout/layout_admin', $this->data);
    }    
    public function addUser()
    {
        $this->data['success']  =   $this->session->flashdata('success');
        $this->data['error']    =   $this->session->flashdata('error');
        $userid = $user_id = $this->ion_auth->user()->row()->id;
        $this->data['title'] = "Add User";
        $this->data['view'] = "users/addUser";
        $this->data['prevurl'] = $prevurl = $this->input->server('HTTP_REFERER', TRUE);

        if(isset($_POST) && !empty($_POST)){

            $first_name = $this->input->post("first_name");
            $last_name = $this->input->post("last_name");
            $emailAddress = $this->input->post("emailAddress");
            $password = $this->input->post("password");
            $workPhone = $this->input->post("workPhone");
            $address = $this->input->post("address");
            $latitude = $this->input->post("latitude");
            $longitude = $this->input->post("longitude");
            $group_id = $this->input->post("user_type");

            $this->form_validation->set_rules('first_name', 'first_name', 'trim|required|min_length[2]|max_length[30]');
            $this->form_validation->set_rules('last_name', 'last_name', 'trim|required|min_length[2]|max_length[30]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[15]|matches[repeatPassword]');
            $this->form_validation->set_rules('repeatPassword', 'Repeat Password', 'trim|required|min_length[5]|max_length[15]');
            $this->form_validation->set_rules('emailAddress', 'Email Address already exist.', 'trim|required|valid_email|max_length[75]|is_unique[users.email]'); 
            $this->form_validation->set_rules('workPhone', 'Phone Number already exist.', 'trim|required|max_length[15]|is_unique[users.phone]');          
            $this->form_validation->set_rules('address', 'address', 'trim|required');           
            $this->form_validation->set_rules('latitude', 'latitude', 'trim|required');           
            $this->form_validation->set_rules('longitude', 'longitude', 'trim|required');  
            // $this->form_validation->set_rules('user_type', 'User group', 'required');  
            // $this->form_validation->set_rules('check_user_type', 'User Type','callback_check_user_type');

            if ($this->form_validation->run()){
                // print_r($this->ion_auth->username_check($emailAddress));
                // die('yes');
                if (!$this->ion_auth->username_check($emailAddress)) {

                    $additional_data = array(
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'parent_id' => $this->session->userdata('user_id'),
                        'phone' => $workPhone,
                        'address' => $address,
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                        'active' => 0,
                        'added_on' => date("Y-m-d H:i:s")
                    );

                    $successmg = 'User added successfully';
                    if ($password != '')
                    {
                        $additional_data['last_password_changed'] = date('Y-m-d');
                    }
                    $user_row_data    =    $this->ion_auth->user()->row();
                    $api_check = 'false';
                    $group = $group_id;

                    $id = $this->ion_auth->register($emailAddress, $password, $first_name,$last_name, $additional_data,$api_check,$group);

                    $this->users_model->update_user_status($id);
                    if ($id) 
                    {

                        if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) 
                        {
                            $config['upload_path'] = './assets/profile_pics/';
                            $config['allowed_types'] = 'gif|jpg|png|jpeg';
                            $config['file_name'] = time()."_".$_FILES['image']['name'];
                            $this->load->library('upload', $config);
                            if (!$this->upload->do_upload('image')) {

                                $error = $this->upload->display_errors();
                                $this->session->set_flashdata('img_error', $error);

                                redirect(site_url('users/add'), 'refresh');

                                die();
                            } else {
                                $file_data = $this->upload->data();
                                $data['image'] = $file_data['file_name'];
                                $this->users_model->update_user_profile($id,$data);
                            }
                        }
                        $data_array = array();
                        //send mail
                        $subject = 'New user registered in client portal';
                        $data['name'] =  $first_name.' '.$last_name;
                        $data['username'] = $emailAddress;
                        $data['password'] = $password;
                        $identity = $this->ion_auth->where('email', strtolower($emailAddress))->users()->row();
                        $this->session->set_flashdata('success','User added successfully');
                        // die('success');
                        // redirect(site_url('users/user_view') . '/' . $id . '/contact_details', 'refresh');
                        redirect(site_url('viewUser'));
                    }else {
                        $this->session->set_flashdata(
                            'error', 'Error in data'
                        );
                    }
                } else {
                    $this->session->set_flashdata('error', 'Username / Email address already exists');
                }
            } else{
                $this->session->set_flashdata('error','Please put valid data in all required fields');
            }
        }
        $this->data['success']  =   $this->session->flashdata('success');
        $this->data['error']    =   $this->session->flashdata('error');
        //set the flash data error success if there is one
        $this->data['groups'] = $groups = $this->ion_auth->groups()->result();
        $this->load->view('layout/layout_admin', $this->data);
    }
    public function editUser($id = ""){

        $this->data['title'] = "View user";
        $this->data['view'] = "users/editUser";
        $user_group = $this->session->userdata('user_group');

        if(isset($_POST) && !empty($_POST))
        {
            $data                   =   array();
            $id                     =   $_POST['id'];
            $data['first_name']     =   $_POST['first_name'];
            $data['last_name']     =   $_POST['last_name'];
            $data['email']          =   $_POST['email'];
            $data['phone']          =   $_POST['phone'];
            $data['address']        =   $_POST['address'];
            $data['latitude']       =   $_POST['latitude'];
            $data['longitude']      =   $_POST['longitude'];

            if($_POST['new_password'] != ""){
                $data['password']      =   $this->ion_auth_model->hash_password($_POST['new_password']);
            }
            $data['updated_on']     =   date('yy-m-d h:m:s');
            if (!in_array('4', $user_group)) {
                $user_role['group_id']  =   $_POST['user_type'];
            }
            if(isset($_FILES['image']) && $_FILES['image']['tmp_name']!=''){
                $config['upload_path'] = './assets/profile_pics/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['file_name'] = time()."_".$_FILES['image']['name'];
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('image')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('img_error', $error);
                    redirect(site_url('users/save_data/').$id, 'refresh');
                    die();
                } else {
                    $file_data = $this->upload->data();
                    $data['image'] = $file_data['file_name'];
                }
            }
            $this->form_validation->set_rules('first_name','first_name','required');
            $this->form_validation->set_rules('last_name','last_name','required');
            $this->form_validation->set_rules('phone','Phone','required');
            // $this->form_validation->set_rules('user_type', 'User Type','callback_check_user_type');
            if($this->form_validation->run()) { 

                if($id > 0){         
                    $this->users_model->update_user($id,$data);
                    if (!in_array('4', $user_group)) {
                        $this->users_model->update_user_type($id,$user_role);
                    }
                    $this->session->set_flashdata('success','Updated successfully');
                }
            }else{
                $this->session->set_flashdata('error', validation_errors());
                $data   =   $this->users_model->get_data($id);
                $groups   =   $this->users_model->get_groups_data($id);
                foreach ($groups as $key => $group_data) {
                    $user_groups_data['groups_data'][$key] = $group_data['group_id']; 
                }
                $respons = array_merge($data,$user_groups_data);
                $groups_data['user_groups']   =   $this->users_model->get_users_groups();
                $response = array_merge($respons,$groups_data);
                $this->data['post'] = $response;
                return $this->load->view('layout/layout_admin', $this->data);
            }
            redirect(site_url('userDetail/').$id);
        }   
        $data = $this->users_model->get_data($id);
        $groups = $this->users_model->get_groups_data($id);

        foreach ($groups as $key => $group_data) {
            $user_groups_data['groups_data'][$key] = $group_data['group_id']; 
        }

        $respons = array_merge($data,$user_groups_data);
        $groups_data['user_groups']   =   $this->users_model->get_users_groups();
        $response = array_merge($respons,$groups_data);
        $this->data['post'] = $response;

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
    public function deleteUser(){

        $user_id = $_POST['record_id'];
        $param['isdel'] = '1';
        $this->db->where('id',$user_id);
        $this->db->update('users',$param);
        echo 'success';
    }
    public function activeUserAccount(){

        if(isset($_POST) && !empty($_POST))
        {
            $user_id = $_POST['user_id'];
            $result = $this->users_model->active_user_account($user_id);
            if($result){
                $this->session->set_flashdata('success','Account activated successfully');
                echo 'success';
            }else{
                echo 'fail';
            }
        }
    }    
    public function deactiveUserAccount(){

        if(isset($_POST) && !empty($_POST))
        {
            $user_id = $_POST['user_id'];
            $result = $this->users_model->deactive_user_account($user_id);
            if($result){
                $this->session->set_flashdata('success','Account deactivated successfully');
                echo 'success';
            }else{
                echo 'fail';
            }
        }
    }
    private function has_permission(){

        $controller = $this->data['controller'];
        $action = $this->data['action'];
        $role_ids_array = $this->data['role_ids_array'];

        if($this->acl_model->has_permission($controller,$action,$role_ids_array) !== TRUE){
            $this->session->set_flashdata('error','Not Authorized!');
            redirect('/dashboard');
        }
    public function get_profile_info($id){
        $data   =   $this->users_model->get_data($id);
        $groups   =   $this->users_model->get_groups_data($id);
        $respons = array_merge($data,$groups);
        $groups_data[0]   =   $this->users_model->get_users_groups();
        $response = array_merge($respons,$groups_data);
        echo json_encode($response);
    }
    public function save_profile_info($id = ""){
        $this->data['title'] = "View user";
        $this->data['view'] = "users/viewUser";
        if(isset($_POST) && !empty($_POST))
        {
            $data                   =   array();
            $id                     =   $this->input->post('user_id');
            $data['username']       =   $this->input->post('name');
            $data['email']          =   $this->input->post('email');
            $data['phone']          =   $this->input->post('phone');
            $data['address']        =   $this->input->post('address');
            $current_url            =   $this->input->post('current_url');
            if($this->input->post('new_password') != ""){
                $data['password']      =   $this->ion_auth_model->hash_password($this->input->post('new_password'));
            }
            $data['updated_on']     =   date('Y-m-d h:m:s');
            if(isset($_FILES['image']) && $_FILES['image']['tmp_name']!=''){
                $config['upload_path'] = './assets/profile_pics/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['file_name'] = time()."_".$_FILES['image']['name'];
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('image')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error',$error);
                    echo '<script>window.location.href="'.$current_url.'";</script>';
                    die();
                } else {
                    $file_data = $this->upload->data();
                    $data['image'] = $file_data['file_name'];
                }
            }
            $this->form_validation->set_rules('name','Name','required');
            $this->form_validation->set_rules('phone','Phone','required');
            if($this->form_validation->run()) { 
                $id = $this->session->userdata('user_id');
                $qry = $this->users_model->update_user($id,$data);
                $this->session->set_flashdata('success','Profile Updated successfully');
            }else{
                $this->session->set_flashdata('error', validation_errors());
            }
            echo '<script>window.location.href="'.$current_url.'";</script>';
        }   
        $this->load->view('layout/layout_admin', $this->data);
    }

}