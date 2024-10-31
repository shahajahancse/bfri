<style>
.tiles-container {
    margin-left: 0px;
    margin-right: 0px;
    box-shadow: 0px 0px 7px 1px #adadad;
}
</style>
<div class="page-content">
    <div class="content">


        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

            :root {
                --light: #f6f6f9;
                --primary: #1976D2;
                --light-primary: #CFE8FF;
                --grey: #eee;
                --dark-grey: #AAAAAA;
                --dark: #363949;
                --danger: #D32F2F;
                --light-danger: #FECDD3;
                --warning: #FBC02D;
                --light-warning: #FFF2C6;
                --success: #388E3C;
                --light-success: #BBF7D0;
            }

            .d_card {
                border-radius: 10px;
                padding: 20px;
                margin: 9px 0px;
                box-shadow: 0px 0px 10px 2px darkgrey;
            }
            h5, h4 {
                color: #000000;
                font-weight: bold;
            }

            .c_card {
                border-radius: 10px;
                padding: 5px;
                display: flex;
                margin: 9px 0px;
                cursor: pointer;
                color: #683091;
                box-shadow: 0px 0px 8px 2px #bdbdbd;
                flex-direction: column;
            }
            h4{
                font-weight: bold;
            }

            .c_card:hover {
                box-shadow: 0px 0px 35px 4px #8f8f8f
            }

            .c_cardn {
                border-radius: 10px;
                padding: 5px;
                display: flex;
                margin: 9px 0px;
                cursor: pointer;
                background: linear-gradient(156deg, transparent, transparent);
                box-shadow: 0px 0px 2px 2px #8f8f8f;
                flex-direction: column;
            }

            .c_cardn:hover {
                box-shadow: 0px 0px 35px 4px #8f8f8f
            }

            #floatingDiv {
                height: 247px;
                width: 200px;
                background-image: linear-gradient(141deg, #cdd0ff, #a9f1c3);
                border-radius: 10px;
                padding: 10px;
                z-index: 999;
                overflow-y: scroll;
            }

            .fli {
                list-style: none;
                border: 1px solid;
                width: 174px;
                padding: 6px;
                border-radius: 8px;
                margin-bottom: 4px;
            }

            #floatingDiv::-webkit-scrollbar {
                display: none;

            }
        </style>

        <div class="row">
            <div class='col-md-12'>
                <h2>Dashboard</h2>
                <h4 class="widget-user-username welcome-hrsale-user">
                    Welcome Back,<span style="color: #1976D2"> <?php echo $this->session->userdata('first_name')?>!</span>
                </h4>
            </div>
            <div class='col-md-12 row'>
                <div class="col-md-6">
                    <div class="d_card" style="background: aliceblue;color: #683091;">
                        <h4>Requisition</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="c_card"  onclick="window.location.href = '<?php echo base_url('requisition/index')?>';">
                                    <h5>Total Requisition</h5>
                                    <div class="col-md-12">
                                        <h3 class="count-all-employees col-md-6"><?=$total_data?></h3>
                                        <i class="fa fa-user col-md-6 fa-3x"
                                            style="height: -webkit-fill-available;text-align: -webkit-center;margin: 6px -3px;"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="c_card"  onclick="window.location.href = '<?php echo base_url('requisition/request_list')?>';">
                                    <h5>Pending</h5>
                                    <div class="col-md-12">
                                        <h3 class="count-present col-md-6"><?=$total_pending?></h3>
                                        <i class="fa fa-laptop col-md-6 fa-3x"
                                            style="height: -webkit-fill-available;text-align: -webkit-center;margin: 6px -3px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="c_card" onclick="window.location.href = '<?php echo base_url('requisition/approve_list')?>';">
                                    <h5>Approved </h5>
                                    <div class="col-md-12">
                                        <h3 class="count-absent col-md-6"><?=$total_approve?></h3>
                                        <i class="fa fa-home col-md-6 fa-3x"
                                            style="height: -webkit-fill-available;text-align: -webkit-center;margin: 6px -3px;"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="c_card"  onclick="window.location.href = '<?php echo base_url('requisition/rejected_list')?>';">
                                    <h5>Rejected</h5>
                                    <div class="col-md-12">
                                        <h3 class="count-late col-md-6"><?=$total_rejected?></h3>
                                        <i class="fa fa-clock-o col-md-6 fa-3x"
                                            style="height: -webkit-fill-available;text-align: -webkit-center;margin: 6px -3px;"
                                            class=" col-md-6"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if(!$this->ion_auth->in_group('User')){ ?>

                <div class="col-md-6">
                    <div class="d_card" style="background: aliceblue;color: #683091;">
                        <h4>Purchase</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="c_card"  onclick="window.location.href = '<?php echo base_url('purchase/index')?>';">
                                    <h5>Total Purchase</h5>
                                    <div class="col-md-12">
                                        <h3 class="count-all-employees col-md-6"><?=$total_datap?></h3>
                                        <i class="fa fa-user col-md-6 fa-3x"
                                            style="height: -webkit-fill-available;text-align: -webkit-center;margin: 6px -3px;"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="c_card"  onclick="window.location.href = '<?php echo base_url('purchase/purchase_pending')?>';">
                                    <h5>Pending</h5>
                                    <div class="col-md-12">
                                        <h3 class="count-present col-md-6"><?=$total_pendingp?></h3>
                                        <i class="fa fa-laptop col-md-6 fa-3x"
                                            style="height: -webkit-fill-available;text-align: -webkit-center;margin: 6px -3px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="c_card" onclick="window.location.href = '<?php echo base_url('purchase/purchase_approved')?>';">
                                    <h5>Approved </h5>
                                    <div class="col-md-12">
                                        <h3 class="count-absent col-md-6"><?=$total_approvep?></h3>
                                        <i class="fa fa-home col-md-6 fa-3x"
                                            style="height: -webkit-fill-available;text-align: -webkit-center;margin: 6px -3px;"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="c_card"  onclick="window.location.href = '<?php echo base_url('purchase/purchase_rejected')?>';">
                                    <h5>Rejected</h5>
                                    <div class="col-md-12">
                                        <h3 class="count-late col-md-6"><?=$total_rejectedp?></h3>
                                        <i class="fa fa-clock-o col-md-6 fa-3x"
                                            style="height: -webkit-fill-available;text-align: -webkit-center;margin: 6px -3px;"
                                            class=" col-md-6"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php
        if ($total_data != 0) {
           $percent_pending = ($total_pending / $total_data) * 100;
           $percent_approve = ($total_approve / $total_data) * 100;
           $percent_rejected = ($total_rejected / $total_data) * 100;
        }else{
           $percent_pending = 0;
           $percent_approve = 0;
           $percent_rejected = 0;
        }

        if ($total_datap != 0) {
           $percent_pendingp = ($total_pendingp / $total_datap) * 100;
           $percent_approvep = ($total_approvep / $total_datap) * 100;
           $percent_rejectedp = ($total_rejectedp / $total_datap) * 100;
        }else{
           $percent_pendingp = 0;
           $percent_approvep = 0;
           $percent_rejectedp = 0;
        }
         ?>
                <div class="col-md-6">
                    <div class="d_card" style="background: aliceblue;color: #683091;">
                        <h4>Requisition Statics</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div style="background: transparent;padding-top: 15px;box-shadow: 0px 0px 7px 1px #adadad;margin: 9px;border-radius: 5px;">
                                    <canvas id="myChart" style="width:100%"></canvas>
                                </div>

                                <script>
                                const xValues = [
                                    'Total Pending',
                                    'Total Approve',
                                    'Total Rejected'
                                ];
                                const yValues = [<?=$percent_pending?>, <?=$percent_approve?>, <?=$percent_rejected?>];
                                const barColors = [
                                    "#b91d47",
                                    "#00aba9",
                                    "#2b5797"
                                ];

                                new Chart("myChart", {
                                    type: "pie",
                                    data: {
                                        labels: xValues,
                                        datasets: [{
                                            backgroundColor: barColors,
                                            data: yValues
                                        }]
                                    },
                                    options: {
                                        title: {
                                            display: true,
                                            text: "Requisition Status"
                                        }
                                    }
                                });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if(!$this->ion_auth->in_group('User')){ ?>
                    <div class="col-md-6">
                        <div class="d_card" style="background: aliceblue;color: #683091;">
                            <h4>Purchase Statics</h4>
                            <div class="row">

                                <div class="col-md-12">
                                    <div style="background: transparent;padding-top: 15px;box-shadow: 0px 0px 7px 1px #adadad;margin: 9px;border-radius: 5px;">
                                        <canvas id="myChartp" style="width:100%"></canvas>
                                    </div>
                                    <script>
                                    const xValuesp = [
                                        'Total Pending',
                                        'Total Approve',
                                        'Total Rejected'
                                    ];
                                    const yValuesp = [<?=$percent_pendingp?>, <?=$percent_approvep?>, <?=$percent_rejectedp?>];
                                    // const barColors = [
                                    //     "#b91d47",
                                    //     "#00aba9",
                                    //     "#2b5797"
                                    // ];

                                    new Chart("myChartp", {
                                        type: "pie",
                                        data: {
                                            labels: xValuesp,
                                            datasets: [{
                                                backgroundColor: barColors,
                                                data: yValuesp
                                            }]
                                        },
                                        options: {
                                            title: {
                                                display: true,
                                                text: "Purchase Status"
                                            }
                                        }
                                    });
                                    </script>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php } ?>
          
            </div>
        </div>
    </div>




    <!-- <div class="content">
        <div class="page-title">
            <h3>Welcome to Dashboard<strong>, <?php echo $this->session->userdata('first_name')?></strong></h3>
        </div>

        <div class="row"
        style="box-shadow: 0px 0px 7px 1px #adadad;margin: 8px;padding: 4px;display: flex;flex-wrap: wrap;background: white;border-radius: 5px;">
            <h3><strong>Requisition</strong></h3><br>
            <div class="row" style="width: -webkit-fill-available;">
                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12  m-b-20">
                    <div class="row tiles-container">
                        <div class="col-md-4 no-padding">
                            <div class="tiles red" style="padding:20px;">
                                <i class="fa fa-dashboard" style="font-size: 38px;"></i>
                            </div>
                        </div>
                        <div class="col-md-8 no-padding">
                            <div class="tiles white text-center">
                                <h2 class="semi-bold text-error weather-widget-big-text no-margin"
                                    style="padding-top: 6px; padding-bottom: 6px; "><?=$total_data?></h2>
                                <div class="tiles-title blend m-b-5"><a href="<?=base_url('requisition/index')?>"
                                        style="font-size: 14px;">Total Requisition</a></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12  m-b-20">
                    <div class="row tiles-container">
                        <div class="col-md-4 no-padding">
                            <div class="tiles blue" style="padding:20px;">
                                <i class="fa fa-dashboard" style="font-size: 38px;"></i>
                            </div>
                        </div>
                        <div class="col-md-8 no-padding">
                            <div class="tiles white text-center">
                                <h2 class="semi-bold text-error weather-widget-big-text no-margin"
                                    style="padding-top: 6px; padding-bottom: 6px; "><?=$total_pending?></h2>
                                <div class="tiles-title blend m-b-5"><a href="<?=base_url('requisition/request_list')?>"
                                        style="font-size: 14px;">Total Pending</a></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12  m-b-20">
                    <div class="row tiles-container">
                        <div class="col-md-4 no-padding">
                            <div class="tiles purple" style="padding:20px;">
                                <i class="fa fa-dashboard" style="font-size: 38px;"></i>
                            </div>
                        </div>
                        <div class="col-md-8 no-padding">
                            <div class="tiles white text-center">
                                <h2 class="semi-bold text-error weather-widget-big-text no-margin"
                                    style="padding-top: 6px; padding-bottom: 6px; "><?=$total_approve?></h2>
                                <div class="tiles-title blend m-b-5"><a href="<?=base_url('requisition/approve_list')?>"
                                        style="font-size: 14px;">Total Approve</a></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12  m-b-20">
                    <div class="row tiles-container">
                        <div class="col-md-4 no-padding">
                            <div class="tiles green" style="padding:20px;">
                                <i class="fa fa-dashboard" style="font-size: 38px;"></i>
                            </div>
                        </div>
                        <div class="col-md-8 no-padding">
                            <div class="tiles white text-center">
                                <h2 class="semi-bold text-error weather-widget-big-text no-margin"
                                    style="padding-top: 6px; padding-bottom: 6px; "><?=$total_rejected?></h2>
                                <div class="tiles-title blend m-b-5"><a href="<?=base_url('requisition/rejected_list')?>"
                                        style="font-size: 14px;">Total Rejected</a></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <?php if(!$this->ion_auth->in_group('User')){ ?>

        <div class="row" 
        style="box-shadow: 0px 0px 7px 1px #adadad;margin: 8px;padding: 4px;display: flex;flex-wrap: wrap;background: white;border-radius: 5px;">
            <h3 class="col-md-12"><strong>Purchase</strong></h3> <br>

            <div class="row" style="width: -webkit-fill-available;">
                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12   m-b-20">
                    <div class="row tiles-container">
                        <div class="col-md-4 no-padding">
                            <div class="tiles red" style="padding:20px;">
                                <i class="fa fa-dashboard" style="font-size: 38px;"></i>
                            </div>
                        </div>
                        <div class="col-md-8 no-padding">
                            <div class="tiles white text-center">
                                <h2 class="semi-bold text-error weather-widget-big-text no-margin"
                                    style="padding-top: 6px; padding-bottom: 6px; "><?=$total_datap?></h2>
                                <div class="tiles-title blend m-b-5"><a href="<?=base_url('purchase/index')?>"
                                        style="font-size: 14px;">Total Purchase</a></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12  m-b-20">
                    <div class="row tiles-container">
                        <div class="col-md-4 no-padding">
                            <div class="tiles blue" style="padding:20px;">
                                <i class="fa fa-dashboard" style="font-size: 38px;"></i>
                            </div>
                        </div>
                        <div class="col-md-8 no-padding">
                            <div class="tiles white text-center">
                                <h2 class="semi-bold text-error weather-widget-big-text no-margin"
                                    style="padding-top: 6px; padding-bottom: 6px; "><?=$total_pendingp?></h2>
                                <div class="tiles-title blend m-b-5"><a href="<?=base_url('purchase/purchase_pending')?>"
                                        style="font-size: 14px;">Total Pending</a></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12  m-b-20">
                    <div class="row tiles-container">
                        <div class="col-md-4 no-padding">
                            <div class="tiles purple" style="padding:20px;">
                                <i class="fa fa-dashboard" style="font-size: 38px;"></i>
                            </div>
                        </div>
                        <div class="col-md-8 no-padding">
                            <div class="tiles white text-center">
                                <h2 class="semi-bold text-error weather-widget-big-text no-margin"
                                    style="padding-top: 6px; padding-bottom: 6px; "><?=$total_approvep?></h2>
                                <div class="tiles-title blend m-b-5"><a href="<?=base_url('purchase/purchase_approved')?>"
                                        style="font-size: 14px;">Total Approve</a></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12  m-b-20">
                    <div class="row tiles-container">
                        <div class="col-md-4 no-padding">
                            <div class="tiles green" style="padding:20px;">
                                <i class="fa fa-dashboard" style="font-size: 38px;"></i>
                            </div>
                        </div>
                        <div class="col-md-8 no-padding">
                            <div class="tiles white text-center">
                                <h2 class="semi-bold text-error weather-widget-big-text no-margin"
                                    style="padding-top: 6px; padding-bottom: 6px; "><?=$total_rejectedp?></h2>
                                <div class="tiles-title blend m-b-5"><a href="<?=base_url('purchase/purchase_rejected')?>"
                                        style="font-size: 14px;">Total Rejected</a></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

       
        <style></style>
        <?php
        if ($total_data != 0) {
           $percent_pending = ($total_pending / $total_data) * 100;
           $percent_approve = ($total_approve / $total_data) * 100;
           $percent_rejected = ($total_rejected / $total_data) * 100;
        }else{
           $percent_pending = 0;
           $percent_approve = 0;
           $percent_rejected = 0;
        }

        if ($total_datap != 0) {
           $percent_pendingp = ($total_pendingp / $total_datap) * 100;
           $percent_approvep = ($total_approvep / $total_datap) * 100;
           $percent_rejectedp = ($total_rejectedp / $total_datap) * 100;
        }else{
           $percent_pendingp = 0;
           $percent_approvep = 0;
           $percent_rejectedp = 0;
        }
         ?>
        <div class="row">
            <div class="col-md-6">
                <div style="background: #fff;padding-top: 15px;box-shadow: 0px 0px 7px 1px #adadad;margin: 9px;border-radius: 5px;">
                    <canvas id="myChart" style="width:100%"></canvas>
                </div>

                <script>
                const xValues = [
                    'Total Pending',
                    'Total Approve',
                    'Total Rejected'
                ];
                const yValues = [<?=$percent_pending?>, <?=$percent_approve?>, <?=$percent_rejected?>];
                const barColors = [
                    "#b91d47",
                    "#00aba9",
                    "#2b5797"
                ];

                new Chart("myChart", {
                    type: "pie",
                    data: {
                        labels: xValues,
                        datasets: [{
                            backgroundColor: barColors,
                            data: yValues
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: "Requisition Status"
                        }
                    }
                });
                </script>
            </div>
            <?php if(!$this->ion_auth->in_group('User')){ ?>

            <div class="col-md-6">
                <div style="background: #fff;padding-top: 15px;box-shadow: 0px 0px 7px 1px #adadad;margin: 9px;border-radius: 5px;">
                    <canvas id="myChartp" style="width:100%"></canvas>
                </div>
                <script>
                const xValuesp = [
                    'Total Pending',
                    'Total Approve',
                    'Total Rejected'
                ];
                const yValuesp = [<?=$percent_pendingp?>, <?=$percent_approvep?>, <?=$percent_rejectedp?>];
                // const barColors = [
                //     "#b91d47",
                //     "#00aba9",
                //     "#2b5797"
                // ];

                new Chart("myChartp", {
                    type: "pie",
                    data: {
                        labels: xValuesp,
                        datasets: [{
                            backgroundColor: barColors,
                            data: yValuesp
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: "Purchase Status"
                        }
                    }
                });
                </script>
            </div>

            <?php } ?>
        </div>
    </div> -->
</div>
</div>