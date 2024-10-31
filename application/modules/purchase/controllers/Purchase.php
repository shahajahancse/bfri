<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase extends Backend_Controller {
   var $userID;

   public function __construct(){
      parent::__construct();

      if (!$this->ion_auth->logged_in()):
         redirect('login');
      endif;

      $this->data['module_name'] = 'Purchase';
      $this->load->model('Purchase_model');
      $this->userSessID = $this->session->userdata('user_id');
   }

   public function index($offset=0){
      $limit = 25;
      //Results
      $results = $this->Purchase_model->get_purchase($limit, $offset); 
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('purchase/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      // Load view
      $this->data['meta_title'] = 'Purchase List';
      $this->data['subview'] = 'index';
      $this->load->view('backend/_layout_main', $this->data);
   }
   public function purchase_pending($offset=0){
      $limit = 25;
      $results = $this->Purchase_model->get_purchase($limit, $offset, '1');         
      $this->data['roleid']=$this->ion_auth->get_group_id();

      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];
      $this->data['pagination'] = create_pagination('purchase/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
      $this->data['meta_title'] = 'Purchase List';
      $this->data['subview'] = 'index';
      $this->load->view('backend/_layout_main', $this->data);
   }
   public function purchase_approved($offset=0){
      $limit = 25;
      $results = $this->Purchase_model->get_purchase($limit, $offset , '2'); 
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];
      $this->data['pagination'] = create_pagination('purchase/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
      $this->data['meta_title'] = 'Purchase List';
      $this->data['subview'] = 'index';
      $this->load->view('backend/_layout_main', $this->data);
   }
   public function purchase_rejected($offset=0){
      $limit = 25;
      $results = $this->Purchase_model->get_purchase($limit, $offset , '3'); 
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];
      $this->data['pagination'] = create_pagination('purchase/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
      $this->data['meta_title'] = 'Purchase List';
      $this->data['subview'] = 'index';
      $this->load->view('backend/_layout_main', $this->data);
   }
   public function purchase_received($offset=0){
      $limit = 25;
      $results = $this->Purchase_model->get_purchase($limit, $offset , '4'); 
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];
      $this->data['pagination'] = create_pagination('purchase/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
      $this->data['meta_title'] = 'Purchase List';
      $this->data['subview'] = 'index';
      $this->load->view('backend/_layout_main', $this->data);
   }

   // public function fiscal_year($f_year){
   //    $limit = 25;
   //    $offset=0;

   //    //Results
   //    $results = $this->Purchase_model->get_purchase($limit, $offset, $f_year); 
   //    $this->data['results'] = $results['rows'];
   //    $this->data['total_rows'] = $results['num_rows'];

   //    //pagination
   //    $this->data['pagination'] = create_pagination('purchase/fiscal_year/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

   //    $f_year_name = $this->Common_model->get_fiscal_year($f_year)->fiscal_year_name;

   //    // Load view
   //    $this->data['meta_title'] = $f_year_name .' Fiscal Year Purchase List';
   //    $this->data['subview'] = 'index';
   //    $this->load->view('backend/_layout_main', $this->data);
   // }

   public function create(){
      $fiscal_year = $this->Common_model->get_current_fiscal_year();
      $this->data['fiscal_year'] = $fiscal_year->fiscal_year_name;
      //Validation
      $this->form_validation->set_rules('title', 'title','required|trim|max_length[255]');
      //Validate and input data
      if ($this->form_validation->run() == true){
         $user = $this->ion_auth->user()->row();
         $approved_id=[];
         $finalappr=[];

         $aar=json_encode($approved_id);
         $finalappr=json_encode($finalappr);
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
         $form_data = array(
            'user_id'         => $user->id,            
            'supplier_name'   => $this->input->post('title'),
            'f_year_id'       => $fiscal_year->id,
            'approved_id'     => $aar,
            'finalappr'     => $finalappr,
            'status'          => 1,
            'desk_id'         => $this->ion_auth->in_group('Store Keeper')?1:0,
            'is_received'     => 0,
            'attachment'      => $attachmentname,
            'created'         => date('Y-m-d H:i:s')
            );
         if($this->Common_model->save('purchase', $form_data)){     
            $insert_id = $this->db->insert_id();
            for ($i=0; $i<sizeof($_POST['pur_item_id']); $i++) { 
               $form_data2 = array(
                  'purchase_id'        => $insert_id,
                  'pur_item_id'        => $_POST['pur_item_id'][$i],
                  'pur_quantity'       => $_POST['pur_quantity'][$i], 
                  'pur_approve'     => 0,                            
                  'pur_fiscal_year_id' => $fiscal_year->id,
                  'pur_remark'         => $_POST['pur_remark'][$i]
                  );
               $this->Common_model->save('purchase_item', $form_data2);

               // $pur_item = $_POST['pur_item_id'][$i];
               // $pur_quantity = $_POST['pur_quantity'][$i];
               // $this->db->query("UPDATE items SET quantity = quantity + $pur_quantity where id = $pur_item");
            }

            $this->session->set_flashdata('success', 'Create Requisition successfully.');
            redirect("purchase");
         }
      }

      //Dropdown
      // $this->data['items'] = $this->Common_model->get_items();
      $this->data['categories'] = $this->Common_model->get_categories();
      $this->data['info'] = $this->Common_model->get_user_details();

      // print_r($this->data['info']['user_info']); exit;

      //Load view
      $this->data['meta_title'] = 'Purchase Entry Form';
      $this->data['subview'] = 'create';
      $this->load->view('backend/_layout_main', $this->data);
   }
   public function edit($id){
      $this->data['categories'] = $this->Common_model->get_categories();
      $this->db->where('id', $id);
      $this->data['info']=$this->db->get('purchase')->row();
      $this->db->select('ri.*, i.item_name, i.quantity, iu.unit_name, c.category_name, sc.sub_cate_name');
      $this->db->from('purchase_item ri');
      $this->db->join('items i', 'i.id = ri.pur_item_id');
      $this->db->join('item_unit iu', 'iu.id = i.unit_id');
      $this->db->join('categories c', 'c.id = i.cat_id');
      $this->db->join('sub_categories sc', 'sc.id = i.sub_cate_id');
      $this->db->where('purchase_id', $id);
      $this->data['purchase_item_data'] = $this->db->get()->result();
      $this->data['meta_title'] = 'Purchase edit Form';
     
         $this->data['subview'] = 'edit';
      
      $this->load->view('backend/_layout_main', $this->data);
   }
   public function edite($id){
      $this->data['categories'] = $this->Common_model->get_categories();

      $this->db->where('id', $id);
      $this->data['info']=$this->db->get('purchase')->row();
      $this->db->select('ri.*, i.item_name, i.quantity, iu.unit_name, c.category_name, sc.sub_cate_name');
      $this->db->from('purchase_item ri');
      $this->db->join('items i', 'i.id = ri.pur_item_id');
      $this->db->join('item_unit iu', 'iu.id = i.unit_id');
      $this->db->join('categories c', 'c.id = i.cat_id');
      $this->db->join('sub_categories sc', 'sc.id = i.sub_cate_id');
      $this->db->where('purchase_id', $id);
      $this->data['purchase_item_data'] = $this->db->get()->result();
      $this->data['meta_title'] = 'Purchase edit Form';
      if($this->data['info']->user_id==$this->ion_auth->user()->row()->id){
         if($this->data['info']->status==1){
            $this->data['subview'] = 'edited';
         }else{
            $this->data['subview'] = 'edit';
         }
      }else{
         $this->data['subview'] = 'edit';
      }
      $this->load->view('backend/_layout_main', $this->data);
   }
   public function edited_update(){
      $user = $this->ion_auth->user()->row();
      $form_data = array( 
         'supplier_name'   => $this->input->post('title'),
         'desk_id'         => 0,
         );
         $this->db->where('id', $this->input->post('id'));
         if ($this->db->update('purchase', $form_data)) {
            $this->db->where('purchase_id', $this->input->post('id'));
            $this->db->delete('purchase_item');
            for ($i=0; $i<sizeof($_POST['pur_item_id']); $i++) { 
               $form_data2 = array(
                  'purchase_id'        => $this->input->post('id'),
                  'pur_item_id'        => $_POST['pur_item_id'][$i],
                  'pur_quantity'       => $_POST['pur_quantity'][$i], 
                  'pur_approve'     => 0,                            
                  'pur_fiscal_year_id' =>'null',
                  'pur_remark'         => $_POST['pur_remark'][$i]
                  );
               $this->Common_model->save('purchase_item', $form_data2);
         }
      }else{
         $this->session->set_flashdata('error', 'Update Requisition failed.');
      }
      $this->session->set_flashdata('success', 'Update Requisition successfully.');
      redirect("purchase");
   }
   public function change_status($id){
         $user = $this->ion_auth->user()->row();
         $this->db->where('id', $id);
         $purchase_data=$this->db->get('purchase')->row();
         $approved_id=json_decode($purchase_data->approved_id);
         $finalappr=json_decode($purchase_data->finalappr);

      
         $status=$this->input->post('status');
         if ($status == 2) {

            $remark=[
               'id' => $user->id,
               'role'=>$this->ion_auth->get_group_id(),
               'remark' => $this->input->post('remark')
            ];
   
            array_push($finalappr, $remark);
            $finalappr=json_encode($approved_id);
            $form_data = array(
               'finalappr'     => $finalappr,
               'status'          => 2,
               'desk_id'         => 0
               );
         }else{
            $remark=[
               'id' => $user->id,
               'role'=>$this->ion_auth->get_group_id(),
               'remark' => $this->input->post('remark')
            ];
   
            array_push($approved_id, $remark);
            $app_id=json_encode($approved_id);
            
            $form_data = array(
               'approved_id'     => $app_id,
               'status'          => $this->input->post('status'),
               'desk_id'         => $this->input->post('desk_id'),
               );
         }
         $this->db->where('id', $id);
         if($this->db->update('purchase' , $form_data)){   
            for ($i=0; $i<sizeof($_POST['hide_id']); $i++) { 
               $form_data2 = array(
                  'pur_approve'       => $_POST['pur_approve'][$i]                            
                  );
                  $this->db->where('purchase_id', $id);
                  $this->db->where('id', $_POST['hide_id'][$i]);
                  $this->db->update('purchase_item', $form_data2);
            }

            $this->session->set_flashdata('success', 'Update Purchase successfully.');
            redirect("purchase");
         }
   }
   public function received($id){
      $form_data = array(
         'is_received'         => 1,
         );
      $this->db->where('id', $id);
      if ($this->db->update('purchase', $form_data)) {
         $this->db->where('purchase_id', $id);
         $purchase_data=$this->db->get('purchase_item')->result();
         foreach($purchase_data as $purchase){
            $this->db->query("UPDATE items SET quantity = quantity + $purchase->pur_approve where id = $purchase->pur_item_id");
         }
         $this->session->set_flashdata('success', 'Update Purchase successfully.');
         redirect("purchase");
      };
   }

   public function details($id){
      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('purchase', 'id', $dataID)) { 
         show_404('Purchase - details - exitsts', TRUE);
      }      

      //Results
      $this->data['info'] = $this->Purchase_model->get_info($dataID);
      // echo '<pre>';
      // print_r($this->data['info']->title); exit;
      $this->data['items'] = $this->Purchase_model->get_items($dataID); 
      // if($this->data['info']->schedule_type == 'Appointment'){
      //    $this->data['persons'] = $this->Purchase_model->get_appointment_persons($this->data['info']->id); 
      // }

      // Load page
      $this->data['meta_title'] = 'Purchase Details';
      $this->data['subview'] = 'details';
      $this->load->view('backend/_layout_main', $this->data);
   }

}