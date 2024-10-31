<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('items')?>" class="active"> <?=$module_title; ?> </a></li>
         <li> <?=$meta_title; ?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('items')?>" class="btn btn-blueviolet btn-xs btn-mini"> Item List</a>  
                  </div>
               </div>
               <div class="grid-body">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>

                  <?php 
                  $attributes = array('id' => 'validate');
                  echo form_open_multipart(uri_string(), $attributes);
                  ?>

                  <div class="row form-row">
                     <div class="col-md-5">
                        <label class="form-label">Select Category <span class="required">*</span></label>
                        <?php echo form_error('cat_id');
                        $more_attr = 'class="form-control input-sm" id="category"';
                        echo form_dropdown('cat_id', $categories, set_value('cat_id', $info->cat_id), $more_attr);
                        ?>
                     </div>
                     <div class="col-md-5">
                        <label class="form-label">Select Sub Category <span class="required">*</span></label>
                        <?php echo form_error('sub_cate_id');
                        $more_attr = 'class="sub_category_val form-control input-sm" id="sub_category" required';
                        echo form_dropdown('sub_cate_id', $sub_categories, set_value('sub_cate_id', $info->sub_cate_id), $more_attr);
                        ?>
                     </div>
                     <div class="col-md-2">
                        <label class="form-label">Order Level </label>
                        <?php echo form_error('order_level'); ?>
                        <input name="order_level" type="text" value="<?=set_value('order_level', $info->order_level)?>" class="form-control input-sm" placeholder="">
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-4">
                        <label class="form-label">Item Name <span class="required">*</span></label>
                        <?php echo form_error('item_name'); ?>
                        <input name="item_name" type="text" value="<?=set_value('item_name', $info->item_name)?>" class="form-control input-sm" placeholder="">
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Select Unit <span class="required">*</span></label>
                        <?php echo form_error('unit_id');
                        $more_attr = 'class="form-control input-sm"';
                        echo form_dropdown('unit_id', $units, set_value('unit_id', $info->unit_id), $more_attr);
                        ?>
                     </div>
                     <div class="col-md-2">
                        <label class="form-label">Quantity</label>
                        <?php echo form_error('quantity'); ?>
                        <input name="quantity" type="text" value="<?=set_value('quantity', $info->quantity)?>" class="form-control input-sm" placeholder="">
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Status</label>
                        <?php echo form_error('status'); ?>
                        <input type="radio" name="status" id="" class="group_control" value="1" <?=set_value('status', $info->status)==1?'checked':'';?>> Enable &nbsp;&nbsp;
                        <input type="radio" name="status" id="" class="group_control" value="0" <?=set_value('status', $info->status)==0?'checked':'';?>> Disable
                     </div>
                  </div>
                  <div class="row form-row">
                     <div class="col-md-12">
                        <h4 class="form-header">Item Group Availability</h4>
                     </div>
                     <div class="col-md-12">
                        <style>
                           td{
                              padding: 5px 0px;
                           }
                        </style>
                        <table class="table table-bordered">
                           <tr>
                              <th>#</th>
                              <th>Group Name</th>
                              <th>Availability</th>
                           </tr>
                           <?php
                           $groups=$this->db->get('groups')->result();
                           foreach ($groups as $key => $value) {
                              $abb_info=$this->db->get_where('availability_items',array('group_id'=>$value->id,'item_id'=>$info->id,'year'=>date('Y')))->row();
                              ?> 
                              <tr>
                                 <td><?= $key+1 ?></td>
                                 <td><?= $value->name ?><input type="hidden" name="group_id[]" value="<?= $value->id ?>"></td>
                                 <td><input type="number" name="availability[]" value="<?=(!empty($abb_info))?$abb_info->availability:0?>"></td>
                              </tr>  
                        <?php } ?>
                       </table>
                     </div>
                  </div>

                  <div class="form-actions">  
                     <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save</button>
                     </div>
                  </div>

                  <?php echo form_close();?>

               </div>  <!-- END GRID BODY -->              
            </div> <!-- END GRID -->
         </div>

      </div> <!-- END ROW -->

   </div>
</div>

<script type="text/javascript">
   $(document).ready(function() {
      $('#validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         cat_id: { required: true },
         sub_cate_id: { required: true },
         item_name: { required: true },
         unit_id: { required: true },
         status: {required: true}
      }
   });
   });   
</script>