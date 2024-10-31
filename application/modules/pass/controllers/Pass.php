<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pass extends Backend_Controller {

	public function __construct(){
      parent::__construct();

      $this->data['module_title'] = 'Pass';
      $this->load->model('Pass_model');

      if(!$this->ion_auth->logged_in()){
         redirect('login');
      }elseif(!($this->ion_auth->is_admin() || $this->ion_auth->is_sec_admin() || $this->ion_auth->is_ps_admin() || $this->ion_auth->is_po_admin())){
         return show_error('You must be an administrator to view this page.');
      }
   }

   public function all($offset=0){

      $limit = 50;
      $results = $this->Pass_model->get_pass($limit, $offset);
      // print_r($results); exit;

      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('pass/all/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

      //Load page
      $this->data['meta_title'] = 'All Pass';
      $this->data['subview'] = 'all';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function request_list($offset=0){

      $limit = 50;
      $results = $this->Pass_model->get_pass($limit, $offset, '0');
      // print_r($results); exit;

      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('pass/request_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

      //Load page
      $this->data['meta_title'] = 'Request Pass List';
      $this->data['subview'] = 'request_list';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function complete_list($offset=0){

      $limit = 50;
      $results = $this->Pass_model->get_pass($limit, $offset, 3);
      // print_r($results); exit;

      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('pass/complete_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

      //Load page
      $this->data['meta_title'] = 'Complete Pass List';
      $this->data['subview'] = 'complete_list';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function approve_list($offset=0){

      $limit = 50;
      $results = $this->Pass_model->get_pass($limit, $offset, 1);
      // print_r($results); exit;

      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('pass/approve_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

      //Load page
      $this->data['meta_title'] = 'Approve Pass List';
      $this->data['subview'] = 'approve_list';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function reject_list($offset=0){

      $limit = 50;
      $results = $this->Pass_model->get_pass($limit, $offset, 2);
      // print_r($results); exit;

      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('pass/reject_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

      //Load page
      $this->data['meta_title'] = 'Reject Pass List';
      $this->data['subview'] = 'reject_list';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function create(){
      // validate form input
      $this->form_validation->set_rules('host_id', 'host name', 'required');
      $this->form_validation->set_rules('name', 'name', 'required');
      $this->form_validation->set_rules('mobile_no', 'mobile no', 'required');

      if ($this->form_validation->run() == true){
         $form_data = array(
            'host_id'   => $this->input->post('host_id'),
            'name'      => $this->input->post('name'),
            'mobile_no' => $this->input->post('mobile_no'),
            'email'     => $this->input->post('email'),
            'created'   => date('Y-m-d H:i:s')
            );

         // print_r($form_data); exit;
         if($this->Common_model->save('pass', $form_data)){
            $this->session->set_flashdata('success', 'New data insert successfully.');
            redirect('pass/all');
         }
      }

      // Dropdown
      $this->data['host_persons'] = $this->Pass_model->get_dd_host_persons();

      // Load View
      $this->data['meta_title'] = 'Create Pass';
      $this->data['subview'] = 'create_pass';
      $this->load->view('backend/_layout_main', $this->data);        
   }

   public function complete($id){
      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('pass', 'id', $dataID)) { 
         show_404('pass - complete - exitsts', TRUE);
      }

      if ($dataID){         
         $this->Common_model->edit('pass', $dataID, 'id', array('status' => 3));
         $this->session->set_flashdata('success', 'Pass complete.');
      }
      redirect('pass/complete_list');
   }

   public function approve($id){
      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('pass', 'id', $dataID)) { 
         show_404('pass - approve - exitsts', TRUE);
      }

      $info = $this->Pass_model->get_info($dataID); 
      if($info->user_id){
         $name = $info->first_name;
         $number = $info->phone;
      }else{
         $name = $info->name;
         $number = $info->mobile_no;
      }

      if ($dataID){         
         $this->Common_model->edit('pass', $dataID, 'id', array('status' => 1));
         $mobile = '+88'.$number;
         $message = 'Dear '.$name.', Your pass request accepted with '.$info->host_name.'. Pass ID: '.sprintf("%04d", $dataID).' Thank You!';
         $this->send_sms($mobile, $message);
         $this->session->set_flashdata('success', 'Approve the pass request.');
      }
      redirect('pass/request_list');
   }

   public function reject($id){
      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('pass', 'id', $dataID)) { 
         show_404('pass - reject - exitsts', TRUE);
      }

      if ($dataID){
         $this->Common_model->edit('pass', $dataID, 'id', array('status' => 2));
         $this->session->set_flashdata('success', 'Reject the pass request.');
      }
      redirect('pass/reject_list');
   }



   /******************** Host Person *********************/
   public function host_person(){
      // set the flash data error message if there is one
      $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

      //list the users
      $this->data['results'] = $this->Pass_model->get_host_person();

      //Load page
      $this->data['meta_title'] = 'Host Person';
      $this->data['subview'] = 'host_person';
      $this->load->view('backend/_layout_main', $this->data);
   }


   public function add_host_person(){
      // validate form input
      $this->form_validation->set_rules('host_name', 'host name', 'required');

      if ($this->form_validation->run() == true){
         $form_data = array(
            'host_name'         => $this->input->post('host_name'),
            'host_designation'  => $this->input->post('host_designation')
            );

         // print_r($form_data); exit;
         if($this->Common_model->save('host_person', $form_data)){
            $this->session->set_flashdata('success', 'New data insert successfully.');
            redirect('pass/host_person');
         }
      }

      // Load View
      $this->data['meta_title'] = 'Add Host Person';
      $this->data['subview'] = 'add_host_person';
      $this->load->view('backend/_layout_main', $this->data);        
   }

   // create a new Task Register
   public function edit_host_person($id){
      $this->form_validation->set_rules('host_name', 'host name', 'required');

      if ($this->form_validation->run() == true){
         $form_data = array(
            'host_name'         => $this->input->post('host_name'),
            'host_designation'  => $this->input->post('host_designation')
            );

         // print_r($form_data); exit;
         if($this->Common_model->edit('host_person', $id, 'id', $form_data)){
            $this->session->set_flashdata('success', 'Information update successfully.');
            redirect('pass/host_person');                
         }
      }

      // Result
      $this->data['info'] = $this->Pass_model->get_host_person_info($id);

      // Load View
      $this->data['meta_title'] = 'Edit Host Person';
      $this->data['subview'] = 'edit_host_person';
      $this->load->view('backend/_layout_main', $this->data);        
   }

   function send_sms($mobile, $message){
      $api_key = "C20019945dde54c4697d80.43761214";
      $contacts = $mobile;
      $senderid = '8804445629106';
      $sms = $message;

      $URL = "http://sms.nanoitworld.com/smsapi?api_key=".urlencode($api_key)."&type=text&contacts=".urlencode($contacts)."&senderid=".urlencode($senderid)."&msg=".urlencode($sms);

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,$URL);
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
      curl_setopt($ch, CURLOPT_POST, 0);
      try{
         $output = $content=curl_exec($ch);
        // print_r($output);
      }catch(Exception $ex){
         $output = "-100";
      }
      return $output; 
   }

}