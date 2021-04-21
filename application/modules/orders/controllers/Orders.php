<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Orders extends MY_Controller 
{
    public function __construct() 
    {

        parent::__construct();
        $this->load->model('orders_model');
        $this->load->dbutil();
        $this->load->helper('download');
        $this->load->helper('common_helper');
        $this->load->helper('language');
        $this->load->library('form_validation');
        $this->load->library('datatables');
        $this->load->helper('datatables_helper');
        $this->load->helper(array('form', 'url', 'string', 'file', 'download'));
        $this->data['main_menu'] = 'orders';

        if (!$this->ion_auth->logged_in()) 
        {
            redirect(site_url('home/logout'), 'refresh');
        }
        $logged_user_data 		= $this->ion_auth->user()->row();
        $this->logged_user_id 	= $logged_user_data->user_id;
        $user_group = $this->session->userdata('user_group');       
    }

    /*
     * 	Public Functions for orders
     */
    public function index($filtertype = ""){

        $this->data['title'] = "Orders";
        $this->data['view'] = "orders/index";
        $this->data['success'] = $this->session->flashdata('success');
        $this->data['error'] = $this->session->flashdata('error');
        $this->data['sub'] = 'orders';
        $this->data['parent_menu'] = 'orders';
        $this->data['popups'] = array('orders/popup_orders');
        $this->load->view('layout/layout_admin', $this->data);
    }
    public function add()
    {
        $this->data['success']  =   $this->session->flashdata('success');
        $this->data['error']    =   $this->session->flashdata('error');
        $userid = $user_id = $this->ion_auth->user()->row()->id;
        $this->data['title'] = "Add Order";
        $this->data['view'] = "orders/addOrder";
        $this->data['shipment_modes'] = $this->orders_model->get_shipment_modes();
        $this->data['prevurl'] = $prevurl = $this->input->server('HTTP_REFERER', TRUE);

        if(isset($_POST) && !empty($_POST)){
            $orders = $order_detail =   array();
            $orders['added_on']     =   $this->input->post('order_date');
            $orders['order_destination']      =   $this->input->post('order_destination');
            $orders['order_destination_latitude']  =   $this->input->post('order_destination_latitude');
            $orders['order_destination_longitude'] =   $this->input->post('order_destination_longitude');
            $orders['order_total_pcs']             =   $this->input->post('order_total_pcs');
            $orders['order_total_weight']          =   $this->input->post('order_total_weight');
            $orders['order_tracking_number']       =   $this->input->post('order_tracking_number');
            $orders['shipper_name']                =   $this->input->post('shipper_name');
            $orders['shipper_address']      =   $this->input->post('shipper_address');
            $orders['shipper_latitude']      =   $this->input->post('shipper_address_lat');
            $orders['shipper_longitude  ']      =   $this->input->post('shipper_address_long');
            $orders['shipper_customer_trn']      =   $this->input->post('shipper_customer_trn');
            $orders['shipper_phone']      =   $this->input->post('shipper_phone');
            $orders['reciever_name']      =   $this->input->post('reciever_name');
            $orders['reciever_address']      =   $this->input->post('reciever_address');
            $orders['reciever_latitude']      =   $this->input->post('reciever_address_lat');
            $orders['reciever_longitude']      =   $this->input->post('reciever_address_long');
            $orders['reciever_phone']      =   $this->input->post('reciever_phone');
            $orders['shipment_mode']      =   $this->input->post('shipment_mode');
            $orders['user_id']      =   $this->input->post('user_id');
            $orders['order_amount']      =   $this->input->post('order_amount');
            $orders['document_fees']      =   $this->input->post('document_fees');
            $orders['insurance']      =   $this->input->post('insurance');
            $orders['packing_charges']      =   $this->input->post('packing_charges');
            $orders['transportation_charges']      =   $this->input->post('transportation_charges');
            $orders['total_vat']      =   $this->input->post('total_vat');
            $orders['grand_total']      =   $this->input->post('grand_total');
            $orders['boxes']      =   array_filter(implode(',', $this->input->post('boxes')));

            $result = $this->orders_model->insert('orders',$orders);
            if (@$result['status'] == "success") {
                $order_id      =   $result['insert_id'];
                $item_name      =   $this->input->post('item_name');
                $item_weight      =   $this->input->post('item_weight');
                $item_freight      =   $this->input->post('item_freight');
                $item_vat      =   $this->input->post('item_vat');
                $item_price      =   $this->input->post('item_price');
                $salesman      =   $this->input->post('salesman');
                foreach ($item_name as $key => $value) {
                    $order_detail['order_id']      =   $order_id;
                    $order_detail['item_name']      =   $item_name[$key];
                    $order_detail['item_weight']      =   $item_weight[$key];
                    $order_detail['item_freight']      =   $item_freight[$key];
                    $order_detail['item_vat']      =   $item_vat[$key];
                    $order_detail['item_price']      =   $item_price[$key];
                    $result_detail = $this->orders_model->insert('orders_detail',$order_detail);
                }
                $this->session->set_flashdata('success', 'Order Generated successfully');
            } else{
                $this->session->set_flashdata('error', 'Order Not Generated');
            }
        }
        $this->data['success']  =   $this->session->flashdata('success');
        $this->data['error']    =   $this->session->flashdata('error');
        //set the flash data error success if there is one
        $this->data['groups'] = $groups = $this->ion_auth->groups()->result();
        $this->load->view('layout/layout_admin', $this->data);
    }
    public function viewOrders(){
        $this->data['orders'] = $this->orders_model->get_all_orders();
        // debug($this->data['orders']); die;
        $this->data['view'] = "orders/viewOrders";
        $this->load->view('layout/layout_admin', $this->data);
    }    
    public function editOrder($id = ""){
        $this->data['title'] = "View user";
        $this->data['view'] = "orders/editUser";
        $user_group = $this->session->userdata('user_group');
        if(isset($_POST) && !empty($_POST))
        {
            $orders = $order_detail =   array();
            $orders['order_date']     =   $this->input->post('order_date');
            $orders['order_destination']      =   $this->input->post('order_destination');
            $orders['order_destination_latitude']          =   $this->input->post('order_destination_latitude');
            $orders['order_destination_longitude']          =   $this->input->post('order_destination_longitude');
            $orders['order_total_pcs']        =   $this->input->post('order_total_pcs');
            $orders['order_total_weight']       =   $this->input->post('order_total_weight');
            $orders['tracking_number']      =   $this->input->post('tracking_number');
            $orders['shipper_name']      =   $this->input->post('shipper_name');
            $orders['shipper_address']      =   $this->input->post('shipper_address');
            $orders['shipper_address_lat']      =   $this->input->post('shipper_address_lat');
            $orders['shipper_address_long']      =   $this->input->post('shipper_address_long');
            $orders['shipper_customer_trn']      =   $this->input->post('shipper_customer_trn');
            $orders['shipper_phone']      =   $this->input->post('shipper_phone');
            $orders['reciever_name']      =   $this->input->post('reciever_name');
            $orders['reciever_address']      =   $this->input->post('reciever_address');
            $orders['reciever_address_lat']      =   $this->input->post('reciever_address_lat');
            $orders['reciever_address_long']      =   $this->input->post('reciever_address_long');
            $orders['reciever_phone']      =   $this->input->post('reciever_phone');
            $orders['shipment_mode']      =   $this->input->post('shipment_mode');
            $orders['salesman']      =   $this->input->post('salesman');
            $orders['order_amount']      =   $this->input->post('order_amount');
            $orders['document_fees']      =   $this->input->post('document_fees');
            $orders['insurance']      =   $this->input->post('insurance');
            $orders['packing_charges']      =   $this->input->post('packing_charges');
            $orders['transportation_charges']      =   $this->input->post('transportation_charges');
            $orders['total_vat']      =   $this->input->post('total_vat');
            $orders['grand_total']      =   $this->input->post('grand_total');
            $result = $this->orders_model->insert('orders',$orders);
            debug($result);
            die('check it');
            $order_detail['order_id']      =   $order_id;
            $order_detail['item_name']      =   $this->input->post('item_name');
            $order_detail['item_weight']      =   $this->input->post('item_weight');
            $order_detail['item_freight']      =   $this->input->post('item_freight');
            $order_detail['item_vat']      =   $this->input->post('item_vat');
            $order_detail['item_price']      =   $this->input->post('item_price');
            $order_detail['boxes']      =   $this->input->post('boxes');
            $order_detail['salesman']      =   $this->input->post('salesman');


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
                    redirect(site_url('orders/save_data/').$id, 'refresh');
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
                    $this->orders_model->update_user($id,$data);
                    if (!in_array('4', $user_group)) {
                        $this->orders_model->update_user_type($id,$user_role);
                    }
                    $this->session->set_flashdata('success','Updated successfully');
                }
            }else{
                $this->session->set_flashdata('error', validation_errors());
                $data   =   $this->orders_model->get_data($id);
                $groups   =   $this->orders_model->get_groups_data($id);
                foreach ($groups as $key => $group_data) {
                    $user_groups_data['groups_data'][$key] = $group_data['group_id']; 
                }
                $respons = array_merge($data,$user_groups_data);
                $groups_data['user_groups']   =   $this->orders_model->get_orders_groups();
                $response = array_merge($respons,$groups_data);
                $this->data['post'] = $response;
                return $this->load->view('layout/layout_admin', $this->data);
            }
            redirect(site_url('userDetail/').$id, 'refresh');
        }   
        $data = $this->orders_model->get_data($id);
        $groups = $this->orders_model->get_groups_data($id);

        foreach ($groups as $key => $group_data) {
            $user_groups_data['groups_data'][$key] = $group_data['group_id']; 
        }

        $respons = array_merge($data,$user_groups_data);
        $groups_data['user_groups']   =   $this->orders_model->get_orders_groups();
        $response = array_merge($respons,$groups_data);
        $this->data['post'] = $response;

        $this->load->view('layout/layout_admin', $this->data);
    }
    public function viewUserDetail($id) {

        $this->data['success'] = $this->session->flashdata('success');
        $this->data['error'] = $this->session->flashdata('error');
        $this->data['title'] = "View User";
        $this->data['view'] = "orders/userDetail";

        $this->data['user'] = $this->orders_model->get_user_data($id);

        $this->data['user_data']    = $this->ion_auth->user($id)->row();
        $this->data['user_group_id'] = $this->session->userdata('user_group');
        $this->data['user_id'] = $id;        
        $this->load->view('layout/layout_admin', $this->data);
    }
    public function deleteUser(){

        $user_id = $_POST['record_id'];
        $param['isdel'] = '1';
        $this->db->where('id',$user_id);
        $this->db->update('orders',$param);
        echo 'success';
    }

}