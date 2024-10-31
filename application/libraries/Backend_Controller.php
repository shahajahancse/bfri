<?php
include 'classes/BanglaConverter.php';

class Backend_Controller extends MY_Controller{	
	var $userSessID;
	// var $officeSess;

	function __construct (){
		parent::__construct();
		$this->ci_minifier->init(0);

		$this->session->set_userdata('site_lang', 'english');
		$this->lang->load('scouts', 'english');
		
		
		// $this->ci_minifier->init('html');
		
		// $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->form_validation->set_error_delimiters('<div class="alert alert-warning"> <i class="fa fa-warning"></i> ', '</div>');		
		$this->lang->load('auth');
		$this->data['meta_title'] = 'Page Title';			
		$this->data['domain_title'] = 'BCCT';		
		$this->load->model('Common_model');	
		// $this->load->model('scouts_member/Scouts_member_model');
		// $this->load->model('offices/Offices_model');
		// $this->load->model('committee/Committee_model');
		$this->userSessID = $this->session->userdata('user_id');
		// $this->officeSess = $this->session->userdata('is_office');

		// if($this->ion_auth->logged_in()){
		// 	// echo '<pre>';
			// print_r($this->session->all_userdata()); exit;
		// 	if($this->session->userdata('current_group') == 5){
		// 		redirect('/');
		// 	}
      $this->data['userDetails'] = $this->Common_model->get_user_details();	
		// }

      $this->data['count_pass_req'] = $this->Common_model->get_count_pass_request();
   }

}