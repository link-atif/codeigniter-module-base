<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Categories extends MY_Controller 
{
    public function __construct() 
    {

        parent::__construct();
        $this->load->model('Categories_model');
        $this->load->dbutil();
        $this->load->helper('download');
        $this->load->helper('common_helper');
        $this->load->helper('language');
        $this->load->helper('datatables');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'string', 'file', 'download'));
        
        // For Opening Side Menu
        $this->data['category_menu'] = 'opened';
        $this->has_permission();
    }
    /*
     * 	Public Functions for Categories
     */
    public function index(){

        if(isset($_POST) && !empty($_POST)){
            $data = array();
            $data = $_POST;

            $this->form_validation->set_rules('cat_name', 'cat_name', 'trim|required|min_length[2]|max_length[30]');
            if ($this->form_validation->run()){
                if (!$this->Categories_model->cat_name_check($data['cat_name'])) {
                    $query = $this->Categories_model->save_category($data);
                    if($query){
                        $this->session->set_flashdata('success','Record added successfully');
                        redirect(site_url('categories'));

                    }else{
                        $this->session->set_flashdata('error','Something went wrong!');            
                    }
                }else{
                    $this->session->set_flashdata('error','Category name already exist!');            
                }
            }else{
                $this->session->set_flashdata('error','Something went wrong!');           
            }
            
        }
        $this->data['title'] = "Categories";
        $this->data['view']       = "categories/viewCategories";
        $this->data['categories'] = $this->Categories_model->get_categories();
        $this->load->view('layout/layout_admin', $this->data);
    }
    public function getCategoryById(){

        if(isset($_POST) && !empty($_POST)){
            $result = $this->Categories_model->get_category($_POST['cat_id']);
            $result = json_encode($result);
            echo $result;
        }
    }

    public function updateCategory(){

        if(isset($_POST) && !empty($_POST)){

            $this->form_validation->set_rules('cat_name', 'cat_name', 'trim|required|min_length[2]|max_length[30]');
            if ($this->form_validation->run()){

                if (!$this->Categories_model->cat_name_check($_POST['cat_name'])) {

                    $query = $this->Categories_model->update_category($_POST);
                    if($query){
                        $this->session->set_flashdata('success','Record added successfully!');
                        redirect(site_url('categories'), 'refresh');
                    }else{
                        $this->session->set_flashdata('error','Something went wrong!');
                    }
                    $this->session->set_flashdata('error','Something went wrong!');           

                }else{
                    $this->session->set_flashdata('error','Category name already exist!');
                    $this->session->set_flashdata('update_error_id',$_POST['cat_id']);
                    redirect(site_url('categories'));
                } 
            }
        }
    }
    public function deleteCategory(){

        if(isset($_POST) && !empty($_POST)){
            $del_id = $this->input->post("record_id");
            $query = $this->Categories_model->delete_category($del_id);
            $this->session->set_flashdata('success','Record deleted successfully');
            return $query;
        }
    }
    public function restoreCategory(){

        if(isset($_POST) && !empty($_POST)){
            $record_id = $this->input->post("record_id");
            $query = $this->Categories_model->restore_category($record_id);
            $this->session->set_flashdata('success','Record restored successfully');
            return $query;
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
    }
}