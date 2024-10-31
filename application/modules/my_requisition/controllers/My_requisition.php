<?php defined('BASEPATH') OR exit('No direct script access allowed');

class My_requisition extends Backend_Controller {
   var $userID;

   public function __construct(){
      parent::__construct();

      if (!$this->ion_auth->logged_in()):
         redirect('login');
      endif;

      $this->data['module_name'] = 'My Requisition';
      $this->load->model('My_requisition_model');
      $this->userSessID = $this->session->userdata('user_id');
   }

   public function index($offset=0){
      $limit = 25;
      $results = $this->My_requisition_model->get_my_requisition($limit, $offset); 
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('my_requisition/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      // Load view
      $this->data['meta_title'] = 'My Requisition List';
      $this->data['subview'] = 'index';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function create(){
      $fiscal_year = $this->Common_model->get_current_fiscal_year();
      $this->data['fiscal_year'] = $fiscal_year->fiscal_year_name;
      
      //Validation
      $this->form_validation->set_rules('title', 'title','required|trim|max_length[255]');
      //Validate and input data
      if ($this->form_validation->run() == true){

         $user = $this->ion_auth->user()->row();
         $approve_reject_user= [];
         $final_appruver= [];
         $attachmentname='';
         if ($_FILES['attachment']) {
            $config['upload_path'] = './attachment/';
            $config['allowed_types'] = 'jpg|png|jpeg|pdf';
            $config['max_size'] = 10240000;
        
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('attachment')) {
                $data = $this->upload->data();
                $originalFileName = $data['file_name'];
        
                // Generate a unique file name
                $uniqueFileName = uniqid() . '.' . pathinfo($originalFileName, PATHINFO_EXTENSION);
        
                // Move the uploaded file to the destination with the unique file name
                $destination = base_url('attachment/') . $uniqueFileName;
                rename($config['upload_path'] . $originalFileName, $config['upload_path'] . $uniqueFileName);
        
                $attachmentname=$uniqueFileName;
            }
        }

        if ($_POST['submit_type']=='save'){ 
            $is_save = 1;
        }else{
            $is_save = 0;
        }
        if ($_POST['urgent_status']){ 
            $urgent_status = 1;
        }else{
            $urgent_status = 0;
        }
         $form_data = array(
            'user_id'   => $user->id,
            'department_id' => ($user->dept_id)?$user->dept_id:'',
            'f_year_id'   => $fiscal_year->id,
            'approve_reject_user'   =>json_encode($approve_reject_user),
            'final_appruver'   =>json_encode($final_appruver),
            'title'     => $this->input->post('title'),
            'desk_id'         => $this->ion_auth->in_group('Store Keeper')?1:0,
            'pin_code'   => mt_rand(1000, 9999),  
            'attachment'   => $attachmentname,  
            'created'   => date('Y-m-d H:i:s'),
            'updated'   => date('Y-m-d H:i:s'),
            'is_save' => $is_save,
            'urgent_status' => $urgent_status,
            );
         // print_r($form_data); exit;
         if($this->Common_model->save('requisitions', $form_data)){     
            // Send Message
            // $mobile = '+88'.$user->phone;
            // $message = 'Your appointment request send admin successfully. Please wait for confirmation sms. Thank You!';
            // $this->send_sms($mobile, $message);

            // Send Mail
            // $this->send_mail(); 

            // Schedule Type Appointment
            $insert_id = $this->db->insert_id();
               // Insert Scout Unit under a group

            for ($i=0; $i<sizeof($_POST['item_id']); $i++) { 
               $form_data2 = array(
                  'requisition_id'     => $insert_id,
                  'item_cate_id'       => $_POST['item_cate_id'][$i],
                  'item_sub_cate_id'   => $_POST['item_sub_cate_id'][$i],
                  'item_id'            => $_POST['item_id'][$i],
                  'dept_id'            => ($user->dept_id)?$user->dept_id:'',
                  'fiscal_year_id'     => $fiscal_year->id,
                  'qty_request'        => $_POST['qty_request'][$i],           
                  'remark'             => $_POST['remark'][$i]
                  );
               $this->Common_model->save('requisition_item', $form_data2);
            }

            $this->session->set_flashdata('success', 'Create Requisition successfully.');
            redirect("my_requisition");
         }
      }

      //Dropdown
      // $this->data['type_dd'] = $this->Common_model->get_schedule_type(); 
      // $this->data['items'] = $this->Common_model->get_items();
      $this->data['categories'] = $this->Common_model->get_categories();
      $this->data['info'] = $this->Common_model->get_user_details();

      // print_r($this->data['info']['user_info']); exit;

      //Load view
      $this->data['meta_title'] = 'Requisition Entry Form';
      $this->data['subview'] = 'create';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function details($id){
      // if(!$this->ion_auth->is_member()){
      //    redirect('dashboard');
      // }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('requisitions', 'id', $dataID)) { 
         show_404('My_requisition - details - exitsts', TRUE);
      }

      

      //Results
      $this->data['info'] = $this->My_requisition_model->get_info($dataID);
      // echo '<pre>';
      // print_r($this->data['info']->title); exit;
      $this->data['items'] = $this->My_requisition_model->get_req_items($dataID); 
      // if($this->data['info']->schedule_type == 'Appointment'){
      //    $this->data['persons'] = $this->My_requisition_model->get_appointment_persons($this->data['info']->id); 
      // }

      // Load page
      $this->data['meta_title'] = 'Requisition Details';
      $this->data['subview'] = 'details';
      $this->load->view('backend/_layout_main', $this->data);
   }


   public function update($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_sec_admin() || $this->ion_auth->is_ps_admin() || $this->ion_auth->is_po_admin())){
         redirect('dashboard');
      }

