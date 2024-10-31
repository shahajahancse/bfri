<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li><a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a></li>
         <li><a href="<?=base_url('my_requisition')?>" class="active"><?=$module_name?></a></li>
         <li><?=$meta_title; ?></li>
      </ul>
      <style type="text/css">
         .tg  {border-collapse:collapse;border-spacing:0; border: 0px solid red;}
         .tg td{font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#00000;background-color:#E0FFEB; vertical-align: middle;}
         .tg th{font-size:14px;font-weight:bold;padding:3px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#bce2c5;text-align: center;}
         .tg .tg-khup{background-color:#efefef;vertical-align:top; color: black; text-align: right; width: 150px;}
         .tg .tg-ywa9{background-color:#ffffff;vertical-align:top; color: black;}
      </style>          

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('requisition/request_list')?>" class="btn btn-blueviolet btn-xs btn-mini"> Request Requisition List</a>  


                     <?php if(!$this->ion_auth->in_group('User') ){ ?>
                                    <?php if($this->ion_auth->in_group('Store Keeper') ){ 
                                       if($row->desk_id==0){
                                       ?>

                                    <?=anchor("requisition/change_status/".encrypt_url($info->id), 'Approval Status', array('class' => 'btn btn-blueviolet btn-mini'))?>  
                                   
                                    <?php }}elseif($roleid==$row->desk_id){?>
                                       
                                       <?=anchor("requisition/change_status/".encrypt_url($info->id), 'Approval Status', array('class' => 'btn btn-blueviolet btn-mini'))?>  
                              <?php }} ?>
                  </div>
               </div>

               <div class="grid-body"  id="printableArea">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>

                  <?php
                  // Stauts
                  if($info->status == 2) {
                     $status = '<span class="label label-success">Approved</span>';
                  }elseif($info->status == 3) {
                     $status = '<span class="label">Rejected</span>';
                  }else{
                     $status = '<span class="label label-important">Pending</span>';
                  }
                  ?>

                  <div class="row">
                     <div class="col-md-12">
                        <table class="tg" width="100%">
                           <tr>
                              <th class="tg-khup"> Requisition Title </th>
                              <td class="tg-ywa9"><?=$info->title?></td>
                              <th class="tg-khup"> Status </th>
                              <td class="tg-ywa9"><?=$status?></td>
                              <!-- <th class="tg-khup"> Fiscal Year</th>
                              <td class="tg-ywa9"><?=$info->fiscal_year_name?></td> -->
                           </tr> 
                           <tr>
                              <th class="tg-khup"> Created </th>
                              <td class="tg-ywa9"><?=date('d M, Y h:i A', strtotime($info->created)); ?></td>
                              <th class="tg-khup"> Updated </th>
                              <td class="tg-ywa9"><?=date('d M, Y h:i A', strtotime($info->updated)); ?></td>
                              <th class="tg-khup"> </th>
                              <td class="tg-ywa9"></td>
                           </tr> 
                           <tr>
                              <th class="tg-khup"> Applicant Name </th>
                              <td class="tg-ywa9"><?=$info->first_name?></td>
                              <th class="tg-khup"> Designation </th>
                              <td class="tg-ywa9"><?=$info->desig_name?></td>
                              <th class="tg-khup"> Department </th>
                              <td class="tg-ywa9"><?=$info->dept_name?></td>
                           </tr> 
                           <tr>
                              <th class="tg-khup"> Urgent </th>
                              <td class="tg-ywa9"><?=($info->urgent_status==0)?'<span >No</span>':'<span class="text-danger">Yes</span>'?></td>
                              <th class="tg-khup"> Save </th>
                              <td class="tg-ywa9"><?=($info->is_save)?'<span class="text-success">Yes</span>':'No' ?></td>
                              
                           </tr> 

                           <tr>
                              <th class="tg-khup"> Requisition List </th>
                              <td class="tg-ywa9" colspan="6">
                                 <table>
                                    <tr>
                                       <th>SL</th>
                                       <th>Item Name (Unit)</th>
                                       <th>Request Qty.</th>
                                       <th>Approve Qty.</th>
                                       <th>Remarks</th>
                                    </tr>
                                    <?php 
                                    $sl=0;
                                    foreach($items as $item){ 
                                       $sl++;
                                       ?>
                                       <tr>
                                          <td><?=$sl?></td>
                                          <td><?=$item->item_name?></td>
                                          <td><?=$item->qty_request?> <?=$item->unit_name?></td>
                                          <td><?=$item->qty_approve?> <?=$item->unit_name?></td>
                                          <td><?=$item->remark?></td>
                                       </tr>
                                       <?php } ?>
                                    </table>
                                 </td>
                              </tr>
                              
                              <tr>
                                <th class="tg-khup">Verifier List</th>
                                    <td class="tg-ywa9" colspan="6">
                                       <table>
                                          <tr>
                                             <th>SL</th>
                                             <th>Verifier Name </th>
                                             <th>Role</th>
                                             <th>Remarks</th>
                                          </tr>
                                          <?php 
                                          $verifier= json_decode($info->approve_reject_user);
                                          foreach($verifier as $value){ 
                                                $sl++;
                                                $this->db->select('first_name');
                                                $this->db->where('id',$value->id);
                                                $query = $this->db->get('users')->row();
                                                $this->db->select('name');
                                                $this->db->where('id',$value->role);
                                                $query2 = $this->db->get('groups')->row();

                                             ?>
                                             <tr>
                                                <td><?=$sl?></td>
                                                <td><?=$query->first_name?></td>
                                                <td><?=$query2->name?></td>
                                                <td><?=$value->Remark?></td>
                                             </tr>
                                             <?php }
                                             ?>
                                          </table>
                                       </td>
                              </tr>
                              <tr>
                                <th class="tg-khup">Approver List</th>
                                    <td class="tg-ywa9" colspan="6">
                                       <table>
                                          <tr>
                                             <th>SL</th>
                                             <th>Approver Name </th>
                                             <th>Role</th>
                                             <th>Remarks</th>
                                          </tr>
                                          <?php 
                                          $sl=0;
                                          $appruver= json_decode($info->final_appruver);
                                          foreach($appruver as $value){ 
                                                $sl++;
                                                $this->db->select('first_name');
                                                $this->db->where('id',$value->id);
                                                $query = $this->db->get('users')->row();

                                                $this->db->select('name');
                                                $this->db->where('id',$value->role);
                                                $query2 = $this->db->get('groups')->row();


                                             ?>
                                             <tr>
                                                <td><?=$sl?></td>
                                                <td><?=$query->first_name?></td>
                                                <td><?=$query2->name?></td>
                                                <td><?=$value->Remark?></td>
                                             </tr>
                                             <?php }
                                             ?>
                                          </table>
                                       </td>
                              </tr>
                              <tr>
                                <th class="tg-khup">Attachment</th>
                                    <td class="tg-ywa9" colspan="6">
                                       <?php if ($info->attachment != '') { ?>
                                          <a href="<?=base_url().'attachment/'.$info->attachment?>" target="_blank" style="cursor:pointer;">Download</a>
                                      <?php } ?>
                                    </td>
                              </tr>

                           </table>
                        </div>
                     </div>

                  </div>  <!-- END GRID BODY -->              
               </div> <!-- END GRID -->
            </div>

         </div> <!-- END ROW -->

      </div>
   </div>