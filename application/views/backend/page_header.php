<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <link rel="icon" type="image/ico" href="<?=base_url('awedget/assets/img/favicon.ico');?>" />
    <title><?=$meta_title?> | BCCT </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link href="<?=base_url();?>awedget/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css"
        media="screen" />
    <meta content="Mysoftheaven (BD) Ltd." name="author" />
    <link href="<?=base_url();?>awedget/assets/plugins/jquery-superbox/css/style.css" rel="stylesheet" type="text/css"
        media="screen" />
    <link href="<?=base_url();?>awedget/assets/plugins/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet"
        type="text/css" media="screen" />
    <link href="<?=base_url();?>awedget/assets/plugins/fullcalendar/dist/fullcalendar.print.min.css" rel="stylesheet"
        type="text/css" media="print" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
   <link href="<?=base_url();?>awedget/assets/plugins/bootstrap-select2/select2.css" rel="stylesheet"
    type="text/css" media="screen"/>
   <link href="<?=base_url();?>awedget/assets/plugins/select2/select2.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="<?=base_url();?>awedget/assets/plugins/dropzone/css/dropzone.css" rel="stylesheet" type="text/css"/>
 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
    <!-- Datepicker -->
    <link href="<?=base_url();?>awedget/assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet"
        type="text/css" />
    <!-- <link href="<?=base_url();?>awedget/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.css" rel="stylesheet" type="text/css" /> -->
    <!-- <link href="<?=base_url();?>awedget/assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" /> -->

    <link href="<?=base_url();?>awedget/assets/plugins/jquery-datatable/css/jquery.dataTables.css" rel="stylesheet" type="text/css"/>
    <link href="<?=base_url();?>awedget/assets/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="<?=base_url();?>awedget/assets/plugins/boostrap-checkbox/css/bootstrap-checkbox.css" rel="stylesheet"
        type="text/css" media="screen" />
    <link rel="stylesheet" href="<?=base_url();?>awedget/assets/plugins/ios-switch/ios7-switch.css" type="text/css"
        media="screen">
    <link href="<?=base_url();?>awedget/assets/plugins/jquery-slider/css/jquery.sidr.light.css" rel="stylesheet"
        type="text/css" media="screen" />
    <?php /*
   <!-- <link href="<?=base_url();?>awedget/assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet"
    type="text/css"/>
    <link href="<?=base_url();?>awedget/assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    */ ?>
    <link href="<?=base_url();?>awedget/assets/plugins/boostrap-3.3.7/css/bootstrap.min.css" rel="stylesheet"
        type="text/css" />
    <link href="<?=base_url();?>awedget/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet"
        type="text/css" />
    <link href="<?=base_url();?>awedget/assets/css/animate.min.css" rel="stylesheet" type="text/css" />
    <?php /*
   <link rel="stylesheet" href="<?=base_url();?>awedget/assets/croper/css/cropper.min.css">
    <link rel="stylesheet" href="<?=base_url();?>awedget/assets/croper/css/main.css">
    */ ?>

    <link href="<?=base_url();?>awedget/assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>awedget/assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>awedget/assets/css/custom-icon-set.css" rel="stylesheet" type="text/css" />
    <?php /*
   <!-- <script src="<?=base_url();?>awedget/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script> -->
    <!-- <script src="<?=base_url();?>awedget/assets/plugins/jquery-3.2.1.min.js" type="text/javascript"></script> -->

    <!-- <script src="<?=base_url();?>awedget/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script> -->
    <!-- <script src="<?=base_url();?>awedget/assets/plugins/jquery-1.9.1.min.js" type="text/javascript"></script> -->
    */?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> -->
    <script type="text/javascript">
    var hostname = '<?php echo base_url();?>';
    </script>
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script> -->
</head> <!-- END HEAD -->
<style>
    .select2-container{
        display: inline-table !important;
    }
