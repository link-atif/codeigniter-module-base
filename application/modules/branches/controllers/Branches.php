<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Branches extends MY_Controller 
{
    public function __construct() 
    {

        parent::__construct();
        $this->load->model('Branches_model');
        $this->load->model('Warehouse/Warehouse_model');
        $this->load->model('Countries/Countries_model');
        $this->load->dbutil();
        $this->load->helper('download');
        $this->load->helper('common_helper');
        $this->load->helper('language');
        $this->load->helper('datatables');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'string', 'file', 'download'));
        
        // For Opening Side Menu
        $this->data['branch_menu'] = 'opened';
    }
    /*
     * 	Public Functions for Categories
     */
    public function index(){
        
        $this->data['title'] = "Branches";
        $this->data['view'] = "branches/viewBranches";
        $this->data['branches'] = $this->Branches_model->get_branches();
        $this->data['warehouses'] = $this->Warehouse_model->get_warehouses();
        $this->data['countries'] = $this->Countries_model->get_countries();
        $this->load->view('layout/layout_admin', $this->data);
    }
    public function saveBranch(){

        if(isset($_POST) && !empty($_POST)){
            $data = array();
            $data = $_POST;

            $this->form_validation->set_rules('branch_name', 'branch_name', 'trim|required|min_length[2]|max_length[30]');
            if ($this->form_validation->run()){
                if (!$this->Branches_model->branch_name_check($data['branch_name'])) {
                    $query = $this->Branches_model->save_branch($data);
                     if($query){

                        $this->session->set_flashdata('success','Record added successfully');
                        redirect(site_url('branches'),'refresh');               
                    }else{
                        $this->session->set_flashdata('error','Something went wrong!');
                    }
                }else{
                    $this->session->set_flashdata('error','Branch name already exist!');
                }
            }else{
                $this->session->set_flashdata('error','Something went wrong!');
            }
        $this->data['view'] = "branches/viewBranches";
        $this->data['branches'] = $this->Branches_model->get_branches();
        $this->data['warehouses'] = $this->Warehouse_model->get_warehouses();
        $this->data['countries'] = $this->Countries_model->get_countries();
        $this->load->view('layout/layout_admin', $this->data);
        }
    }
    public function getBranchById(){

        if(isset($_POST) && !empty($_POST)){
            $result = $this->Branches_model->get_branch($_POST['branch_id']);

            $countries = $this->Countries_model->get_countries();
            $warehouses = $this->Warehouse_model->get_warehouses();
            $branches = $this->Branches_model->get_branches();
            $data_array =array('data' => $result,'countries' => $countries,'warehouses' => $warehouses,'branches' => $branches);
            $result = json_encode($data_array);
            echo $result;
        }
    }
    
    public function updateBranch(){

        if(isset($_POST) && !empty($_POST)){

            $this->form_validation->set_rules('branch_name', 'branch_name', 'trim|required|min_length[2]|max_length[30]');
            if ($this->form_validation->run()){

                    $query = $this->Branches_model->update_branch($_POST);
                     if($query){
                        $this->session->set_flashdata('success','Record updated successfully');
                        redirect(site_url('branches'));
                    }else{
                        $this->session->set_flashdata('update_error_id',$_POST['branch_id']);
                        $this->session->set_flashdata('error','Something went wrong!');
                        redirect(site_url('branches'));
                    }
            }
           
        }
    }

    public function deleteBranch(){

        if(isset($_POST) && !empty($_POST)){
            $del_id = $this->input->post("record_id");
            $query = $this->Branches_model->delete_branch($del_id);
            $this->session->set_flashdata('success','Record deleted successfully');

            return $query;
        }
    }
    public function restoreBranch(){

        if(isset($_POST) && !empty($_POST)){
            $record_id = $this->input->post("record_id");
            $query = $this->Branches_model->restore_branch($record_id);
            $this->session->set_flashdata('success','Record restored successfully');
            return $query;
        }
    }
    public function subBranches(){

        $this->data['title'] = "Branches";
        $this->data['view'] = "branches/viewSubBranches";
        $this->data['branches'] = $this->Branches_model->get_branches();
        $this->data['subbranches'] = $this->Branches_model->get_sub_branches();
        $this->load->view('layout/layout_admin', $this->data);
    }
    public function saveSubBranch(){

        if(isset($_POST) && !empty($_POST)){
            $data = array();
            $data = $_POST;
            $branch_data = $this->Branches_model->get_branch($_POST['branch_id']);
            $data['parent_id'] = $_POST['branch_id'];
            $data['branch_warehouse_id'] = $branch_data->branch_warehouse_id;
            $data['branch_country_id'] = $branch_data->branch_country_id;
            unset($data['branch_id']);

            $this->form_validation->set_rules('branch_name', 'branch_name', 'trim|required|min_length[2]|max_length[30]');
            if ($this->form_validation->run()){
                if (!$this->Branches_model->branch_name_check($data['branch_name'])) {
                    $query = $this->Branches_model->save_branch($data);
                     if($query){

                        $this->session->set_flashdata('success','Record added successfully');
                        redirect(site_url('subBranches'),'refresh');               
                    }else{
                        $this->session->set_flashdata('error','Something went wrong!');
                    }
                }else{
                    $this->session->set_flashdata('error','Branch name already exist!');
                }
            }else{
                $this->session->set_flashdata('error','Something went wrong!');
            }
           
        }
        $this->data['title'] = "Branches";
        $this->data['view'] = "branches/viewSubBranches";
        $this->data['branches'] = $this->Branches_model->get_branches();
        $this->data['subbranches'] = $this->Branches_model->get_sub_branches();
        $this->load->view('layout/layout_admin', $this->data);
    }
    public function updateSubBranch(){

        if(isset($_POST) && !empty($_POST)){
            $data = array();
            $data = $_POST;
            $branch_data = $this->Branches_model->get_branch($_POST['parent_id']);
            $data['parent_id'] = $_POST['parent_id'];
            $data['branch_warehouse_id'] = $branch_data->branch_warehouse_id;
            $data['branch_country_id'] = $branch_data->branch_country_id;

            $this->form_validation->set_rules('branch_name', 'branch_name', 'trim|required|min_length[2]|max_length[30]');
            if ($this->form_validation->run()){

                    $query = $this->Branches_model->update_branch($data);
                     if($query){
                        $this->session->set_flashdata('success','Record updated successfully');
                        redirect(site_url('subBranches'));
                    }else{
                        $this->session->set_flashdata('update_error_id',$_POST['branch_id']);
                        $this->session->set_flashdata('error','Something went wrong!');
                        redirect(site_url('subBranches'));
                    }
            }
           
        }
    }
    public function deleteSubBranch(){

        if(isset($_POST) && !empty($_POST)){
            $del_id = $this->input->post("record_id");
            $query = $this->Branches_model->delete_branch($del_id);
            $this->session->set_flashdata('success','Record deleted successfully');

            return $query;
        }
    }
    public function restoreSubBranch(){

        if(isset($_POST) && !empty($_POST)){
            $record_id = $this->input->post("record_id");
            $query = $this->Branches_model->restore_branch($record_id);
            $this->session->set_flashdata('success','Record restored successfully');
            return $query;
        }
    }
}