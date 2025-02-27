<div class="page-content">
   <div class="content">
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="javascript:void()" class="active"> <?=$module_name?> </a></li>
         <li> <?=$meta_title;?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <a href="<?=base_url('my_requisition/create')?>" class="btn btn-blueviolet btn-xs btn-mini"> Create Requisition</a>
                  </div>
               </div>

               <div class="grid-body ">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>
                  <table class="table table-hover table-condensed" border="0">
                     <thead>
                        <tr>
                           <th> SL </th>
                           <th>Title</th>
                           <th>PIN Code</th>
                           <th>Created</th>
                           <th>Status</th>
                           <th style="text-align: right;">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        $sl=$pagination['current_page'];
                        foreach ($results as $row): $sl++;
                           $status = '<span class="label label-secondary">Draft</span>';
                           if ($row->status == 2) {
                                 $status = '<span class="label label-warning">On process</span>';
                           }else if($row->status == 3){
                                 $status = '<span class="label label-primary">Forward SM</span>';
                           }else if($row->status == 4){
                                 $status = '<span class="label label-info">Back User From JD</span>';
                           }else if($row->status == 5){
                                 $status = '<span class="label label-info">Back User From DG</span>';
                           }else if($row->status == 6){
                                 $status = '<span class="label label-blueviolet">Approve JD</span>';
                           }else if($row->status == 7){
                                 $status = '<span class="label label-warning">Back JD From DG</span>';
                           }else if($row->status == 8){
                                 $status = '<span class="label label-success">DG Approve</span>';
                           }else if($row->status == 9){
                                 $status = '<span class="label label-important">Rejected</span>';
                           }else if($row->status == 10){
                                 $status = '<span class="label label-primary">Delivery </span>';
                           }
                        ?>
                        <tr>
                           <td class="v-align-middle"><?=$sl.'.'?></td>
                           <td class="v-align-middle"><?=$row->title; ?></td>
                           <td class="v-align-middle"><?=$row->pin_code; ?></td>
                           <td class="v-align-middle"><?=date('d-m-Y', strtotime($row->created_at)); ?> </td>
                           <td> <?=$status?></td>
                           <td align="right">
                              <div class="btn-group">
                                 <a class="btn btn-success dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                                 <ul class="dropdown-menu pull-right">
                                    <?php if($userDetails['user_info']->id==$row->user_id && in_array($row->status,array(1,4,5))){ ?>
                                    <li><a href="<?=base_url('my_requisition/edit/'.$row->id)?>"> Edit</a> </li>
                                    <?php } ?>

                                    <?php if($this->ion_auth->in_group(array('badmin','sm'))&& $row->status==2){ ?>
                                    <li><a href="<?=base_url('requisition/ap_status/'.$row->id)?>"> Approval</a> </li>
                                    <?php } ?>

                                    <?php if($this->ion_auth->in_group(array('badmin','jd'))&&in_array($row->status,array(3,7))){ ?>
                                    <li><a href="<?=base_url('requisition/ap_status/'.$row->id)?>"> Approval</a> </li>
                                    <?php } ?>

                                    <?php if($this->ion_auth->in_group(array('badmin','dg'))&& $row->status==6){ ?>
                                    <li><a href="<?=base_url('requisition/ap_status/'.$row->id)?>"> Approval</a> </li>
                                    <?php } ?>

                                    <?php if($this->ion_auth->in_group(array('badmin','sm'))&& $row->status==8){ ?>
                                    <li><a href="<?=base_url('requisition/received/'.$row->id)?>"> Delivery</a> </li>
                                    <?php } ?>

                                    <li><a href="<?=base_url('my_requisition/details/'.$row->id)?>"> Details</a> </li>
                                 </ul>
                              </div>
                           </td>
                        </tr>
                     <?php endforeach;?>
                  </tbody>
               </table>

               <div class="row">
                  <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Requisition </span></div>
                  <div class="col-sm-8 col-md-8 text-right">
                     <?php echo $pagination['links']; ?>
                  </div>
               </div>

            </div>

         </div>
      </div>
   </div>

</div> <!-- END Content -->

</div>