      // $dataID = $id; //exit;
      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('appointment', 'id', $dataID)) { 
         show_404('appointment - update - exitsts', TRUE);
      }

      //Validation
      $this->form_validation->set_rules('title', 'name/title','required|trim|max_length[255]');
      $this->form_validation->set_rules('mobile_no', 'mobile no', 'required|trim');
      $this->form_validation->set_rules('date', 'date and time', 'required|trim');

      //Validate and input data
      if ($this->form_validation->run() == true){
         $form_data = array(
            'schedule_type'   => $this->input->post('schedule_type'),
            'title'           => $this->input->post('title'),
            'organization'    => $this->input->post('organization'),
            'mobile_no'       => $this->input->post('mobile_no'),
            'email'           => $this->input->post('email'),
            'date'            => $this->input->post('date'),
            'venue'           => $this->input->post('venue'),
            'purpose'         => $this->input->post('purpose')
            );

         // print_r($form_data); exit;
         if($this->Common_model->edit('appointment',  $dataID, 'id', $form_data)){

            $this->session->set_flashdata('success', 'Update information successfully.');
            redirect("appointment");
         }
      }

      //Dropdown
      $this->data['type_dd'] = $this->Common_model->get_schedule_type(); 

      //Results
      $this->data['info'] = $this->My_requisition_model->get_info($dataID); 
      
      //Load view
      $this->data['meta_title'] = 'Update Appointment';
      $this->data['subview'] = 'update';
      $this->load->view('backend/_layout_main', $this->data);
   }

   /************************************ PASS **********************************/

   public function my_pass($offset=0){
      $limit = 25;
      if(!$this->ion_auth->is_member()){
         redirect('dashboard');
      }

      //Results
      $results = $this->My_requisition_model->get_my_pass($limit, $offset, $this->userSessID); 
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('my_appointment/my_pass/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      // Load view
      $this->data['meta_title'] = 'My Pass List';
      $this->data['subview'] = 'my_pass';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function create_pass(){
      // validate form input
      $this->form_validation->set_rules('host_id', 'host name', 'required');
      $this->form_validation->set_rules('reason', 'reason', 'required');

      if ($this->form_validation->run() == true){
         $form_data = array(
            'user_id'   => $this->userSessID,
            'host_id'   => $this->input->post('host_id'),
            'reason'    => $this->input->post('reason'),
            'created'   => date('Y-m-d H:i:s')
            );

         // print_r($form_data); exit;
         if($this->Common_model->save('pass', $form_data)){
            // Send Message
            // $user = $this->ion_auth->user()->row();
            // $mobile = '+88'.$user->phone;
            // $message = 'Your pass request create successfully. Please wait for confirmation sms. Thank You!';
            // $this->send_sms($mobile, $message);

            $this->session->set_flashdata('success', 'New data insert successfully.');
            redirect('my_appointment/my_pass');
         }
      }

      // Dropdown
      $this->data['host_persons'] = $this->My_requisition_model->get_dd_host_persons();

      // Load View
      $this->data['meta_title'] = 'Create Pass';
      $this->data['subview'] = 'create_pass';
      $this->load->view('backend/_layout_main', $this->data);        
   }

   public function cancelpass($id){
      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('pass', 'id', $dataID)) { 
         show_404('pass - cancelpass - exitsts', TRUE);
      }

      if ($dataID){
         $this->Common_model->edit('pass', $dataID, 'id', array('status' => 4));
         $this->session->set_flashdata('success', 'Cancel the pass request.');
      }
      redirect('my_appointment/my_pass');
   }



   

   public function delete($id){  
      //Check Authentication
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_sec_admin() || $this->ion_auth->is_ps_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('appointment', 'id', $dataID)) { 
         show_404('appointment - delete - exitsts', TRUE);
      }

      //Delete data
      if($this->My_requisition_model->appointment_destroy($dataID)){
         // Delete Scouts Region from database         
         $this->session->set_flashdata('success', 'Appointmetn delete successfully.');
         redirect("appointment");   
      }else{
         $this->session->set_flashdata('warning', 'Something is wrong.');
         redirect("appointment");   
      }
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

   public function send_mail(){
      //Load email library
      $this->load->library('email');

      // $mailBody = "Hello, \r\n\r\n We received a request to reset your scouts password. \r\n Your verify code: \r\n\r\n Thanky You!";
      // ssl://smtp.gmail.com
      $mailBody = "Test mail digital schedule.";

      $config['protocol']     = 'smtp';
      $config['smtp_host']    = 'ssl://smtp.gmail.com';
      $config['smtp_port']    = '465';
      $config['smtp_ssl']     = 'tls';
      $config['smtp_timeout'] = '7';
      $config['smtp_user']    = 'testingemail9400@gmail.com'; //testingemail9400@gmail.com > te12345678
      $config['smtp_pass']    = 'te12345678';
      $config['charset']      = 'utf-8';
      $config['newline']      = "\r\n";
      $config['mailtype']     = 'text'; // or html
      $config['validation']   = TRUE; // bool whether to validate email or not      

      $this->email->initialize($config);

      $this->email->from('testingemail9400@gmail.com', 'Digital Schedule');
      $this->email->to('mostafa.csit@gmail.com'); 

      $this->email->subject('Account Activation - Digiatal Schedule');
      $this->email->message($mailBody);  

      // Send Mail
      if($this->email->send()){
         echo 'Email sent.';
      } else {
         show_error($this->email->print_debugger());
      }
   }

}