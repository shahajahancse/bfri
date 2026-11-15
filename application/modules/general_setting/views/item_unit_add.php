<div class="page-content">
  <div class="content">
    <ul class="breadcrumb">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
     <!--  <li> <?=$module_name?> </li> -->
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
       <div class="col-md-12">
          <div class="grid simple horizontal">
             <div class="grid-title">
              <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
              <div class="pull-right">
                <a href="<?=base_url('general_setting/units')?>" class="btn btn-blueviolet btn-xs btn-mini">List</a>
              </div>
             </div>
             <div class="grid-body">
              <?php if($this->session->flashdata('success')):?>
                  <div class="alert alert-success">
                      <a class="close" data-dismiss="alert">&times;</a>
                      <?php echo $this->session->flashdata('success');;?>
                  </div>
              <?php endif; ?>

              <?php
              $attributes = array('id' => 'department_validate');
              echo form_open_multipart("general_setting/item_unit_add", $attributes);?>

              <div class="row form-row">
                <div class="col-md-4">
                  <label class="form-label">Name <span style="color:red">*</span></label>
                  <?php echo form_error('unit_name'); ?>
                  <input name="unit_name" id="unit_name" type="text" value="<?=set_value('unit_name')?>" class="form-control input-sm" placeholder="">
                </div>
                <div class="col-md-4">
                  <label class="form-label">Status <span style="color:red">*</span></label>
                  <?php echo form_error('status'); ?>
                  <select name="status" class="form-control" id="status">
                    <option value="">Select One</option>
                    <option value="Enable">Active</option>
                    <option value="Disable">Inactive</option>
                  </select>
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
      $('#department_validate').validate({
      // focusInvalid: false,
      ignore: "",
      rules: {
         name_bn: {
            required: true
         },
         name_en: {
            required: true
         },
         address_bn: {
            required: true
         },
         address_en: {
            required: true
         },
      },

    });
   });
</script>
