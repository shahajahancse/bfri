<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="page-content">     
   <div class="content">
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('pass/host_person')?>" class="active"> <?=$module_title; ?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal green">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <a href="<?=base_url('pass/add_host_person')?>" class="btn btn-blueviolet btn-xs btn-mini"> Add Host Person</a>  
                  </div>            
               </div>

               <div class="grid-body">
                  <div id="infoMessage"><?php //echo $message;?></div>
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>

                  <table class="table table-hover table-bordered  table-flip-scroll cf">
                     <thead class="cf">
                        <tr>
                           <th width="15">SL</th>
                           <th>Host Name</th>
                           <th>Designation</th>
                           <th width="150">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl = 0;
                        foreach ($results as $row):
                           $sl++;
                        ?>
                        <tr>
                           <td><?=$sl.'.'?></td>
                           <td><?php echo $row->host_name;?></td>
                           <td><?php echo $row->host_designation;?></td>
                           <td><?php echo anchor("pass/edit_host_person/".$row->id, 'Edit','class="btn btn-mini btn-primary"') ;?>&nbsp;<a href="#" class="btn btn-mini btn-danger">Delete</a></td>                           
                        </tr>
                        <?php 
                        endforeach;
                        ?>
                     </tbody>
                  </table>
               </div> <!-- /grid-body -->
            </div>
         </div>
      </div>

   </div> <!-- /content -->
</div> <!-- /page-content -->