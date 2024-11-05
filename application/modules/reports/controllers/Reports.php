<?php defined('BASEPATH') OR exit('No direct script access allowed');
  // include 'classes/BanglaConverter.php';
class Reports extends Backend_Controller {

	public function __construct(){
    parent::__construct();
    
    $this->data['module_name'] = $this->data['module_title'] = 'Reports';
    if (!$this->ion_auth->logged_in()):
      redirect('login');
    endif;
    $pr=$this->ion_auth->get_permission();
    if (!in_array('5', $pr)) {
      
      redirect('dashboard');

    }
    $this->load->model('Reports_model');
  }

    public function index(){
      // Validation
      $this->form_validation->set_rules('fiscal_year', 'fiscal_year', 'required');
      
      if($this->form_validation->run() == true){
        
        $btn_submit = $this->input->post('btnsubmit');
        $this->data['date_from'] = $this->input->post('date_from');
        $this->data['date_to'] = $this->input->post('date_to');        
        $this->data['user_id'] = $this->input->post('user_id');   
        $this->data['fiscal_year'] = $this->input->post('fiscal_year');   

        if( $btn_submit == 'item_report') {
          // $this->data['region'] = $this->Common_model->get_data('office_region');

          // Results
          $this->data['results'] = $this->Reports_model->get_items();
          // echo '<pre>'; 
          // print_r($this->data['results']); exit;

          // Generate PDF
          $this->data['headding'] = 'Item Report';
          $html= $this->load->view('pdf_item_report', $this->data, true);
          // exit();
          $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
          $mpdf->WriteHtml($html);
          $mpdf->output();
          // $mpdf->output('report.pdf', "D");

        }else if( $btn_submit == 'request_requisition') {

          $arrayInput = array(
            'status' => 1, 
            'start_date'=>$this->data['date_from'], 
            'end_date'=>$this->data['date_to'],
            'user_id'=>$this->data['user_id'],
            'fiscal_year'=>$this->data['fiscal_year'],
          );

          // Results
          $this->data['results'] = $this->Reports_model->get_requisition($arrayInput);

          // Generate PDF
          $this->data['headding'] = 'Request Requisition';
          echo $this->load->view('pdf_request_requisition', $this->data, true);
          exit();
          $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
          $mpdf->WriteHtml($html);
          $mpdf->output();
          // $mpdf->output('report.pdf', "D");

        }else if( $btn_submit == 'approve_requisition') {
          $this->data['date_from'] = $this->input->post('date_from');
          $this->data['date_to'] = $this->input->post('date_to');

          $arrayInput = array(
            'status' => 2, 
            'start_date'=>$this->data['date_from'], 
            'end_date'=>$this->data['date_to'],
            'user_id'=>$this->data['user_id'],
            'fiscal_year'=>$this->data['fiscal_year'],
          );
          // Results
          $this->data['results'] = $this->Reports_model->get_requisition($arrayInput);

          // echo '<pre>'; 
          // print_r($this->data['results']); exit;

          // Generate PDF
          $this->data['headding'] = 'Approve Requisition';
          echo $this->load->view('pdf_approve_requisition', $this->data, true);
          exit();
          $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
          $mpdf->WriteHtml($html);
          $mpdf->output();
          // $mpdf->output('report.pdf', "D");

        }else if( $btn_submit == 'rejected_requisition') {
          $this->data['date_from'] = $this->input->post('date_from');
          $this->data['date_to'] = $this->input->post('date_to');

          $arrayInput = array(
            'status' => 3, 
            'start_date'=>$this->data['date_from'], 
            'end_date'=>$this->data['date_to'],
            'user_id'=>$this->data['user_id'],
            'fiscal_year'=>$this->data['fiscal_year'],
          );
          // Results
          $this->data['results'] = $this->Reports_model->get_requisition($arrayInput);

          // Generate PDF
          $this->data['headding'] = 'Rejected Requisition';
          echo $this->load->view('pdf_rejected_requisition', $this->data, true);
          exit();
          $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
          $mpdf->WriteHtml($html);
          $mpdf->output();
          // $mpdf->output('report.pdf', "D");

        }else if( $btn_submit == 'delivered_requisition') {
          // $this->data['region'] = $this->Common_model->get_data('office_region');
          $this->data['date_from'] = $this->input->post('date_from');
          $this->data['date_to'] = $this->input->post('date_to');

          $arrayInput = array(
            'start_date'=>$this->data['date_from'], 
            'end_date'=>$this->data['date_to'],
            'user_id'=>$this->data['user_id'],
            'fiscal_year'=>$this->data['fiscal_year'],
          );
          // Results
          $this->data['results'] = $this->Reports_model->get_requisition_delivered($arrayInput);

          // echo '<pre>'; 
          // print_r($this->data['results']); exit;

          // Generate PDF
          $this->data['headding'] = 'Delivered Requisition';
          echo $this->load->view('pdf_delivered_requisition', $this->data, true);
          exit();
          $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
          $mpdf->WriteHtml($html);
          $mpdf->output();
          // $mpdf->output('report.pdf', "D");

        }else if( $btn_submit == 'user_request_requisition') {

        $arrayInput = array(
          'status' => 1, 
          'start_date'=>$this->data['date_from'], 
          'end_date'=>$this->data['date_to'],
          'user_id'=>$this->session->userdata('user_id'),
          'fiscal_year'=>$this->data['fiscal_year'],
        );

        // Results
        $this->data['results'] = $this->Reports_model->get_requisition($arrayInput);

        // Generate PDF
        $this->data['headding'] = 'Request Requisition';
        echo $this->load->view('pdf_request_requisition', $this->data, true);
        exit();
        $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
        // $mpdf->output('report.pdf', "D");

        }else if( $btn_submit == 'user_approve_requisition') {
          $this->data['date_from'] = $this->input->post('date_from');
          $this->data['date_to'] = $this->input->post('date_to');

          $arrayInput = array(
            'status' => 2, 
            'start_date'=>$this->data['date_from'], 
            'end_date'=>$this->data['date_to'],
            'user_id'=>$this->session->userdata('user_id'),
            'fiscal_year'=>$this->data['fiscal_year'],
          );
          // Results
          $this->data['results'] = $this->Reports_model->get_requisition($arrayInput);

          // echo '<pre>'; 
          // print_r($this->data['results']); exit;

          // Generate PDF
          $this->data['headding'] = 'Approve Requisition';
          echo $this->load->view('pdf_approve_requisition', $this->data, true);
          exit();
          $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
          $mpdf->WriteHtml($html);
          $mpdf->output();
          // $mpdf->output('report.pdf', "D");

        }else if( $btn_submit == 'user_rejected_requisition') {
          $this->data['date_from'] = $this->input->post('date_from');
          $this->data['date_to'] = $this->input->post('date_to');

          $arrayInput = array(
            'status' => 3, 
            'start_date'=>$this->data['date_from'], 
            'end_date'=>$this->data['date_to'],
            'user_id'=>$this->session->userdata('user_id'),
            'fiscal_year'=>$this->data['fiscal_year'],
          );
          // Results
          $this->data['results'] = $this->Reports_model->get_requisition($arrayInput);

          // Generate PDF
          $this->data['headding'] = 'Rejected Requisition';
          echo $this->load->view('pdf_rejected_requisition', $this->data, true);
          exit();
          $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
          $mpdf->WriteHtml($html);
          $mpdf->output();
          // $mpdf->output('report.pdf', "D");

        }else if( $btn_submit == 'user_delivered_requisition') {
          // $this->data['region'] = $this->Common_model->get_data('office_region');
          $this->data['date_from'] = $this->input->post('date_from');
          $this->data['date_to'] = $this->input->post('date_to');

          $arrayInput = array(
            'start_date'=>$this->data['date_from'], 
            'end_date'=>$this->data['date_to'],
            'user_id'=>$this->session->userdata('user_id'),
            'fiscal_year'=>$this->data['fiscal_year'],
          );
          // Results
          $this->data['results'] = $this->Reports_model->get_requisition_delivered($arrayInput);

          // echo '<pre>'; 
          // print_r($this->data['results']); exit;

          // Generate PDF
          $this->data['headding'] = 'Delivered Requisition';
          echo $this->load->view('pdf_delivered_requisition', $this->data, true);
          exit();
          $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
          $mpdf->WriteHtml($html);
          $mpdf->output();
          // $mpdf->output('report.pdf', "D");

        
        }else if( $btn_submit == 'low_inventory') {
            $this->data['date_from'] = $this->input->post('date_from');
            $this->data['date_to'] = $this->input->post('date_to');

            // Results
            $this->data['results'] = $this->Reports_model->get_low_inventory_items();
            // echo '<pre>'; 
            // print_r($this->data['results']); exit;

            // Generate PDF
            $this->data['headding'] = 'Low Inventory Item Report';
            echo $this->load->view('pdf_low_inventory_item', $this->data, true);
            exit();
            $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
            // $mpdf->output('report.pdf', "D");
        }else if( $btn_submit == 'request_purchase') {
          $this->data['date_from'] = $this->input->post('date_from');
          $this->data['date_to'] = $this->input->post('date_to');

          $arrayInput = array(
            'status' => 1,
            'start_date'=>$this->data['date_from'],
            'end_date'=>$this->data['date_to'],
            'user_id'=>$this->data['user_id'],
            'fiscal_year'=>$this->data['fiscal_year'],
          );

          // Results
          $this->data['results'] = $this->Reports_model->get_purchase($arrayInput);

          // echo '<pre>'; 
          // print_r($this->data['results']); exit;

          // Generate PDF
          $this->data['headding'] = 'Request Purchase';
          echo $this->load->view('pdf_request_purchase', $this->data, true);
          exit();
          $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
          $mpdf->WriteHtml($html);
          $mpdf->output();
        }else if( $btn_submit == 'approve_purchase') {
          $this->data['date_from'] = $this->input->post('date_from');
          $this->data['date_to'] = $this->input->post('date_to');

          $arrayInput = array(
            'status' => 2,
            'start_date'=>$this->data['date_from'],
            'end_date'=>$this->data['date_to'],
            'user_id'=>$this->data['user_id'],
            'fiscal_year'=>$this->data['fiscal_year'],
          );

          // Results
          $this->data['results'] = $this->Reports_model->get_purchase($arrayInput);

          // echo '<pre>'; 
          // print_r($this->data['results']); exit;

          // Generate PDF
          $this->data['headding'] = 'Approve Purchase';
          echo $this->load->view('pdf_approve_purchase', $this->data, true);
          exit();
          $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
          $mpdf->WriteHtml($html);
          $mpdf->output();
          // $mpdf->output('report.pdf', "D");

        }else if( $btn_submit == 'rejected_purchase') {
          $this->data['date_from'] = $this->input->post('date_from');
          $this->data['date_to'] = $this->input->post('date_to');

          $arrayInput = array(
            'status' => 3,
            'start_date'=>$this->data['date_from'],
            'end_date'=>$this->data['date_to'],
            'user_id'=>$this->data['user_id'],
            'fiscal_year'=>$this->data['fiscal_year'],
          );

          // Results
          $this->data['results'] = $this->Reports_model->get_purchase($arrayInput);

          // echo '<pre>'; 
          // print_r($this->data['results']); exit;

          // Generate PDF
          $this->data['headding'] = 'Rejected Purchase';
          echo $this->load->view('pdf_rejected_purchase', $this->data, true);
          exit();
          $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
          $mpdf->WriteHtml($html);
          $mpdf->output();
          // $mpdf->output('report.pdf', "D");

        }else if( $btn_submit == 'recceived_purchase') {
          // $this->data['region'] = $this->Common_model->get_data('office_region');
          $this->data['date_from'] = $this->input->post('date_from');
          $this->data['date_to'] = $this->input->post('date_to');

          $arrayInput = array(
            // 'status' => 1,
            'start_date'=>$this->data['date_from'],
            'end_date'=>$this->data['date_to'],
            'user_id'=>$this->data['user_id'],
            'fiscal_year'=>$this->data['fiscal_year'],
          );

          // Results
          $this->data['results'] = $this->Reports_model->get_purchase_delivered($arrayInput);

          // echo '<pre>'; 
          // print_r($this->data['results']); exit;

          // Generate PDF
          $this->data['headding'] = 'Delivered Purchase';
          echo $this->load->view('pdf_delivered_purchase', $this->data, true);
          exit();
          $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
          $mpdf->WriteHtml($html);
          $mpdf->output();
          // $mpdf->output('report.pdf', "D");
        }
      
      }
      $this->data['users'] = $this->Common_model->get_users();
      // $this->data['fiscal_year'] = $this->Common_model->get_fiscal_year();
      // Load View 
      $this->data['meta_title'] = 'Reports';
      $this->data['subview'] = 'index';
      $this->load->view('backend/_layout_main', $this->data);
    
  } 


