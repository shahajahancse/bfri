<div id="myModal" class="modal fade" role="dialog">
    <form id="requisition_form_m">
        <input type="hidden" name="r_ids" id="r_ids">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Send Requisition</h4>
                </div>
                <div class="modal-body" style="background: #f3f5f6;">
                    <div class="col-md-12" style="color: black">
                            <strong>Title</strong>: <span id="r_title"></span>
                    </div>
                    <!-- <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td>Item Name</td>
                                    <td>Quantity</td>
                                    <td>Available</td>
                                    <td>Remark</td>
                                </tr>
                            </thead>
                            <tbody id="r_table_body"></tbody>
                        </table>
                    </div> -->
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <label for="r_desk_id">Send To</label>
                            <select name="r_desk_id" id="r_desk" required >
                                <option value="">Select One</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="r_remark">Remarks</label>
                            <textarea name="r_remark" id="r_remark" class="form-control"
                                style="height: 32px;  width: -webkit-fill-available" ></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-md-12" style="padding: 10px 29px;">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>




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
                        <h4><span class="semi-bold"><?=$meta_title;?></span></h4>
                        <div class="pull-right">
                            <!-- <a href="<?=base_url('my_requisition/create')?>" class="btn btn-blueviolet btn-xs btn-mini"> Create Requisition</a> -->
                        </div>
                    </div>

                    <div class="grid-body ">
                        <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success">
                            <?=$this->session->flashdata('success');?>
                        </div>
                        <?php endif;?>
                        <table class="table table-hover table-condensed dataTable" border="0">
                            <thead>
                                <tr>
                                    <th style="width:10px;"> SL </th>
                                    <th style="width:200px;">Title</th>
                                    <th style="width:200px;">User Name</th>
                                    <th style="width:200px;">ON Desk</th>
                                    <th style="width:100px;">Created</th>
                                    <th style="width:100px;">Updated</th>
                                    <th style="width:50px;">Status</th>
                                    <th style="width:50px;">Urgent status</th>
                                    <th style="width:40px; text-align: right;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                       $sl = $pagination['current_page'];
                                       foreach ($results as $row):
                                          $sl++;

                                          if ($row->status == 2) {
                                             $status = '<span class="label label-success">Approved</span>';
                                          } elseif ($row->status == 3) {
                                          $status = '<span class="label">Rejected</span>';
                                       } else {
                                          $status = '<span class="label label-important">Pending</span>';
                                       }
                                    ?>
                                <?php 
                        $create_at=date('Y-m-d', strtotime($row->created)); 
                        $today_date = date('Y-m-d');
                        $day_diff=abs(strtotime($today_date) - strtotime($create_at));
                        $number_of_days=floor($day_diff/(60*60*24));
                        if($number_of_days > 7) {
                           $colorb = '#ff8686';
                        }elseif($number_of_days > 5) {
                           $colorb = '#ffbc86';
                        }elseif($number_of_days > 3) {
                           $colorb = '#f3f982';
                        }else{
                           $colorb = 'white';
                        }

                        
                        ?>
                                <tr style="background-color:<?=$colorb?>;">
                                    <td><?=$sl . '.'?></td>
                                    <td><?=$row->title;?></td>
                                    <td><?=$row->first_name;?></td>
                                    <td>

                                        <?php
                                          if ($row->desk_id == 0) {
                                             echo 'N/A';
                                          } else {
                                             $this->db->where('id', $row->desk_id);
                                             $desk = $this->db->get('groups');
                                             echo $desk->row()->name;
                                          }
                                          ?>



                                    </td>

                                    <td><?=date('d M, Y h:i A', strtotime($row->created));?>
                                    </td>
                                    <td><?=date('d M, Y h:i A', strtotime($row->updated));?>
                                    </td>
                                    <td> <?=$status?>
                                        <?php
                                          if ($row->is_save ==1) {
                                             echo '<span class="label label-success">Saved</span>';
                                          }
                                    ?>
                                    </td>
                                    <td> <?=($row->urgent_status==1)?'Urgent':'Not Urgent'?></td>

                                    <td align="right">
                                        
                                        <?php if ($row->user_id == $this->session->userdata('user_id')) {?>
                                        <?=anchor("requisition/edite/" . encrypt_url($row->id), 'Edit', array('class' => 'btn btn-info btn-mini'))?>
                                        <?php }?>
                                        <?php if (!$this->ion_auth->in_group('User')) {?>
                                        <?php if ($this->ion_auth->in_group('Store Keeper')) {
                                                 if ($row->desk_id == 0) {
                                          ?>

                                        <?=anchor("requisition/change_status/" . encrypt_url($row->id), 'Approval Status', array('class' => 'btn btn-blueviolet btn-mini'))?>
                                        <button type="button" onclick="get_re_data('<?=$row->id?>')"
                                            class="btn btn-info btn-mini" data-toggle="modal" data-target="#myModal">Send</button>
                                        <?php }} elseif ($roleid == $row->desk_id) {?>
                                            <button type="button" onclick="get_re_data('<?=$row->id?>')"
                                            class="btn btn-info btn-mini" data-toggle="modal" data-target="#myModal">Send</button>
                                        <?=anchor("requisition/change_status/" . encrypt_url($row->id), 'Approval Status', array('class' => 'btn btn-blueviolet btn-mini'))?>
                                        <?php }}?>


                                        <?=anchor("requisition/details/" . encrypt_url($row->id), 'Details', array('class' => 'btn btn-primary btn-mini'))?>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> Total <span
                                    style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Requisition
                                </span></div>
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
<script>
const get_re_data = (id) => {
    $.ajax({
        type: "POST",
        url: "<?=base_url('requisition/get_re_data') ?>",
        data: {
            id: id,
        },
        success: function(data) {
            var data = JSON.parse(data);
            $('#r_desk').empty();
            $('#r_desk').append(data.send_option);
            $('#r_ids').val(id);
            // $('#r_table_body').empty();
            // $('#r_table_body').append(data.items_table);
            $('#r_title').text(data.info.title);
        }
    })
}
</script>
<script>
    $('#requisition_form_m').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "<?=base_url('requisition/send_requisition') ?>",
            data: $('#requisition_form_m').serialize(),
            success: function(data) {
                $('#myModal').modal('toggle');

                if (data == 'success') {

                    showMessage('success', 'Requisition sent successfully')

                }else{
                    showMessage('error', 'Something went wrong')

                }
            },
            error: function(data) {
                $('#myModal').modal('toggle');
                showMessage('error', 'Something went wrong')
            }
        })
    })

</script>