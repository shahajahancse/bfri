<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Backend_Controller {
	var $userData;

	public function __construct(){
		parent::__construct();
		if (!$this->ion_auth->logged_in()){
			redirect('login');
		}

		$this->data['module_name'] = 'Dashboard';
		$this->load->model('Dashboard_model');
		$this->load->model('requisition/Requisition_model');
		$this->userData = $this->Common_model->get_user_details();
		
		// $this->userSessID = $this->session->userdata('user_id');
      // print_r($this->session->all_userdata());		
		//$this->session->set_userdata('current_group', 'superadmin');
	}	

	public function index(){
		// if($this->ion_auth->in_group('User')){
		// 	$this->data['info'] = $this->userData['user_info'];
		// 	$this->data['user'] = $this->ion_auth->user()->row();
		// 	$this->data['meta_title'] = 'Dashboard';
		// 	$this->data['subview'] = 'user_dashboard';						
		// 	$this->load->view('backend/_layout_main', $this->data);
		// }else{
			$result = $this->Dashboard_model->get_count_data();
			$this->data['total_data'] = $result;

			$result = $this->Dashboard_model->get_count_data(1);
			$this->data['total_pending'] = $result;

			$result = $this->Dashboard_model->get_count_data(2);
			$this->data['total_approve'] = $result;

			$result = $this->Dashboard_model->get_count_data(3);
			$this->data['total_rejected'] = $result;

			$result = $this->Dashboard_model->get_count_data_parches();
			$this->data['total_datap'] = $result;

			$result = $this->Dashboard_model->get_count_data_parches(1);
			$this->data['total_pendingp'] = $result;

			$result = $this->Dashboard_model->get_count_data_parches(2);
			$this->data['total_approvep'] = $result;

			$result = $this->Dashboard_model->get_count_data_parches(3);
			$this->data['total_rejectedp'] = $result;

			// Load Page
			$this->data['meta_title'] = 'Dashboard';
			$this->data['subview'] = 'admin_dashboard';				
			$this->load->view('backend/_layout_main', $this->data);	
		// }
	}

	public function ajaxevent(){
		if (!$this->ion_auth->logged_in()){
			redirect('login');
		}

		$session_data = $this->session->userdata('user_id');  // get id of author
		//$this->db->where('author', $session_data); // get data 'where' author=session.id
		$result =  $this->db->where('status', 1)->get('appointment')->result_array();
		// print_r($result); exit;
		print_r(json_encode($result)); 
	}

	public function no_assign(){
			//Load page       
		$this->data['meta_title'] = 'No Assign';
		$this->data['subview'] = 'no_assign';
		$this->load->view('backend/_layout_main', $this->data);
	}

}