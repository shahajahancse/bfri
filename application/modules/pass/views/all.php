<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="page-content">     
   <div class="content">
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('pass')?>" class="active"> <?=$module_title; ?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal green">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <a href="<?=base_url('pass/create')?>" class="btn btn-blueviolet btn-xs btn-mini"> Create Pass </a>
                  </div>            
               </div>

               <div class="grid-body ">
                  <div id="infoMessage"><?php echo $message;?></div>   
                  <!-- <form method="get" action="">
                     <div class="row">
                        <div class="col-md-2">     
                           <input type="text" name="name" value="<?=$_GET['name']?>" class="form-control input-sm" placeholder="Name"> 
                        </div>
                        <div class="col-md-2">     
                           <input type="text" name="username" value="<?=$_GET['username']?>" class="form-control input-sm" placeholder="Username"> 
                        </div>
                        <div class="col-md-1">
                           <div class="pull-right ">
                              <button type="submit" class="btn btn-blueviolet btn-mini"><i class="icon-ok"></i> Search</button>
                           </div>
                        </div>
                     </div>
                  </form> -->

                  <table class="table table-hover table-bordered table-flip-scroll cf">
                     <thead class="cf">
                        <tr>
                           <th>SL</th>
                           <th width="200">Datetime</th>
                           <th>Name</th>                        
                           <th>Mobile No</th>
                           <th>Email</th>
                           <th>Host</th>
                           <th width="80">Status</th>
                           <th width="60">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl = $pagination['current_page'];
                        foreach ($results as $row):
                           $sl++;

                        if($row->user_id){
                           $name    = $row->first_name;
                           $mobile  = $row->phone;
                           $email   = $row->email;
                        }else{
                           $name    = $row->name;
                           $mobile  = $row->mobile_no;
                           $email   = $row->email;
                        }

                        if($row->status == 1) {
                           $status = '<span class="label label-success">Approve</span>';
                        }elseif($row->status == 2) {
                           $status = '<span class="label">Reject</span>';
                        }elseif($row->status == 3) {
                           $status = '<span class="label">Complete</span>';
                        }elseif($row->status == 4) {
                           $status = '<span class="label">Cancel</span>';
                        }else{
                           $status = '<span class="label label-important">Pending</span>';
                        }

                        $host = $row->host_name.' ('.$row->host_designation.')';
                        ?>
                        <tr>
                           <td><?=$sl.'.'?></td>
                           <td><?php echo date("F d, Y h:i A", strtotime($row->created));?></td>
                           <td><?php echo $name;?></td>
                           <td><?php echo $mobile;?></td>
                           <td><?php echo $email;?></td>
                           <td><?php echo $host;?></td>
                           <td><?php echo $status;?></td>
                           <td align="right">
                              <div class="btn-group"> <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                                 <ul class="dropdown-menu pull-right">
                                    <li><?=anchor("pass/approve/".encrypt_url($row->id), 'Approve App.')?></li>
                                    <li><?=anchor("pass/reject/".encrypt_url($row->id), 'Reject App.')?></li>                                    
                                    <?php 
                                    if($this->ion_auth->is_admin() || $this->ion_auth->is_sec_admin() || $this->ion_auth->is_ps_admin()){ ?>
                                    <li><?=anchor("pass/delete/".encrypt_url($row->id), 'Delete', 'onclick="return confirm(\'Be careful! Are you sure you want to delete this pass?\');"')?></li>
                                    <?php } ?>
                                 </ul>
                              </div>
                           </td>
                        </tr>
                        <?php 
                        endforeach;
                        ?>
                     </tbody>
                  </table>

                  <div class="row">
                     <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Pass </span></div>
                     <div class="col-sm-8 col-md-8 text-right">
                        <?php echo $pagination['links']; ?>
                     </div>
                  </div>

               </div>

            </div>
         </div>
      </div>

   </div> <!-- /END ROW -->
</div> <!-- /page-content -->