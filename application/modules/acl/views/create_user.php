<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="page-content">
    <div class="content">
        <ul class="breadcrumb" style="margin-bottom: 20px;">
            <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
            <li> <a href="<?=base_url('acl')?>" class="active"> <?=$module_title; ?> </a></li>
            <li><?=$meta_title; ?></li>
        </ul>

        <div class="row">
            <div class="col-md-8">
                <div class="grid simple horizontal red">
                    <div class="grid-title">
                        <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                        <div class="pull-right">
                            <a href="<?=base_url('acl')?>" class="btn btn-blueviolet btn-xs btn-mini"> User List</a>
                        </div>
                    </div>
                    <div class="grid-body">
                        <?php echo form_open("acl/create_user", array('id' => 'jsvalidate'));?>

                        <?php if($this->session->flashdata('success')):?>
                        <div class="alert alert-success">
                            <?php echo $this->session->flashdata('success');?>
                        </div>
                        <?php endif; ?>

                        <div class="row form-row">
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <?php echo form_error('full_name'); ?>
                                <?php echo form_input($full_name);?>
                            </div>
                            <div class="col-md-6">
                                <?php if($identity_column!=='email') { ?>
                                <label class="form-label">Username or Email</label>
                                <?php echo form_error('identity'); ?>
                                <?php echo form_input($identity);?>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="row form-row">
                            <div class="col-md-6">
                                <label class="form-label"><?php echo lang('create_user_phone_label', 'phone');?></label>
                                <?php echo form_error('phone'); ?>
                                <?php echo form_input($phone);?>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><?php echo lang('create_user_email_label', 'email');?></label>
                                <?php echo form_error('email'); ?>
                                <?php echo form_input($email);?>
                            </div>
                        </div>

                        <div class="row form-row">
                            <div class="col-md-6">
                                <label
                                    class="form-label"><?php echo lang('create_user_password_label', 'password');?></label>
                                <?php echo form_error('password'); ?>
                                <?php echo form_input($password);?>
                            </div>
                            <div class="col-md-6">
                                <label
                                    class="form-label"><?php echo lang('create_user_password_confirm_label', 'password_confirm');?></label>
                                <?php echo form_error('password_confirm'); ?>
                                <?php echo form_input($password_confirm);?>
                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="pull-right">
                                <?php echo form_submit('submit', 'Save', "class='btn btn-primary btn-cons'"); ?>
                            </div>
                        </div>
                        <?php echo form_close();?>

                    </div> <!-- END GRID BODY -->
                </div> <!-- END GRID -->
            </div>

        </div> <!-- END ROW -->

    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {

    // JS Validation
    $('#jsvalidate').validate({
        // focusInvalid: false, 
        ignore: "",
        rules: {
            full_name: {
                required: true
            },
            phone: {
                required: true,
                number: true,
                minlength: 11,
                maxlength: 11
            },
            date: {
                required: true
            },
            date_end: {
                required: true
            },
            venue: {
                required: true
            }
        },

        invalidHandler: function(event, validator) {
            //display error alert on form submit    
        },

        errorPlacement: function(label, element) { // render error placement for each input type   
            $('<span class="error"></span>').insertAfter(element).append(label)
            var parent = $(element).parent('.input-with-icon');
            parent.removeClass('success-control').addClass('error-control');
        },

        highlight: function(element) { // hightlight error inputs
            var parent = $(element).parent();
            parent.removeClass('success-control').addClass('error-control');
        },

        unhighlight: function(element) { // revert the change done by hightlight

        },

        success: function(label, element) {
            var parent = $(element).parent('.input-with-icon');
            parent.removeClass('error-control').addClass('success-control');
        },

        submitHandler: function(form) {
            form.submit();
        }
    });
});
</script>