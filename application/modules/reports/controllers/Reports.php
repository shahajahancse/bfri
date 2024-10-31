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
    $this->form_validation->set_rules('division', 'division', 'trim');

    // Input Data
    $btn_submit = $this->input->post('btnsubmit');
    // $region = $this->input->post('region');
    // $dis_type = $this->input->post('dis_type');
    // $date_from = date_db_format($this->input->post('date_from'));
    // $date_to = date_db_format($this->input->post('date_to'));


    if($this->form_validation->run() == true){

      if( $btn_submit == 'item_report') {
        // $this->data['region'] = $this->Common_model->get_data('office_region');
        $this->data['date_from'] = $this->input->post('date_from');
        $this->data['date_to'] = $this->input->post('date_to');        

        // Results
        $this->data['results'] = $this->Reports_model->get_items();
        // echo '<pre>'; 
        // print_r($this->data['results']); exit;

        // Generate PDF
        $this->data['headding'] = 'Item Report';
        echo $this->load->view('pdf_item_report', $this->data, true);
exit();
        $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
        // $mpdf->output('report.pdf', "D");

      }else if( $btn_submit == 'request_requisition') {
        $this->data['date_from'] = $this->input->post('date_from');
        $this->data['date_to'] = $this->input->post('date_to');

        $arrayInput = array('status' => 1, 'start_date'=>$this->data['date_from'], 'end_date'=>$this->data['date_to']);

        // Results
        $this->data['results'] = $this->Reports_model->get_requisition($arrayInput);

        // echo '<pre>'; 
        // print_r($this->data['results']); exit;

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

        $arrayInput = array('status' => 2, 'start_date'=>$this->data['date_from'], 'end_date'=>$this->data['date_to']);

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

        $arrayInput = array('status' => 3, 'start_date'=>$this->data['date_from'], 'end_date'=>$this->data['date_to']);

        // Results
        $this->data['results'] = $this->Reports_model->get_requisition($arrayInput);

        // echo '<pre>'; 
        // print_r($this->data['results']); exit;

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

        $arrayInput = array('start_date'=>$this->data['date_from'], 'end_date'=>$this->data['date_to']);

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

        $arrayInput = array('status' => 1, 'start_date'=>$this->data['date_from'], 'end_date'=>$this->data['date_to']);

        // Results
        $this->data['results'] = $this->Reports_model->get_requisition($arrayInput);

        // echo '<pre>'; 
        // print_r($this->data['results']); exit;

        // Generate PDF
        $this->data['headding'] = 'Request Requisition';
        echo $this->load->view('pdf_request_requisition', $this->data, true);
exit();
        $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
        // $mpdf->output('report.pdf', "D");

      }else if( $btn_submit == 'approve_purchase') {
        $this->data['date_from'] = $this->input->post('date_from');
        $this->data['date_to'] = $this->input->post('date_to');

        $arrayInput = array('status' => 2, 'start_date'=>$this->data['date_from'], 'end_date'=>$this->data['date_to']);

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

      }else if( $btn_submit == 'rejected_purchase') {
        $this->data['date_from'] = $this->input->post('date_from');
        $this->data['date_to'] = $this->input->post('date_to');

        $arrayInput = array('status' => 3, 'start_date'=>$this->data['date_from'], 'end_date'=>$this->data['date_to']);

        // Results
        $this->data['results'] = $this->Reports_model->get_requisition($arrayInput);

        // echo '<pre>'; 
        // print_r($this->data['results']); exit;

        // Generate PDF
        $this->data['headding'] = 'Rejected Requisition';
        echo $this->load->view('pdf_rejected_requisition', $this->data, true);
exit();
        $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
        // $mpdf->output('report.pdf', "D");

      }else if( $btn_submit == 'recceived_purchase') {
        // $this->data['region'] = $this->Common_model->get_data('office_region');
        $this->data['date_from'] = $this->input->post('date_from');
        $this->data['date_to'] = $this->input->post('date_to');

        $arrayInput = array('start_date'=>$this->data['date_from'], 'end_date'=>$this->data['date_to']);

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
      }
    }

    //Dropdown
    $this->data['users'] = $this->Common_model->get_users();
    // $this->data['fiscal_year'] = $this->Common_model->get_fiscal_year();
    // $this->data['scout_section'] = $this->Common_model->set_scout_section();      
    // $this->data['dis_type'] = $this->Common_model->get_scout_district_type();

    // Load View 
    $this->data['meta_title'] = 'Reports';
    $this->data['subview'] = 'index';
    $this->load->view('backend/_layout_main', $this->data);
  }   
}