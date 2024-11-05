<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('reports/index')?>" class="active"> <?=$module_title; ?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <div class="row-fluid">
         <div class="span12">
            <div class="grid simple horizontal">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>           
               </div>

               <div class="grid-body">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>
                  
                  <?php 
                  $attributes = array('id' => 'validate', 'target'=>'_blank');
                  echo form_open("reports/index", $attributes);?>

                  <fieldset class="col-md-12">      
                     <legend>Report Filtering</legend>
                     <div id="error" style="display: none;">
                        <div class="alert alert-danger">Please fill up red level input filtering field.</div>
                     </div>

                     <div class="row">
                        <div class="col-md-4 m-t-10">
                           <label for="user_id"> Select User</label>
                           <select name="user_id" class="form-control input-sm" id="user_id">
                              <?php
                              foreach ($users as $key => $value) {
                                 if ($value != null) {
                                    echo '<option value="' . $key . '">' . $value . '</option>';
                                 }
                              }
                              ?>
                           </select>
                        </div>
                        <div class="col-md-4 m-t-10">
                           <label for="fiscal_year"> Select Fascial Year</label>
                           <select name="fiscal_year" class="form-control input-sm" id="fiscal_year">
                              <option value="">-- Select fascial year --</option>
                              <?php
                              $fascial=$this->db->get('fiscal_year')->result();
                              foreach ($fascial as $key => $value) {
                                 if ($value != null) {
                                    echo '<option ' . ($value->active==1?"selected":"") . ' value="' . $value->id . '">' . $value->fiscal_year_name . '</option>';
                                 }
                              }
                              ?>
                           </select>
                        </div>
                        <div class="col-md-2 m-t-10">
                           <label for="date_from">From Date</label>
                           <input name="date_from" value="<?=set_value('date_from')?>" type="text" id="date_from" class="form-control input-sm datepicker" placeholder="Date From" autocomplete="off">
                        </div>
                        <div class="col-md-2 m-t-10">
                           <label for="date_from">To Date</label>
                           <input name="date_to" value="<?=set_value('date_to')?>" type="text" id="date_to" class="form-control input-sm datepicker" placeholder="Date To" autocomplete="off">
                        </div>
                     </div>
                 </fieldset> 

                <?php if(in_array('5', $this->ion_auth->get_permission())){?>
                     <fieldset class="col-md-12">      
                        <legend>Item Report</legend>
                        <button type="submit" name="btnsubmit" value="item_report" class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> Item Report </button>
                        <button type="submit" name="btnsubmit" value="low_inventory" class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> Low Invertory </button>
                     </fieldset> 
                     <fieldset class="col-md-12">      
                        <legend>Requsition Report</legend>
                        <button type="submit" name="btnsubmit" value="request_requisition"  class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> Request Requisition </button>
                        <button type="submit" name="btnsubmit" value="approve_requisition" class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> Approve Requisition </button>
                        <button type="submit" name="btnsubmit" value="rejected_requisition" class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> Rejected Requisition </button>
                        <button type="submit" name="btnsubmit" value="delivered_requisition" class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> Delivered Requisition </button>
                     </fieldset> 
                     <fieldset class="col-md-12">      
                        <legend>Report Button</legend>
                        <button type="submit" name="btnsubmit" value="request_purchase"  class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> Request Purchase </button>
                        <button type="submit" name="btnsubmit" value="approve_purchase"  class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> Approve Purchase </button>
                        <button type="submit" name="btnsubmit" value="rejected_purchase"  class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> Rejected Purchase </button>
                        <button type="submit" name="btnsubmit" value="recceived_purchase"  class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> Recceived Purchase </button>
                     </fieldset> 
               <?php } ?>
                     <fieldset class="col-md-12">      
                        <legend>Your Own Report</legend>
                              <button type="submit" name="btnsubmit" value="user_request_requisition"  class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> Request Requisition </button>
                              <button type="submit" name="btnsubmit" value="user_approve_requisition" class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> Approve Requisition </button>
                              <button type="submit" name="btnsubmit" value="user_rejected_requisition" class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> Rejected Requisition </button>
                              <button type="submit" name="btnsubmit" value="user_delivered_requisition" class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> Delivered Requisition </button>
                     </fieldset> 
                  <div class="clearfix"></div>
                  <?php form_close(); ?>
               </div> <!-- /grid-body -->
            </div> <!-- /grid -->
         </div>
      </div> <!-- /row-fluid -->

   </div> <!-- /content -->
   
</div> <!-- /page-content -->

<script>

   function smr_region() {
      // var field = document.getElementById("financing_id").value;
      var startDate = document.getElementById("date_from").value;
      var endDate = document.getElementById("date_to").value;
      submitOK = "true";

      // if (field == '') {        
      //   $("#financing_id").css("border", "1px solid red");
      //   submitOK = "false";
      // }
      if (startDate == '') {        
         $("#date_from").css("border", "1px solid red");
         submitOK = "false";
      }
      if (endDate == '') {        
         $("#date_to").css("border", "1px solid red");
         submitOK = "false";
      }

      if (submitOK == "false") {
         $("#error").show();
         return false;
      }else{
         // window.open(hostname);
         $("#validate").submit();
      }
   }
</script>