  public function dynamic_report() {
    $this->data['meta_title'] = 'Dynamic Reports';
    $this->data['subview'] = 'dynamic/dynamic_report';
    $this->load->view('backend/_layout_main', $this->data);
  }
  public function get_dynamic_report() {
    $report_type = $this->input->post('report_type');
    $user_id = $this->input->post('user_id');
    $fiscal_year = $this->input->post('fiscal_year');
    $product_id = $this->input->post('product_id');
    $from_date = $this->input->post('from_date');
    $to_date = $this->input->post('to_date');
    $status = $this->input->post('report_status');

    $arrayInput = array(
      'status' => $status,
      'start_date'=>$from_date,
      'end_date'=>$to_date,
      'user_id'=>$user_id,
      'fiscal_year'=>$fiscal_year,
    );
    //dd($arrayInput);

    if ($report_type == 1) {
      if ($status && $status!='' && $status == 4) {
        if (($key = array_search($status, $arrayInput)) !== false) {
          unset($arrayInput[$key]);
        }
        $this->data['results'] = $this->Reports_model->get_requisition_delivered($arrayInput);
        // Generate PDF
        $this->data['headding'] = 'Delivered Requisition';
        echo $this->load->view('pdf_delivered_requisition', $this->data, true);
        exit();

      }else{
        $this->data['results'] = $this->Reports_model->get_requisition($arrayInput);
        $this->data['headding'] = 'Request Requisition';
        echo $this->load->view('pdf_request_requisition', $this->data, true);
        exit();
      }
    }else{
      if ($status && $status!='' && $status == 4) {
        if (($key = array_search($status, $arrayInput)) !== false) {
            unset($arrayInput[$key]);
        }
        $this->data['results'] = $this->Reports_model->get_purchase_delivered($arrayInput);
        $this->data['headding'] = 'Delivered Purchase';
        echo $this->load->view('pdf_delivered_purchase', $this->data, true);
        exit();
      }else{
        $this->data['results'] = $this->Reports_model->get_purchase($arrayInput);
        // Generate PDF
        $this->data['headding'] = 'Request Purchase';
        echo $this->load->view('pdf_request_purchase', $this->data, true);
        exit(); 
      }
    }
  }
}