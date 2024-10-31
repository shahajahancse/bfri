<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends Backend_Controller {	

   public function __construct(){
      parent::__construct();
      if (!$this->ion_auth->logged_in()):
         redirect('login');
      endif;

      $this->data['module_title'] = 'Items';
      $this->load->model('Common_model'); 
      $this->load->model('Items_model');     
   }

   public function index(){
      $this->data['results'] = $this->Items_model->get_items(); 
      // print_r($this->data['results']); exit;

      // Load page
      $this->data['meta_title'] = 'All Items';
      $this->data['subview'] = 'index';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function create(){
      //Validation
      $this->form_validation->set_rules('cat_id', 'select category', 'required|trim');
      $this->form_validation->set_rules('sub_cate_id', 'select sub category', 'required|trim');
      $this->form_validation->set_rules('unit_id', 'select unit', 'required|trim');
      $this->form_validation->set_rules('item_name', 'item name', 'required|trim');

      //Validate and input data
      if ($this->form_validation->run() == true){
         $form_data = array(
            'cat_id'        => $this->input->post('cat_id'),
            'sub_cate_id'   => $this->input->post('sub_cate_id'),
            'unit_id'       => $this->input->post('unit_id'),
            'item_name'     => $this->input->post('item_name'),
            'quantity'      => $this->input->post('quantity'),
            'order_level'   => $this->input->post('order_level')
            );           

         // print_r($form_data); exit;
         if($this->Common_model->save('items', $form_data)){
            $item_id=$this->db->insert_id();
           $group_id= $this->input->post('group_id');
           $availability=$this->input->post('availability');
           foreach ($group_id as $key => $value) {
              $data = array(
                'item_id' => $item_id,
                'group_id' => $value,
                'availability' => $availability[$key],
                'year' => date('Y')
              );
              $this->db->insert('availability_items', $data);
           }
            $this->session->set_flashdata('success', 'Item create successfully.');
            redirect('items');
         }
      }
      //Dropdown
      $this->data['categories'] = $this->Common_model->get_categories();
      $this->data['units'] = $this->Common_model->get_units();

      // Load page
      $this->data['meta_title'] = 'Add Item Form';
      $this->data['subview'] = 'create';
      $this->load->view('backend/_layout_main', $this->data);
   }
   public function get_sub_category_by_category($id){
      $dataID = $id;
      $this->db->where('cate_id', $dataID);
      $query = $this->db->get('sub_categories');
      $sub_category = $query->result();
      echo json_encode($sub_category);  
   }

   public function edit($id){
      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('items', 'id', $dataID)) { 
         show_404('items - edit - exitsts', TRUE);
      }

      //Validation
      $this->form_validation->set_rules('cat_id', 'select category', 'required|trim');
      $this->form_validation->set_rules('unit_id', 'select unit', 'required|trim');
      $this->form_validation->set_rules('sub_cate_id', 'select sub category', 'required|trim');    
      $this->form_validation->set_rules('item_name', 'item name', 'required|trim');
      $this->form_validation->set_rules('status', 'Status', 'required|trim');

      if ($this->form_validation->run() == true){
         $form_data = array(
            'cat_id'      => $this->input->post('cat_id'),
            'sub_cate_id'   => $this->input->post('sub_cate_id'),
            'unit_id'     => $this->input->post('unit_id'),
            'item_name'   => $this->input->post('item_name'),
            'quantity'    => $this->input->post('quantity'),
            'order_level' => $this->input->post('order_level'),
            'status'      => $this->input->post('status')
            );           

         // print_r($form_data); exit;
         if($this->Common_model->edit('items', $dataID, 'id', $form_data)){
            $item_id= $dataID;
            $group_id= $this->input->post('group_id');
            $availability=$this->input->post('availability');
            $this->db->where('item_id', $item_id);
            $this->db->delete('availability_items');
            foreach ($group_id as $key => $value) {
               $data = array(
                 'item_id' => $item_id,
                 'group_id' => $value,
                 'availability' => $availability[$key],
                 'year' => date('Y')
               );
               $this->db->insert('availability_items', $data);
            }
            $this->session->set_flashdata('success', 'Informatioin update successfully.');
            redirect('items');
         }
      }

      //Dropdown
      $this->data['categories'] = $this->Common_model->get_categories();
      $this->data['sub_categories'] = $this->Common_model->get_sub_categories();
      $this->data['units'] = $this->Common_model->get_units();

      $this->data['info'] = $this->Items_model->get_info($dataID);

      // Load page
      $this->data['meta_title'] = 'Edit Item Form';
      $this->data['subview'] = 'edit';
      $this->load->view('backend/_layout_main', $this->data);
   }

   function delete($id) {
      if(!$this->ion_auth->is_admin()){
         redirect('dashboard');
      }
      $this->data['info'] = $this->Items_model->delete($id);

      $this->session->set_flashdata('success', 'Item delete successfully.');
      redirect('items');     
   }



   public function details($id){
      if(!$this->ion_auth->is_admin()){
         redirect('dashboard');
      }

      $encriptID = (int) decrypt_url($id);

      $this->data['users'] = $this->ion_auth->user()->row();

      $this->data['complain'] = $this->Complain_model->get_info($encriptID);
        // $this->data['scout_member_list'] = $this->Complain_model->get_scout_member_list($id);
        // $this->data['scout_member'] = $this->Complain_model->get_scout_member($id, $this->data['users']->id);

      $this->data['meta_title'] = 'Details Feedback on Complain';
      $this->data['subview'] = 'details';
      $this->load->view('backend/_layout_main', $this->data);
   }

   /*************details_pdf function pdf start**************/
   public function details_pdf($id=0){
      if(!$this->ion_auth->is_admin()){
         redirect('dashboard');
      }

      $encriptID = (int) decrypt_url($id);

      $this->data['users'] = $this->ion_auth->user()->row();

      $this->data['complain'] = $this->Complain_model->get_info($encriptID);

      //...............................................................................
      $this->data['meta_title'] = "Details Feedback on Complain";
      $html = $this->load->view('details_pdf', $this->data, true);   
      $file_name ="details_pdf.pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "D");
   }
   /*************details_pdf function pdf End**************/


}