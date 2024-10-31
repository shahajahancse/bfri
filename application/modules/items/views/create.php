
<style>
.input-sm {
    height: 30px;
    padding: 0px 0px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 3px;
}
</style>


<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <?=$module_title?> </li>
         <li> <?=$meta_title; ?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('items')?>" class="btn btn-blueviolet btn-xs btn-mini"> Items List</a>  
                  </div>
               </div>
               <div class="grid-body" style="padding: 26px 29px;">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>

                  <?php 
                  $attributes = array('id' => 'validate');
                  echo form_open_multipart("items/create", $attributes);?>                  
                  <div class="row form-row">
                     <div class="col-md-5">
                        <label class="form-label">Select Category <span class="required">*</span></label>
                        <?php
                      
                        $cat=$this->db->get('categories')->result();
                        ?>
                        <select name="cat_id" onchange="getSubCategory(this.value)" class="form-control input-sm" required>
                           <option value="">-- Select One --</option>
                           <?php
                           foreach ($cat as $key => $value) {
                              ?>
                              <option value="<?=$value->id?>"><?=$value->category_name?></option>
                              <?php
                           } ?>
                        </select>
                     </div>
                     <div class="col-md-5">
                        <label class="form-label">Select Sub Category <span class="required">*</span></label>
                        <?php echo form_error('sub_cate_id'); ?>
                        <select name="sub_cate_id" class="sub_category_val form-control input-sm" id="sub_category" required>
                           <option value="">-- Select One --</option>
                        </select>
                     </div>
                     <div class="col-md-2">
                        <label class="form-label">Order Level </label>
                        <?php echo form_error('order_level'); ?>
                        <input name="order_level" type="text" value="<?=set_value('order_level')?>" class="form-control input-sm" placeholder="">
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-6">
                        <label class="form-label">Item Name <span class="required">*</span></label>
                        <?php echo form_error('item_name'); ?>
                        <input name="item_name" type="text" value="<?=set_value('item_name')?>" class="form-control input-sm" placeholder="">
                     </div>
                     <div class="col-md-4">
                        <label class="form-label">Select Unit <span class="required">*</span></label>
                        <?php echo form_error('unit_id');
                        $more_attr = 'class="form-control input-sm"';
                        echo form_dropdown('unit_id', $units, set_value('unit_id'), $more_attr);
                        ?>
                     </div>
                     <div class="col-md-2">
                        <label class="form-label">Quantity <span class="required">*</span></label>
                        <?php echo form_error('quantity'); ?>
                        <input name="quantity" type="text" value="<?=set_value('quantity')?>" class="form-control input-sm" placeholder="">
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
                           foreach ($groups as $key => $value) { ?>   
                              <tr>
                                 <td><?= $key+1 ?></td>
                                 <td><?= $value->name ?> <input type="hidden" name="group_id[]" value="<?= $value->id ?>"></td>
                                 <td><input type="number" name="availability[]" value="0"></td>
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
      ignore: "",
      rules: {
         cat_id: { required: true },
         sub_cate_id: { required: true },
         item_name: { required: true },
         unit_id: { required: true },
         quantity: { required: true }
      }
   });
   });   
</script>
<script>
   function getSubCategory(id){
      $.ajax({
         type: "POST",
         url: "<?=base_url('items/get_sub_category_by_category/');?>"+id,
         success: function(data){
             var parsedData = JSON.parse(data);
             $('#sub_category').empty();
             parsedData.forEach(function(item){
                 $('#sub_category').append('<option value="' + item.id + '">' + item.sub_cate_name + '</option>');
             })
         }
      })
      
   }
</script>