</style>
<?php  if($this->router->fetch_class('my_message') == 'my_message'){ ?>

<body class="inner-menu-always-open">
    <?php }else{ ?>

    <body class="">
        <?php } ?>
        <div class="header navbar navbar-inverse ">
            <div class="navbar-inner">
                <div class="header-seperation">
                    <ul class="nav pull-left notifcation-center" id="main-menu-toggle-wrapper" style="display:none">
                        <li class="dropdown"> <a id="main-menu-toggle" href="#main-menu" class="">
                                <div class="iconset top-menu-toggle-white"></div>
                            </a>
                        </li>
                    </ul>

                    <a href="<?=base_url('dashboard')?>"> <img style="height: 60px;width: 251px;" src="<?=base_url('awedget/assets/img/logo.jpg')?>" alt=""></a>
                    <ul class="nav pull-right notifcation-center">
                        <li class="dropdown" id="header_task_bar">
                          
                        </li>
                    </ul>
                </div>

                <div class="header-quick-nav">
                    <div class="pull-left">
                        <ul class="nav quick-section">
                            <li class="quicklinks"> <a href="javascript:;" class="" id="layout-condensed-toggle"
                                    style="color: #8dc641;"> <i class="fa fa-bars"
                                        style="font-size: 22px; color: #8dc641 !important;"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- BEGIN CHAT TOGGLER -->
                    <div class="pull-right">
                        <div class="chat-toggler">
                            <a>
                                <div class="user-details">
                                    <div class="username">
                                        <span class="bold"
                                            style="margin-left: 20px;"><?=$userDetails['user_info']->first_name?></span>
                                        <span
                                            style="font-size: 12px; font-weight: bold;">(<?=$userDetails['user_info']->username;?>)</span>
                                    </div>
                                </div>
                            </a>
                            <?php
                            $this->load->model('Common_model');
                            $get_requisition = $this->Common_model->get_requisition($limit, $offset, '1');
                            $get_purchase = $this->Common_model->get_purchase($limit, $offset, '1'); 
                            $allcount=count($get_requisition) + count($get_purchase);
                            ?>

                             <a id="notification" onclick="get_notification()" style="padding: 11px 19px;position: relative; display: inline-block; cursor: pointer;"> 
                               <span class="badge badge-danger" style="position: absolute;height: 15px;padding: 1px 6px;margin: -5px 9px;"><?=$allcount?></span>
                                <i class="fa fa-bell" style="font-size: 22px; color: #8dc641 !important;"></i>
                             </a>
                             <style>
                                .listt {
                                    list-style: none;
                                    padding: 4px 7px;
                                    border: 1px solid black;
                                    display: flex;
                                    margin: 5px 7px;
                                    overflow: hidden;
                                    border-radius: 5px;
                                }
                                .r_title{
                                    font-size: 16px;
                                    font-weight: bold;
                                }
                                .r_date {
                                    font-size: 11px;
                                    color: #606162;
                                    padding-left: 12px;
                                }
                                .r_status {
                                    font-size: 11px;
                                    color: #606162;
                                    padding-left: 12px;
                                }
                             </style>
                             <div id="notification_content" style="position: absolute;background: aliceblue;width: 264px;min-height: 198px;margin: 33px -87px;border-radius: 15px;height: fit-content;"> 
                                <div class="col-md-12" style="height: fit-content;border-bottom: 1px solid;padding: 0;overflow: auto;max-height: 241px;">
                                    <span style="height: 31px;display: block;background: #8dc641;color: black;font-weight: bold;padding: 5px 9px;font-size: larger;position: fixed;width: 264px;">Requisition <span class="badge badge-danger"><?=count($get_requisition)?></span></span>
                                    <ul style="margin-top: 36px;padding: 0;">
                                    <?php 
                                        if(count($get_requisition) > 0){
                                            foreach ($get_requisition as $key => $value) {
                                                ?>
                                                 <li class="listt">
                                                    <a href="<?=base_url('requisition/details/').encrypt_url($value->id) ?>" style="color: black;">
                                                    <div style="line-height: 15px;">
                                                    <span class="r_title"><?=$value->title?></span><br>
                                                    <span class="r_date">Create On : <?= date('d-M-Y h:i A', strtotime($value->created))?></span><br>
                                                    <span class="r_date">Update On : <?=date('d-M-Y h:i A', strtotime($value->updated)) ?></span><br>
                                                    <span class="r_status"><span class=" badge badge-danger">Pending</span>
                                                    </div>
                                                    </a>
                                                </li>
                                                <?php }
                                             }else{?>
                                                    <span>No Requisition</span>
                                                <?php }?>
                                    </ul>
                                </div>
                                <div class="col-md-12" style="height: fit-content;border-bottom: 1px solid;padding: 0;overflow: auto;max-height: 241px;">
                                    <span style="height: 31px;display: block;background: #8dc641;color: black;font-weight: bold;padding: 5px 9px;font-size: larger;position: fixed;width: 264px;">Purchase <span class="badge badge-danger"><?=count($get_purchase)?> </span></span>
                                    <ul style="margin-top: 36px;padding: 0;">
                                        <?php
                                            if(count($get_purchase) > 0){
                                                foreach ($get_purchase as $key => $value) {
                                                    ?>
                                                     <li class="listt">
                                                        <a href="<?=base_url('purchase/details/').encrypt_url($value->id)?>" style="color: black;">
                                                        <div style="line-height: 15px;">
                                                        <span class="r_title"><?=$value->supplier_name?></span><br>
                                                        <span class="r_date">Create On <?= date('d-M-Y h:i A', strtotime($value->created))?></span><br>
                                                        <span class="r_date">Update On <?=date('d-M-Y h:i A', strtotime($value->updated)) ?></span><br>
                                                        <span class="r_status"><span class=" badge badge-danger">Pending</span>
                                                        </div>
                                                        </a>
                                                    </li>

                                               <?php }}else{?>
                                                    <span>No Purchase</span>
                                                <?php }?>
                                       
                                    </ul>
                                </div>
                                
                             </div>
                             <script>
                             function get_notification(){
                                 $("#notification_content").toggle();
                               }
                               $("#notification_content").hide();
                            //    window.onclick = function(event) {
                            //      if (!event.target.matches('#notification')) {
                            //        $("#notification_content").toggle();
                            //      }
                            //    }
                               
                             </script>
                            <?php
                                $path = base_url().'profile_img/';
                                if($userDetails['user_info']->profile_img != NULL){
                                    $img_url = $path.$userDetails['user_info']->profile_img;
                                }else{
                                    $img_url = $path.'no-img.png';
                                }
                                ?>
                            <div class="profile-pic"> <img src="<?=$img_url?>" alt="Profile Image"
                                    data-src="<?=$img_url?>" data-src-retina="<?=$img_url?>" width="35" height="35" />
                            </div>
                        </div>

                        <ul class="nav quick-section ">
                            <li class="quicklinks"> <a data-toggle="dropdown" class="dropdown-toggle  pull-right "
                                    href="javascript:;" id="user-options"> <i class="fa fa-cog"
                                        style="font-size: 22px; color: #8dc641 !important;"></i> </a>
                                <ul class="dropdown-menu  pull-right" role="menu" aria-labelledby="user-options">
                                    <!-- <li><a href="<?=base_url('my_office')?>"> <i class="fa fa-user"></i>  My Office</a> </li> -->
                                    <li class="divider"></li>
                                    <li><a href="<?=base_url('logout')?>"><i class="fa fa-power-off"></i> Log Out</a>
                                    </li>
                                    <li><a href="<?=base_url('acl/edit_user').'/'.$userDetails['user_info']->id?>"><i class="fa fa-user"></i> Profile</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div> <!-- END CHAT TOGGLER -->

                </div> <!-- END TOP NAVIGATION MENU -->
            </div> <!-- END TOP NAVIGATION BAR -->
        </div> <!-- END HEADER -->


        <!-- BEGIN CONTAINER -->
        <div class="page-container row-fluid">
            <?php if($this->router->fetch_class('my_message') == 'my_message'){ ?>
            <div class="page-sidebar mini mini-mobile" id="main-menu" data-inner-menu="1">
                <div class="page-sidebar-wrapper">
                    <?php }else{ ?>
                    <div class="page-sidebar" id="main-menu">
                        <div class="page-sidebar-wrapper" id="main-menu-wrapper">
                            <?php } ?>
                            <div class="user-info-wrapper"
                                style=" padding-bottom: 10px; border-bottom: 1px solid #db0424;">
                                <div class="user-info" style="background-color: white; ">
                                    <span style="color: #683091">Login as:</span>
                                    <span class="label label-success">
                                        <?php  ;
                                        $t=$this->ion_auth->groupe($this->session->userdata['user_id']);

                                        ?>
                                        <strong><?= $t->name ?></strong></span>
                                </div>
                            </div>

                            <!-- BEGIN SIDEBAR MENU -->
                            <ul class="pull-left">
                                <li class="start <?=backend_activate_menu_class('dashboard')?>">
                                    <a href="<?=base_url('dashboard');?>"> <i class="icon-custom-home"></i> <span
                                            class="title">Dashboard</span></a>
                                </li>

                                <li class="start <?=backend_activate_menu_class('requisition')?>"> <a href="javascript:;">
                                        <i class="fa fa-tags"></i> <span class="title">Requisition</span> <span
                                            class="selected"></span> <span class="arrow"></span> </a>
                                    <ul class="sub-menu">
                                    <?php
                                        $permission=$this->ion_auth->get_permission();
                                        if(in_array(1,$permission)){
                                            ?>
                                       <li> <a href="<?=base_url('my_requisition/create');?>"> Create Requisition </a> </li>
                                        <?php } ?>
                                        <li> <a href="<?=base_url('requisition');?>"> Requisition List </a> </li>
                                        <li> <a href="<?=base_url('requisition/request_list');?>"> Requisition Pending  List </a> </li>
                                        <li> <a href="<?=base_url('requisition/approve_list');?>"> Requisition Approved List </a> </li>
                                        <li> <a href="<?=base_url('requisition/rejected_list');?>"> Requisition Rejected List </a> </li>
                                        <li> <a href="<?=base_url('requisition/delivered_list');?>"> Requisition Delivered List </a> </li>
                                    </ul>
                                </li>
                                <?php 
                                 if(in_array('6', $this->ion_auth->get_permission())){?>
                                <li class="start <?=backend_activate_menu_class('purchase')?>"> <a href="javascript:;">
                                        <i class="fa fa-tags"></i> <span class="title">Purchase</span> <span
                                            class="selected"></span> <span class="arrow"></span> </a>
                                    <ul class="sub-menu">
                                        <li> <a href="<?=base_url('purchase/create');?>"> Create Purchase  </a> </li>
                                        <li> <a href="<?=base_url('purchase');?>"> Purchase List </a> </li>
                                        <li> <a href="<?=base_url('purchase/purchase_pending');?>"> Purchase Pending </a> </li>
                                        <li> <a href="<?=base_url('purchase/purchase_approved');?>"> Purchase Approved </a> </li>
                                        <li> <a href="<?=base_url('purchase/purchase_rejected');?>"> Purchase Rejected </a> </li>
                                        <li> <a href="<?=base_url('purchase/purchase_received');?>"> Purchase Received </a> </li>
                                    </ul>
                                </li>
                            
                                <li class="start <?=activate_menu_method('index')?>"><a
                                        href="<?=base_url('reports/index')?>"> <i class="fa fa-th"></i>
                                        <span class="title">Reports</span> </a>
                                </li>

                                <li class="start <?=backend_activate_menu_class('items')?>"> <a href="javascript:;"> <i
                                            class="fa fa-tags"></i> <span class="title">Item Setup</span> <span
                                            class="selected"></span> <span class="arrow"></span> </a>
                                    <ul class="sub-menu">
                                        <li> <a href="<?=base_url('items');?>"> Item List </a> </li>
                                    </ul>
                                </li>
                                <?php } ?>
                                <?php if($this->ion_auth->is_admin()){ ?>
                                <li class="start <?=backend_activate_menu_class('general_setting')?>"> <a
                                        href="javascript:;"> <i class="fa fa-cogs"></i> <span class="title">General
                                            Setting</span> <span class="selected"></span> <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li> <a href="<?=base_url('general_setting/sub_categories');?>"> Sub
                                                Categories</a></li>
                                        <li> <a href="<?=base_url('general_setting/categories');?>"> Categories</a></li>
                                        <li> <a href="<?=base_url('general_setting/item_unit');?>"> Item Unit</a></li>
                                        <li> <a href="<?=base_url('general_setting/department');?>"> Department</a></li>
                                        <li> <a href="<?=base_url('general_setting/designation');?>"> Designation</a>
                                        <li> <a href="<?=base_url('general_setting/group');?>"> Group</a>
                                        </li>
                                    </ul>
                                </li>
                                <?php } ?>

                                <?php if($this->ion_auth->is_admin()){ ?>
                                <li class="start <?=backend_activate_menu_class('acl')?>"> <a href="javascript:;"> <i
                                            class="fa fa-key"></i> <span class="title">Access Control</span> <span
                                            class="selected"></span> <span class="arrow"></span> </a>
                                    <ul class="sub-menu">
                                        <li> <a href="<?=base_url('acl');?>"> User List </a> </li>
                                    </ul>
                                </li>
                                <?php } ?>




                                <li class="start"><a href="<?=base_url('logout')?>">
                                        <i class="fa fa-power-off"></i>
                                        <span class="title">Log Out</span> </a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                            <!-- END SIDEBAR MENU -->
                        </div>

                        <?php if($this->router->fetch_class('my_message') == 'my_message'){ ?>
                        <div class="inner-menu nav-collapse" style="float: right;">
                            <div class="inner-wrapper" style="margin-bottom: 10px;">
                                <a href="javascript:void();" class="btn btn-block btn-primary"><span
                                        class="bold">COMPOSE</span></a>
                            </div>
                            <ul class="big-items">
                                <li class="active"><span class="badge badge-important">2</span><a
                                        href="javascript:void();"> Inbox</a></li>
                                <li><a href="javascript:void();">Sent</a></li>
                                <li><a href="javascript:void();">Draft</a></li>
                                <li><a href="javascript:void();">Trash</a></li>
                            </ul>
                            <ul class="small-items" style="margin-bottom: 0px;">
                                <li class=""><a href="#"> Home</a></li>
                                <li><span class="badge badge-important">2</span><a href="#"> Work</a></li>
                            </ul>
                            <div class="inner-wrapper" style="margin-top: 5px;">
                                <p class="menu-title">QUICK VIEW</p>
                            </div>
                            <ul class="small-items" style="margin-bottom: 0px;">
                                <li class=""><a href="#"> Documents</a></li>
                                <li class=""><span class=" badge badge-disable ">203</span><a href="#"> Images</a></li>
                            </ul>
                        </div>
                        <?php } ?>

                    </div>

                    <a href="#" class="scrollup">Scroll</a>

                    <div class="footer-widget">
                        <div class="copyrights pull-left" style="width: 50%">
                            <!-- <span> <span style="vertical-align: bottom; font-size: 10px;">কারিগরি সহায়তায় |</span>  <a href="http://a2i.pmo.gov.bd/" target="_blank">  -->
                            <!-- <img src="<?php echo base_url('fwedget/assets/images/logo_ict.png')?>" height="10"> </a> </span> -->
                        </div>
                        <div class="copyrights pull-right" style="width: 50%">
                            <!-- <span style=" float: right;"> <span style="vertical-align: bottom; font-size: 11px;">Developed By |</span> <a href="http://www.mysoftheaven.com/" target="_blank"> 
                  <img src="<?php echo base_url('awedget/assets/img/mysoft-logo.png')?>" height="18"></a> </span> -->
                        </div>

                        <?php /*
               <!-- <div class="lock">    
                  <a href="<?=base_url('login/logout')?>"><i class="fa fa-power-off"></i></a>
                    </div> -->
                    */ ?>
                </div>
                <!-- END SIDEBAR -->